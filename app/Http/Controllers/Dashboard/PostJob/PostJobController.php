<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\PostJob;
use App\CandidateInfo;
use App\EmployerProfile;
use App\Educational;
use App\CandidateExperience;
use App\JobQquestions;
use Socialite;
use Session;
use Mail;
use App\Country;
use App\City;
use auth;
use App\Job;

use Illuminate\Support\Facades\Hash;
class PostJobController extends Controller
{


        //SHOW JOBS
        public function index(PostJob $job)
        { 
        $jobs = $job->paginate(10);
        return view('Dashboardadmin.Postjob.postjob_index',compact('jobs'));

        }
    
    


        //search in postjob
        public function search(Request $request) 
        {
            $posts = PostJob::where('job_for', 'LIKE', '%' . $request->s . '%')
            ->orWhere('job_id', 'LIKE', '%' . $request->s . '%')
            ->orWhere('created_by', 'LIKE', '%' . $request->s . '%')
            ->orWhere('created_at', 'LIKE', '%' . $request->s . '%');
        
        
            $posts =$posts->get();
            //dd($posts);
            $post1 = Job::where('name', 'LIKE', '%' . $request->s . '%');
            
            $post1 =$post1->get();
        // dd($post1);
        
            return view('Dashboardadmin.Postjob.search_index', compact('posts','post1'));
        }


        //delete post 
        public function destroy($id, PostJob $job) 
        {
            
           $userid=PostJob::where('id',$id)->select('created_by')->first();

           $uid=$userid->created_by;
            $user=User::find($uid)->delete();
            $job->find($id)->delete();
        
       return redirect('/adminpanel/postjob')->withFlashMessage('JOB deleted correctly ');

         }



    //delete more row at once
    public function deleteid(Request $request) 
    {
      
        $delid=$request->input('delid');
        //dd($delid);
        $userid=PostJob::wherein('id',$delid)->select('created_by')->get();
        // dd($userid);
         User::whereIn('id', $userid)->delete();
        
        PostJob::whereIn('id', $delid)->delete();
    
        return redirect('/adminpanel/postjob')->withFlashMessage('JOB Deleted Correctly ');

    }


    //ADD FORM 
    public function Create(Request $request)
    {
        return view('Dashboardadmin.Postjob.create_account');
    }

    public function add(Request $request)
    {
        // return $request->all();
        $this->validate($request,[

        'job_id'=>'required',
        'industry_id'=>'required',
        'country_id'=>'required',
        'job_for'=>'required',
        'name'=>'required',
        'phone'=>'required',
        'email'=>'required|email|unique:users',
        'password'=>'required',
    
        ]);



        $code = 1000;
            $points=0;

            $countcoins=['name'=>$request['name'],
            'email'=>$request['email'],
            'password' => bcrypt($request['password']),
            'last_name'=>$request['last_name'],
            'job_for'=>$request['job_for'],
            'country_id'=>$request['country_id'],
        
    ];
    //dd($countcoins);
    foreach ( $countcoins as   $value) {

        if($value != null && $value !="0")
        {

            $points ++;
        }

    }
    $totalpoints=$points*5;
        

        $lastUser =  \DB::table('users')->orderBy('id', 'desc')->first();
            if($lastUser)
            {
                $code = $lastUser->code++;
            }

            $user = User::create(['name'=>$request['name'],
            'email'=>$request['email'],
            'password' => bcrypt($request['password']),
            'type'=>'employer','code'=>$code]);
            
            $input = $request->all();
            unset($input['name'],$input['email'],$input['password']);
            $input['created_by']= $user->id;
            $job=PostJob::create($input);
            if($user)
            {
                EmployerProfile::create(['type'=>$request['job_for'],
                'first_name'=>$request['name'],
                'last_name'=>'.',
                'user_id'=>$user->id,
                'coins'=>$totalpoints]);
            }

        
        
        

        if($request['language_ids'])
        {
            foreach ($request['language_ids'] as $key => $lang) {
                # code...
                \App\JobLanguage::create(['language_id'=>$lang,'job_id'=>$job->id]);
            }
        }
        if($request['skill_ids'])
        {
            foreach ($request['skill_ids'] as $key => $skill) {
                # code...
                \App\UserSkill::create(['user_id'=>$job->id, 'user_id'=>$skill])
                ;
            }
        }
        \App\Company::create(['name'=>$request['name'],'size'=>'5',
        'country_id'=>$request['country_id'],'lat'=>'0','lang'=>'0',
        'created_by'=>$user->id,'industry_id'=>0]);

        
        return Redirect()->back()->withFlashMessage('Job Added correctly');
    }
       
    
    //EDIT FORM
     public function edit( PostJob $job ,$id) 
     {
        $data = $job->find($id);
        return view('Dashboardadmin.Postjob.edit', compact('data'));

     }



        //update postjob
        public function update(Request $request, $id) 
        {
        
        try
        {

            $this->validate($request,[

                'job_id'=>'required',
                'industry_id'=>'required',
                'country_id'=>'required',
                'job_for'=>'required',
                'name'=>'required',
                'phone'=>'required',
                'email'=>'required|email|unique:users',
            
        
                ]);
                
        $code = 1000;
            $points=0;

            $countcoins=['name'=>$request['name'],
            'email'=>$request['email'],
            'password' => bcrypt($request['password']),
            'last_name'=>$request['last_name'],
            'job_for'=>$request['job_for'],
            'country_id'=>$request['country_id'],
        
    ];
    //dd($countcoins);
    foreach ( $countcoins as   $value) {

        if($value != null && $value !="0")
        {

            $points ++;
        }

    }
    $totalpoints=$points*5;

            $lastUser =  \DB::table('users')->orderBy('id','desc')->first();
            //dd($lastUser);
            if($lastUser)
            {
                $code = $lastUser->code++;
            }


            $userid=PostJob::where('id',$id)->select('created_by')->first();
     
            

    $user = user::find($uid);
            //dd($user);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
        $user->type = 'employer';
            $user->code=$code;
        $user->save();
            

    
            $job = PostJob::find($id);
        
            $job->job_id = $request->job_id;
            $job->job_for = $request->job_for;
            $job->num_of_candidates = $request->num_of_candidates;
            $job->phone = $request->phone;
            $job->created_by= $uid;
            $job->country_id = $request->country_id;
            $job->min_salary = $request->min_salary;
            $job->max_salary = $request->max_salary;
            $job->min_salary = $request->min_salary;
            $job->currency_id = $request->currency_id;
            $job->prefered_gender = $request->prefered_gender;
            $job->job_requirements = $request->job_requirements;
            $job->industry_id = $request->industry_id;
            $job->availability = $request->availability;
            $job->job_descripton = $request->job_descripton;
        
            
            $job->save();

    // $employer = EmployerProfile::find($id);
        //dd( $employer);
        //$employer->type = $request->job_for;
        //$employer->first_name = $request->name;
        //$employer->user_id = $uid;
        //$employer->coins = $totalpoints;
        //$employer->save();
        
        

        
            

            return Redirect()->back()->withFlashMessage('Job updated correctly');
            
        }    
        catch(Exception $e) 
            {
            return redirect('/');
            }
        }
   

        //MAIDHELPER ASS FORM
        public function CreateMaidhelper(Request $request)
        {
            return view('Dashboardadmin.Postjob.create_maidhelper');
        }


        //STOR MAID
        public function addmaidhelper(Request $request)
        {
            // return $request->all();
            $this->validate($request,[

            'job_id'=>'required',
            'industry_id'=>'required',
            'country_id'=>'required',
            
            
        
            ]);

            
                $input = $request->all();
                unset($input['name'],$input['email'],$input['password']);
                $input['created_by']=1858 ;
                $job=PostJob::create($input);
         

            if($request['language_ids'])
            {
                foreach ($request['language_ids'] as $key => $lang) {
                    # code...
                    \App\JobLanguage::create(['language_id'=>$lang,'job_id'=>$job->id]);
                }
            }
            if($request['skill_ids'])
            {
                foreach ($request['skill_ids'] as $key => $skill) {
                    # code...
                    \App\UserSkill::create(['1858 '=>$job->id, '1858 '=>$skill])
                    ;
                }
            }
            
            
            return Redirect()->back();
        }
            


       //post questions
        public function edit2( PostJob $job ,$id) 
        {    
            $data2 = $job->find($id);
            return view('Dashboardadmin.Postjob.create_question', compact('data2'));

        }

        //ADDING QUESTION
        public function addQuestion( PostJob $id)
        {
      
           JobQquestions::create([

            'question'=>request('question'),
            'weight'=>request('weight'),
            'post_job_id'=>$id->id]);
            
            
            return Redirect()->back()->withFlashMessage('Question Added correctly');
        }
            

    
    
}
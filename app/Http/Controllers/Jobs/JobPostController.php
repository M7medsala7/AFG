<?php

namespace App\Http\Controllers\Jobs;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PostJob;
use App\JobLanguage;
use App\SuccessStories;
use App\EmployerProfile;
use Auth;
use DB;
use Session;
use App\User;
use App\CandidateInfo;
class JobPostController extends Controller
{
    
    public function create()
    {
    	return view('employer.post_job');
    }


    //job likes
    public function likejob($id)
    {

        try
        {
        if(\Auth::user()==null)
                {
                    return redirect('/login');
                }
                else
                {
                    $post_job=PostJob::find($id);
                    $Like=DB::table('user_like_jobs')
                    ->where('job_id',$id)
                    ->where('user_id',\Auth::user()->id)
                    ->first();

                    if($Like==null)
                    {
                    $post_job->likejob()->attach($id,['user_id'=>\Auth::user()->id]);
                    }
                    else
                    {

                    $post_job->likejob()->detach(['user_id'=>\Auth::user()->id]);

                    }
                    $link='/ViewJob/'.$id; 
                    return redirect ($link);           


            }
        }
        catch(Exception $e) 
        {
         return redirect('/');
         }   

    }

            public function ApplyOk()
            {

                    if(\Auth::user()==null)
                    {
                    return redirect('/login');
                    }
                    else
                    {
                    return redirect ('/home');
                    }

            }
             

            //apply job
            public function ApplyJob($id)
            {
                try
               { 

                    if(\Auth::user()==null)
                    {
                    return redirect('/login');
                    }
                    else
                    {
                    //Record in apply job
                    $post_job=PostJob::find($id);

                    $getApplied=DB::table('job_applications')->where('job_post_id',$id)
                    ->where('user_id',\Auth::user()->id)->first();

                    if($getApplied == null)
                    {

                        if(Auth::user()->type=="employer")
                        {
                        Session::flash('flash', "you employer,you must register as candidate ".'<a href="/register/candidates">View cart</a>');
                        
                        $link='/ViewJob/'.$id;
                        return redirect ($link);
        
                    }
                        else
                        {
                        $post_job->applicants()->attach($id,['user_id'=>\Auth::user()->id]);
                        Session::flash('flash_message', 'Applied Sucessfully');
                        if($post_job->link == null) 
                        {
                        $link='/ViewJob/'.$id;
            
                        }
                        else
                        {
                        $link=$post_job->link;
                        }
                        return redirect ($link);
                        }

                    }
                    else
                    {
                    Session::flash('flash_message', 'you already applied thanks');
                    }
            //if indeed

        }
    }
    catch(Exception $e) 
    {
     return redirect('/');
     }
        
    }
    

    //logout and register
    public function logoutandregister()
    {
        auth()->logout();
        return redirect('/register/candidates');
        
    }
    


    public function store(Request $request)
    {
         

        try
        {
                $this->validate($request,[
                    'job_id'=>'required',
                    'industry_id'=>'required',
                    'country_id'=>'required',
                    ]);
                $input= $request->all();
                $input['job_for']=\Auth::user()->employer->type;
                unset($input['skill_ids'],$input['language_ids']);
                $input['created_by']= \Auth::user()->id;
                $job = PostJob::create($input);
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
                        \App\JobSkill::create(['job_id'=>$job->id, 'skill_id'=>$skill])
                        ;
                    }
                }
                
                return redirect('/home');
    }
    catch(Exception $e) 
    {
     return redirect('/');
     }
    }



    public function getCandidatedStarredJob(Request $request)
    {
        try
        {

                $job_id = $request['jobId'];
                $job = PostJob::find($job_id);
                if($job)
                {
                    $topCandidates = $job->starred()->paginate(6);
                }
                else
                {
                    $topCandidates = null;
                }
                $html = view('employer.starred',compact('topCandidates'))->render();
                $number_of_pages = ceil(count($job->starred)/6);
                $urls = [];
                for ($i=1; $i <= $number_of_pages ; $i++) { 
                    # code...
                    array_push($urls,'/next_can/'.$job->starred->take(6*$i)->last()->id);
                }
                

                return [$html,$number_of_pages,$urls];
    }
    catch(Exception $e) 
    {
     return redirect('/');
     }

    }


    public function getNextCan(Request $request,$id)
    {
        try
        {
                $job_id = $request['job_id'];
                $job = PostJob::find($job_id);
                if($job)
                {
                    $topCandidates = $job->starred->where('id','>',$id)->take(6);
                }
                else
                {
                    $topCandidates = null;
                }
                $html = view('employer.starred',compact('topCandidates'))->render();
                return $html;

    }
    catch(Exception $e) 
    {
     return redirect('/');
     }

    }


    public function getApplicants(Request $request)
    {
        try
        {
                $job_id = $request['jobId'];
                $job = PostJob::find($job_id);
                if($job)
                {
                    $topCandidates = $job->applicants->take(4);
                }
                else
                {
                    $topCandidates = null;
                }
                $html = view('employer.starred',compact('topCandidates'))->render();
                $number_of_pages = ceil(count($job->starred)/6);
                $urls = [];
                for ($i=1; $i <= $number_of_pages ; $i++) { 
                    # code...
                    array_push($urls,'/next_applicants/'.$job->starred->take(6*$i)->last()->id);
                }
                

                return [$html,$number_of_pages,$urls];
    }
    catch(Exception $e) 
    {
     return redirect('/');
     }

    }


    public function getNextApplicants(Request $request, $id)
    {
        try
        {
                $job_id = $request['job_id'];
                $job = PostJob::find($job_id);
                if($job)
                {
                    $topCandidates = $job->applicants->where('id','>',$id)->take(6);
                }
                else
                {
                    $topCandidates = null;
                }
                $html = view('employer.starred',compact('topCandidates'))->render();
                return $html;
    }
    catch(Exception $e) 
    {
     return redirect('/');
     }

    }



    public function ViewJob($id)
    {
        
        try
        {
            $job = PostJob::where('id',$id)->first(); 
            $Skilljob=DB::table('job_skills')
                ->join('skills','skills.id','job_skills.skill_id')
                ->where('job_id',$id)->get();

                $jobforcompany = PostJob::where('created_by',$job->created_by)->get();
                $jobCan=null;
                $color='black';
                // Like or Not 

            if(Auth::user() !=null)
            {
            $Like=DB::table('user_like_jobs')
                                ->where('job_id',$id)
                                ->where('user_id',\Auth::user()->id)
                                ->first();
                        if($Like!=null)
                        {
                        $color='red';
                        
                        }
            }
                if(Auth::user() !=null && Auth::user()->CanInfo !=null)
                {
                    $jobCan=PostJob::where('job_id',Auth::user()->CanInfo->job_id)->get();

                
                    


                }
                return view('Arabic.Jobs.ViewJob',compact('job','jobforcompany','jobCan','color','Skilljob'));
            }
            catch(Exception $e) 

            {

            return redirect('/');

            }
   
    }








    public function empolyerCount(Request $request)
    {
       try
       {

            $id=$request->selected;
            $resultQuery=CandidateInfo::join('nationalities','nationalities.id','candidate_infos.nationality_id')
            ->where('candidate_infos.job_id',$id)
            ->select( DB::raw('count(candidate_infos.nationality_id) as count ,nationalities.name') )
            ->groupBy('candidate_infos.nationality_id')->get();

            $dataresult=[];
            foreach ($resultQuery as $resultQu) {
                                                    array_push($dataresult,array(
                                                    'label' => $resultQu->name,
                                                    'y' => $resultQu->count
                                                    ));
                                                
                                                }
            return Response::json($dataresult,  200, [], JSON_NUMERIC_CHECK);
        }
        catch(Exception $e) 

        {

        return redirect('/');

        }



    }


    
   


}

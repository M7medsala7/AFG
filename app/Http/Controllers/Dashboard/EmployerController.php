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
use App\Notifications\Employer;
use App\Notifications;


use Carbon\Carbon;
use Socialite;
use Session;
use Mail;
use App\Country;
use App\SuccessStories;
use App\City;
use App\auth;
use Illuminate\Support\Facades\Hash;
class EmployerController extends Controller
{


            //show employer informations 
            public function index(EmployerProfile $employer) 
            {
            
                $employers = $employer->orderBy('created_at','DESC')->paginate(8);
            
                return view('Dashboardadmin.Employer.employer_index', compact('employers'));
            }




            //search in employer
            public function search(Request $request) 
            {
            

                $emp = EmployerProfile::where('first_name', 'LIKE', '%' . $request->s . '%')
            
                ->orWhere('id', 'LIKE', '%' . $request->s . '%')
                ->orWhere('user_id', 'LIKE', '%' . $request->s . '%')
                ->orWhere('created_at', 'LIKE', '%' . $request->s . '%')
                ->orWhere('address', 'LIKE', '%' . $request->s . '%')
                ->orWhere('type', 'LIKE', '%' . $request->s . '%');
            
                $emp =$emp->get();
            
            
                return view('Dashboardadmin.Employer.search_index', compact('emp'));
            }
    



             //delete employer
            public function destroy($id, EmployerProfile $employer)
             {
             
                $userid=EmployerProfile::where('id',$id)->select('user_id')->first();

                $uid=$userid->user_id;
                $user=User::find($uid)->delete();
                $employer->find($id)->delete();
            
                return redirect('/adminpanel/employer')->withFlashMessage('Employer deleted correctly ');

            }

            //delete more rows
            public function deleteid(Request $request) 
            {
                

               $delid=$request->input('delid');

              $userid=EmployerProfile::wherein('id',$delid)->select('user_id')->get();
           
              User::whereIn('id', $userid)->delete();
              EmployerProfile::whereIn('id', $delid)->delete(); 
          
               return redirect('/adminpanel/employer')->withFlashMessage('Employer deleted correctly ');

            }


            //create employer form 
            public function CreateEmployer(Request $request)
            {
                return view('Dashboardadmin.Employer.create_account');
            }



            //store employer
            public function add(Request $request)
            {
            
            try
            {  
                $request->validate([
                    'first_name' => 'max:255|min:1',
                    'last_name' => 'max:255|min:1',
                    'email' => 'unique:users|max:255|min:1',
                    'password' => 'required|max:255',
                ]);
                $code = 1000;
                $points=0;

                $countcoins=['name'=>$request['first_name'],
                'email'=>$request['email'],
                'password' => bcrypt($request['password']),
                'last_name'=>$request['last_name'],
                'job_for'=>$request['job_for'],
                'country_id'=>$request['country_id'],
                'city_id'=>$request['city_id'], ];

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
                //dd($code);
                $userdata = [
                    'name' => $request->first_name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'type'=>'employer',
                    'code'=>$code,];
            
                $usernew = new User;
                $usernew=User::create($userdata);

                //dd($usernew->id);
                if($usernew)
                {
                $empdata = [
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'address' => $request->address,
                    'type'=>$request->job_for,
                    //'city_id'=>$cityQuery->id,
                    'country_id'=>$request->country_id,
                    'city_id'=>$request->city_id,
                    'coins'=>$totalpoints,
                    'user_id'=>$usernew->id, ];
        
                }
                $emp = new EmployerProfile;
                $emp->create($empdata);
                auth()->user()->notify(new Employer($emp));
                //Notification::route('mail','Social@maidandhelper.com')->notify(new Employer($emp));
                \App\Company::create(['name'=>$request['first_name'],'size'=>'5','country_id'=>$request['country_id'],'lat'=>'0','lang'=>'0','industry_id'=>0]);


                return Redirect()->back()->withFlashMessage('employr added correctly');
            }    
            catch(Exception $e) 
                {
                return redirect('/');
                }
            }


            
            //edite form
            public function edit( EmployerProfile $employers ,$id)
             {
                $data = $employers->find($id);
                // dd($data);
                return view('Dashboardadmin.Employer.edit', compact('data','user'));

            }

    
            //update employer information 
            public function update(Request $request, $id) 
            {
            
            try
            {

                $request->validate([
                    'first_name' => 'max:255|min:1',
                    'last_name' => 'max:255|min:1',
                    'email' => 'unique:users|max:255|min:1',
                    'password' => 'required|max:255',
                ]);
            
            
                $code = 1000;
                $points=0;

                $countcoins=['name'=>$request['first_name'],
                'email'=>$request['email'],
                'password' => bcrypt($request['password']),
                'last_name'=>$request['last_name'],
                'job_for'=>$request['job_for'],
                'country_id'=>$request['country_id'],
                'city_id'=>$request['city_id'], ];
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
                $userid=EmployerProfile::where('id',$id)->select('user_id')->first();
                $uid=$userid->user_id;
                //dd($uid);
               
                

                $user = user::find($uid);
                //dd($user);
                $user->name = $request->first_name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->type = 'employer';
                $user->code=$code;
                $user->save();
                
            
                $employer = EmployerProfile::find($id);
            
                $employer->first_name = $request->first_name;
                $employer->last_name = $request->last_name;
                $employer->address = $request->address;
                $employer->type = $request->job_for;
                $employer->user_id= $uid;
                $employer->country_id = $request->country_id;
                $employer->city_id = $request->city_id;
                $employer->coins = $totalpoints;
                
                $employer->save();
                
                $company=\App\Company::find($id);
                $company->name = $request->first_name;
                $company->country_id = $request->country_id;
                $company->industry_id = 0;
                $company->lang = '0';
                $company->lat = '0';
                $company->size = '5';
                $company->save();
        

                return Redirect()->back()->withFlashMessage('Employer updated correctly');
                
            }    
            catch(Exception $e) 
                {
                return redirect('/');
                }
            }

            //create employer story form 
            public function CreateStory(Request $request)
            {
                return view('Dashboardadmin.Employer.createstory');
            }


             //store employer success story
             public function addstorys(Request $request)
             {
             
             try
             {  
                 $request->validate([
                     'first_name' => 'max:255|min:1',
                     'last_name' => 'max:255|min:1',
                     'email' => 'unique:users|max:255|min:1',
                     'password' => 'required|max:255',
                  
                 ]);

                 $logo = "";
    
               
             
                 //dd($code);
                 $userdata = [
                     'name' => $request->first_name,
                     'email' => $request->email,
                     'password' => Hash::make($request->password),
                     'type'=> 'employer',
                    
                     ];
             
                 $usernew = new User;
                 $usernew=User::create($userdata);

                 if($request->hasFile('logo'))
                 {
                     $logo = $this->saveUploadedFile($request['logo'],$usernew);
                     $usernew->logo=$logo;
                     $usernew->save();
         
                 }

               
                $asd=$usernew->id;
 
                // dd($asd);
               
                 $empdata = [
                     'first_name' => $request->first_name,
                     'last_name' => $request->last_name,
                
                     'type'=>$request->job_for,
                   
                     'user_id'=>$asd, ];
         
             
                 $emp = new EmployerProfile;
                 $emp=EmployerProfile::create($empdata);
                
               
                 $emp_id=$emp->id;
               // dd($emp_id);
                 $successstory = [
                     'description' => $request->description,
                     'job_id'=>$request['job_id'],
                     'emp_id'=>$emp_id,
                     'approval'=>1,
                     'user_id'=>$asd ];
         
               
                 $story = new SuccessStories;
                 $story=SuccessStories::create($successstory);


                 \App\Company::create(['name'=>$request['first_name'],'size'=>'5','country_id'=>$request['country_id'],'lat'=>'0','lang'=>'0','industry_id'=>0]);

                 return Redirect()->back()->withFlashMessage('Success Story added correctly');
             }    
             catch(Exception $e) 
                 {
                 return redirect('/');
                 }
             }


             public function saveUploadedFile($file, $user)
             {
                     $filename = time().$file->getClientOriginalName();
                     $type = $file->getMimeType();
                     $extension = $file->getClientOriginalExtension();
                     $path = 'uploads/'.$user->id;
                     $destPath = 'uploads/'.$user->id.'/'.$filename;
                     if(!\File::exists($path)) {
                         // path does not exist
                         \File::makeDirectory($path, $mode = 0777, true, true);
                     }
                     $success =$file->move($path,$filename);
                 // $destPath = str_replace(public_path(), "", $destPath);
                     return $destPath;
             }


             //create Story form 
              public function addstory(EmployerProfile $employer ,$id) 
             {    
                 $data2 = $employer->find($id);
                 return view('Dashboardadmin.Employer.create_story', compact('data2'));
     
             }
   
             //stor success story of employer
             public function SuccessStory(Request $request, $id)
             {
               $userid=EmployerProfile::where('id',$id)->select('user_id')->first();
              
               $uid=$userid->user_id;
               
              // dd( $uid);
               SuccessStories::create([
     
                 'description'=>request('description'),
                 'job_id'=>request('job_id'),
                 'emp_id'=>$id,
                 'approval'=>1,
                 'user_id'=>$uid]);


                 $user = user::find($uid);
               
                 $user->type = 'employer';
              
                 $user->save();

                if($request->hasFile('logo'))
                {
                    $logo = $this->saveUploadedFile($request['logo'],$user);
                    $user->logo=$logo;
                    $user->save();
        
                }
                 
                 return Redirect()->back()->withFlashMessage('Story Added correctly');
             }

              //update stories approval  
            public function updateStory(Request $request) 
            {
            
            try
            {
               $SuccessStories = SuccessStories::find($request['id']);
                $SuccessStories->approval =$request['active'];
                $SuccessStories->save();
               // return Redirect()->back()->withFlashMessage(' Approval Added');
            }

            catch(Exception $e) 
            {
            return redirect('/');
            }
        }
        
        
}

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
use App\Notifications\Candidate_notification;
use App\Notification;
use Carbon\Carbon;
use App\Educational;
use App\CandidateExperience;
use Socialite;
use Session;
use App\SuccessStories;
use Hash;
use Auth;
class CandidatesController extends Controller
{  

        public function showpanel()
        {
          
                if (Auth::check()) {
                 return view('Dashboardadmin.home.index');
                }
                    
        else{
         return redirect('/login');
            }
        }

          //add story form
          public function addstory(CandidateInfo $can ,$id) 
          {    
              $data2 = $can->find($id);
              return view('Dashboardadmin.Candidates.create_story', compact('data2'));
  
          }

          //stor success story of candiades
          public function SuccessStory(Request $request, $id)
          {
            $userid=CandidateInfo::where('id',$id)->select('user_id')->first();
           
            $uid=$userid->user_id;
           // dd( $uid);
            SuccessStories::create([
  
              'description'=>request('description'),
              'can_id'=>$id,
              'approval'=>1,
              'user_id'=>$uid]);
              
              return Redirect()->back()->withFlashMessage('Story Added correctly');
          }

        //show candidates
        public function index(CandidateInfo $cans)
        { 
            $candidates = $cans->orderBy('created_at','Desc')->paginate(8);
            $user = User::paginate(3);
            return view('Dashboardadmin.Candidates.candidates_index' ,compact('candidates','user'));   
        
        }


        //search in candidates
        public function search(Request $request) 
        {
        
            $can = CandidateInfo::where('user_id', 'LIKE', '%' . $request->s . '%')
            ->orWhere('visa_type', 'LIKE', '%' . $request->s . '%')
            ->orWhere('last_name', 'LIKE', '%' . $request->s . '%')
            ->orWhere('descripe_yourself', 'LIKE', '%' . $request->s . '%')
            ->orWhere('created_at', 'LIKE', '%' . $request->s . '%');
        
            $can =$can->get();
             // dd( $emp);
        
            return view('Dashboardadmin.Candidates.search_index', compact('can'));
        }


        //delete candidate one by one
        public function destroy($id, CandidateInfo $cans) 
        {
            $userid=CandidateInfo::where('id',$id)->select('user_id')->first();

            $uid=$userid->user_id;
            $user=User::find($uid)->delete();
            $cans->find($id)->delete();
            return redirect('/adminpanel/candidate')->withFlashMessage(' deleted correctly ');

        }


        //delete from more rows at once
        public function deleteid(Request $request) 
        {
            $delid=$request->input('delid');
            
            $userid=CandidateInfo::wherein('id',$delid)->select('user_id')->get();
           // dd($userid);
            User::whereIn('id', $userid)->delete();
            
            CandidateInfo::whereIn('id', $delid)->delete();
        
            return redirect('/adminpanel/candidate')->withFlashMessage('Candidates Deleted Correctly ');
    
        }

     
        //create candidates form
        public function CreateCandidates(Request $request)
        {
            return view('Dashboardadmin.Candidates.create_account');
        }

        //edite form
        public function edit( CandidateInfo $can ,$id) 
        {
            
            $data=$can->find($id);
            return view('Dashboardadmin.Candidates.edit', compact('data'));
        
        }


        //store candidates
        public function add(Request $request)
        {
        
        try
        {  
            $this->validate($request,[
                'first_name'=>'required',
                'email' => 'email|required|unique:users',
                'gender' =>'required',
                'visa_type'=>'required',
                'looking_for_job'=>'required',
            
                ]);

                /***
        ***increment code for the new user***
        ***/
        $videopoint=0;
        $logopoint=0;
        $cvgpoint=0;
        $skillpoint=0;
        $langpoint=0;
        $edupoint=0;
        $points=0;
            $code = 1000;
        
            //get the code value;
            $lastUser =  \DB::table('users')->orderBy('id', 'desc')->first();
            if($lastUser)
            {
                $code = $lastUser->code++;
            }
        //*code generated*/


        //**create user
            $user = User::create(['name'=>$request['first_name'],
            'email'=>$request['email'],
            'password' => bcrypt($request['password']),
            'type'=>'candidate',
            'code'=>$code]);

            //**user created
            $video_path = Session::get('VideoPath');
            $cv_path = "";
            $logo = "";
    
            if($request->hasFile('logo'))
            {
                $logo = $this->saveUploadedFile($request['logo'],$user);
                $user->logo=$logo;
                $user->save();
    
                $logopoint=10;
            }
            if($request->hasFile('video_file'))
            {
                $video_path = $this->saveFile($request['video_file'],$user);
                $videopoint=30;
            }
            if($request->hasFile('cv_path'))
            {
                $cv_path = $this->saveUploadedFile($request['cv_path'],$user);
    
                $cvgpoint=10;
            }
        
            if($request['language_ids'])
            {
                foreach ($request['language_ids'] as $key => $lang) {
                    # code...
                    \App\UserLanguage::create(['language_id'=>$lang,'user_id'=>$user->id]);
                }
                $langpoint=5;
            }
            if(count($request['skill_ids']))
            {
                foreach ($request['skill_ids'] as $key => $skill) {
                    # code...
                    \App\UserSkill::create(['user_id'=>$user->id, 'skill_id'=>$skill]);
    
                }
                $skillpoint=5;
            }
            if($request['educational_level'])
            {
                Educational::create(['level'=>$request['educational_level'],'user_id'=>$user->id]);
                $edupoint=5;
            }
    
    
    
            $countcoins=['name'=>$request['first_name'],
            'email'=>$request['email'],
            'password' => bcrypt($request['password']),
            'last_name'=>$request['last_name'],
            'phone_number'=>$request['phone_number'],
            'religion_id'=>$request['religion_id'],
            'birthdate'=>$request['birthdate'],
            'visa_type'=>$request['visa_type'],
            'visa_expire_date'=>$request['visa_expire_date'],
            'job_id'=>$request['job_id'],
            'industry_id'=>$request['industry_id'],
            'country_id'=>$request['country_id'],
            'gender'=>$request['gender'],
            'martial_status'=>$request['martial_status'],
            'descripe_yourself'=>$request['descripe_yourself'],
            'looking_for_job'=>$request['looking_for_job'],
            'nationality_id'=>$request['nationality_id'],
            'working_in'=>$request['working_in'],
            'start_date'=>$request['start_date'],
            'end_date'=>$request['end_date'],
            'employer_nationality_id'=>$request['employer_nationality_id'],
            'company_name'=>$request['company_name'],
            'country_id'=>$request['work_country_id'],
            'salary'=>$request['salary'],
            'role'=>$request['role'],
            $request['prefered_location_id']
    ];
    //dd($countcoins);
    foreach ( $countcoins as   $value) {
    
        if($value != null && $value !="0")
        {
    
            $points ++;
        }
    
    }
    
    $totalpoints=$points*5+$cvgpoint+$logopoint+$edupoint+$skillpoint+$videopoint+$langpoint;
    //dd($totalpoints);

            
            if($user)
            {
                $CandidateInfo= [
                'last_name'=>$request['last_name'],
                'phone_number'=>$request['phone_number'],
                'religion_id'=>$request['religion_id'],'
                birthdate'=>$request['birthdate'],
                'visa_type'=>$request['visa_type'],
                'visa_expire_date'=>$request['visa_expire_date'],
                'job_id'=>$request['job_id'],
                'industry_id'=>$request['industry_id'],
                'country_id'=>$request['country_id'],
                'gender'=>$request['gender'],
                'salary'=>$request['salary'],
                'CurrencyId'=>$request['CurrencyId'],
                'Eductionlevel'=>$request['Eductionlevel'],
                'martial_status'=>$request['martial_status'],
                'descripe_yourself'=>$request['descripe_yourself'],
                'looking_for_job'=>$request['looking_for_job'],
                'nationality_id'=>$request['nationality_id'],
                'vedio_path'=>$video_path,
                'cv_path'=>$cv_path,
                'user_id'=>$user->id,
                'coins'=>$totalpoints];
                CandidateInfo::create($CandidateInfo);
                auth()->user()->notify(new Candidate_notification($CandidateInfo));
                Notification::route('mail','hadeel.mostafa.cs@gmail.com')->notify(new Candidate_notification($CandidateInfo));
            }
            

            $can_experience = ['working_in'=>$request['working_in'],
            'start_date'=>$request['start_date'],
            'end_date'=>$request['end_date'],
            'employer_nationality_id'=>$request['employer_nationality_id'],
            'company_name'=>$request['company_name'],
            'country_id'=>$request['work_country_id'],
            'salary'=>$request['salary'],
            'role'=>$request['role'],
            'user_id'=>$user->id];
            //dd($can_experience);
            CandidateExperience::create($can_experience);
            $prefered_location = $request['prefered_location_id'];
            if($prefered_location)
            {
                $locations = [];
                array_push($locations,$prefered_location);
                //dd($prefered_location);
                if($request['prefered_location_ids'])
                {
                    foreach ($request['prefered_location_ids'] as $key => $prefered) {
                        # code...
                        array_push($locations,$prefered);
                    }
                }

                foreach (array_unique($locations) as $key => $loc) {
                    # code...
                \App\PreferedLocation::create(['user_id'=>$user->id,'country_id'=>$loc]);
                }
                
            }


            return Redirect()->back()->withFlashMessage('Candidates Added Correctly');
        }    
        catch(Exception $e) 
            {
            return redirect('/');
            }
        }


        
        //update information
        public function update(Request $request, $id) 
        {
        
        try
        {
            $this->validate($request,[
                'first_name'=>'required',
                'email' => 'email|required|unique:users',
                'gender' =>'required',
                'visa_type'=>'required',
                'looking_for_job'=>'required',
            
                ]);

            $videopoint=0;
            $logopoint=0;
            $cvgpoint=0;
            $skillpoint=0;
            $langpoint=0;
            $edupoint=0;
            $points=0;
                $code = 1000;
            
                //get the code value;
                $lastUser =  \DB::table('users')->orderBy('id', 'desc')->first();
                if($lastUser)
                {
                    $code = $lastUser->code++;
                }
            //*code generated*/


            //**update user
                //$user = User::find($id);
                $userid=CandidateInfo::where('id',$id)->select('user_id')->first();
                $uid=$userid->user_id;
            // dd($uid);
                //$user=User::find($uid)->delete();
                

                $user = user::find($uid);
                $user->name = $request->first_name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->type = 'candidate';
                $user->code = $code;

                $user->save();

                //**user updated
                $video_path = Session::get('VideoPath');
                $cv_path = "";
                $logo = "";
        
                if($request->hasFile('logo'))
                {
                    $logo = $this->saveUploadedFile($request['logo'],$user);
                    $user->logo=$logo;
                    $user->save();
        
                    $logopoint=10;
                }
                if($request->hasFile('video_file'))
                {
                    $video_path = $this->saveFile($request['video_file'],$user);
                    $videopoint=30;
                }
                if($request->hasFile('cv_path'))
                {
                    $cv_path = $this->saveUploadedFile($request['cv_path'],$user);
        
                    $cvgpoint=10;
                }
            
                if($request['language_ids'])
                {
                    foreach ($request['language_ids'] as $key => $lang) {
                        # code...
                    
                        $langs=\App\UserLanguage::find($uid);
                        $langs->language_id =$lang;
                        $langs->user_id =$user->id;
                        $langs->save();
                    }
                    $langpoint=5;
                }
                if($request['skill_ids'])
                {
                    foreach ($request['skill_ids'] as $key => $skill) {
                        # code...
                        $skills=\App\UserSkill::find($uid);
                        $skills->skill_id =$skill;
                        $skills->user_id =$user->id;
                        $skills->save();
                    }
                    $skillpoint=5;
                }
                if($request['educational_level'])
                {
                    
                    $eduction=Educational::find($uid);
                        $eduction->level = $request->educational_level;
                        $eduction->user_id =$user->id;
                        $eduction->save();
                    $edupoint=5;

                }
        
        
        
                $countcoins=['name'=>$request['first_name'],
                'email'=>$request['email'],
                'password' => bcrypt($request['password']),
                'last_name'=>$request['last_name'],
                'phone_number'=>$request['phone_number'],
                'religion_id'=>$request['religion_id'],
                'birthdate'=>$request['birthdate'],
                'visa_type'=>$request['visa_type'],
                'visa_expire_date'=>$request['visa_expire_date'],
                'job_id'=>$request['job_id'],
                'industry_id'=>$request['industry_id'],
                'country_id'=>$request['country_id'],
                'gender'=>$request['gender'],
                'martial_status'=>$request['martial_status'],
                'descripe_yourself'=>$request['descripe_yourself'],
                'looking_for_job'=>$request['looking_for_job'],
                'nationality_id'=>$request['nationality_id'],
                'working_in'=>$request['working_in'],
                'start_date'=>$request['start_date'],
                'end_date'=>$request['end_date'],
                'employer_nationality_id'=>$request['employer_nationality_id'],
                'company_name'=>$request['company_name'],
                'country_id'=>$request['work_country_id'],
                'salary'=>$request['salary'],
                'role'=>$request['role'],
                $request['prefered_location_id']
        ];
        //dd($countcoins);
        foreach ( $countcoins as   $value) {
        
            if($value != null && $value !="0")
            {
        
                $points ++;
            }
        
        }
        
        $totalpoints=$points*5+$cvgpoint+$logopoint+$edupoint+$skillpoint+$videopoint+$langpoint;
        //dd($totalpoints);
        

        
            
                    $candinfo=CandidateInfo::find($id);
                    $candinfo->last_name = $request->last_name;
                    $candinfo->phone_number = $request->phone_number;
                    $candinfo->religion_id = $request->religion_id;
                    $candinfo->birthdate = $request->birthdate;
                    $candinfo->visa_type = $request->visa_type;
                    $candinfo->visa_expire_date = $request->visa_expire_date;
                    $candinfo->job_id = $request->job_id;
                    $candinfo->industry_id = $request->industry_id;
                    $candinfo->country_id = $request->country_id;
                    $candinfo->gender = $request->gender;
                    $candinfo->salary = $request->salary;
                    $candinfo->CurrencyId = $request->CurrencyId;
                    $candinfo->Eductionlevel = $request->Eductionlevel;
                    $candinfo->martial_status = $request->martial_status;
                    $candinfo->descripe_yourself = $request->descripe_yourself;
                    $candinfo->looking_for_job = $request->looking_for_job;
                    $candinfo->nationality_id = $request->nationality_id;
                    $candinfo->vedio_path = $video_path;
                    $candinfo->cv_path = $cv_path;
                    $candinfo->user_id =$user->id;
                    $candinfo->coins = $totalpoints;
                // $eduction->user_id =$user->id;
                $candinfo->save();


                //updates in can_experinence
                $can_experience=CandidateExperience::find($id);
                $can_experience->working_in = $request->working_in;
                $can_experience->start_date = $request->start_date;
                $can_experience->employer_nationality_id = $request->employer_nationality_id;
                $can_experience->company_name = $request->company_name;
                $can_experience->country_id = $request->country_id;
                $can_experience->salary = $request->salary;
                $can_experience->role = $request->role;
                $can_experience->user_id = $user->id;
                $can_experience->save();
                
            //update in location
            $prefered_location = $request['prefered_location_id'];
            if($prefered_location)
            {
                $locations = [];
                array_push($locations,$prefered_location);
                //dd($prefered_location);
                if($request['prefered_location_ids'])
                {
                    foreach ($request['prefered_location_ids'] as $key => $prefered) {
                        # code...
                        array_push($locations,$prefered);
                    }
                }

                foreach (array_unique($locations) as $key => $loc) {
                    # code...
                    $location= \App\PreferedLocation::find($id);
                    $location->user_id = $user->id;
                    $location->country_id = $loc;
                    $location->save();
              
                }
                
            }
                

            
            
            

            return Redirect()->back()->withFlashMessage('Candidates Updated Correctly');
            
        }    
        catch(Exception $e) 
            {
            return redirect('/');
            }
        }


         //create employer story form 
         public function CreateStory(Request $request)
         {
             return view('Dashboardadmin.Candidates.createstory');
         }

    

          //store candidates success story
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
                  'type'=> 'candidate',
                 
                  ];
          
              $usernew = new User;
              $usernew=User::create($userdata);
             
              if($request->hasFile('logo'))
              {
                  $logo = $this->saveUploadedFile($request['logo'],$usernew);
                  $usernew->logo=$logo;
                  $usernew->save();
      
              }

              $user_id=$usernew->id;
              //dd($usernew->id);
             
              $candata = [
               
                  'last_name' => $request->last_name,
                  'job_id'=>$request->job_id,
                  'user_id'=>$user_id, ];
      
              
              $candidate = new CandidateInfo;
              $candidate=CandidateInfo::create($candata);
           
             
              $candidate_id=$candidate->id;
              $successstory = [
                  'description' => $request->description,
                  'can_id'=>$candidate_id,
                  'approval'=>1,
                  'user_id'=>$user_id, ];
      
              
              
              $story = new SuccessStories;
              $story=SuccessStories::create($successstory);


              return Redirect()->back()->withFlashMessage('Success Story added correctly');
          }    
          catch(Exception $e) 
              {
              return redirect('/');
              }
          }
        
        


        public function saveFile($file, $user)
        {
                $filename = 'video'.time().$file->getClientOriginalName();
                $type = $file->getMimeType();
                $extension = $file->getClientOriginalExtension();
                $path = 'videos/'.$user->id;
                $destPath = 'videos/'.$user->id.'/'.$filename;
                if(!\File::exists($path)) {
                    // path does not exist
                    \File::makeDirectory($path, $mode = 0777, true, true);
                }
                $success =$file->move($path,$filename);
            // $destPath = str_replace(public_path(), "", $destPath);
                return $destPath;
           
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


   


        public function EditStoreVideo(request $request)
        {
             try
        {
            $blobInput = $request->file('data');

            $VideoName =  $request->get('name');
            $id=$request->get('id');

            $path=("upload/video").$VideoName;
            if (!file_exists($path)) {
            $random_string = md5(microtime());

            $blobInput->move(("upload/video"),$VideoName);
           $q= CandidateInfo::
        where('id', $id)  // find your user by their email
        ->limit(1)  // optional - to ensure only one record is updated.
        ->update(array('vedio_path' => "/upload/video/".$VideoName));
            }
            else
            {
            $random_string = md5(microtime());
            $blobInput->move(public_path("/upload/video"),$random_string.".webm");

               $q= CandidateInfo::
        where('id', $id)  // find your user by their email
        ->limit(1)  // optional - to ensure only one record is updated.
        ->update(array('vedio_path' => "/upload/video/".$random_string.".webm "));

           
            }
        }    
    catch(Exception $e) 
        {
           return redirect('/home');
        } 
        }



          public function EditUploadVideo(request $request)
        {
             try
        {
          
            $blobInput = $request->file('video');
           
          
            $id=$request->get('id');
           
         $VideoName= $blobInput->getClientOriginalName();

            $path=("upload/video").$VideoName;
            if (!file_exists($path)) {
            $random_string = md5(microtime());
            $blobInput->move(("upload/video"),$VideoName);
           $q= CandidateInfo::
        where('id', $id)  // find your user by their email
        ->limit(1)  // optional - to ensure only one record is updated.
        ->update(array('vedio_path' => "upload/video/".$VideoName));
            }
            else
            {
            $random_string = md5(microtime());
            $blobInput->move(("upload/video"),$random_string.".webm");

               $q= CandidateInfo::
        where('id', $id)  // find your user by their email
        ->limit(1)  // optional - to ensure only one record is updated.
        ->update(array('vedio_path' => "upload/video/".$random_string.".webm "));

           
            }
        }    
    catch(Exception $e) 
        {
           return redirect('/home');
        } 
        }

        public function EditUploadlogo(request $request)
        {
             try
        {
          
            $blobInput = $request->file('logo');
           
          
            $id=$request->get('id');
           
         $VideoName= $blobInput->getClientOriginalName();

            $path=("upload/logo").$VideoName;
            if (!file_exists($path)) {
            $random_string = md5(microtime());
            $blobInput->move(("upload/logo"),$VideoName);
           $q= CandidateInfo::
        where('id', $id)  // find your user by their email
        ->limit(1)  // optional - to ensure only one record is updated.
        ->update(array('logo' => "upload/logo/".$VideoName));
            }
            else
            {
            $random_string = md5(microtime());
            $blobInput->move(("upload/logo"),$random_string.".webm");

               $q= CandidateInfo::
        where('id', $id)  // find your user by their email
        ->limit(1)  // optional - to ensure only one record is updated.
        ->update(array('logo' => "upload/logo/".$random_string.".webm "));

           
            }
        }    
    catch(Exception $e) 
        {
           return redirect('/home');
        } 
        }

    
}
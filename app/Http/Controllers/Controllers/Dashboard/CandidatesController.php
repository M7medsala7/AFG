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
use Socialite;
use Session;
class CandidatesController extends Controller
{
     public function index()
    { 
        return view('Dashboardadmin.Candidates.FullCandidate');   
     
    }
  public function saveFile($file, $user){
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

 public function saveUploadedFile($file, $user){
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


     public function fregcand(Request $request)
    {
 
        //return $request->hasFile('logo')?"true":"pase";
        $this->validate($request,[
            'first_name'=>'required',
            'email' => 'email|required',
            'gender' =>'required',
            'visa_type'=>'required',
            'looking_for_job'=>'required'
            ]);
    /***
    ***increment code for the new user***
    ***/
        $code = 1000;
        //get the code value;
        $lastUser =  \DB::table('users')->orderBy('id', 'desc')->first();
        if($lastUser)
        {
            $code = $lastUser->code++;
        }
    //*code generated*/


    //**create user
        $user = User::create(['name'=>$request['first_name'],'email'=>$request['email'],'password' => bcrypt($request['password']),'type'=>'candidate','code'=>$code]);
    //**user created
        $video_path = Session::get('VideoPath');
        $cv_path = "";
        $logo = "";
        if($request->hasFile('logo'))
        {
            $logo = $this->saveUploadedFile($request['logo'],$user);
            $user->logo=$logo;
            $user->save();
        }
        if($request->hasFile('video_file'))
        {
        //to store video
        
            $video_path = $this->saveFile($request['video_file'],$user);
        }
        if($request->hasFile('cv_path'))
        {
            $cv_path = $this->saveUploadedFile($request['cv_path'],$user);
        }
        if($user)
        {
            CandidateInfo::create(['last_name'=>$request['last_name'],'phone_number'=>$request['phone_number'],'religion_id'=>$request['religion_id'],'birthdate'=>$request['birthdate'],'visa_type'=>$request['visa_type'],'visa_expire_date'=>$request['visa_expire_date'],'job_id'=>$request['job_id'],'industry_id'=>$request['industry_id'],'country_id'=>$request['country_id'],'gender'=>$request['gender'],'martial_status'=>$request['martial_status'],'descripe_yourself'=>$request['descripe_yourself'],'looking_for_job'=>$request['looking_for_job'],'nationality_id'=>$request['nation_id'],'vedio_path'=>$video_path, 'cv_path'=>$cv_path, 'user_id'=>$user->id,'CurrencyId'=>$request['currency_id'],'Eductionlevel'=>$request['eductionallevel']]);
        }
        if($request['language_ids'])
        {
            foreach ($request['language_ids'] as $key => $lang) {
                # code...
                \App\UserLanguage::create(['language_id'=>$lang,'user_id'=>$user->id]);
            }
        }
        if($request['skill_ids'])
        {
            foreach ($request['skill_ids'] as $key => $skill) {
                # code...
                \App\UserSkill::create(['user_id'=>$user->id, 'skill_id'=>$skill]);
            }
        }
        if($request['Eductionlevel'])
        {
            Educational::create(['level'=>$request['Eductionlevel'],'user_id'=>$user->id]);
        }


        $can_experience = ['working_in'=>$request['working_in'],'start_date'=>$request['start_date'],'end_date'=>$request['end_date'],'nationality_id'=>$request['employer_nationality_id'],'company_name'=>$request['company_name'],'country_id'=>$request['work_country_id'],'salary'=>$request['salary'],'role'=>$request['role'],'user_id'=>$user->id];
        CandidateExperience::create($can_experience);
        $prefered_location = $request['prefered_location_id'];
        if($prefered_location)
        {
            $locations = [];
            array_push($locations,$prefered_location);
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

       
        return redirect('/fregister/candidate');

    }



    public function  updateimage( Request $request)

        {
          
        $file = $request['file'];
            
           $images = $request->file('images');
          
  
            $id =  $request->get('id');

           $imageName = $images->getClientOriginalName();


                $path=("upload/imgageslogo").$imageName;
               
              // notation octale : valeur du mode correcte
                  

                if (!file_exists($path)) {
                  $images->move(("upload/imgageslogo"),$imageName);
                  
                $q =User::join('candidate_infos','candidate_infos.user_id','users.id')->where('candidate_infos.id', $id)
                ->select('users.id AS UID','users.logo')->first();
               

 if ($q)
 {
    $user = User::find($q->UID);


      $user->logo = "upload/imgageslogo/".$imageName;

      $user->save();
      
 }
                }
                else
                {
                   $random_string = md5(microtime());
                   $images->move(public_path("upload/imgageslogo"),$random_string.".jpg");
                   
                     $q =User::join('candidate_infos','candidate_infos.user_id','users.id')->where('candidate_infos.id', $id) ->select('users.id AS UID','users.logo')->first();
                    
 if ($q)
 {
    $user = User::find($q->UID);


      $user->logo = "/upload/imgageslogo/".$random_string.".jpg";

      $user->save();
      
 }
                
                }
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

    
}
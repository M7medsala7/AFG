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
        $path = public_path().'/videos/'.$user->id;
        $destPath = public_path().'/videos/'.$user->id.'/'.$filename;
        if(!\File::exists($path)) {
            // path does not exist
            \File::makeDirectory($path, $mode = 0777, true, true);
        }
        $success =$file->move($path,$filename);
        $destPath = str_replace(public_path(), "", $destPath);
        return $destPath;
    }

 public function saveUploadedFile($file, $user){
        $filename = time().$file->getClientOriginalName();
        $type = $file->getMimeType();
        $extension = $file->getClientOriginalExtension();
        $path = public_path().'/uploads/'.$user->id;
        $destPath = public_path().'/uploads/'.$user->id.'/'.$filename;
        if(!\File::exists($path)) {
            // path does not exist
            \File::makeDirectory($path, $mode = 0777, true, true);
        }
        $success =$file->move($path,$filename);
        $destPath = str_replace(public_path(), "", $destPath);
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
            'looking_for_job'=>'required',
            'agreeBox' => 'required',
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

    
}
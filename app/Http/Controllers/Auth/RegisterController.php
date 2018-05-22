<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\PostJob;
use App\CandidateInfo;
use App\EmployerProfile;
use App\Educational;
use App\CandidateExperience;
use Socialite;
use Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
   

    Public function StoreVideo(request $request)
    {
    $blobInput = $request->file('data');

   
            $VideoName =  $request->get('name');


                $path=public_path("/assets/video").$VideoName;
              // notation octale : valeur du mode correcte
                  

                if (!file_exists($path)) {
                     $random_string = md5(microtime());
                  $blobInput->move(public_path("/assets/video"),$VideoName);
                
                   // $video = New Video();
                    Session::put('VideoPath',"/assets/video".$random_string.".webm ");
                    // $video->save();
                    }
                else
                {
                   $random_string = md5(microtime());
                   $blobInput->move(public_path("/assets/video"),$random_string.".webm");

                   Session::put('VideoPath',"/assets/video".$random_string.".webm ");
                   // $video=new Video();
                 // $video->path="/assets/video".$random_string.".webm ";
                 
                  // $video->save();
                
                }
               
                 
    }


    public function redirectToProvider($id){
       
        Session::put('TypeRegestier',$id);

        return Socialite::driver('facebook')->redirect();
    }

    public function handleProvider(){

        $userDataFace=Socialite::driver('facebook')->user();
        $userExsist=User::where('email',$userDataFace->email)->first();
        if($userExsist ==null)
        {

            $type=Session::get('TypeRegestier');
            if($type==2)
                $type="candidate";
            else
                $type="employer";


           
        $user = User::create(['name'=>$userDataFace->name,'email'=>$userDataFace->email,'password' =>$userDataFace->token,'type'=>$type]);
           
                unset($userDataFace->name,$userDataFace->email,$userDataFace->token);
              
                \Auth::loginUsingId($user->id);
                return redirect('/home');
        }
        else
        {

        \Auth::loginUsingId($userExsist->id);
                return redirect('/home');
        }
    }


    public function redirectToProviderGoogle($id){
         Session::put('TypeRegestier',$id);
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderGooglr(){
        $userData=Socialite::driver('google')->user();
        $userExsist=User::where('email',$userData->email)->first();

        if($userExsist == null)
        {

        $user = User::create(['name'=>$userData->name,'email'=>$userData->email,'password' =>$userData->token,'type'=>'employer']);
          
                \Auth::loginUsingId($user->id);
                return redirect('/home');
        }
        else
        {

        \Auth::loginUsingId($userExsist->id);
                return redirect('/home');
        }
    }
//Twitter Regestration


  public function redirectToProvidertwitter($id){
     Session::put('TypeRegestier',$id);
       return Socialite::driver('twitter')->redirect();
    }

    public function handleProvidertwitter(){

    
        $userData = Socialite::driver('twitter')->redirect();
      
        $userExsist=User::where('email',$userData->email)->first();

        if($userExsist == null)
        {

        $user = User::create(['name'=>$userData->name,'email'=>$userData->email,'password' =>$userData->token,'type'=>'employer']);
          
                \Auth::loginUsingId($user->id);
                return redirect('/home');
        }
        else
        {

        \Auth::loginUsingId($userExsist->id);
                return redirect('/home');
        }
    }


//End 


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function emplyReg(Request $request)
    {
        $this->validate($request, [
            'job_id' => 'required',
            'job_for'=>'required',
            'name'=>'required',
            'phone'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'country_id'=>'required',
            'industry_id'=>'required',

        ]);
        $code = 1000;
        //get the code value;
        $lastUser =  \DB::table('users')->orderBy('id', 'desc')->first();
        if($lastUser)
        {
            $code = $lastUser->code++;
        }
          $user = User::create(['name'=>$request['name'],'email'=>$request['email'],'password' => bcrypt($request['password']),'type'=>'employer','code'=>$code]);
        $input = $request->all();
        unset($input['name'],$input['email'],$input['password']);
        $input['created_by']= $user->id;
        PostJob::create($input);
        if($user)
        {
            EmployerProfile::create(['type'=>$request['job_for'],'name'=>$request['name'],'last_name'=>'.','user_id'=>$user->id]);
        }
        \App\Company::create(['name'=>$request['name'],'size'=>'5','country_id'=>$request['country_id'],'lat'=>'0','lang'=>'0','created_by'=>$user->id,'industry_id'=>$request['industry_id']]);
        \Auth::loginUsingId($user->id);

        return redirect('/home');
    }
    public function candReg(Request $request)
    {
        $this->validate($request, [
            'job_id' => 'required',
            'industry_id'=>'required',
            'name'=>'required',
            'gender' =>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required',
            'country_id'=>'required',
        ]);
        $code = 1000;
        $vedio_path = Session::get('VideoPath');
        //get the code value;
        $lastUser =  \DB::table('users')->orderBy('id', 'desc')->first();
        if($lastUser)
        {
            $code = $lastUser->code++;
        }
        $user = User::create(['name'=>$request['name'],'email'=>$request['email'],'password' => bcrypt($request['password']),'type'=>'candidate','code'=>$code]);
        $input = $request->all();
        if($request->hasFile('video_file'))
        {
            $vedio_path = $this->saveFile($request['video_file'],$user);
            $input['vedio_path']=$vedio_path;
        }
        unset($input['name'],$input['email'],$input['password']);
        $input['user_id']= $user->id;
        CandidateInfo::create($input);
        \Auth::loginUsingId($user->id);
        return redirect('/home');
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

   /***
        *full registeration
    ****/
            //employer part 
    public function empFullRegType(Request $request)
    {
        Session::put('empType',$request['type']);
        return redirect('/f_register/employeer');
    }
    public function empFullReg()
    {
        $type=Session::get('empType');
        return view('auth.create_account',compact('type'));
    }

    public function f_reg_emp(Request $request)
    {
    
    /**
    **Validation 
    **/
     // return $request->all();
        $request['email_confirmation']= strtolower($request['email_confirmation']);
        $request['email']= strtolower($request['email']);
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'type'=>'required',
            'last_name'=>'required',
            'address' =>'required',
            'email'=>'required|email|confirmed|unique:users',
            'password'=>'required',
            'city_id'=>'required',
        ]);
        if ($validator->fails()) {
            return \Response::json($validator->messages(), 500);
        }
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
        $user = User::create(['name'=>$request['first_name'].' '.$request['last_name'],'email'=>$request['email'],'password' => bcrypt($request['password']),'type'=>'employer','code'=>$code]);
    //**user created

        $input = $request->all();
        if($user)
        {
            EmployerProfile::create(['city_id'=>$input['city_id'],'type'=>$request['type'],'first_name'=>$request['first_name'],'last_name'=>$request['last_name'],'user_id'=>$user->id]);
        }
        \App\Company::create(['name'=>$request['first_name'],'size'=>'5','country_id'=>$request['country_id'],'lat'=>'0','lang'=>'0','created_by'=>$user->id,'industry_id'=>0]);
        \Auth::loginUsingId($user->id);
        return "true";
    }


    //////Candidate part
    public function candFullReg(Request $request)
    {
        return view('auth.full_candidate_reg');
    }

    public function f_reg_cand(Request $request)
    {
        //return $request->hasFile('logo')?"true":"pase";
        $this->validate($request,[
            'first_name'=>'required',
            'email' => 'email|required',
            'gender' =>'required',
            'visa_type'=>'required',
            'visa_expire_date'=>'required',
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
            CandidateInfo::create(['last_name'=>$request['last_name'],'phone_number'=>$request['phone_number'],'religion_id'=>$request['religion_id'],'birthdate'=>$request['birthdate'],'visa_type'=>$request['visa_type'],'visa_expire_date'=>$request['visa_expire_date'],'job_id'=>$request['job_id'],'industry_id'=>$request['industry_id'],'country_id'=>$request['country_id'],'gender'=>$request['gender'],'martial_status'=>$request['martial_status'],'descripe_yourself'=>$request['descripe_yourself'],'looking_for_job'=>$request['looking_for_job'],'nationality_id'=>$request['nationality_id'],'vedio_path'=>$video_path, 'cv_path'=>$cv_path, 'user_id'=>$user->id]);
        }
        if($request['language_ids'])
        {
            foreach ($request['language_ids'] as $key => $lang) {
                # code...
                \App\UserLanguage::create(['language_id'=>$lang,'user_id'=>$user->id]);
            }
        }
        if(count($request['skill_ids']))
        {
            foreach ($request['skill_ids'] as $key => $skill) {
                # code...
                \App\UserSkill::create(['user_id'=>$user->id, 'skill_id'=>$skill]);
            }
        }
        if($request['educational_level'])
        {
            Educational::create(['level'=>$request['educational_level'],'user_id'=>$user->id]);
        }


        $can_experience = ['working_in'=>$request['working_in'],'start_date'=>$request['start_date'],'end_date'=>$request['end_date'],'employer_nationality_id'=>$request['employer_nationality_id'],'company_name'=>$request['company_name'],'country_id'=>$request['work_country_id'],'salary'=>$request['salary'],'role'=>$request['role'],'user_id'=>$user->id];
        CandidateExperience::create($can_experience);
        $prefered_location = $request['prefered_location_id'];
        if($prefered_location)
        {
            $locations = [];
            array_push($locations,$prefered_location);
            if(count($request['prefered_location_ids']))
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

        \Auth::loginUsingId($user->id);
        return redirect('/home');

    }

}

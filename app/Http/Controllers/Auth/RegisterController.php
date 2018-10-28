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
use App\Notifications\AddEmployer;
use App\Notifications\PostJobs;
use App\Notifications\Candidate_notification;
use App\Notifications;
use Carbon\Carbon;
use Socialite;
use Session;
use Mail;
use App\Country;
use App\City;
use App\Http\Requests\RegisterFormRequest;
use App\Http\Requests\FullCanRegisterFormRequest;
use  App\Http\Requests\CanRegisterFormRequest;
use  App\Http\Requests\EmpRegisterFormRequest;
use JsValidator;

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
     try
        {

           $blobInput =$request->file("video-blob");
           $VideoName =  md5(microtime());
         //  dd($request->file("video-blob"));
           $blobInput->move(("upload/video"),$VideoName);
           Session::put('VideoPath',"upload/video/".$VideoName);
           return response()->json([
            'success' => true,
        ]);
        }    
    catch(Exception $e) 
        {
           return redirect('/home');
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
        if($type==2)
        {
          CandidateInfo::create(['user_id'=>$user->id]);
            
        }
        else
        {
            \App\Company::create(['name'=>$user->name,'size'=>'5','lat'=>'0','lang'=>'0','created_by'=>$user->id,'industry_id'=>0]);

          
        }
       
   

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

       public function emplyReg(RegisterFormRequest $request)

    {
         
    try
    {

        // $this->validate($request, [
        //     'job_id' => 'required',
        //     'job_for'=>'required',
        //     'name'=>'required',
        //     'phone'=>'required',
        //     'email'=>'required|email|unique:users',
        //     'password'=>'required',
        //     'country_id'=>'required',

        // ]);
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
        //dd($request['email']);
        //get the code value;
        $lastUser =  \DB::table('users')->orderBy('id', 'desc')->first();
        if($lastUser)
        {
            $code = $lastUser->code++;
        }
          $user = User::create(['name'=>$request['name'],
          'email'=>$request['email'],'password' => bcrypt($request['password']),
          'type'=>'employer','code'=>$code]);
          //dd($user);

        $input = $request->all();
        unset($input['name'],$input['email'],$input['password']);
        $input['created_by']= $user->id;
        PostJob::create($input);
        if($user)
        {
            $job = EmployerProfile::create(['type'=>$request['job_for'],
            'name'=>$request['name'],'last_name'=>'.',
            'user_id'=>$user->id, 'phone'=>$request['phone'],'coins'=>$totalpoints]);
           
      
        }
       
        \App\Company::create(['name'=>$request['name'],'size'=>'5','country_id'=>$request['country_id'],'lat'=>'0','lang'=>'0','created_by'=>$user->id,'industry_id'=>0]);


        $user->notify(new PostJobs($job));     
        //Sending Mail after adding
        $data=array('Email'=>$request['email']);
        Mail::send('emails.NewJob', $data, function($message) use ($data) {
        $message->to('Social@maidandhelper.com');
        $message->subject('new job is added ');

        });

        //Sending Mail after regestration
      
       $data=array('Email'=>$request['email']);
        Mail::send('emails.RegestrationSucess', $data, function($message) use ($data) {
        $message->to($data['Email']);
       $message->subject('registeration completed');

      });

        \Auth::loginUsingId($user->id);

        return redirect('/home');
        
        
            }    
    catch(Exception $e) 
        {
         return redirect('/');
         }
    }
 
   
    public function candReg(CanRegisterFormRequest $request)
    {
          try
          {
       
    
        $code = 1000;
        $vedio_path='';
                $vedio_path = Session::get('VideoPath');
              //  dd("dd",$vedio_path);
                $points=0;
                 $videopoint=0;



        //get the code value;
        $lastUser =  \DB::table('users')->orderBy('id', 'desc')->first();
        if($lastUser)
        {
            $code = $lastUser->code++;
        }

        $user = User::create(['name'=>$request['name'],
        'email'=>$request['email'],
        'password' => bcrypt($request['password']),
        'type'=>'candidate','code'=>$code]);
        $input = $request->all();

 
        if($request->hasFile('video_file'))
        {
            $vedio_path = $this->saveFile($request['video_file'],$user);
            $input['vedio_path']=$vedio_path;
            $videopoint=30;
        }
        else
        {
            $vedio_path =  Session::get('VideoPath');
            $input['vedio_path']=$vedio_path;
            $videopoint=30;
        }

        unset($input['name'],$input['email'],$input['password']);
        $input['user_id']= $user->id;
        $countcoins=['name'=>$request['name'],
        'email'=>$request['email'],
        'industry_id'=>$request['industry_id'],
        'job_id'=>$request['job_id'],
        'gender'=>$request['gender'],
        'password' => bcrypt($request['password']),
        
        'country_id'=>$request['country_id'],
       
];
  //dd($countcoins);
foreach ( $countcoins as   $value) {

    if($value != null && $value !="0")
    {

        $points ++;
    }

}
$totalpoints=$points*5+$videopoint;
 $input['coins']=$totalpoints;
 

 $CandidateInfo= CandidateInfo::create($input);
        
        $user->notify(new Candidate_notification($CandidateInfo));
        //Sending Mail after adding
        $data=array('Email'=>$request['email']);
        Mail::send('emails.NewEmployer', $data, function($message) use ($data) {
        $message->to('Social@maidandhelper.com');
        $message->subject('new user is added ');

        });




         //Sending Mail after regestration
        $data=array('Email'=>$request['email']);
        Mail::send('emails.RegestrationSucess', $data, function($message) use ($data) {
        $message->to($data['Email']);
        $message->subject('registeration completed');

        });

        \Auth::loginUsingId($user->id);
        return redirect('/home');
            }    
    catch(Exception $e) 
        {
         return redirect('/');
         }
    }

    public function saveFile($file, $user){
        try
        {


        $filename = 'video'.time().$file->getClientOriginalName();
        $type = $file->getMimeType();
        $extension = $file->getClientOriginalExtension();
        $path = 'videos/'.$user->id;
        $destPath ='videos/'.$user->id.'/'.$filename;
        if(!\File::exists($path)) {
            // path does not exist
            \File::makeDirectory($path, $mode = 0777, true, true);
        }
        $success =$file->move($path,$filename);
       // $destPath = str_replace( $destPath);
        return $destPath;
          }    
    catch(Exception $e) 
        {
           return redirect('/home');
        }
    }

    public function saveUploadedFile($file, $user){
        $filename = time().$file->getClientOriginalName();
        $type = $file->getMimeType();
        $extension = $file->getClientOriginalExtension();
        $path = 'uploads/'.$user->id;
        $destPath ='uploads/'.$user->id.'/'.$filename;
        if(!\File::exists($path)) {
            // path does not exist
            \File::makeDirectory($path, $mode = 0777, true, true);
        }
        $success =$file->move($path,$filename);
       // $destPath = str_replace( $destPath);
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
        //dd($type);
        return view('auth.create_account',compact('type'));
    }

    public function f_reg_emp(EmpRegisterFormRequest $request)
    {
    try
    {
       
   
        $code = 1000;
        $points=0;
          $countcoins=['name'=>$request['name'],
        'email'=>$request['email'],
        'phone'=>$request['phone'],
        'password' => bcrypt($request['password']),
        'last_name'=>$request['last_name'],
        'job_for'=>$request['job_for'],
        'country_id'=>$request['country_id'],
         'city_id'=>$request['city_id'],
        'type'=>$request['type'],
        'first_name'=>$request['first_name'],

       
];
  //dd($countcoins);
foreach ( $countcoins as   $value) {

    if($value != null && $value !="0")
    {

        $points ++;
    }

}
$totalpoints=$points*5;

$country=$request['country_id'];
$city=$request['city_id'];
 
 $countryQuery=Country::where('name',$country)->first();

  if( $countryQuery== null)
  {

     $location = New Country;
    $location->name =$request['country_id'];
$location->save();


  }

  
    $countryQueryCityID=Country::where('name',$country)->first();

         $citynam = New City;
    $citynam->name =$city;
   
   $citynam->country_id=$countryQueryCityID->id;
$citynam->save();

 




   $cityQuery=City::where('name',$city)->first();
        //get the code value;
        $lastUser =  \DB::table('users')->orderBy('id', 'desc')->first();
        if($lastUser)
        {
            $code = $lastUser->code++;
        }
    //*code generated*/

    //**create user
        $user = User::create(['name'=>$request['first_name'].' '.$request['last_name'],
        'email'=>$request['email'],'password' => bcrypt($request['password']),
        'type'=>'employer','code'=>$code]);
    //**user created

        $input = $request->all();
        if($user)
        {
            $emptype= EmployerProfile::create(['city_id'=>$cityQuery->id,
            'type'=>$request['type'],'first_name'=>$request['first_name'],
            'last_name'=>$request['last_name'],'country_id'=>$countryQueryCityID->id,
            'user_id'=>$user->id,'phone'=>$request['phone'],'coins'=>$totalpoints]);
         
          
           // dd($emp);
         
        }
       
          

        \App\Company::create(['name'=>$request['first_name'],'size'=>'5','country_id'=>$countryQueryCityID->id,'lat'=>'0','lang'=>'0','created_by'=>$user->id,'industry_id'=>0]);
        // $user->notify(new AddEmployer($emptype));
        //Sending Mail after adding
         $data=array('Email'=>$request['email']);
         // Mail::send('emails.NewJob', $data, function($message) use ($data) {
         // $message->to('Social@maidandhelper.com');
         // $message->subject('new job is added ');
 
       //  });
 
 
        //Sending Mail after regestration
        $data=array('Email'=>$request['email']);
        // Mail::send('emails.RegestrationSucess', $data, function($message) use ($data) {
        // $message->to($data['Email']);
        // $message->subject('registeration completed');

        // });


        \Auth::loginUsingId($user->id);
        return "true";
        
          }    
    catch(Exception $e) 
        {
         return redirect('/');
         }
        
        
    }

   
    //////Candidate part
    public function candFullReg(Request $request)
    {
        return view('auth.full_candidate_reg');
    }

   
    public function f_reg_cand(FullCanRegisterFormRequest $request)
    {
 try{
 

        //return $request->hasFile('logo')?"true":"pase";
        // $this->validate($request,[
        //     'first_name'=>'required',
        //     'email' => 'email|required|unique:users',
        //     'gender' =>'required',
        //     'visa_type'=>'required',
        //     'looking_for_job'=>'required',
        //     'agreeBox' => 'required',
        //     ]);
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
        'MaxSalary'=>$request['MaxSalary'],
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
            $CandidateInfos=['last_name'=>$request['last_name'],
            'phone_number'=>$request['phone_number'],
            'religion_id'=>$request['religion_id'],
            'birthdate'=>$request['birthdate'],
            'visa_type'=>$request['visa_type'],
            'salary'=>$request['salary'],
            'MaxSalary'=>$request['MaxSalary'],
            'visa_expire_date'=>$request['visa_expire_date'],
            'job_id'=>$request['job_id'],
            'industry_id'=>$request['industry_id'],
            'country_id'=>$request['country_id'],
            'gender'=>$request['gender'],
            'martial_status'=>$request['martial_status'],
            'descripe_yourself'=>$request['descripe_yourself'],
            'looking_for_job'=>$request['looking_for_job'],
            'nationality_id'=>$request['nationality_id'],
            'vedio_path'=>$video_path, 
            'cv_path'=>$cv_path, 
            'user_id'=>$user->id,'coins'=>$totalpoints];
        }
        $CandidateInfo = new CandidateInfo;
         $CandidateInfo->create($CandidateInfos);
    


        $can_experience = ['working_in'=>$request['working_in'],'start_date'=>$request['start_date'],'end_date'=>$request['end_date'],'employer_nationality_id'=>$request['employer_nationality_id'],'company_name'=>$request['company_name'],'country_id'=>$request['work_country_id'],'salary'=>$request['salary'],'role'=>$request['role'],'user_id'=>$user->id];
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


        $user->notify(new Candidate_notification($CandidateInfo));
        //Sending Mail after adding
         $data=array('Email'=>$request['email']);
         Mail::send('emails.NewEmployer', $data, function($message) use ($data) {
         $message->to('Social@maidandhelper.com');
         $message->subject('new user is added ');
 
         });

         //Sending Mail after regestration
        //$data=array('Email'=>$request['email']);
     //Mail::send('emails.RegestrationSucess', $data, function($message) use ($data) {
        //$message->to($data['Email']);
        //$message->subject('registeration completed');

        //});

        \Auth::loginUsingId($user->id);
        return redirect('/home');

   

    }    
    catch(Exception $e) 
        {
         return redirect('/');
         }

}
}

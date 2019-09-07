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

class AgencyCandidateController extends Controller
{
    
    Public function StoreVideo2(request $request)
    {
     
           $blobInput =$request->file("video-blob");
           $VideoName =  md5(microtime());
        //    dd($request->file("video-blob"));
           $blobInput->move(("upload/video"),$VideoName);
           Session::put('VideoPath',"upload/video/".$VideoName);
           return response()->json([
            'success' => true,
        ]);
              
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

public function owncandidate()
{
      $data =CandidateInfo::where('Agency_ID',\Auth::user()->id)
                      ->where('candidate_infos.IsDeletedAgency',0)
                     ->select('*')
                     ->get();
 $jobs=PostJob::with('job')->where('created_by',\Auth::user()->id)->get();
        $allClients=User::whereHas('EmpInfo', function ($query)  {
            $query->where('Agency_ID', \Auth::user()->id);
            $query->where('DeletedByAgency','!=', 1);
        })
        ->where('type','client')->get();
     return view('auth.ownCandidate',compact('data','jobs','allClients'));
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

 
    public function registercandidateagency(Request $request)
    {

          try
          {
           
        $code = 1000;
        $vedio_path='';
        $vedio_path = Session::get('VideoPath');
        $points=0;
        $videopoint=0;
        //get the code value;
        $lastUser =  \DB::table('users')->orderBy('id', 'desc')->first();
        if($lastUser)
        {
            $code = $lastUser->code++;
        }
      
        $user = User::create(['name'=>$request['name'],
        'email'=>\Auth::user()->name.md5(microtime()),
        'password' => bcrypt(123456),
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
            $vedio_path =  Session::get('VideoPath');;
            $input['vedio_path']=$vedio_path;
            $videopoint=30;
        }
        unset($input['name'],\Auth::user()->name,$input['password']);
        $input['user_id']= $user->id;
        $countcoins=['name'=>$request['name'],
        'email'=>$request['name'].md5(microtime()),
        'industry_id'=>$request['industry_id'],
        'job_id'=>$request['job_id'],
        'gender'=>$request['gender'],
        'password' => bcrypt($request['password']),
        'country_id'=>$request['country_id'],
       
];
foreach ( $countcoins as   $value) {

    if($value != null && $value !="0")
    {

        $points ++;
    }

}
        //add skills 
        $skillpoint=0;
        $langpoint=0;
        $logopoint=0;
        if(count($request['skill_ids']))
        {
        foreach ($request['skill_ids'] as $key => $skill) {
        \App\UserSkill::create(['user_id'=>$user->id, 'skill_id'=>$skill]);

        }
        $skillpoint=5;
        }
        if($request['language_ids'])
        {
            foreach ($request['language_ids'] as $key => $lang) {
                # code...
                \App\UserLanguage::create(['language_id'=>$lang,'user_id'=>$user->id]);
            }
            $langpoint=5;
        }
        $cv_path="";
        if($request->hasFile('cv_path'))
        {
            $cv_path = $this->saveUploadedFile($request['cv_path'],$user);

            $cvgpoint=10;
        }
        if($request->hasFile('logo'))
        {
            $logo = $this->saveUploadedFile($request['logo'],$user);
            $user->logo=$logo;
            $user->save();

            $logopoint=10;
        }
$totalpoints=$points*5+$videopoint+$skillpoint+$langpoint+$logopoint;
$input['coins']=$totalpoints;
$input['Agency_ID']= (\Auth::user()->id);
$input['cv_path']=$cv_path;
$EmployerProfile=EmployerProfile::where('user_id',\Auth::user()->id)->first();  
$input['phone_number']=$EmployerProfile->phone;
$input['last_name']=$request['name'];
 $CandidateInfo= CandidateInfo::create($input);
        
        $user->notify(new Candidate_notification($CandidateInfo));
        //Sending Mail after adding
        // $data=array('Email'=>\Auth::user()->email);
        // Mail::send('emails.NewEmployer', $data, function($message) use ($data) {
        // $message->to('Social@maidandhelper.com');
        // $message->subject('new user is added ');

        // });

         //Sending Mail after regestration
        // $data=array('Email'=>\Auth::user()->email);
        // Mail::send('emails.RegestrationSucess', $data, function($message) use ($data) {
        // $message->to($data['Email']);
        // $message->subject('registeration completed');

       // });

        \Auth::loginUsingId(\Auth::user()->id);
        return redirect('/owncandidate');
            }    
    catch(Exception $e) 
        {
         return redirect('/');
         }
    }
    public function registerwithout(Request $request)
    {

          try
          {
          
        $code = 1000;
        $vedio_path='';
        $vedio_path = Session::get('VideoPath');
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
            $vedio_path =  Session::get('VideoPath');;
            $input['vedio_path']=$vedio_path;
            $videopoint=30;
        }
        unset($input['name'],$user->name,$input['password']);
        $input['user_id']= $user->id;
        $countcoins=['name'=>$request['name'],
        'email'=>$request['name'].md5(microtime()),
        'industry_id'=>$request['industry_id'],
        'job_id'=>$request['job_id'],
        'gender'=>1,
        'nationality_id'=>$request['nationality_id'],
        'password' => bcrypt($request['password']),
        'country_id'=>$request['country_id'],
       
];
foreach ( $countcoins as   $value) {

    if($value != null && $value !="0")
    {

        $points ++;
    }

}

        $cv_path="";
        if($request->hasFile('cv_path'))
        {
            $cv_path = $this->saveUploadedFile($request['cv_path'],$user);

            $cvgpoint=10;
        }
        if($request->hasFile('logo'))
        {
            $logo = $this->saveUploadedFile($request['logo'],$user);
            $user->logo=$logo;
            $user->save();

            $logopoint=10;
        }   
$totalpoints=$points*5+$videopoint+ $logopoint;
$input['coins']=$totalpoints;
$input['cv_path']=$cv_path; 
$input['phone_number']=$request['phone'];
$input['last_name']=$request['name'];
 $CandidateInfo= CandidateInfo::create($input);
   \Auth::loginUsingId($user->id);
        $user->notify(new Candidate_notification($CandidateInfo));
      // Sending Mail after adding
        $data=array('Email'=>\Auth::user()->email);
        Mail::send('emails.RegestrationSucess', $data, function($message) use ($data) {
        $message->to('Social@maidandhelper.com');
        $message->subject('new user is added ');

        });

         //Sending Mail after regestration
        $data=array('Email'=>\Auth::user()->email);
        Mail::send('emails.RegestrationSucess', $data, function($message) use ($data) {
        $message->to($data['Email']);
        $message->subject('registeration completed');

        });
        if($request['jobid'] !="Register")
        {
            $post_job=PostJob::find($request['jobid']);
        $post_job->applicants()->attach($user->id);
        }
        
        
     
        return redirect('/home');
            }    
    catch(Exception $e) 
        {
         return redirect('/');
         }
    }




}
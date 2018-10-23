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
        if(count($request['skill_ids']))
        {
        foreach ($request['skill_ids'] as $key => $skill) {
        \App\UserSkill::create(['user_id'=>$user->id, 'skill_id'=>$skill]);

        }
        $skillpoint=5;
        }
$totalpoints=$points*5+$videopoint+$skillpoint;
$input['coins']=$totalpoints;
$input['Agency_ID']= (\Auth::user()->id);
 $CandidateInfo= CandidateInfo::create($input);
        
        $user->notify(new Candidate_notification($CandidateInfo));
        //Sending Mail after adding
        $data=array('Email'=>\Auth::user()->email);
        Mail::send('emails.NewEmployer', $data, function($message) use ($data) {
        $message->to('Social@maidandhelper.com');
        $message->subject('new user is added ');

        });

        //  //Sending Mail after regestration
        // $data=array('Email'=>\Auth::user()->email);
        // Mail::send('emails.RegestrationSucess', $data, function($message) use ($data) {
        // $message->to($data['Email']);
        // $message->subject('registeration completed');

        // });

        \Auth::loginUsingId(\Auth::user()->id);
        return redirect('/home');
            }    
    catch(Exception $e) 
        {
         return redirect('/');
         }
    }



}
<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request; 
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use App\PostJob;
use App\Religion;
use App\Job;
use App\Country;
use App\Skills;
use App\City;
use App\CandidateInfo;
use App\EmployerProfile;
use DB;
use App\Notifications\Candidate_notification;
use App\Notifications;
use App\Http\Requests\RegisterFormRequest;
use App\Http\Requests\FullCanRegisterFormRequest;
use App\Http\Requests\CanRegisterFormRequest;
use App\Http\Requests\EmpRegisterFormRequest;
use Mail;
use App\Industry;
use App\Nationality;
use App\Currency;
use App\Company;
use App\Exprience;
use App\SuccessStories;
use App\UserLikeCandidates;
use App\Language;
use App\Notification_settings;
use App\seen_profile;
use App\seen_job;
use App\Packages;
use App\PackagesUser;
use Hash;
use Carbon\Carbon;
use App\CandidateExperience;
use App\NotificationsUser;
use App\jobtoclient;
use App\UserDevicesToken;
use App\Events\AddNotificationToFirebaseEvent;

class apicontroller extends Controller 
{
public $successStatus = 200;
/** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function login(Request $request){ 

        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 


          $userdata=User::where('email',request('email'))
          ->first();
          if($userdata->type=='employer')
          {

           $user=EmployerProfile::with(['country','city'])
          ->join('users','users.id','=','employer_profiles.user_id')
           ->join('companies','companies.Created_by','=','employer_profiles.user_id')
          ->where('user_id', $user->id)
          ->select('*','users.*','employer_profiles.type as usertype','companies.*')
          ->first();
              
          }else
          {
$user=CandidateInfo::with(['country','religion','job','industry','nationality','ExperinceWork','getCandidateLang','getCandidatePreferedLoc','getCandidateSkill','currency'])
->join('users','users.id','=','candidate_infos.user_id')
->where('user_id', $user->id)
->select('*','users.*','users.type as usertype','descripe_yourself as description','phone_number as phone')
->first();
              
          }

          // add fcm token
          if (request('token')) {
              UserDevicesToken::firstOrCreate(['user_id' => $user->id, 'fcm_token' => request('token')]);
          }
          
          
            return response()->json(['user' => $user,"Message"=> "",
        "Success"=>true]); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }
/** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
     
     
       public function getsharedjobtoclient(Request $request){ 
         
         
          $Data=PostJob::with(['Industry','job','Currency','country','getJobLanguage','getJobSkill'])
          ->join('shared_jobtoclient','shared_jobtoclient.postjob_id','=','.post_jobs.id')
          ->where('shared_jobtoclient.client_id',$request['client_id'])
          ->get();
          
               
    return response()->json(['jobs' => $Data,"Message"=> "","Success"=>true]); 
         
     }
     
     public function sharedjobtoclient(Request $request){ 
         
         
         
                    $jobtoclient= New jobtoclient;
                    $jobtoclient->postjob_id=$request['postjob_id'];
                    $jobtoclient->client_id=$request['client_id'];
                    $jobtoclient->save();
        
    return response()->json(['data' => [],"Message"=> "","Success"=>true]); 
         
     }
     
        public function candidateoremployer(Request $request){ 


          $userdata=User::where('id',request('user_id'))
          ->first();

          if($userdata->type=='employer')
          {

  $user=EmployerProfile::with(['country','city'])
          ->join('users','users.id','=','employer_profiles.user_id')
           ->join('companies','companies.Created_by','=','employer_profiles.user_id')
          ->where('user_id', request('user_id'))
          ->select('*','users.*','employer_profiles.type as usertype','companies.*')
          ->first();
              
          }else
          {
$user=CandidateInfo::with(['country','religion','job','industry','nationality','ExperinceWork','getCandidateLang','getCandidatePreferedLoc','getCandidateSkill','currency'])
->join('users','users.id','=','candidate_infos.user_id')
->where('user_id',request('user_id'))
->select('*','users.*','users.type as usertype','descripe_yourself as description','phone_number as phone')
->first();
              
          }

             
                 return response()->json(['user' => $user,"Message"=> "",
        "Success"=>true]);
          
         
      
    }
public function  sharecandidatetoclient (Request $request)
{
 
$clinet=explode("_",$request->clientids);
$candidate=explode("_",$request->canids);

$agency=$request->user_id;
if($request->agencycomment !=null)
{
   $comment=$request->agencycomment; 
}
else
{
    $comment='';
}


$CanQuery=CandidateInfo::whereIn('user_id',$candidate)->get();

foreach ($CanQuery as $can) {
   
\DB::table('SharedClient')->where('Can_id',$can->user_id)->delete();

    $can->getCandidateClientStaus2()->attach($clinet ,array('Can_id' => $can->user_id,'Agency_id'=> $agency,'CommentAgency' => $comment,'job_id'=>$request->job_id));
    
     \DB::table('job_applications')->insert(
        array(
               'job_post_id' =>$request->job_id, 
               'user_id'    =>$can->user_id,
                'video_path'    =>'',
        )
    );
 
     
}


 return response()->json(['data' => [],"Message"=> "",
        "Success"=>true]);
    
}
     
   public function updatestatusorcommentbyagenytocandidate (Request $request)
   {
       
       
       if($request->AgencyStatus !=null)
       {
           $update = \DB::table('SharedClient')
                    ->where('Agency_id',$request->Agency_id)
                    ->where('Client_id',$request->Client_id)
                    ->where('Can_id',$request->Can_id)
                    ->update( [ 'AgencyStatus' =>$request->AgencyStatus]);  
       }
         if($request->CommentAgency !=null)
       {
           $update = \DB::table('SharedClient')
                    ->where('Agency_id',$request->Agency_id)
                    ->where('Client_id',$request->Client_id)
                    ->where('Can_id',$request->Can_id)
                    ->update( [ 'CommentAgency' =>$request->CommentAgency]);  
       }
       
       
          if($request->CommentAgency !=null)
       {
           $update = \DB::table('SharedClient')
                    ->where('Agency_id',$request->Agency_id)
                    ->where('Client_id',$request->Client_id)
                    ->where('Can_id',$request->Can_id)
                    ->update( [ 'CommentAgency' =>$request->CommentAgency]);  
       }
       
       
          if($request->CommentAgency !=null)
       {
           $update = \DB::table('SharedClient')
                    ->where('Agency_id',$request->Agency_id)
                    ->where('Client_id',$request->Client_id)
                    ->where('Can_id',$request->Can_id)
                    ->update( [ 'CommentAgency' =>$request->CommentAgency]);  
       }
       
        
      return response()->json(['data' => [],"Message"=> "",
        "Success"=>true]);
       
   }
     
     
     
     public function getcandidateclient (Request $request)
{
  

    
    $data = CandidateInfo::with(['country','religion','job','industry','nationality','ExperinceWork','getCandidateLang','getCandidatePreferedLoc','getCandidateSkill','currency'])
->join('users','users.id','=','candidate_infos.user_id')
->join('SharedClient','SharedClient.Can_id','candidate_infos.user_id')
->where('Client_id',$request->client_id)
->where('SharedClient.seen',1)
->select('*','users.*','descripe_yourself as description','phone_number as phone','ClientStatus','AgencyStatus','CommentAgency','CommentClient')
->get();
    

 return response()->json(['candidates ' => $data,"Message"=> "",
        "Success"=>true]);  
}
     
     
        public function deleteclient(Request $request)
    {
       
        $update = \DB::table('employer_profiles')
            ->where('user_id',$request->client_id)
            ->update( [ 'DeletedByAgency' =>1]); 
      return response()->json(['data' => [],"Message"=> "",
        "Success"=>true]);
      
        
    }
   public function deleteCandidatebyagency(Request $request)
    {
      
            $update = \DB::table('candidate_infos')
            ->where('Agency_ID', $request->user_id)
            ->where('user_id',$request->can_id)
            ->update(['IsDeletedAgency' =>1]); 
     
        return response()->json(['data' => [],"Message"=> "",
        "Success"=>true]);
        
    }
     public function getcanbyagency(Request $request)
     {
         $user=CandidateInfo::with(['country','religion','job','industry','nationality','ExperinceWork','getCandidateLang','getCandidatePreferedLoc','getCandidateSkill','currency'])
->join('users','users.id','=','candidate_infos.user_id')
->where('Agency_ID', $request->agency_ID)
->select('*','users.*','descripe_yourself as description','phone_number as phone')
->get();

         return response()->json(['users' => $user,"Message"=> "",
        "Success"=>true]); 

     }
     
    public function notifyuser(Request $request)
    
      {
        $data=NotificationsUser::where("user_id",$request->user_id)->get();
        return response()->json(['data' => $data,"Message"=> "","Success"=>true]); 
      }
     
    public function clientShow (Request $request) {
        $data=[];
        $allclient=EmployerProfile::
         where('Agency_ID',$request->user_id)
        ->where('DeletedByAgency',0)
        ->get();
        
        $allclient= EmployerProfile::with(['country','city'])
          ->join('users','users.id','=','employer_profiles.user_id')
          ->join('companies','companies.Created_by','=','employer_profiles.user_id')
           ->where('Agency_ID',$request->user_id)
        ->where('DeletedByAgency',0)
          ->select('*','users.*','employer_profiles.type as usertype','companies.*')
          ->get();
       
        foreach($allclient as $value)
        {

            $Shortlisted= DB::table('SharedClient')
            ->where('Client_id',$value->user_id)
            ->where('ClientStatus','=','Shortlisted')
            ->count();

            $Rejected= DB::table('SharedClient')
            ->where('Client_id',$value->user_id)
            ->where('ClientStatus','=','Rejected')
            ->count();

            $Interview= DB::table('SharedClient')
            ->where('Client_id',$value->user_id)
            ->where('ClientStatus','=','Interview')
            ->count();

         
            $ReferenceCheck= DB::table('SharedClient')
            ->where('Client_id',$value->user_id)
            ->where('ClientStatus','=','Reference Check')
            ->count();
$SalaryFinalization= DB::table('SharedClient')
            ->where('Client_id',$value->user_id)
            ->where('ClientStatus','=','Salary Finalization')
            ->count();
$SendItegration= DB::table('SharedClient')
                ->where('Client_id',$value->user_id)
                ->where('ClientStatus','=','Send to Itegration')
                ->count();

          //country name
            $country=Country::where('id',$value->country_id)->first();
            $city=City::where('id',$value->city_id)->first();

            //city name
            //image for client
            $image=User::where('id',$value->user_id)->first();

            
            array_push($data,array(
            'name'=>$value->first_name,
            'user_id'=>$value->user_id,
            'country'=>$country->name,
            'city'=>$city->name,
            'Shortlisted'=>$Shortlisted,
            'Interview'=>$Interview,
            'Rejected'=>$Rejected,

            'ReferenceCheck'=>$ReferenceCheck,
            'SendItegration'=>$SendItegration,
            'SalaryFinalization'=>$SalaryFinalization,
            'image'=>$image->logo

            ));
  
        }
return response()->json(['users' => $allclient,"Message"=> "",
        "Success"=>true]); 

    } 
public function clientStore(Request $request)
  {
  
    try
    {
        
        
        $userExsist=User::where('email',$request['email'])->first();
        if($userExsist !=null)
        {
             return response()->json(['user' => [],"Message"=> "email already Exsist",
        "Success"=>true]);
        }

        $code = 1000;
        $points=0;
        $countcoins=['name'=>$request['name'],
        'email'=>$request['email'],
        'password' => bcrypt($request['password']),
        'last_name'=>$request['name'],
        'country_id'=>$request['country_id'],
        'city_id'=>$request['city_id'],
        'type'=>'employer',   
        ];
        foreach ( $countcoins as   $value) 
        {
            if($value != null && $value !="0")
            {
             $points ++;
            }
        }
    $totalpoints=$points*5;

        //get the code value;
        $lastUser =  \DB::table('users')->orderBy('id', 'desc')->first();
        if($lastUser)
        {
            $code = $lastUser->code++;
        }
    //*code generated*/

    //**create user
        $user = User::create(['name'=>$request['name'],
        'email'=>$request['email'],'password' => bcrypt($request['password']),
        'type'=>'employer','code'=>$code]);
    //**user created
        $input = $request->all();
        if($user)
        {
            $EmployerProfile=EmployerProfile::where('user_id',$request['user_id'])->first();  
            $emptype= EmployerProfile::create(['city_id'=>$request['city_id'],
            'type'=>'client','first_name'=>$request['name'],
            'last_name'=>$request['name'],'country_id'=>$request['country_id'],
            'user_id'=>$user->id,'Agency_ID'=>$request['user_id'],'phone'=>$EmployerProfile->phone,'coins'=>$totalpoints]);
        }
      
     \App\Company::create(['name'=>$request['name'],'size'=>'0','Country_id'=>$request['country_id'],'lat'=>'0','lang'=>'0','Created_by'=>$user->id,'industry_id'=>'0']);
     
     
          $user=EmployerProfile::with(['country','city'])
          ->join('users','users.id','=','employer_profiles.user_id')
           ->join('companies','companies.Created_by','=','employer_profiles.user_id')
          ->where('user_id',$user->id )
          ->select('*','users.*','employer_profiles.type as usertype','companies.*')
          ->first();
     
     

          return response()->json(['user' => $user,"Message"=> "",
        "Success"=>true]);   
          }    
    catch(Exception $e) 
        {
           return response()->json(['data' => [],"Message"=> "",
        "Success"=>false]); 
         }  
    }
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'email' => 'required|email', 
            'password' => 'required', 
            'c_password' => 'required|same:password', 
        ]);
if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
$input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        $user = User::create($input); 
        $success['token'] =  $user->createToken('MyApp')-> accessToken; 
        $success['name'] =  $user->name;
        
         // add fcm token
          if (request('token')) {
              UserDevicesToken::firstOrCreate(['user_id' => $user->id, 'fcm_token' => request('token')]);
          }
return response()->json(['success'=>$success], $this-> successStatus); 
    }
/** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function details() 
    { 
        $user = Auth::user(); 
        return response()->json(['user' => $user], $this-> successStatus); 
    } 
    public function employerprofile(Request $request)
    {
        
       
        
            $user=EmployerProfile::with(['country','city'])
          ->join('users','users.id','=','employer_profiles.user_id')
          ->join('companies','companies.Created_by','=','employer_profiles.user_id')
          ->where('user_id', $request->user_id)
          ->select('*','users.*','employer_profiles.type as usertype','companies.*')
          ->first();
             return response()->json(['user' => $user,"Message"=> "",
        "Success"=>true]); 
          
    }
      public function searchcandidate(Request $request) 
    {
        
        try{
            
            
        $country_id=[];
        if ($request['country_id'] != "")
        {
            foreach(explode('_', $request['country_id']) as $info) 
            {
            array_push($country_id, $info);
            } 
        } 
        
        $skills_id=[];
        if ($request['skills_id'] != "")
        {
            foreach(explode('_', $request['skills_id']) as $info) 
            {
            array_push($skills_id, $info);
            } 
        }
             if (request('Natinality_id')==0 && request('country_id')== "" &&
            request('job_id')== "" && request('skills_id')=="" &&  request('gender')==0 && request('industry_id')==0)
            {
              $Data=CandidateInfo::with(['country','religion','job','industry','nationality','ExperinceWork','getCandidateLang','getCandidatePreferedLoc','getCandidateSkill','currency'])
                ->join('users','users.id','=','candidate_infos.user_id')
               ->select('*','users.*','users.type as usertype','descripe_yourself as description','phone_number as phone')
                ->get();
                
              return response()->json(['users' => $Data,"Message"=> "","Success"=>true]); 
            }


            else if  (request('Natinality_id')!=0 && request('country_id')== "" &&
            request('job_id')== "" && request('skills_id')=="" &&  request('gender')==0 && request('industry_id')==0)
            {
              $Data=CandidateInfo::with(['country','religion','job','industry','nationality','ExperinceWork','getCandidateLang','getCandidatePreferedLoc','getCandidateSkill','currency'])
                ->join('users','users.id','=','candidate_infos.user_id')
                ->where('nationality_id',request('Natinality_id'))
             ->select('*','users.*','users.type as usertype','descripe_yourself as description','phone_number as phone')
                ->get();
                
              return response()->json(['users' => $Data,"Message"=> "","Success"=>true]); 
            }

            else if  (request('Natinality_id')==0 && request('country_id')!= "" &&
            request('job_id')== "" && request('skills_id')=="" &&  request('gender')==0 && request('industry_id')==0)
            {
              $Data=CandidateInfo::with(['country','religion','job','industry','nationality','ExperinceWork','getCandidateLang','getCandidatePreferedLoc','getCandidateSkill','currency'])
                ->join('users','users.id','=','candidate_infos.user_id')
                ->whereIN('country_id',$country_id)
             ->select('*','users.*','users.type as usertype','descripe_yourself as description','phone_number as phone')
                ->get();
                
              return response()->json(['users' => $Data,"Message"=> "","Success"=>true]); 
            }
             //industry_id 
            else if  (request('Natinality_id')==0 && request('country_id')== "" &&
            request('job_id')== "" && request('skills_id')=="" &&  request('gender')==0 && request('industry_id')!=0)
            {
              $Data=CandidateInfo::with(['country','religion','job','industry','nationality','ExperinceWork','getCandidateLang','getCandidatePreferedLoc','getCandidateSkill','currency'])
                ->join('users','users.id','=','candidate_infos.user_id')
                ->where('industry_id',request('industry_id'))
               ->select('*','users.*','users.type as usertype','users.type as usertype','descripe_yourself as description','phone_number as phone')
                ->get();
                
              return response()->json(['users' => $Data,"Message"=> "","Success"=>true]); 
            }
  //gender 
  else if  (request('Natinality_id')==0 && request('country_id')== "" &&
  request('job_id')== "" && request('skills_id')=="" &&  request('gender')!=0 && request('industry_id')==0)
  {
    $Data=CandidateInfo::with(['country','religion','job','industry','nationality','ExperinceWork','getCandidateLang','getCandidatePreferedLoc','getCandidateSkill','currency'])
      ->join('users','users.id','=','candidate_infos.user_id')
      ->where('gender',request('gender'))
    ->select('*','users.*','users.type as usertype','descripe_yourself as description','phone_number as phone')
      ->get();
      
    return response()->json(['users' => $Data,"Message"=> "","Success"=>true]); 
  }
  //skills
  else if  (request('Natinality_id')==0 && request('country_id')== "" &&
  request('job_id')== "" && request('skills_id')!="" &&  request('gender')==0 && request('industry_id')==0)
  {
    $Data=CandidateInfo::with(['country','religion','job','industry','nationality','ExperinceWork','getCandidateLang','getCandidatePreferedLoc','getCandidateSkill','currency'])
      ->join('users','users.id','=','candidate_infos.user_id')
      ->join('user_skills','user_skills.user_id','=','candidate_infos.user_id')
      ->whereIN('user_skills.skill_id',$skills_id)
    ->select('*','users.*','users.type as usertype','descripe_yourself as description','phone_number as phone')
      ->get();
      
    return response()->json(['users' => $Data,"Message"=> "","Success"=>true]); 
  }
      //job name
    else if (request('job_id')!= "" && request('Natinality_id')== 0 &&
      request('country_id')== ""  && request('skills_id')=="" &&  request('gender')==0 && request('industry_id')==0)
       {
      
          $Matchingcandata=[];
          $JobNameLiks=Job::where('name', 'LIKE', '%'.request('job_id').'%')->get();
          foreach($JobNameLiks as $JobNameLiks)
          {
              $Matchingcan = CandidateInfo::with(['country','religion','job','industry','nationality','ExperinceWork','getCandidateLang','getCandidatePreferedLoc','getCandidateSkill','currency'])
              ->join('users','users.id','=','candidate_infos.user_id')
              ->where('job_id',$JobNameLiks->id)
          ->select('*','users.*','users.type as usertype','descripe_yourself as description','phone_number as phone')
              ->get();
                
              foreach ($Matchingcan as $Matching) {
                 array_push($Matchingcandata, $Matching); 
              }  
          } 
             return response()->json(['users' => $Matchingcandata,"Message"=> "","Success"=>true]); 
       }



    else if  (request('Natinality_id')!=0 && request('country_id')!= "" &&
            request('job_id')== "" && request('skills_id')=="" &&  
            request('gender')==0 && request('industry_id')==0)
            {
              $Data=CandidateInfo::with(['country','religion','job','industry','nationality','ExperinceWork','getCandidateLang','getCandidatePreferedLoc','getCandidateSkill','currency'])
                ->join('users','users.id','=','candidate_infos.user_id')
                ->whereIN('country_id',$country_id)
                 ->where('nationality_id',request('Natinality_id'))
               ->select('*','users.*','users.type as usertype','descripe_yourself as description','phone_number as phone')
                ->get();
              return response()->json(['users' => $Data,"Message"=> "","Success"=>true]); 
            }
            
    else if  (request('Natinality_id')!=0 && request('country_id')!= "" &&
    request('job_id')== "" && request('skills_id')=="" &&  
    request('gender')!=0 && request('industry_id')!=0)
    {
        $Data=CandidateInfo::with(['country','religion','job','industry','nationality','ExperinceWork','getCandidateLang','getCandidatePreferedLoc','getCandidateSkill','currency'])
        ->join('users','users.id','=','candidate_infos.user_id')
        ->whereIN('country_id',$country_id)
        ->where('nationality_id',request('Natinality_id'))
        ->where('gender',request('gender'))
        ->where('industry_id',request('industry_id'))
      ->select('*','users.*','users.type as usertype','descripe_yourself as description','phone_number as phone')
        ->get();
        return response()->json(['users' => $Data,"Message"=> "","Success"=>true]); 
    }
    else if  (request('Natinality_id')!=0 && request('country_id')!= "" &&
    request('job_id')== "" && request('skills_id')=="" &&  
    request('gender')!=0 && request('industry_id')==0)
    {
        $Data=CandidateInfo::with(['country','religion','job','industry','nationality','ExperinceWork','getCandidateLang','getCandidatePreferedLoc','getCandidateSkill','currency'])
        ->join('users','users.id','=','candidate_infos.user_id')
        ->whereIN('country_id',$country_id)
        ->where('nationality_id',request('Natinality_id'))
        ->where('gender',request('gender'))
->select('*','users.*','descripe_yourself as description','phone_number as phone')
        ->get();
        return response()->json(['users' => $Data,"Message"=> "","Success"=>true]); 
    } 
    else if  (request('Natinality_id')!=0 && request('country_id')!= "" &&
    request('job_id')== "" && request('skills_id')=="" &&  
    request('gender')==0 && request('industry_id')!=0)
    {
        $Data=CandidateInfo::with(['country','religion','job','industry','nationality','ExperinceWork','getCandidateLang','getCandidatePreferedLoc','getCandidateSkill','currency'])
        ->join('users','users.id','=','candidate_infos.user_id')
        ->whereIN('country_id',$country_id)
        ->where('nationality_id',request('Natinality_id'))
        ->where('industry_id',request('industry_id'))
        ->select('*','users.*','users.type as usertype','descripe_yourself as description','phone_number as phone')
        ->get();
        return response()->json(['users' => $Data,"Message"=> "","Success"=>true]); 
    }   
    else if (request('job_id')!= "" && request('Natinality_id')!= 0 && request('country_id')!= ""  && request('skills_id')=="" &&  request('gender')==0 && request('industry_id')==0)
        {
            $Matchingcandata=[];
            $JobNameLiks=Job::where('name', 'LIKE', '%'.request('job_id').'%')->get();
            foreach($JobNameLiks as $JobNameLiks)
            {
                $Matchingcan = CandidateInfo::with(['country','religion','job','industry','nationality','ExperinceWork','getCandidateLang','getCandidatePreferedLoc','getCandidateSkill','currency'])
                ->join('users','users.id','=','candidate_infos.user_id')
                ->whereIN('country_id',$country_id)
                ->where('nationality_id',request('Natinality_id'))
                ->where('job_id',$JobNameLiks->id)
               ->select('*','users.*','users.type as usertype','descripe_yourself as description','phone_number as phone')
                ->get();
                foreach ($Matchingcan as $Matching) {
                   array_push($Matchingcandata, $Matching); 
                }  
            } 
               return response()->json(['users' => $Matchingcandata,"Message"=> "","Success"=>true]); 
        }
               //job name
    else if (request('job_id')!= "" && request('Natinality_id')!= 0 &&
        request('country_id')== ""  && request('skills_id')=="" &&  request('gender')==0 && request('industry_id')==0)
         {
            $Matchingcandata=[];
            $JobNameLiks=Job::where('name', 'LIKE', '%'.request('job_id').'%')->get();
            foreach($JobNameLiks as $JobNameLiks)
            {
                $Matchingcan = CandidateInfo::with(['country','religion','job','industry','nationality','ExperinceWork','getCandidateLang','getCandidatePreferedLoc','getCandidateSkill','currency'])
                ->join('users','users.id','=','candidate_infos.user_id')
                 ->where('nationality_id',request('Natinality_id'))
                ->where('job_id',$JobNameLiks->id)
              ->select('*','users.*','users.type as usertype','descripe_yourself as description','phone_number as phone')
                ->get();
                  
                foreach ($Matchingcan as $Matching) {
                   array_push($Matchingcandata, $Matching); 
                }  
            } 
               return response()->json(['users' => $Matchingcandata,"Message"=> "","Success"=>true]); 
         }
              //job name
    else if (request('job_id')!= "" && request('Natinality_id')== 0 &&
        request('country_id')!= ""  && request('skills_id')=="" &&  request('gender')==0 && request('industry_id')==0)
         {
            $Matchingcandata=[];
            $JobNameLiks=Job::where('name', 'LIKE', '%'.request('job_id').'%')->get();
            foreach($JobNameLiks as $JobNameLiks)
            {
                $Matchingcan = CandidateInfo::with(['country','religion','job','industry','nationality','ExperinceWork','getCandidateLang','getCandidatePreferedLoc','getCandidateSkill','currency'])
                ->join('users','users.id','=','candidate_infos.user_id')
                ->whereIN('country_id',$country_id)
                ->where('job_id',$JobNameLiks->id)
               ->select('*','users.*','users.type as usertype','descripe_yourself as description','phone_number as phone')
                ->get();
                  
                foreach ($Matchingcan as $Matching) {
                   array_push($Matchingcandata, $Matching); 
                }  
            } 
               return response()->json(['users' => $Matchingcandata,"Message"=> "","Success"=>true]); 
         }
        }
       catch(Exception $e) 
        {
          return response()->json(['error'=>'error data'], 401);
       }
    }
    
    
    
     public function getseenprofilebydate(Request $request)
        {
            
            
            
            $seenprofile=[];
              $Start_Date=$request->date ." 00:00:00";
            $End_Date=$request->date ." 23:59:59";
             $range=array( $Start_Date, $End_Date);
            $data=seen_profile::where('user_id',$request->user_id)
            ->whereBetween('created_at',$range)
     
            ->get();
            foreach($data as $value)
            {
          
       
              $user=EmployerProfile::with(['country','city'])
          ->join('users','users.id','=','employer_profiles.user_id')
          ->join('companies','companies.Created_by','=','employer_profiles.user_id')
          ->where('user_id', $value->employer_id)
          ->select('*','users.*','employer_profiles.type as usertype','companies.*')
          ->first();
          
               
                   array_push($seenprofile, $user); 
                
            } 
               return response()->json(['seenprofile' => $seenprofile,"Message"=> "","Success"=>true]); 

        }
        
        
        
        
         public function getseenprofilegroupdate(Request $request)
        {
            
            
            
            $seenprofile=[];
            

            
            
             $data=seen_profile::where('user_id',$request->user_id)
            ->select("seen_profile.created_at",DB::raw("(COUNT(seen_profile.employer_id)) as count"))
        ->orderBy('created_at')
        ->groupBy(DB::raw("(seen_profile.created_at)"))
        ->get();
            
            
       //     dd($data);
            
        //     foreach($data as $value)
        //     {
          
       
        //       $user=EmployerProfile::with(['country','city'])
        //   ->join('users','users.id','=','employer_profiles.user_id')
        //   ->join('companies','companies.Created_by','=','employer_profiles.user_id')
        //   ->where('user_id', $value->employer_id)
        //   ->select('*','users.*','companies.*')
        //   ->first();
          
               
        //           array_push($seenprofile, $user); 
                
        //     } 
               return response()->json(['seenprofile' => $data,"Message"=> "","Success"=>true]); 

        }
        
        public function getpackages()
        {
           $data= Packages::with(['getpackattribute'])->get();
            return response()->json(['packages' => $data,"Message"=> "","Success"=>true]); 
           
        }
        
          public function getuserpackages (Request $request)
    {
        $DueDate=Carbon::now()->toDateString();
          $data= Packages::with(['getpackattribute'])
             ->join('package_user','package_user.packages_id','=','packages.id')
            ->where('users_id',$request['users_id'])
            ->where('EndDate','!=' ,$DueDate)
           ->get();
            return response()->json(['packages' => $data,"Message"=> "","Success"=>true]); 
    }
    
    public function choosepackages (Request $request)
    {


    $DueDate=Carbon::now()->toDateString();
    //check user if has Valid Date
       $Packagevalid=PackagesUser::where('users_id',$request['users_id'])
                    ->where('EndDate','!=' ,$DueDate)
                    ->first();
                
                if( $Packagevalid != null || $Packagevalid !=[])  
                 {
                
                       return response()->json(['data' => [],"Message"=> "you already have payment dosenot finish yet","Success"=>true]);    
                 }   
                else
                 {


                    $PackageData= New PackagesUser;
                    $PackageData->packages_id=$request['packages_id'];
                    $PackageData->users_id=$request['users_id'];

                    $Start=Carbon::now();
                    $PackageData->StartDate=$Start->toDateString();
                  
                    if($request['PackType']==1)
                    $End=$Start->addDays(30);
                    else
                    $End=$Start->addDays(365);
                    
                    $PackageData->EndDate=$End->toDateString();
                    $PackageData->PackType=$request['PackType'];

                    $PackageData->save();
        
    return response()->json(['data' => [],"Message"=> "","Success"=>true]); 
                 }
 
    }
      public function getseenprofile(Request $request)
        {
            
            
            
             $seenprofile=[];
            $data=seen_profile::where('user_id',$request->user_id)->get();
            foreach($data as $value)
            {
    
                 $user=EmployerProfile::with(['country','city'])
          ->join('users','users.id','=','employer_profiles.user_id')
          ->join('companies','companies.Created_by','=','employer_profiles.user_id')
         ->where('user_id', $value->employer_id)
          ->select('*','users.*','employer_profiles.type as usertype','companies.*')
          ->first();
               
                   array_push($seenprofile, $user); 
                
            } 
               return response()->json(['seenprofile' => $seenprofile,"Message"=> "","Success"=>true]); 

        }
        
        public function updatepostjobstatus(Request $request)
        {
            $postjob=PostJob::find($request->job_id);
      
            $postjob->status=$request->status;
            $postjob->save();
            return response()->json(['Data' => [],"Message"=> "","Success"=>true]); 
            
        }
          public function getseenjobbydate(Request $request)
        {
            
            $seenjob=[];
              $Start_Date=$request->date ." 00:00:00";
            $End_Date=$request->date ." 23:59:59";
             $range=array( $Start_Date, $End_Date);
            $data=seen_job::where('job_id',$request->job_id)
             ->whereBetween('created_at',$range)
            ->get();
            foreach($data as $value)
            {
                $user=CandidateInfo::with(['country','religion','job','industry','nationality','ExperinceWork','getCandidateLang','getCandidatePreferedLoc','getCandidateSkill','currency'])
                ->join('users','users.id','=','candidate_infos.user_id')
                ->where('user_id', $value->can_id)
              ->select('*','users.*','users.type as usertype','descripe_yourself as description','phone_number as phone')
                ->first();  
                array_push($seenjob, $user); 
                
            } 
               return response()->json(['seen' => $seenjob,"Message"=> "","Success"=>true]); 
            
        }
          public function getseenjob(Request $request)
        {
            
            $seenjob=[];
            $data=seen_job::where('job_id',$request->job_id)->get();
            foreach($data as $value)
            {
                $user=CandidateInfo::with(['country','religion','job','industry','nationality','ExperinceWork','getCandidateLang','getCandidatePreferedLoc','getCandidateSkill','currency'])
                ->join('users','users.id','=','candidate_infos.user_id')
                ->where('user_id', $value->can_id)
              ->select('*','users.*','users.type as usertype','descripe_yourself as description','phone_number as phone')
                ->first();  
                array_push($seenjob, $user); 
                
            } 
               return response()->json(['users' => $seenjob,"Message"=> "","Success"=>true]); 
            
        }
        
        public function seenprofile(Request $request)
        {
        // try
        //     {
              
            $seen_profile= New seen_profile;
            $seen_profile->employer_id =$request->employer_id;
           
            $seen_profile->user_id =$request->user_id;

            $seen_profile->save(); 
            
            return response()->json(['seen_profile' => $seen_profile,"Message"=> "","Success"=>true]); 
                
        //     }
        //  catch(Exception $e) 
        //     {
        //       return response()->json(['error'=>'error data'], 401);
        //     }
        
    }
      public function seenjob(Request $request)
        {
        // try
        //     {
              
            $seen_job= New seen_job;
            $seen_job->job_id =$request->job_id;
           
            $seen_job->can_id =$request->can_id;

            $seen_job->save(); 
            
            return response()->json(['seen_job' => [],"Message"=> "","Success"=>true]); 
                
        //     }
        //  catch(Exception $e) 
        //     {
        //       return response()->json(['error'=>'error data'], 401);
        //     }
        
    }
    
    
    
    
    
    
     public function addworkexprience(Request $request)
    {
          $can_experience = ['working_in'=>$request['working_in'],'start_date'=>$request['start_date'],'end_date'=>$request['end_date'],'employer_nationality_id'=>$request['employer_nationality_id'],'company_name'=>$request['company_name'],'country_id'=>$request['work_country_id'],'salary'=>$request['salary'],'role'=>$request['role'],'user_id'=>$request->user_id,'currency_id'=>$request['currency_id'],'job_id'=>$request['job_id']];
          //dd($can_experience);
        CandidateExperience::create($can_experience);
            return response()->json(['Data' => [],"Message"=> "","Success"=>true]);  
        
    }
    
    public function updateworkexprience(Request $request)
    {
        
          $can_experience =CandidateExperience::find($request->id);
          if($request['working_in'] !=null){
              $can_experience->working_in=$request['working_in'];
          }
           if($request['start_date'] !=null){
              $can_experience->start_date=$request['start_date'];
          }
         if($request['end_date'] !=null){
              $can_experience->end_date=$request['end_date'];
          }
           if($request['employer_nationality_id'] !=null){
              $can_experience->employer_nationality_id=$request['employer_nationality_id'];
          }
            if($request['company_name'] !=null){
              $can_experience->company_name=$request['company_name'];
          }
            if($request['work_country_id'] !=null){
              $can_experience->country_id=$request['work_country_id'];
          }
            if($request['salary'] !=null){
              $can_experience->salary=$request['salary'];
          }
         if($request['role'] !=null){
              $can_experience->role=$request['role'];
          }
           if($request['currency_id'] !=null){
              $can_experience->currency_id=$request['currency_id'];
          }
           if($request['job_id'] !=null){
              $can_experience->job_id=$request['job_id'];
          }
        if($request['user_id'] !=null){
              $can_experience->user_id=$request['user_id'];
          }
    
        
          //dd($can_experience);
        $can_experience->save();
            return response()->json(['Data' => [],"Message"=> "","Success"=>true]);  
    }
    
    public function deleteworkexprience(Request $request)
    {
         $can_experience =CandidateExperience::find($request->id);
           $can_experience->delete();
            return response()->json(['Data' => [],"Message"=> "","Success"=>true]);  
         
    }
    
    public function getworkexprience(Request $request)
    {
         $can_experience =CandidateExperience::with(['experincecountry','Empnationality','job','currency'])->where('user_id',$request->user_id)->get();
     
            return response()->json(['Data' =>$can_experience,"Message"=> "","Success"=>true]);  
         
    }
    
      public function checkpassword(Request $request)
    {
        $user=User::where('id',$request->user_id)->first();
        
        
         if(Auth::attempt(['email' => $user->email, 'password' => $request->password])){ 
            return response()->json(['Data' => [],"Message"=> "","Success"=>true]);   
         }
        
        else
        {
              return response()->json(['Data' => [],"Message"=> "","Success"=>false]); 
        }
        
    }
       public function updatepassword(Request $request)
    {
        
        $user=User::where('id',$request->user_id)->first();
        
         if(Auth::attempt(['email' => $user->email, 'password' => $request->oldpassword])){ 
             
        $user=User::where('id',$request->user_id)->first();
        $user->password= Hash::make($request->password);
        $user->save();;  
          return response()->json(['Data' =>[],"Message"=> "","Success"=>true]);
         }
         else
         {
                
            return response()->json(['Data' =>[],"Message"=> "","Success"=>false]); 
         }
        
        
     
        
        
    }
    
    

     public function addsetting(Request $request)
    {
        try
            {
                $Notification_settings=Notification_settings::where('user_id',$request->user_id)->first();
                
                if($Notification_settings==null)
                {
            $Notification_settings= New Notification_settings;
            $Notification_settings->inbox_email =$request->inbox_email;
            $Notification_settings->inbox_push =$request->inbox_push;
                  
            $Notification_settings->companies_email = $request->companies_email;
            $Notification_settings->companies_push =$request->companies_push;
                  
            $Notification_settings->profile_email = $request->profile_email;
            $Notification_settings->profile_push = $request->profile_push;
                  
            $Notification_settings->user_id =$request->user_id;
                  
                }
                else
                {
                    if($request->inbox_email !=null)
                    {
                         $Notification_settings->inbox_email =$request->inbox_email;
                    }
                    if($request->inbox_push !=null)
                    {
                          $Notification_settings->inbox_push =$request->inbox_push;
            
                    }
                    
                    
                     if($request->companies_email !=null)
                    {
                          $Notification_settings->companies_email = $request->companies_email;
                    }
                    
                    
                     if($request->companies_push !=null)
                    {
                            $Notification_settings->companies_push =$request->companies_push;
                    }
                    
                    
                     if($request->profile_email !=null)
                    {
                      $Notification_settings->profile_email = $request->profile_email;
                    }
                    
                    
                     if($request->profile_push !=null)
                    {
                         $Notification_settings->profile_push = $request->profile_push;
                    }
 
            $Notification_settings->user_id =$request->user_id;
                }
           
            
          
            $Notification_settings->save(); 
            
            return response()->json(['Notification_settings' => $Notification_settings,"Message"=> "","Success"=>true]); 
                
            }
         catch(Exception $e) 
            {
              return response()->json(['error'=>'error data'], 401);
            }
        
    }
    
     public function getusersetting(Request $request)
    {
          $Notification_settings=Notification_settings::where('user_id',$request->user_id)->first(); 
            
            return response()->json(['Notification_settings' => $Notification_settings,"Message"=> "","Success"=>true]);
    }
    
    
    public function searchjobs(Request $request) 
    {
        try
        {
            if (request('job_id')== "" && request('country_id')== "" &&
            request('industry_id')== 0 && request('employment_type_id') == 0 &&
            request('experience_id')== 0 && request('salary_from')== 0 
            && request('salary_to')== 0 )
            {
               
              $Data=PostJob::with(['Industry','job','Currency','country','getJobLanguage','getJobSkill'])->get();
              return response()->json(['jobs' => $Data,"Message"=> "","Success"=>true]); 
            }
          
             //Desired location
            else if (request('job_id')== "" && request('country_id')!= 0 &&
            request('industry_id')== 0 && request('employment_type_id') == 0 &&
            request('experience_id')== 0 && request('salary_from')== 0 
            && request('salary_to')== 0 )
            {
                
                $Data=PostJob::with(['Industry','job','Currency','country','getJobLanguage','getJobSkill'])
                ->where('country_id',request('country_id'))->get();
              return response()->json(['jobs' => $Data,"Message"=> "","Success"=>true]); 
            }
             //industry
            else if (request('job_id')== "" && request('country_id')== 0 &&
            request('industry_id')!= 0 && request('employment_type_id') == 0 &&
            request('experience_id')== 0 && request('salary_from')== 0 
            && request('salary_to')== 0 )
            {
              
                $Data=PostJob::with(['Industry','job','Currency','country','getJobLanguage','getJobSkill'])
                ->where('industry_id',request('industry_id'))->get();
                return response()->json(['jobs' => $Data,"Message"=> "","Success"=>true]); 
            }
           //employer
           else if (request('job_id')== "" && request('country_id')== 0 &&
           request('industry_id')== 0 && request('employment_type_id') != 0 &&
           request('experience_id')== 0 && request('salary_from')== 0 
           && request('salary_to')== 0 )
            {
              
                $Data=PostJob::with(['Industry','job','Currency','country','getJobLanguage','getJobSkill'])
                ->where('job_for',request('employment_type_id'))->get();
                  return response()->json(['jobs' => $Data,"Message"=> "","Success"=>true]); 
            }
        //   --------------------------------------------------
        //salary
        else if (request('job_id')== "" && request('country_id')== 0 &&
        request('industry_id')== 0 && request('employment_type_id') == 0 &&
        request('experience_id')== 0 && request('salary_from')!= 0 
        && request('salary_to')!= 0 )
         {
        
             $Data=PostJob::with(['Industry','job','Currency','country','getJobLanguage','getJobSkill'])
             ->whereBetween('min_salary',[request('salary_from'),request('salary_to')])
            ->whereBetween('max_salary',[request('salary_from'),request('salary_to')])
             ->get();
               return response()->json(['jobs' => $Data,"Message"=> "","Success"=>true]); 
         }
        //job name
        else if (request('job_id')!= "" && request('country_id')== 0 &&
        request('industry_id')== 0 && request('employment_type_id') == 0 &&
        request('experience_id')== 0 && request('salary_from')== 0 
        && request('salary_to')== 0 )
         {
            $MatchingJobs=[];
            $JobNameLiks=Job::where('name', 'LIKE', '%'.request('job_id').'%')->get();
            foreach($JobNameLiks as $JobNameLiks)
            {
                $MatchingJo = PostJob::with(['Industry','job','Currency','country','getJobLanguage','getJobSkill'])
                ->where('job_id',$JobNameLiks->id)
                ->get();    
                foreach ($MatchingJo as $Matching) {
                   array_push($MatchingJobs, $Matching); 
                }  
            } 
               return response()->json(['jobs' => $MatchingJobs,"Message"=> "","Success"=>true]); 
         }
 //all have values 
 else if (request('job_id')!= "" && request('country_id')!= 0 &&
        request('industry_id')!= 0 && request('employment_type_id') != 0 &&
        request('experience_id')!= 0 && request('salary_from')!= 0 
        && request('salary_to')!= 0 )
         {
            $MatchingJobs=[];
            $JobNameLiks=Job::where('name', 'LIKE', '%'.request('job_id').'%')->get();
            foreach($JobNameLiks as $JobNameLiks)
            {
                $MatchingJo = PostJob::with(['Industry','job','Currency','country','getJobLanguage','getJobSkill'])
                ->where('job_id',$JobNameLiks->id)
                ->whereBetween('min_salary',[request('salary_from'),request('salary_to')])
                ->whereBetween('max_salary',[request('salary_from'),request('salary_to')])
                ->where('job_for',request('employment_type_id'))
                ->where('industry_id',request('industry_id'))
                ->where('country_id',request('country_id'))
                ->get();    
                foreach ($MatchingJo as $Matching) {
                   array_push($MatchingJobs, $Matching); 
                }  
            } 
               return response()->json(['jobs' => $MatchingJobs,"Message"=> "","Success"=>true]); 
         }
          
         
 //all have values 
 else if (request('job_id')!= "" && request('country_id')!= 0 &&
        request('industry_id')!= 0 && request('employment_type_id') != 0 &&
        request('experience_id')== 0 && request('salary_from')== 0 
        && request('salary_to')== 0 )
         {
            $MatchingJobs=[];
            $JobNameLiks=Job::where('name', 'LIKE', '%'.request('job_id').'%')->get();
            foreach($JobNameLiks as $JobNameLiks)
            {
                $MatchingJo = PostJob::with(['Industry','job','Currency','country','getJobLanguage','getJobSkill'])
                ->where('job_id',$JobNameLiks->id)
                ->where('job_for',request('employment_type_id'))
                ->where('industry_id',request('industry_id'))
                ->where('country_id',request('country_id'))
                ->get();    
                foreach ($MatchingJo as $Matching) {
                   array_push($MatchingJobs, $Matching); 
                }  
            } 
               return response()->json(['jobs' => $MatchingJobs,"Message"=> "","Success"=>true]); 
         }
         else if (request('job_id')!= "" && request('country_id')!= 0 &&
         request('industry_id')!= 0 && request('employment_type_id') == 0 &&
         request('experience_id')== 0 && request('salary_from')== 0 
         && request('salary_to')== 0 )
          {
             $MatchingJobs=[];
             $JobNameLiks=Job::where('name', 'LIKE', '%'.request('job_id').'%')->get();
             foreach($JobNameLiks as $JobNameLiks)
             {
                 $MatchingJo = PostJob::with(['Industry','job','Currency','country','getJobLanguage','getJobSkill'])
                 ->where('job_id',$JobNameLiks->id)
                 ->where('industry_id',request('industry_id'))
                 ->where('country_id',request('country_id'))
                 ->get();    
                 foreach ($MatchingJo as $Matching) {
                    array_push($MatchingJobs, $Matching); 
                 }  
             } 
                return response()->json(['jobs' => $MatchingJobs,"Message"=> "","Success"=>true]); 
          }
          else if (request('job_id')!= "" && request('country_id')!= 0 &&
          request('industry_id')!= 0 && request('employment_type_id') != 0 &&
          request('experience_id')== 0 && request('salary_from')== 0 
          && request('salary_to')== 0 )
           {
              $MatchingJobs=[];
              $JobNameLiks=Job::where('name', 'LIKE', '%'.request('job_id').'%')->get();
              foreach($JobNameLiks as $JobNameLiks)
              {
                  $MatchingJo = PostJob::with(['Industry','job','Currency','country','getJobLanguage','getJobSkill'])
                  ->where('job_id',$JobNameLiks->id)
                  ->where('industry_id',request('industry_id'))
                  ->where('country_id',request('country_id'))
                  ->where('job_for',request('employment_type_id'))
                  ->get();    
                  foreach ($MatchingJo as $Matching) {
                     array_push($MatchingJobs, $Matching); 
                  }  
              } 
                 return response()->json(['jobs' => $MatchingJobs,"Message"=> "","Success"=>true]); 
           }
           else if (request('job_id')!= "" && request('country_id')== 0 &&
           request('industry_id')!= 0 && request('employment_type_id') != "" &&
           request('experience_id')== 0 && request('salary_from')== 0 
           && request('salary_to')== 0 )
            {
               
               $MatchingJobs=[];
               $JobNameLiks=Job::where('name', 'LIKE', '%'.request('job_id').'%')->get();
               foreach($JobNameLiks as $JobNameLiks)
               {
                   $MatchingJo = PostJob::with(['Industry','job','Currency','country','getJobLanguage','getJobSkill'])
                   ->where('job_id',$JobNameLiks->id)
                   ->where('industry_id',request('industry_id'))
                   ->where('job_for',request('employment_type_id'))
                   ->get();    
                   foreach ($MatchingJo as $Matching) {
                      array_push($MatchingJobs, $Matching); 
                   }  
               } 
                  return response()->json(['jobs' => $MatchingJobs,"Message"=> "","Success"=>true]); 
            }
          else if (request('job_id')!= "" && request('country_id')!= 0 &&
          request('industry_id')== 0 && request('employment_type_id') == 0 &&
          request('experience_id')== 0 && request('salary_from')== 0 
          && request('salary_to')== 0 )
           {
              $MatchingJobs=[];
              $JobNameLiks=Job::where('name', 'LIKE', '%'.request('job_id').'%')->get();
              foreach($JobNameLiks as $JobNameLiks)
              {
                  $MatchingJo = PostJob::with(['Industry','job','Currency','country','getJobLanguage','getJobSkill'])
                  ->where('job_id',$JobNameLiks->id)
          
                  ->where('country_id',request('country_id'))
                  ->get();    
                  foreach ($MatchingJo as $Matching) {
                     array_push($MatchingJobs, $Matching); 
                  }  
              } 
                 return response()->json(['jobs' => $MatchingJobs,"Message"=> "","Success"=>true]); 
           }
          

         }
        catch(Exception $e) 
          {
              return response()->json(['error'=>'error data'], 401);
          }
    }
/** 
     * alljobs api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function alljobs() 
    { 
        $Data = Job::all(); 
    return response()->json(['jobs'=>$Data,"Message"=> "","Success"=>true]);
    }
   
     public function company(Request $re) 
    { 
        $Data = Company::with(['Industry','country'])->where('Created_by',$re['Created_by'])->first(); 
    return response()->json(['company'=>$Data,"Message"=> "","Success"=>true]);
    }
    
    public function allidustry() 
    { 
        $Data = Industry::all(); 
        return response()->json(['idustries' => $Data,"Message"=> "",
        "Success"=>true]); 
    }
     public function language() 
    { 
        $Data = Language::all(); 
        return response()->json(['languages' => $Data,"Message"=> "",
        "Success"=>true]); 
    }
    
     public function getMatchingcandidates(Request $req)
    {
        $alljobCan=[];
        $Alljobs=\App\PostJob::where('created_by',$req->user_id)->select('job_id')->get();
        foreach ($Alljobs as  $value)
        {
           array_push($alljobCan,$value->job_id);
        }
        $TopCandidate=CandidateInfo::with(['country','religion','job','industry','nationality','ExperinceWork','getCandidateLang','getCandidatePreferedLoc','getCandidateSkill','currency'])
->join('users','users.id','=','candidate_infos.user_id')
->whereIN('job_id',$alljobCan)
->select('*','users.*','descripe_yourself as description','phone_number as phone')
->get();
         return response()->json(['users' => $TopCandidate,"Message"=> "",
        "Success"=>true]); 
    }
    
    
    
      public function getMatchingjobsregister(Request $Req)
    {
       $MatchingJobs=[];
        $CandidateInfo=CandidateInfo::where('user_id',$Req->user_id)->first();
        //dd($CandidateInfo);
        if($CandidateInfo->job_id!=null)
        {
            //Matching job 

          $JobName=Job::where('id',$CandidateInfo->job_id)->select('name')->first();
        

          $JobNameLiks=Job::where('name', 'LIKE', '%'.$JobName->name.'%')->get();
        foreach($JobNameLiks as $JobNameLiks)
          {
            $MatchingJo =PostJob::with(['Industry','job','country','getJobLanguage','getJobSkill'])->where('job_id',$JobNameLiks->id)
               ->get();
            

          foreach ($MatchingJo as $Matching) {
  
               array_push($MatchingJobs, $Matching); 
   
  
           }  
        }    
        }     
        else
        {

            $MatchingJobs=null;
        } 
        
        return response()->json(['jobs' => $MatchingJobs,"Message"=> "",
        "Success"=>true]); 
       
        
    }
    
    
      public function getMatchingcandidatescertainjon(Request $req)
    {
        $alljobCan=[];
        $Alljobs=\App\PostJob::where('created_by',$req->user_id)
        ->where('job_id',$req->job_id)
        ->select('job_id')->get();
        foreach ($Alljobs as  $value)
        {
           array_push($alljobCan,$value->job_id);
        }
        $TopCandidate=CandidateInfo::with(['country','religion','job','industry','nationality','ExperinceWork','getCandidateLang','getCandidatePreferedLoc','getCandidateSkill','currency'])
->join('users','users.id','=','candidate_infos.user_id')
->whereIN('job_id',$alljobCan)
->select('*','users.*','descripe_yourself as description','phone_number as phone')
->get();
         return response()->json(['candidates' => $TopCandidate,"Message"=> "",
        "Success"=>true]); 
    }
    
     public function allnationality() 
    { 
        $Data = Nationality::all(); 
        return response()->json(['nationality' => $Data,"Message"=> "",
        "Success"=>true]); 
    }
    public function allcurrency() 
    { 
        $Data = Currency::all(); 
        return response()->json(['currencies' => $Data,"Message"=> "","Success"=>true]); 
    }
     public function candidateVideos(Request $req) 
    { 
        $Data = DB::table('videos')->where('User_Id',$req['User_Id'])->get(); 
        return response()->json(['videos' => $Data,"Message"=> "","Success"=>true]); 
    }
      public function allexprience() 
    { 
        $Data = Exprience::all(); 
        return response()->json(['exprience' => $Data,"Message"=> "","Success"=>true]); 
    }
    
     public function employertype() 
    { 
       
        $Data =PostJob::select('job_for')->orderByRaw('FIELD(job_for, "Family", "Company", "Agency","Jobs In KSA","Jobs In Oman","Jobs In Qatar","Jobs In UAE","Maidcv.Com","Jobs In USA","GulfTalent")','DESC')
 ->distinct('job_for')->get();
        return response()->json(['employer_type' => $Data,"Message"=> "","Success"=>true]); 
    }
    
   
    /** 
     * allcountry api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function allcountry() 
    { 
        $Data = Country::all(); 
       return response()->json(['countries' => $Data,"Message"=> "",
        "Success"=>true]);  
    }
     public function allreligion() 
    { 
        $Data = Religion::all(); 
       return response()->json(['religion.' => $Data,"Message"=> "",
        "Success"=>true]);  
    }
      /** 
     * allskills api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function allskills() 
    { 
        $Data = Skills::all(); 
         return response()->json(['skills' => $Data,"Message"=> "",
        "Success"=>true] );  
    }
        /** 
     * allcity api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
   public function allcity(Request $request)
    { 
         $allcity = City::where('country_id',$request['id'])->get(); 
        return response()->json(['cities' => $allcity,"Message"=> "",
        "Success"=>true] ); 
    }
   /** 
     * viewjobapi 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function viewjob(Request $request)
    { 
        $Data =PostJob::with(['Industry','job','country','getJobLanguage','getJobSkill'])->where('id',$request['job_id'])
               ->first();
       
        
         return response()->json(['job' => $Data,"Message"=> "",
        "Success"=>true] ); 
        
    }
    public function revlantjob(Request $request)
    {
        // to get cand iD to get job id 
        $CandidateInfo=CandidateInfo::where('user_id',$request["can_id"])->first();
        $Data =PostJob::with(['Industry','job','country','getJobLanguage','getJobSkill'])->get();
  
       $MatchingJobs=[];
        $CandidateInfo=CandidateInfo::where('user_id',$request["can_id"])->first();
        //dd($CandidateInfo);
        if($CandidateInfo->job_id!=null)
        {
            //Matching job 

          $JobName=Job::where('id',$CandidateInfo->job_id)->select('name')->first();
        

          $JobNameLiks=Job::where('name', 'LIKE', '%'.$JobName->name.'%')->get();
        foreach($JobNameLiks as $JobNameLiks)
          {
            $MatchingJo = PostJob::with(['Industry','job','Currency','country','getJobLanguage','getJobSkill'])->where('job_id',$JobNameLiks->id)->get();    

          foreach ($MatchingJo as $Matching) {
  
               array_push($MatchingJobs, $Matching); 
   
  
           }  
        }    
        }     
        else
        {

            $MatchingJobs=null;
        } 
        // return $MatchingJobs;
   

        
        
        
       
          return response()->json(['jobs' => $MatchingJobs,"Message"=> "",
        "Success"=>true]); 
        
        
    }
 /** 
     * viewprofile
     * 
     * @return \Illuminate\Http\Response 
     */ 
  public function viewprofile(Request $request)
    { 
        $Data =CandidateInfo::with(['country','religion','job','industry','nationality','ExperinceWork','getCandidateLang','getCandidatePreferedLoc','getCandidateSkill','currency'])
->join('users','users.id','=','candidate_infos.user_id')
->where('user_id', $request->can_id)
->select('*','users.*','descripe_yourself as description','phone_number as phone')
->first();
        
        // if ($Data->CanInfo->birthdate !=null)
        // $age=$Data->getAge($Data->CanInfo->birthdate);
        // else
        // $age="";
  
        // $simialr_candidates = CandidateInfo::where('job_id',$Data->CanInfo->job_id)->where('country_id',$Data->CanInfo->country_id)
        // ->where('id','!=',$Data->CanInfo->id)->get(); 
       return response()->json(['user' => $Data,"Message"=> "","Success"=>true] ); 
    }
     public function jobbyemployer(Request $request)
    { 
        $Data =PostJob::with(['Industry','job','country','getJobLanguage','getJobSkill'])
->where('created_by',$request['user_id'])
->get();
 
       return response()->json(['jobs' => $Data,"Message"=> "","Success"=>true] ); 
    }
    public function applyjob(Request $request)
{
    $post_job=PostJob::find($request['job_id']);
    $Like=DB::table('job_applications')
    ->where('job_post_id',$request['job_id'])
    ->where('user_id',$request['user_id'])
    ->first();
    if($Like==null)
    {

    \DB::table('job_applications')->insert(
        array(
               'job_post_id' =>$request['job_id'], 
               'user_id'    =>$request['user_id'],
                'video_path'    =>$request['video_path'],
        )
    );
    return response()->json(['data' => [],"Message"=> "apllied Successfully","Success"=>true]); 
    }
    else
    {
        DB::table('job_applications')
    ->where('job_post_id',$request['job_id'])
    ->where('user_id',$request['user_id'])
    ->delete();
       
    return response()->json(['data' => [],"Message"=> "you remove appllied Successfully","Success"=>true]); 
    }
}  









public function savejob(Request $request)
{
    $post_job=PostJob::find($request['job_id']);
    $Like=DB::table('user_like_jobs')
    ->where('job_id',$request['job_id'])
    ->where('user_id',$request['user_id'])
    ->first();
    if($Like==null)
    {

    \DB::table('user_like_jobs')->insert(
        array(
               'job_id' =>$request['job_id'], 
               'user_id'    =>$request['user_id']
        )
    );
    return response()->json(['data' => [],"Message"=> "like Successfully","Success"=>true]); 
    }
    else
    {
        DB::table('user_like_jobs')
    ->where('job_id',$request['job_id'])
    ->where('user_id',$request['user_id'])
    ->delete();
       
    return response()->json(['data' => [],"Message"=> "dislike Successfully","Success"=>true]); 
    }
}    
public function yourfavouritejobs(Request $request)
{
    $Data=[];
    $favourite=DB::table('user_like_jobs')->where('user_id',$request['user_id'])->get();
//dd($favourite);
        foreach ($favourite as $Matching) {
            
            $Dataset=PostJob::with(['Industry','job','country','getJobLanguage','getJobSkill'])
            ->where('id',$Matching->job_id)
            ->first();
            if( $Dataset !=null){
                array_push($Data, $Dataset); 
            }
           
        } 

return response()->json(['jobs' => $Data,"Message"=> "","Success"=>true] ); 
}



public function whofavouritejobs(Request $request)
{
    $Data=[];
    $favourite=DB::table('user_like_jobs')->where('job_id',$request['job_id'])->get();

        foreach ($favourite as $Matching) {

            $Dataset= CandidateInfo::with(['country','religion','job','industry','nationality','ExperinceWork','getCandidateLang','getCandidatePreferedLoc','getCandidateSkill','currency'])
                ->join('users','users.id','=','candidate_infos.user_id')
                ->where('user_id',$Matching->user_id)
               ->select('*','users.*','users.type as usertype','descripe_yourself as description','phone_number as phone')
                ->first();
           array_push($Data, $Dataset); 
        } 

return response()->json(['users' => $Data,"Message"=> "","Success"=>true] ); 
}



public function deletejob(Request $request)
{
    $favourite=DB::table('user_like_jobs')->where('job_id',$request['job_id'])->get();
   // dd($favourite);
    if($favourite==null || $favourite==[]  )
    {
        $postjob=PostJob::find($request['job_id']);
        $postjob->delete();
        
    }
    else
    {
        return response()->json(['Data' => [],"Message"=> "",
        "Success"=>false] ); 
    }
    
}
public function favouritecan(Request $request)
{
        
        $Data=[];
        $favourite=DB::table('user_like_candidates')->where('employer_id',$request['user_id'])->get();
 
        foreach ($favourite as $Matching) {
            $Dataset= CandidateInfo::with(['country','religion','job','industry','nationality','ExperinceWork','getCandidateLang','getCandidatePreferedLoc','getCandidateSkill','currency'])
                ->join('users','users.id','=','candidate_infos.user_id')
                ->where('user_id',$Matching->user_id)
                ->select('*','users.*','users.type as usertype','descripe_yourself as description','phone_number as phone')
                ->first();
            
           array_push($Data,$Dataset); 
        } 
        
        return response()->json(['users' => $Data,"Message"=> "",
        "Success"=>true] ); 
}
    public function likecandidate(Request $request)
    {
        $liked = UserLikeCandidates::where('employer_id',$request['employer_id'])
        ->where('user_id',$request['can_id'])->first();
        if(!$liked)
        {
            \DB::table('user_like_candidates')->insert(
                array(
                       'employer_id' =>$request['employer_id'], 
                       'user_id'    =>$request['can_id']
                )
            );
        return response()->json(['data' => [],"Message"=> "like Successfully",
        "Success"=>true] ); 

        }
        else
        {
        $liked->delete();
        return response()->json(['data' => [],"Message"=> "dislike Successfully",
        "Success"=>true] ); 
        }
    }
    //employer Registeration
    
    
    
    public function updateemployerprofile(Request $request){
        
        
               try
        {
            
             //**update user
              $userid=EmployerProfile::where('id',$request->user_id)->select('user_id')->first();
              
           
            
            //update user
              $user = user::find($request->user_id);
              if($request->name !=null)
              {
                  $user->name = $request->name;
              }
              
                 if($request->email !=null)
              {
                  $user->name = $request->email;
              }

              $user->save();

             //update EmployerProfile
             $EmployerProfile=EmployerProfile::where('user_id',$request->user_id)->first();;
      if($EmployerProfile ==null){
           return response()->json(['user' => [] ,"Message"=> "user not exsist",
                   "Success"=>true]); 
      }
           
              
               if($request->name !=null)
              {
                   $EmployerProfile->first_name = $request->name;
              }
              
               if($request->phone !=null)
              {
                  $EmployerProfile->phone = $request->phone;
              }
              
               if($request->country_id !=null)
              {
                  $EmployerProfile->country_id = $request->country_id;
              }
              
               if($request->address !=null)
              {
                  $EmployerProfile->address = $request->address;
              }
              
               if($request->nationality !=null)
              {
                  $EmployerProfile->nationality = $request->nationality;
              }

              $EmployerProfile->user_id =$request->user_id;
              $EmployerProfile->coins = $request->coins;
              $EmployerProfile->save();
              
              
              // company
              
              $company= \App\Company::where('Created_by',$request->user_id)->first();
              
              
                 if($request->name !=null)
              {
                  $company->name = $request->name;
              }
              
              
                 if($request->industry_id !=null)
              {
                  $company->industry_id = $request->industry_id;
              }
                
                 if($request->size !=null)
              {
                  $company->size = $request->size;
              }
              
                  if($request->description !=null)
              {
                  $company->description = $request->description;
              }
              
                    if($request->website !=null)
              {
                  $company->website = $request->website;
              }
                      if($request->company_linkedin !=null)
              {
                  $company->company_linkedin = $request->company_linkedin;
              }
              
              
              if($request->company_facebook !=null)
              {
                  $company->company_facebook = $request->company_facebook;
              }
              
               if($request->company_twitter !=null)
              {
                  $company->company_twitter = $request->company_twitter;
              }
                if($request->company_youtube !=null)
              {
                  $company->company_youtube = $request->company_youtube;
              }
                if($request->company_googleplus !=null)
              {
                  $company->company_googleplus = $request->company_googleplus;
              }

             
$company->save();

      
          
               $user=EmployerProfile::with(['country','city'])
          ->join('users','users.id','=','employer_profiles.user_id')
          ->join('companies','companies.Created_by','=','employer_profiles.user_id')
       ->where('user_id',$request->user_id)
          ->select('*','users.*','employer_profiles.type as usertype','companies.*')
          ->first();
            
             return response()->json(['user' => $user ,"Message"=> "",
                   "Success"=>true]); 
            
        }    
        catch(Exception $e) 
            {
              return response()->json(['Data' => [],"Message"=> "",
                   "Success"=>false]); 
             }
         }
        
        
        
        
        
        
        
        
        
        
        
        
        
 
    
    
    
    
    public function employerregistation(Request $request)
    {
     
    // try
    // {
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
        'remember_token'=>$request['remember_token'],
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
 
 

  
        $countryQueryCityID=Country::where('name',$country)->first();
        $citynam = New City;
     
        //get the code value;
        $lastUser =  \DB::table('users')->orderBy('id', 'desc')->first();
        if($lastUser)
        {
            $code = $lastUser->code++;
        }
    //*code generated*/

    //**create user
        $user = User::create(['name'=>$request['name'],'remember_token'=>$request['remember_token'],
        'email'=>$request['email'],'password' => bcrypt($request['password']),
        'type'=>'employer','code'=>$code]);
    //**user created

        $input = $request->all();
        if($user)
        {
            $emptype= EmployerProfile::create(['city_id'=>$city,
            'type'=>$request['type'],'first_name'=>$request['name'],
            'last_name'=>$request['name'],'country_id'=>$country,
            'user_id'=>$user->id,'phone'=>$request['phone'],'coins'=>$totalpoints]);
         
          
           // dd($emp);
         
        }


     \App\Company::create(['name'=>$request['name'],'size'=>'5','Country_id'=>$country,'lat'=>'0','lang'=>'0','Created_by'=>$user->id,'industry_id'=>'0']);

        // $user->notify(new AddEmployer($emptype));
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
        
          $user=EmployerProfile::with(['country','city'])
          ->join('users','users.id','=','employer_profiles.user_id')
          ->join('companies','companies.Created_by','=','employer_profiles.user_id')
       ->where('user_id', $user->id)
          ->select('*','users.*','employer_profiles.type as usertype','companies.*')
          ->first();
        
        //post job 
        $PostJob=new PostJob;
        
      if($request->job_id !=null)
        {
             $PostJob->job_id=$request->job_id;
        }
        if($request->industry_id !=null)
        {
             $PostJob->industry_id=$request->industry_id;
        }
         if($request->num_of_candidates !=null)
        {
             $PostJob->num_of_candidates=$request->num_of_candidates;
        }
         if($request->country_id !=null)
        {
             $PostJob->country_id=$request->country_id;
        }
         if($request->job_descripton !=null)
        {
             $PostJob->job_descripton=$request->job_descripton;
        }
         if($request->availability !=null)
        {
             $PostJob->availability=$request->availability;
        }
          if($request->job_requirements !=null)
        {
             $PostJob->job_requirements=$request->job_requirements;
        }
           if($request->currency_id !=null)
        {
             $PostJob->currency_id=$request->currency_id;
        }
        
            if($request->max_salary !=null)
        {
             $PostJob->max_salary=$request->max_salary;
        }
             if($request->prefered_gender !=null)
        {
             $PostJob->prefered_gender=$request->prefered_gender;
        }
     
               if($request->min_salary !=null)
        {
             $PostJob->min_salary=$request->min_salary;
        }
        
        
         $PostJob->	created_by=$user->user_id;
          $PostJob->save();
                
                //insert languages
$languagelist=[];
if ($request['language_ids'] != "")
{
   foreach(explode('_', $request['language_ids']) as $info) 
  {
       array_push($languagelist, $info);
      
  } 
}
 foreach ($languagelist as $key => $lang) {
     
   \App\JobLanguage::create(['language_id'=>$lang,'job_id'=>$PostJob->id]);
}    
    
    
                    
                //insert languages
$skill_ids=[];
if ($request['skill_ids'] != "")
{
   foreach(explode('_', $request['skill_ids']) as $info) 
  {
       array_push($skill_ids, $info);
      
  } 
}
 foreach ($skill_ids as $key => $skill) {
     
   \App\JobSkill::create(['job_id'=>$PostJob->id, 'skill_id'=>$skill]);
} 
        

    
      return response()->json(['user' => $user,'Message'=>'',"Success"=>true]);
   
    }
    
    public function addcanbyagency(Request $request)
    { 
$countrylist=[];
if ($request['country_list'] != "")
{
   foreach(explode('_', $request['country_list']) as $info) 
  {
       array_push($countrylist, $info);
      
  } 
}


$skilllist=[];
if ($request['skills_id'] != "")
{
   foreach(explode('_', $request['skills_id']) as $info) 
  {
       array_push($skilllist, $info);
      
  } 
}


$languageist=[];
if ($request['languages_id'] != "")
{
   foreach(explode('_', $request['languages_id']) as $info) 
  {
       array_push($languageist, $info);
      
  } 
}

       // request('email')
        // try
        // {
      $code = 1000;
      $vedio_path='';
      $lastUser =  \DB::table('users')->orderBy('id', 'desc')->first();
      //check Email
      $ExsistUser =  \DB::table('users')
      ->where('email',$request['email'])
      ->first();
      if($ExsistUser !=null || $ExsistUser !=[])
      {
        return response()->json(['Data'=>[],"Message"=> "Email already Exsist",
        "Success"=>true]);
      }
     
      if($lastUser)
      {
        $code = $lastUser->code++;
      }

      $user = User::create(['name'=>$request['name'],
      'email'=>$request['email'],
      'password' => bcrypt($request['password']),
      'type'=>'candidate','code'=>$code]);
      $input = $request->all();


      $input['vedio_path']='';
      unset($input['name'],$input['email'],$input['password']);
      $input['user_id']= $user->id;
      $countcoins=['name'=>$request['name'],
      'email'=>$request['email'],'remember_token'=>$request['email'],
      'industry_id'=>$request['industry_id'],
      'Agency_ID'=>$request['Agency_ID'],
      'job_id'=>$request['job_id'],
      'religion_id'=>$request['religion_id'],
      'gender'=>$request['gender'],
      'password' => bcrypt($request['password']),
      'country_id'=>$request['country_id'],
      'private'=>$request['private'],
      'coins'=>$request['coins'],
     
];



$CandidateInfo= CandidateInfo::create($input);


    foreach ($countrylist as $key => $loc) {
       \App\PreferedLocation::create(['user_id'=>$user->id,'country_id'=>$loc]);
    }



 foreach ($skilllist as $key => $loc) {
       \App\UserSkill::create(['user_id'=>$user->id,'skill_id'=>$loc]);
    }
    
    
    
     foreach ($countrylist as $key => $loc) {
       \App\UserLanguage::create(['user_id'=>$user->id,'language_id'=>$loc]);
    }



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
    //  $user = Auth::user(); "Message"=> "Email already Exsist",
          $user=CandidateInfo::with(['country','religion','job','industry','nationality','ExperinceWork','getCandidateLang','getCandidatePreferedLoc','getCandidateSkill','currency'])
          ->join('users','users.id','=','candidate_infos.user_id')
          ->where('user_id', $user->id)
          ->select('*','users.*','users.type as usertype','descripe_yourself as description','phone_number as phone')
          ->first();
      return response()->json(['user' => $user,'Message'=>'',"Success"=>true]); 

    }

    
    public function easycanreg(Request $request)
    { 
$countrylist=[];
if ($request['country_list'] != "")
{
   foreach(explode('_', $request['country_list']) as $info) 
  {
       array_push($countrylist, $info);
      
  } 
}

       // request('email')
        // try
        // {
      $code = 1000;
      $vedio_path='';
      $lastUser =  \DB::table('users')->orderBy('id', 'desc')->first();
      //check Email
      $ExsistUser =  \DB::table('users')
      ->where('email',$request['email'])
      ->first();
      if($ExsistUser !=null || $ExsistUser !=[])
      {
        return response()->json(['Data'=>[],"Message"=> "Email already Exsist",
        "Success"=>true]);
      }
     
      if($lastUser)
      {
        $code = $lastUser->code++;
      }

      $user = User::create(['name'=>$request['name'],
      'email'=>$request['email'],
      'password' => bcrypt($request['password']),
      'type'=>'candidate','code'=>$code]);
      $input = $request->all();

 
      $input['vedio_path']='';
      unset($input['name'],$input['email'],$input['password']);
      $input['user_id']= $user->id;
      $countcoins=['name'=>$request['name'],
      'email'=>$request['email'],'remember_token'=>$request['email'],
      'industry_id'=>$request['industry_id'],
      'job_id'=>$request['job_id'],
      'gender'=>$request['gender'],
      'password' => bcrypt($request['password']),
      'country_id'=>$request['country_id'],
      'coins'=>$request['coins'],
     
];



$CandidateInfo= CandidateInfo::create($input);


    foreach ($countrylist as $key => $loc) {
       \App\PreferedLocation::create(['user_id'=>$user->id,'country_id'=>$loc]);
    }


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
    //  $user = Auth::user(); "Message"=> "Email already Exsist",
          $user=CandidateInfo::with(['country','religion','job','industry','nationality','ExperinceWork','getCandidateLang','getCandidatePreferedLoc','getCandidateSkill','currency'])
          ->join('users','users.id','=','candidate_infos.user_id')
          ->where('user_id', $user->id)
         ->select('*','users.*','users.type as usertype','descripe_yourself as description','phone_number as phone')
          ->first();
      return response()->json(['user' => $user,'Message'=>'',"Success"=>true]); 
//         }    
//   catch(Exception $e) 
//       {
//         return response()->json(['error'=>'Something Wrong'], 401);
//        }
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
            return response()->json(['error'=>'Something Wrong'], 401);
        }
    }
public function getallsucess()
{
    $Data =SuccessStories::all();
     return response()->json(['sucessstory' =>$Data,"Message"=> "","Success"=>true]); 
    
}
public function getsucessbyuser(Request $request)
{
    $Data =SuccessStories::where('user_id',$request->user_id)->first();
     return response()->json(['sucessstory' =>$Data,"Message"=> "","Success"=>true]); 
    
}

public function getappliescandidateforjob(Request $request)
{
     $Data=[];
    $favourite=DB::table('job_applications')->where('job_post_id',$request['job_id'])->get();
//dd($favourite);
        foreach ($favourite as $Matching) {
            
            $Dataset=CandidateInfo::with(['country','religion','job','industry','nationality','ExperinceWork','getCandidateLang','getCandidatePreferedLoc','getCandidateSkill','currency'])
->join('users','users.id','=','candidate_infos.user_id')
->join('job_applications','job_applications.user_id','=','candidate_infos.user_id')
->where('candidate_infos.user_id',$Matching->user_id)
->select('*','users.*','status','addNote','descripe_yourself as description','phone_number as phone')
->first();
            

            
           array_push($Data, $Dataset); 
        } 
    
    
    
     return response()->json(['users' =>$Data,"Message"=> "","Success"=>true]); 
}

public function getappliesjob(Request $request)
{
     $Data=[];
    $favourite=DB::table('job_applications')->where('user_id',$request['user_id'])->get();

        foreach ($favourite as $Matching) {
            
            $Dataset=PostJob::with(['Industry','job','country','getJobLanguage','getJobSkill'])
            ->where('id',$Matching->job_post_id)
            ->first();
            
           array_push($Data, $Dataset); 
        } 
    
    
    
     return response()->json(['jobs' =>$Data,"Message"=> "","Success"=>true]); 
}
    public function addsucessstoryEmp(Request $request)
    {
        
     $userid=DB::table('employer_profiles')->where('user_id',$request->user_id)->first();
        if($userid == null)
        {
            return response()->json(['Data' => [],"Message"=> "",
        "Success"=>false]); 
           
              
        }
        else{
             SuccessStories::create([
         'description'=>$request->description,
         'emp_id'=> $userid->id,
         'approval'=>1,
         'user_id'=>$request->user_id]);
   return response()->json(['Data' => [],"Message"=> "",
        "Success"=>true]); 
         
            
        }
         
    }
       public function addsucessstoryCan(Request $request)
    {
     $userid=DB::table('candidate_infos')->where('user_id',$request->user_id)->first();
    if($userid == null)
        {
          
           
            return response()->json(['Data' => [],"Message"=> "",
        "Success"=>false]); 
              
        }
        else{
          SuccessStories::create([
         'description'=>$request->description,
         'can_id'=> $userid->id,
         'approval'=>1,
         'user_id'=>$request->user_id]);
           
            return response()->json(['Data' => [],"Message"=> "",
        "Success"=>true]); 
        }
    }
        public function uploadCV(Request $request){
        try
             {
                $file = $request['file']; 
                $files = $request->file('files');
                $id =  $request->get('id');
                $cvName = $files->getClientOriginalName();
                $path=("upload/cv").$cvName;
                 if (!file_exists($path)) {
                     $files->move(("upload/cv"),$cvName);
                     $q =User::where('id',$request->user_id)->first();
                         if ($q)
                         {
                             $CandidateInfo = CandidateInfo::where('user_id',$request->user_id)->first();
                             $CandidateInfo->cv_path = "upload/cv/".$cvName;
                             $CandidateInfo->save();
                             
                             
                             
                             $user=CandidateInfo::with(['country','religion','job','industry','nationality','ExperinceWork','getCandidateLang','getCandidatePreferedLoc','getCandidateSkill','currency'])
->join('users','users.id','=','candidate_infos.user_id')
->where('user_id', $request->user_id)
->select('*','users.*','descripe_yourself as description','phone_number as phone')
->first();
                             
                             
                             return response()->json(['user' => $user,"Message"=> "","Success"=>true] ); 
                         }
                     }
                 else
                     {
                        $random_string = md5(microtime());
                        $files->move(public_path("upload/cv"),$random_string);
                        $q =User::where('id',$request->user_id)->first();           
                             if ($q)
                             {
                                $CandidateInfo = CandidateInfo::where('user_id',$request->user_id)->first();
                                $CandidateInfo->cv_path = "/upload/cv/".$random_string;
                                 $CandidateInfo->save();
                                 
                                 
                                                     $user=CandidateInfo::with(['country','religion','job','industry','nationality','ExperinceWork','getCandidateLang','getCandidatePreferedLoc','getCandidateSkill','currency'])
->join('users','users.id','=','candidate_infos.user_id')
->where('user_id', $request->user_id)
->select('*','users.*','descripe_yourself as description','phone_number as phone')
->first();
                                 
                                 
                                 return response()->json(['user' => $user,"Message"=> "","Success"=>true] ); 
                             }
                        }
         }
         catch(Exception $e) 
         {
             return response()->json(['user' => [],"Message"=> "","Success"=>false] ); 
         }
          
     }
    public function updateimage(Request $request)
    {
        try
            {
               $file = $request['file']; 
               $images = $request->file('images');
               $id =  $request->get('id');
               $imageName = $images->getClientOriginalName();
               $path=("upload/imgageslogo").$imageName;
                if (!file_exists($path)) {
                    $images->move(("upload/imgageslogo"),$imageName);
                    $q =User::where('id', $id)->first();
                        if ($q)
                        {
                            $user = User::find($q->id);
                            $user->logo = "upload/imgageslogo/".$imageName;
                            $user->save();
                            
                            if($q->type=='employer')
          {

 
          
            $user=EmployerProfile::with(['country','city'])
          ->join('users','users.id','=','employer_profiles.user_id')
          ->join('companies','companies.Created_by','=','employer_profiles.user_id')
       ->where('user_id', $user->id)
          ->select('*','users.*','employer_profiles.type as usertype','companies.*')
          ->first();
          
              
          }else
          {
$user=CandidateInfo::with(['country','religion','job','industry','nationality','ExperinceWork','getCandidateLang','getCandidatePreferedLoc','getCandidateSkill','currency'])
->join('users','users.id','=','candidate_infos.user_id')
->where('user_id', $user->id)
->select('*','users.*','descripe_yourself as description','phone_number as phone')
->first();
              
          }
                            
                            
                            return response()->json(['user' => $user,"Message"=> "","Success"=>true] ); 
                        }
                    }
                else
                    {
                       $random_string = md5(microtime());
                       $images->move(public_path("upload/imgageslogo"),$random_string.".jpg");
                       $q =User::where('id',$id)->first();            
                            if ($q)
                            {
                                $user = User::find($q->id);
                                $user->logo = "/upload/imgageslogo/".$random_string.".jpg";
                                $user->save();
                                
                                
                                
                                                      if($q->type=='employer')
          {

      
               $user=EmployerProfile::with(['country','city'])
          ->join('users','users.id','=','employer_profiles.user_id')
          ->join('companies','companies.Created_by','=','employer_profiles.user_id')
     ->where('user_id', $user->id)
          ->select('*','users.*','employer_profiles.type as usertype','companies.*')
          ->first();
          
              
          }else
          {
$user=CandidateInfo::with(['country','religion','job','industry','nationality','ExperinceWork','getCandidateLang','getCandidatePreferedLoc','getCandidateSkill','currency'])
->join('users','users.id','=','candidate_infos.user_id')
->where('user_id', $user->id)
->select('*','users.*','descripe_yourself as description','phone_number as phone')
->first();
              
          }
                                
                                return response()->json(['user' => $user,"Message"=> "","Success"=>true] ); 
                            }
                       }
        }
        catch(Exception $e) 
        {
            return response()->json(['user' => [],"Message"=> "","Success"=>false] ); 
        }
    }
      public function updatecover(Request $request)
    {
        try
            {
               $file = $request['file']; 
               $images = $request->file('images');
               $id =  $request->get('user_id');
               $imageName = $images->getClientOriginalName();
               $path=("upload/imgageslogo").$imageName;
                if (!file_exists($path)) {
                    $images->move(("upload/imgageslogo"),$imageName);
                    $q =User::where('id', $id)->first();
                        if ($q)
                        {
                           
                            $user = EmployerProfile::where('user_id', $request->get('user_id'))->first();
                        
                            $user->coverphoto = "upload/imgageslogo/".$imageName;
                             
                            $user->save();
                            
                                $user=EmployerProfile::with(['country','city'])
          ->join('users','users.id','=','employer_profiles.user_id')
          ->join('companies','companies.Created_by','=','employer_profiles.user_id')
    ->where('user_id', $request->get('user_id'))
          ->select('*','users.*','employer_profiles.type as usertype','companies.*')
          ->first();
                            
                            
                            
                            
                            return response()->json(['user' => $user,"Message"=> "","Success"=>true] ); 
                        }
                    }
                else
                    {
                       $random_string = md5(microtime());
                       $images->move(public_path("upload/imgageslogo"),$random_string.".jpg");
                       $q =User::where('id',$id)->first();            
                            if ($q)
                            {
                                $user = EmployerProfile::where('user_id',$id)->first();
                                $user->coverphoto = "/upload/imgageslogo/".$random_string.".jpg";
                                $user->save();
                                
            
                             
                             
               $user=EmployerProfile::with(['country','city'])
          ->join('users','users.id','=','employer_profiles.user_id')
          ->join('companies','companies.Created_by','=','employer_profiles.user_id')
    ->where('user_id',$id)
          ->select('*','users.*','employer_profiles.type as usertype','companies.*')
          ->first();
                             
                                
                                
                                return response()->json(['user' => $user,"Message"=> "","Success"=>true] ); 
                            }
                       }
        }
        catch(Exception $e) 
        {
            return response()->json(['user' => [],"Message"=> "","Success"=>false] ); 
        }
    }
    public function updatevidetitle(Request $req)
    {
        
        
            try
             {
                 $update=  DB::table('videos')
                ->where('id', $req->video_id)
                ->update(['video_title' => $req->title]);
                
                
            
           
                return response()->json(['user' => $user,"Message"=> "","Success"=>true] );
               
                }    
            catch(Exception $e) 
                {
                    return response()->json(['user' => [],"Message"=> "","Success"=>false] ); 
                } 
        
    }
    
      public function updatejobapplicationstatus(Request $req)
    {
        
        
            try
             {
                 if($req->status != null){
                  $update=  DB::table('job_applications')
                ->where('user_id', $req->user_id)
                  ->where('job_post_id', $req->job_post_id)
                ->update(['status' => $req->status]);
                 return response()->json(['user' => [],"Message"=> "","Success"=>true] );
                     
                 }
                  if($req->addNote != null){
                  $update=  DB::table('job_applications')
                ->where('user_id', $req->user_id)
                  ->where('job_post_id', $req->job_post_id)
                ->update(['addNote' => $req->addNote]);
                 return response()->json(['user' => [],"Message"=> "","Success"=>true] );
                     
                 }
                
                
           
                return response()->json(['user' => [],"Message"=> "","Success"=>true] );
               
                }    
            catch(Exception $e) 
                {
                    return response()->json(['user' => [],"Message"=> "","Success"=>false] ); 
                } 
        
    }
    
     public function updatemainvidetitle(Request $req)
    {
        
        
            try
             {
                 $update=  DB::table('candidate_infos')
                ->where('user_id', $req->user_id)
                ->update(['video_title' => $req->title]);



    

$user=CandidateInfo::with(['country','religion','job','industry','nationality','ExperinceWork','getCandidateLang','getCandidatePreferedLoc','getCandidateSkill','currency'])
->join('users','users.id','=','candidate_infos.user_id')
->where('user_id', $req->user_id)
->select('*','users.*','descripe_yourself as description','phone_number as phone')
->first();

                return response()->json(['user' => $user,"Message"=> "","Success"=>true] );
               
                }    
            catch(Exception $e) 
                {
                    return response()->json(['user' => [],"Message"=> "","Success"=>false] ); 
                } 
        
    }
    
                //edit uploaded video
    public function updatemainvideo(request $request)
        {
            try
             {
                $blobInput = $request->file('video');
                $id=$request->get('id');
                $VideoName= $blobInput->getClientOriginalName();
                $path=("upload/video").$VideoName;
                $data =User::where('id',$id)->first();   
                if (!file_exists($path)) {
                $random_string = md5(microtime());
                $blobInput->move(("upload/video"),$VideoName);
                $q= CandidateInfo::where('user_id', $id)->limit(1)  // optional - to ensure only one record is updated.
                    ->update(array('vedio_path' => "upload/video/".$VideoName));
                    
                    
                    $user=CandidateInfo::with(['country','religion','job','industry','nationality','ExperinceWork','getCandidateLang','getCandidatePreferedLoc','getCandidateSkill','currency'])
->join('users','users.id','=','candidate_infos.user_id')
->where('user_id',$id)
->select('*','users.*','descripe_yourself as description','phone_number as phone')
->first();
                    
                    
                    
                return response()->json(['user' => $user,"Message"=> "","Success"=>true] );
                }
                else
                    {
                        $random_string = md5(microtime());
                        $blobInput->move(("upload/video"),$random_string.".webm");
                        $q= CandidateInfo::
                        where('user_id', $id)  // find your user by their email
                        ->limit(1)  // optional - to ensure only one record is updated.
                        ->update(array('vedio_path' => "upload/video/".$random_string.".webm "));
                        
                        
$user=CandidateInfo::with(['country','religion','job','industry','nationality','ExperinceWork','getCandidateLang','getCandidatePreferedLoc','getCandidateSkill','currency'])
->join('users','users.id','=','candidate_infos.user_id')
->where('user_id',$id)
->select('*','users.*','descripe_yourself as description','phone_number as phone')
->first();
            
                        
                        return response()->json(['user' => $user,"Message"=> "","Success"=>true] );
                    }
                }    
            catch(Exception $e) 
                {
                    return response()->json(['user' => [],"Message"=> "","Success"=>false] ); 
                } 
        }
            public function makemainvideo(request $request)
        {
            try
             {
                  $q= CandidateInfo::where('user_id', $request->user_id)->limit(1)  // optional - to ensure only one record is updated.
                    ->update(array('vedio_path' => $request->videopath));
                    
                    
                    
                     $update = \DB::table('videos')
            ->where('id',$request->video_id)
            ->update( [ 'MainVideo' =>1]); 
  
                    
                    
                    
$user=CandidateInfo::with(['country','religion','job','industry','nationality','ExperinceWork','getCandidateLang','getCandidatePreferedLoc','getCandidateSkill','currency'])
->join('users','users.id','=','candidate_infos.user_id')
->where('user_id',$request->user_id)
->select('*','users.*','descripe_yourself as description','phone_number as phone')
->first();
                    
                    
                    
                return response()->json(['videopath' => $request->videopath,"Message"=> "","Success"=>true] );
                
                }    
            catch(Exception $e) 
                {
                    return response()->json(['user' => [],"Message"=> "","Success"=>false] ); 
                } 
        }
        public function newvideo(request $request)
        {
            try
             {
                $blobInput = $request->file('video');
                $id=$request->get('id');
                
                $VideoName= $blobInput->getClientOriginalName();
                $path=("upload/video").$VideoName;
                $data =User::where('id',$id)->first();   
                if (!file_exists($path)) {
                $random_string = md5(microtime());
                $blobInput->move(("upload/video"),$VideoName);
                
                //save th
                  $blobInput2 = $request->file('Thumbnail');
                 $Videoimg= $blobInput2->getClientOriginalName();
                $path2=("upload/video").$Videoimg;
                  
                if (!file_exists($path2)) {
                $random_string = md5(microtime());
                $blobInput2->move(("upload/video"),$Videoimg);
                }
                else{
                     $random_string2 = md5(microtime());
                        $blobInput2->move(("upload/video"),$random_string2.".jpg"); 
                }
                
                $videoInsert=\DB::table('videos')->insert(
                    array(
                           'Path' =>"upload/video/".$VideoName, 
                           'local_id'=>$request->local_id,
                            'local_path'=>$request->local_path,
                             'video_title'=>$request->video_title,
                           'User_Id'    =>$request->id,
                              'Thumbnail'=>"upload/video/".$Videoimg,
                    )
                );
                return response()->json(['videopath' =>'upload/video/'.$VideoName,"Message"=> "","Success"=>true] );
                }
                else
                    {
                        $random_string = md5(microtime());
                        $blobInput->move(("upload/video"),$random_string.".webm");
                        $videoInsert=\DB::table('videos')->insert(
                            array(
                                'Path' =>"upload/video/".$random_string.".webm ", 
                                'User_Id'    =>$request->id,
                                'local_id'=>$request->local_id,
                                 'video_title'=>$request->video_title,
                                'local_path'=>$request->local_path,
                                 'Thumbnail'=>"upload/video/".$random_string2.".jpg ",
                                
                            )
                        );
                        
                        return response()->json(['videopath' => 'upload/video/'.$random_string.webm,"Message"=> "","Success"=>true] );
                    }
                }    
            catch(Exception $e) 
                {
                    return response()->json(['user' => [],"Message"=> "","Success"=>false] ); 
                } 
        }  
        public function deletevideo(request $request)
        {
            try
             {
                $id=$request->get('id');
                $video=\DB::table('videos')
                ->where('id',$id)
                ->delete();
                return response()->json(['user' => [],"Message"=> "","Success"=>true] );
                }    
            catch(Exception $e) 
                {
                    return response()->json(['user' => [],"Message"=> "","Success"=>false] ); 
                } 
        } 
        
    public function topcandidate() 
    { 
       
        $Data =CandidateInfo::with(['country','religion','job','industry','nationality','ExperinceWork','getCandidateLang','getCandidatePreferedLoc','getCandidateSkill','currency'])
          ->join('users','users.id','=','candidate_infos.user_id')
         ->select('*','users.*','users.type as usertype','descripe_yourself as description','phone_number as phone')
            ->orderBy('candidate_infos.created_at', 'DEC')->where('seen','=',1)->limit(10)->get();
        
       return response()->json(['users' => $Data,"Message"=> "",
        "Success"=>true]);  
    }
     public function revlantjobwithoutReg(Request $request)
    {
    $MatchingJobs=[];
    //Matching job 
    $JobName=Job::where('id',$request['job_id'])->select('name')->first();
    $JobNameLiks=Job::where('name', 'LIKE', '%'.$JobName->name.'%')->get();
    foreach($JobNameLiks as $JobNameLiks)
    {
        $MatchingJo = PostJob::with(['Industry','job','Currency','country','getJobLanguage','getJobSkill'])
        ->where('job_id',$JobNameLiks->id)
        ->orwhere('job_id',$request['industry_id'])
          ->orwhere('country_id',$request['country_id'])
           ->get();    
        foreach ($MatchingJo as $Matching) {
           array_push($MatchingJobs, $Matching); 
        }  
    }    
    return response()->json(['jobs' => $MatchingJobs,"Message"=> "",
    "Success"=>true]); 
        
    }
     public function addskillpostjob(Request $request)
    {
         $job=PostJob::find($request->post_job_id);
        $skill_ids=[];
        if ($request['skill_ids'] != "")
        {
        foreach(explode('_', $request['skill_ids']) as $info) 
        {
        array_push($skill_ids, $info);
        
        } 
        }
        foreach ($skill_ids as $key => $skill) {
        
        \App\JobSkill::create(['job_id'=>$job->id, 'skill_id'=>$skill]);
        }  
      return response()->json(['Data' => [],"Message"=> "",
    "Success"=>true]); 
    }
     public function addlanguagepostjob(Request $request)
    {
          $job=PostJob::find($request->post_job_id);
         $languagelist=[];
        if ($request['language_ids'] != "")
        {
         foreach(explode('_', $request['language_ids']) as $info) 
         {
        array_push($languagelist, $info);
        
          } 
        }
        foreach ($languagelist as $key => $lang) {
        
        \App\JobLanguage::create(['language_id'=>$lang,'job_id'=>$job->id]);
        } 
          return response()->json(['Data' => [],"Message"=> "",
    "Success"=>true]); 
    }
    
    
    public function updatepostjob(Request $request)
    {
        
        $PostJob=PostJob::find($request->post_job_id);
       // dd($PostJob);
        if($request->job_id !=null)
        {
             $PostJob->job_id=$request->job_id;
        }
        if($request->industry_id !=null)
        {
             $PostJob->industry_id=$request->industry_id;
        }
         if($request->num_of_candidates !=null)
        {
             $PostJob->num_of_candidates=$request->num_of_candidates;
        }
         if($request->country_id !=null)
        {
             $PostJob->country_id=$request->country_id;
        }
         if($request->job_descripton !=null)
        {
             $PostJob->job_descripton=$request->job_descripton;
        }
         if($request->availability !=null)
        {
             $PostJob->availability=$request->availability;
        }
          if($request->job_requirements !=null)
        {
             $PostJob->job_requirements=$request->job_requirements;
        }
           if($request->currency_id !=null)
        {
             $PostJob->currency_id=$request->currency_id;
        }
        
            if($request->max_salary !=null)
        {
             $PostJob->max_salary=$request->max_salary;
        }
             if($request->prefered_gender !=null)
        {
             $PostJob->prefered_gender=$request->prefered_gender;
        }
     
               if($request->min_salary !=null)
        {
             $PostJob->min_salary=$request->min_salary;
        }
                if($request->confidential !=null)
        {
             $PostJob->confidential=$request->confidential;
        }
        
        
       $PostJob->save();
               
          
          
    return response()->json(['Data' => [],"Message"=> "",
    "Success"=>true]);  
            
    }
    
    public function postjob(Request $request)
    {           
        
               
            $user=EmployerProfile::where('user_id',$request->user_id)->first();
            if( $user==null)
            {
                  return response()->json(['Data' => [],"Message"=> "",
                 "Success"=>false]);  
            }
            else
            {
                $userdata=User::where('id',$request->user_id)->first();
           
                $input= $request->all();
                $input['job_for']=$user->type;
                unset($input['skill_ids'],$input['language_ids']);
                $input['created_by']= $request->user_id;
                $job = PostJob::create($input);
                
                
             
                
                
                //insert languages
$languagelist=[];
if ($request['language_ids'] != "")
{
   foreach(explode('_', $request['language_ids']) as $info) 
  {
       array_push($languagelist, $info);
      
  } 
}
 foreach ($languagelist as $key => $lang) {
     
   \App\JobLanguage::create(['language_id'=>$lang,'job_id'=>$job->id]);
}    
    
    
                    
                //insert languages
$skill_ids=[];
if ($request['skill_ids'] != "")
{
   foreach(explode('_', $request['skill_ids']) as $info) 
  {
       array_push($skill_ids, $info);
      
  } 
}
 foreach ($skill_ids as $key => $skill) {
     
   \App\JobSkill::create(['job_id'=>$job->id, 'skill_id'=>$skill]);
}    
              
                    $data=array('Email'=>$userdata->email);
                    Mail::send('emails.NewJob', $data, function($message) use ($data) {
                    $message->to('Social@maidandhelper.com');
                    $message->subject('new job is added ');
                    });
          
          
          
          testPushNotificationEvent('poat job','New post job added');
          
          
    //               return response()->json(['Data' => [],"Message"=> "",
    // "Success"=>true]);  
            }
              
                
}
    
    
    
    public function confirmationmail(Request $request)
    {
            $data=array('Email'=>$request->email);
                    Mail::send('emails.NewJob', $data, function($message) use ($data) {
                    $message->to('Social@maidandhelper.com');
                    $message->subject('new job is added ');
                    });
                  return response()->json(['Data' => [],"Message"=> "",
                   "Success"=>true]); 
    }
    
    
    
     public function deleteuserlanguage(Request $request)
    {
          $data=DB::table('user_languages')->where('id',$request->id)->delete();
        return response()->json(['Data' => [],"Message"=> "",
                   "Success"=>true]);  
    }
      public function deleteuserskill(Request $request)
    {
         $data=DB::table('user_skills')->where('id',$request->id)->delete();
         return response()->json(['Data' => [],"Message"=> "",
                   "Success"=>true]); 
    }
    
    
    
      public function deletelanguagepostjob(Request $request)
    {
          $data=DB::table('job_languages')
          ->where('language_id',$request->language_id)
           ->where('job_id',$request->job_id)
          ->delete();
        return response()->json(['Data' => [],"Message"=> "",
                   "Success"=>true]);  
    }
      public function deleteskillpostjob(Request $request)
    {
         $data=DB::table('job_skills')
         ->where('skill_id',$request->skill_id)
           ->where('job_id',$request->job_id)
         ->delete();
         return response()->json(['Data' => [],"Message"=> "",
                   "Success"=>true]); 
    }
    
    
      public function deleteuserlocation(Request $request)
    {
         $data=DB::table('user_prefered_locations')->where('id',$request->id)->delete();
         return response()->json(['Data' => [],"Message"=> "",
                   "Success"=>true]); 
    }
    
    
    
       //update candidate informations
    public function updateFullReg(Request $request)
    {



             //**update user
              $userid=CandidateInfo::where('user_id',$request->user_id)->select('user_id')->first();
              
       
    
            //update user
              $user = user::find($request->user_id);
              
            
              if($request->name !=null)
              {
                  $user->name = $request->name;
              }
              
                 if($request->email !=null)
              {
                  $user->email = $request->email;
              }

              $user->save();

            
             //update candidate info
             $candinfo=CandidateInfo::where('user_id',$request->user_id)->first();;
      
               if($request->first_name !=null)
              {
                   $candinfo->first_name = $request->first_name;
              }
              
               
              if($request->last_name !=null)
              {
                   $candinfo->last_name = $request->last_name;
              }
              
              
               if($request->phone !=null)
              {
                  $candinfo->phone_number = $request->phone;
              }
              
               if($request->religion_id !=null)
              {
                  $candinfo->religion_id = $request->religion_id;
              }
              
               if($request->salary !=null)
              {
                  $candinfo->salary = $request->salary;
              }
              
               if($request->MaxSalary !=null)
              {
                  $candinfo->MaxSalary = $request->MaxSalary;
              }
              
               if($request->birthdate !=null)
              {
                  $candinfo->birthdate = $request->birthdate;
              }
              
               if($request->visa_type !=null)
              {
                   $candinfo->visa_type = $request->visa_type;
              }
              
               if($request->visa_expire_date !=null)
              {
                  
                  $candinfo->visa_expire_date = $request->visa_expire_date;
              }
               if($request->job_id !=null)
              {
                  
                    $candinfo->job_id = $request->job_id;
              }
              if($request->industry_id !=null)
              {
                  
                    $candinfo->industry_id = $request->industry_id;
              }
              
               if($request->country_id !=null)
              {
                  
                $candinfo->country_id = $request->country_id;
              }
               if($request->gender !=null)
              {
                  
                      $candinfo->gender = $request->gender;
              }
              
                  if($request->CurrencyId !=null)
              {
                 
                    $candinfo->CurrencyId = $request->CurrencyId;
              }
              
              
                  if($request->Eductionlevel !=null)
              {
                  
                     $candinfo->Eductionlevel = $request->Eductionlevel;
              }
              
                    if($request->martial_status !=null)
              {
                  
                      $candinfo->martial_status = $request->martial_status;
              }
              
                    if($request->description !=null)
              {
                  
                     $candinfo->descripe_yourself = $request->description;
              }
              
                     if($request->looking_for_job !=null)
              {
                  
                     $candinfo->looking_for_job = $request->looking_for_job;
              }
              
                      if($request->nationality_id !=null)
              {
                  $candinfo->nationality_id = $request->nationality_id;
                 
              }
             
              $candinfo->user_id =$request->user_id;
              $candinfo->coins = $request->coins;
             // dd($candinfo);
              $candinfo->save();
          
              
//insert languages
$languagelist=[];
if ($request['language_list'] != "")
{
   foreach(explode('_', $request['language_list']) as $info) 
  {
       array_push($languagelist, $info);
      
  } 
}

 foreach ($languagelist as $key => $lang) {
     
     
      \DB::table('user_languages')->insert(
        array(
               'language_id' =>$lang, 
               'user_id'    =>$request->user_id
        )
    );
     
     
 
}             
             
              //insert skills
              $skilllist=[];
if ($request['skill_list'] != "")
{
   foreach(explode('_', $request['skill_list']) as $info) 
  {
       array_push($skilllist, $info);
      
  } 
}
 foreach ($skilllist as $key => $val) {
     
     
         \DB::table('user_skills')->insert(
        array(
               'skill_id' =>$val, 
               'user_id'    =>$request->user_id
        )
    );
  
}

              
//prefered //country
              
              $countrylist=[];
if ($request['country_list'] != "")
{
   foreach(explode('_', $request['country_list']) as $info) 
  {
       array_push($countrylist, $info);
      
  } 
}
 foreach ($countrylist as $key => $loc) {
     
       \App\PreferedLocation::create(['user_id'=>$request->user_id,'country_id'=>$loc]);
}

          $user=CandidateInfo::with(['country','religion','job','industry','nationality','ExperinceWork','getCandidateLang','getCandidatePreferedLoc','getCandidateSkill','currency'])
->join('users','users.id','=','candidate_infos.user_id')
->where('user_id', $user->id)
->select('*','users.*','descripe_yourself as description','phone_number as phone')
->first();    
            
             return response()->json(['user' => $user ,"Message"=> "",
                   "Success"=>true]); 
     
         }
         
         
         public function testPushNotificationEvent($title,$bodytext)
         {
             
             
               $usersTokens = User::whereHas('fcmtokens', function ($query) {
                                        $query->whereNotNull('fcm_token');
                                    })->get()->pluck('fcmtokens')->flatten()
                                    ->pluck('fcm_token')
                                    ->all();
                                    
                foreach($usersTokens as $userToken)
                {
                      event(new AddNotificationToFirebaseEvent($title,$bodytext, 'post_job',8502,$userToken ));
                }

     
                return response()->json(['status' =>'notification sent', 
                           "Success"=>true]); 
        
        
        
         }

}
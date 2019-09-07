<?php

namespace App\Http\Controllers\Jobs;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PostJob;
use App\JobLanguage;
use App\SuccessStories;
use App\EmployerProfile;
use App\Notifications\PostJobs;
use App\Notification;
use Carbon\Carbon;
use Auth;
use DB;
use Session;
use App\User;
use Socialite;
use Mail;
use App\CandidateInfo;
use App\Http\Requests\AddPostJobFormRequest;

class JobPostController extends Controller
{
    
 


    public function create()
    {
        return view('employer.post_job');
    }
public function yourfavouritejobs()
{
$data=PostJob::join('user_like_jobs','user_like_jobs.job_id','=','post_jobs.id')
->where('user_id',\Auth::user()->id)
->get();
return view('Arabic.Candadties.yourFavouriteJobs',compact('data'));
}

public function applyWithoutRegestration($jobid)
{
    if($jobid=="Register")
    {
        $label="apply now";
    }
    else
    {
         $label="Apply Now without registration";
    }
return view('Arabic.Jobs.ApplyWithoutReg',compact('jobid','label'));
}

public function favouritecan()
{
    $favouritecan=CandidateInfo:: join('user_like_candidates','user_like_candidates.user_id','=','candidate_infos.user_id')
         ->where('user_like_candidates.employer_id',\Auth::user()->id)
                    ->get();
                    return view('employer.yourFavouriteJobs',compact('favouritecan'));
                  //  dd($favouritecan);
}

public function yourappliedjobs()
{
$data=PostJob::join('job_applications','job_applications.job_post_id','=','post_jobs.id')
->where('user_id',\Auth::user()->id)
->get();
return view('Arabic.Candadties.yourAppliedJobs',compact('data'));
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
return redirect ($link);
            
                        }
                        else
                        {
                        $link=$post_job->link;
return redirect ($link);

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
    


    public function store(AddPostJobFormRequest $request)
    {
    

        try
        {
               
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
                auth()->user()->notify(new PostJobs($job));
                //Sending Mail after adding
                    $data=array('Email'=>$request['email']);
                    Mail::send('emails.NewJob', $data, function($message) use ($data) {
                    $message->to('Social@maidandhelper.com');
                    $message->subject('new job is added ');

                    });
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
$Applied=0;
            if(Auth::user() !=null)
            {
            $Like=DB::table('user_like_jobs')
                                ->where('job_id',$id)
                                ->where('user_id',\Auth::user()->id)
                                ->first();
                                 $Applied=DB::table('job_applications')
                                ->where('job_post_id',$id)
                                ->where('user_id',\Auth::user()->id)
                                ->first();
                                $Applied=1;
                                
                        if($Like!=null)
                        {
                        $color='red';
                        
                        }
            }
                if(Auth::user() !=null && Auth::user()->CanInfo !=null)
                {
                    $jobCan=PostJob::where('job_id',Auth::user()->CanInfo->job_id)->get();

                
                    


                }
                return view('Arabic.Jobs.ViewJob',compact('job','Applied','jobforcompany','jobCan','color','Skilljob'));
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
        $CanJob=collect();

            $id=$request->selected;

         
$AppliedJob=PostJob::where('created_by',\Auth::user()->id)->where('job_id',$id)->get();

foreach($AppliedJob as $Applied)
{

    foreach ($Applied->applicants as $app) {

        $CanJob->push($app->CanInfo);
    }
}


          

            $dataresult=[];
            foreach ($CanJob as $resultQu) {
                 
                                                    array_push($dataresult,array(
                                                    'label' => $resultQu->nationality->name,
                                                    'y' => count($CanJob)
                                                    ));
                                                
                                                }
            return \Response::json($dataresult,  200, [], JSON_NUMERIC_CHECK);
        }
        catch(Exception $e) 

        {

        return redirect('/');

        }



    }


    public function jobStatstics(Request $request)
    {


         $employerJobs = \Auth::user()->postJobs;
            $employerJobsShow = \Auth::user()->postJobs->first();
            //dd($employerJobs[0]->seen);
            $countrynames= EmployerProfile::
            join('countries','countries.id','=','employer_profiles.country_id')
            ->select('countries.name  AS CName' )
            ->where('user_id',\Auth()->user()->id)->get();
            $citynames= EmployerProfile::
            join('cities','cities.id','=','employer_profiles.city_id')
            ->select('cities.name  AS cityName' )
            ->where('user_id',\Auth()->user()->id)->get();

            
       $id=$request->selected;
     $jobStatstics = PostJob::where('job_id',$id)->where('created_by',\Auth::user()->id)->first();

         $employerJobsfor = EmployerProfile::where('user_id',\Auth()->user()->id)->first();
           $ownCan=CandidateInfo::where('Agency_ID',\Auth::user()->id)->get();
               return view('employer.JobsStatstics',compact('employerJobs','countrynames','citynames','employerJobsShow','jobStatstics','employerJobsfor','ownCan'));

    
    }
   
public function showalljob($id)
{
    $userid=$id;
    $Jobs=[];
    $countJob=PostJob::where('created_by',$id)->get();



    foreach ($countJob as $count) {
      
    $CountAppliedOwn= CandidateInfo::where('job_id',$count->job_id)->where('Agency_ID',$userid)->count();
    $CountAppliedOwnCanidates= CandidateInfo::join('job_applications','job_applications.user_id','candidate_infos.user_id')
    -> where('job_applications.job_post_id',$count->id)
    ->where('candidate_infos.job_id',$count->job_id)
    ->where('candidate_infos.Agency_ID',$userid)->
    count();
if($CountAppliedOwnCanidates==0)
{
    $CanCount=$count->applicants->count()+$CountAppliedOwn;

}
else
{
    $CanCount=$count->applicants->count();
}
       

        array_push($Jobs,array(
            'id'=> $count->job->id,
                     'jobname' => $count->job->name,
                         'cancount' => $CanCount,
                            'date' => $count->created_at,

                                                    ));
    
    }

    return view('employer.employeralljobs',compact('Jobs','userid')); 

}
public function  showcandidatejob($id,$userid)
{
$CanJob=collect();
$ShortCan=Collect();
$ReferenceCheckCan=Collect();
$RejectedCan=Collect();
$SalaryFinalizationCan=Collect();
$InterviewCan=Collect();
$SendtoItegrationCan=Collect();
$OwnCan= CandidateInfo::where('job_id',$id)->where('Agency_ID',$userid)->get();
$AppliedJob=PostJob::where('created_by',$userid)->where('job_id',$id)->get();

foreach($AppliedJob as $Applied)
{

    foreach ($Applied->applicants as $app) {

        $CanJob->push($app->CanInfo);
    }
}

$merged = $OwnCan->merge($CanJob);
$result = $merged->all();
foreach ($result  as $all) {
 if(!is_null($all->getCandidateStaus->find($userid))) 

 {
    
 
 
    $status=$all->getCandidateStaus->find($userid)->pivot->AgencyStatus;

if($status=="Shortlisted")
{
     $ShortCan->push($all);

       
    }

    if($status=="Reference Check")
{
     $ReferenceCheckCan->push($all);

       
    }


        if($status=="Rejected")
{
     $RejectedCan->push($all);

       
    }

            if($status=="Salary Finalization")
{
     $SalaryFinalizationCan->push($all);

       
    }

                if($status=="Interview")
{
     $InterviewCan->push($all);

       
    }
                if($status=="Send to Itegration")
{
     $SendtoItegrationCan->push($all);

       
    }
 

}
}
$sendtoitegration=$SendtoItegrationCan->count();
$interview=$InterviewCan->count();
$salaryfinalization=$SalaryFinalizationCan->count();
$rejected=$RejectedCan->count();
$referencecheck=$ReferenceCheckCan->count();
$shortlist=$ShortCan->count();
$referencecheck=$ReferenceCheckCan->count();
$allCan=count($result);
$userclien=User::find($userid);
$allClients=User::whereHas('EmpInfo', function ($query) use($userid) {
    $query->where('Agency_ID', $userid);
    $query->where('DeletedByAgency','!=', 1);
})
->where('type','client')->get();
      return view('employer.showcandidatejob',compact('result','allCan','userid','shortlist','referencecheck','id','rejected','interview','salaryfinalization','sendtoitegration','allClients')); 

}



public function reloadtable(Request $request)
{
  
      $userid=$request->userid;
   $id= $request->jobid;
        $CanJob=collect();
$ShortCan=Collect();
$ReferenceCheckCan=Collect();
$RejectedCan=Collect();
$SalaryFinalizationCan=Collect();
$InterviewCan=Collect();
$SendtoItegrationCan=Collect();
$OwnCan= CandidateInfo::where('job_id',$request->jobid)->where('Agency_ID',$request->userid)->get();
$AppliedJob=PostJob::where('created_by',$request->userid)->where('job_id',$request->jobid)->get();
if($request->status=='All')
{


foreach($AppliedJob as $Applied)
{

    foreach ($Applied->applicants as $app) {

        $CanJob->push($app->CanInfo);
    }
}

$merged = $OwnCan->merge($CanJob);
$result = $merged->all();


return view('employer.patshowcan',compact('result','allCan','userid','shortlist','id','referencecheck'));
}

if($request->status=='Shortlisted')
{



foreach($AppliedJob as $Applied)
{

    foreach ($Applied->applicants as $app) {

        $CanJob->push($app->CanInfo);
    }
}

$merged = $OwnCan->merge($CanJob);
$resultall = $merged->all();

foreach ($resultall  as $all) {
  
 if(!is_null($all->getCandidateStaus->find($userid))) 

 {
    

    $status=$all->getCandidateStaus->find($userid)->pivot->AgencyStatus;

if($status=="Shortlisted")
{
     $ShortCan->push($all);

       
    }
  

}

}


$result=$ShortCan;

return view('employer.patshowcan',compact('result','allCan','userid','shortlist','id'));
}


if($request->status=='Reference Check')
{



foreach($AppliedJob as $Applied)
{

    foreach ($Applied->applicants as $app) {

        $CanJob->push($app->CanInfo);
    }
}

$merged = $OwnCan->merge($CanJob);
$resultall = $merged->all();

foreach ($resultall  as $all) {
  
 if(!is_null($all->getCandidateStaus->find($userid))) 

 {
    

    $status=$all->getCandidateStaus->find($userid)->pivot->AgencyStatus;

if($status=="Reference Check")
{
     $ReferenceCheckCan->push($all);

       
    }
  

}

}


$result=$ReferenceCheckCan;


return view('employer.patshowcan',compact('result','allCan','userid','shortlist','id'));
}
 
 if($request->status=='Rejected')
{



foreach($AppliedJob as $Applied)
{

    foreach ($Applied->applicants as $app) {

        $CanJob->push($app->CanInfo);
    }
}

$merged = $OwnCan->merge($CanJob);
$resultall = $merged->all();

foreach ($resultall  as $all) {
  
 if(!is_null($all->getCandidateStaus->find($userid))) 

 {
    

    $status=$all->getCandidateStaus->find($userid)->pivot->AgencyStatus;

if($status=="Rejected")
{
     $RejectedCan->push($all);

       
    }
  

}

}


$result=$RejectedCan;


return view('employer.patshowcan',compact('result','allCan','userid','shortlist','id'));
} 


 if($request->status=='Salary Finalization')
{



foreach($AppliedJob as $Applied)
{

    foreach ($Applied->applicants as $app) {

        $CanJob->push($app->CanInfo);
    }
}

$merged = $OwnCan->merge($CanJob);
$resultall = $merged->all();

foreach ($resultall  as $all) {
  
 if(!is_null($all->getCandidateStaus->find($userid))) 

 {
    

    $status=$all->getCandidateStaus->find($userid)->pivot->AgencyStatus;

if($status=="Salary Finalization")
{
     $SalaryFinalizationCan->push($all);

       
    }
  

}

}


$result=$SalaryFinalizationCan;


return view('employer.patshowcan',compact('result','allCan','userid','shortlist','id'));
}

 if($request->status=='Interview')
{



foreach($AppliedJob as $Applied)
{

    foreach ($Applied->applicants as $app) {

        $CanJob->push($app->CanInfo);
    }
}

$merged = $OwnCan->merge($CanJob);
$resultall = $merged->all();

foreach ($resultall  as $all) {
  
 if(!is_null($all->getCandidateStaus->find($userid))) 

 {
    

    $status=$all->getCandidateStaus->find($userid)->pivot->AgencyStatus;

if($status=="Interview")
{
     $InterviewCan->push($all);

       
    }
  

}

}


$result=$InterviewCan;


return view('employer.patshowcan',compact('result','allCan','userid','shortlist','id'));
} 

 if($request->status=='Send to Itegration')
{



foreach($AppliedJob as $Applied)
{

    foreach ($Applied->applicants as $app) {

        $CanJob->push($app->CanInfo);
    }
}

$merged = $OwnCan->merge($CanJob);
$resultall = $merged->all();

foreach ($resultall  as $all) {
  
 if(!is_null($all->getCandidateStaus->find($userid))) 

 {
    

    $status=$all->getCandidateStaus->find($userid)->pivot->AgencyStatus;

if($status=="Send to Itegration")
{
     $SendtoItegrationCan->push($all);

       
    }
  

}

}


$result=$SendtoItegrationCan;


return view('employer.patshowcan',compact('result','allCan','userid','shortlist','id'));
}       
}
public function  updatestatus(Request $request)
{

    $Query = \DB::table('client')->where('Emp_id', $request->agenid)->where('Can_id',$request->userid)->first();
$data[]=[
    'Emp_id'=>$request->agenid,
    'Can_id'=>$request->userid,
    'AgencyStatus'=>$request->status,
];


if(is_null($Query))
{
    
    \DB::table('client')->insert($data);
    
}

else
{
   $update = \DB::table('client')->where('Emp_id', $request->agenid)->where('Can_id',$request->userid) ->limit(1) ->update( [ 'AgencyStatus' => $request->status ]); 

}
return redirect()->back()->with('success', 'Status Updated'); 
}


public function  shareclient (Request $request)
{
 
$clinet=explode(",",$request->clientids);
$candidate=explode(",",$request->canids);
$agency=\Auth::user()->id;
$comment=$request->agencycomment;
  $CanQuery=CandidateInfo::whereIn('user_id',$candidate)->get();


foreach ($CanQuery as $can) {
   
\DB::table('SharedClient')->where('Can_id',$can->user_id)->delete();

    $can->getCandidateClientStaus()->attach($clinet ,array('Can_id' => $can->user_id,'Agency_id'=> $agency,'CommentAgency' => $comment));
     
}



          return response()->json(['status'=>true,'message'=>"Candidate Shared successfully."]);
    
}
public function  sharejobtocandidate (Request $request)
{
 

$job=explode(",",$request->jobIds);
 $candidate=explode(",",$request->canids);


  $PostJobQuery=PostJob::whereIn('job_id',$job)->where('created_by',\Auth::user()->id)->get();

foreach ($PostJobQuery as $job) {
   


     $job->applicants()->sync($candidate);

    
}



          return response()->json(['status'=>true,'message'=>"Job Shared successfully."]);
    
}
}

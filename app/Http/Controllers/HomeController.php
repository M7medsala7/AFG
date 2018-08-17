<?php

namespace App\Http\Controllers;
use App\CandidateInfo;
use App\PostJob;
use App\Job;
use Auth;
use App\User;
use App\Skills;
use Illuminate\Http\Request;
use App\EmployerProfile; 
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function  editFullReg(Request $request)
    {
        try
        {
        return view('auth.Edit_Candidate_reg');
        }    
        catch(Exception $e) 
        {
            return redirect('/');
        }
    }
    public function EditJobRef()
    {
        try
        {
        return view('Postjob.EditJobRefrnces');
        }    
        catch(Exception $e) 
        {
            return redirect('/');
        }
    }
    public function index()
    {
      try  
        {

        if(\Auth::user())
        {
            if(\Auth::user()->type=='employer')
                return $this->employerDashboard();
            else
               return $this->CanadatiesDashboard();
        }
        else
            return view('home');
        }    
        catch(Exception $e) 
        {
            return redirect('/');
        }

    }
    public function CanadatiesDashboard()
    {
        try
        {
            $RecommandJobs=[];
            $CandidateInfo=\Auth::user()->CanInfo()->first();
            if (\Auth::user()->Birthday !=null)
            $age=\Auth::user()->getAge(\Auth::user()->Birthday);
            else
            $age=" ";
            $SKills_Can=\Auth::user()->getUserSkill()->get();

            if($CandidateInfo->job_id!=null)
            {
            $jobName=Job::where('id',$CandidateInfo->job_id)->first();
            $JobNames=Job::where('id',$CandidateInfo->job_id)->select('name')->limit(2)->first();
            $JobNameLiks=Job::where('name', 'LIKE', '%'.$JobNames->name.'%')->limit(2)->get();
            foreach($JobNameLiks as $JobNameLiks)
            {
            $MatchingJos = PostJob::where('job_id',$JobNameLiks->id)
            ->orwhere('country_id',$CandidateInfo->country_id)->limit(3)->get();  
                foreach ($MatchingJos as $Matching) 
                {
                array_push($RecommandJobs, $Matching); 
                } 
            }       
            $Candidates=CandidateInfo::where('vedio_path','!=',null)
                        ->where('job_id',$CandidateInfo->job_id)
                        ->where('user_id','!=',\Auth::user()->id)
                        ->get();                  
            $MatchingJobs = PostJob::where('job_id',$CandidateInfo->job_id)
                                    ->get(); 
            }
            else
            {
            $jobName=null;
            $RecommandJobs=null;
            $Candidates=null;
            $MatchingJobs=null;

            }
            return view('candidates.CandadtiesDashboard',compact('age','MatchingJobs','Candidates','RecommandJobs','jobName','CandidateInfo'));
            }    
            catch(Exception $e) 
            {
                return redirect('/');
            }
    
    }
    public function getNotify()
    {
        try
        {
        $similarJobs =\App\PostJob::where('job_id',1)->get();
        return json_encode($similarJobs);
        }    
        catch(Exception $e) 
        {
            return redirect('/');
        }
    }
    public function MatchingJobs()
    {
        try
        {
        $MatchingJobs=[];
        $CandidateInfo=\Auth::user()->CanInfo()->first();
        if($CandidateInfo->job_id!=null)
        {
            $JobName=Job::where('id',$CandidateInfo->job_id)->select('name')->first();
            $JobNameLiks=Job::where('name', 'LIKE', '%'.$JobName->name.'%')->get();
            foreach($JobNameLiks as $JobNameLiks)
            {
            $MatchingJo = PostJob::where('job_id',$JobNameLiks->id)->get();    

                foreach ($MatchingJo as $Matching)
                {
                    array_push($MatchingJobs, $Matching); 
                }  
            }    
        }     
        else
        {
          $MatchingJobs=null;
        } 
        return view('employer.SuggestesEmployee',compact('MatchingJobs','CandidateInfo'));
        }    
        catch(Exception $e) 
        {
            return redirect('/');
        }
    }
    public function ContactShow()
    {
        try
        {
        return view('CompanyInfo.contact');
        }    
        catch(Exception $e) 
        {
            return redirect('/');
        }
    }
    public function getjobsbycountry()
    {
        try
        {
      $CandidateInfo=\Auth::user()->CanInfo()->first(); 
      $RecommandJobs = PostJob::join('jobs','jobs.id','=','post_jobs.job_id')
                    ->join('countries','countries.id','=','post_jobs.country_id')
                    ->where('country_id',$CandidateInfo->country_id)
                    ->select('job_for','max_salary','min_salary','jobs.name','countries.Lnag','countries.Lat')
                    ->get(); 
        return json_encode(['jobs'=>$RecommandJobs]);
        }    
        catch(Exception $e) 
        {
            return redirect('/');
        }                  
    }
    public function employerDashboard()
    {
        try
        {
        $employerJobs = \Auth::user()->postJobs;
        $countrynames= EmployerProfile::
        join('countries','countries.id','=','employer_profiles.country_id')
        ->select('countries.name  AS CName' )
        ->where('user_id',\Auth()->user()->id)->get();
         $citynames= EmployerProfile::
        join('cities','cities.id','=','employer_profiles.city_id')
        ->select('cities.name  AS cityName' )
        ->where('user_id',\Auth()->user()->id)->get();
        return view('employer.dashboard',compact('employerJobs','countrynames','citynames'));
        }    
        catch(Exception $e) 
        {
            return redirect('/');
        }
    }  
    public function getNextTopCandidates(Request $request)
    {
        try
        {
        $topCandidates = collect();
        $job = \App\PostJob::find($request['jobId']);
        $candidates = \App\CandidateInfo::where('id','>',$request['last_candidate_id'])->get();
        foreach ($candidates as $key => $candidate) {
            if($candidate->job_id == $job->job_id && $candidate->nationality == $job->nationality && $candidate->country_id == $job->country_id)
            {
                $candidate['order']=1;
                $topCandidates->push($candidate);
            }
            elseif ($candidate->job_id == $job->job_id && $candidate->country_id == $job->country_id && $candidate->nationality != $job->nationality)
            {
                $candidate['order']=3;
                $topCandidates->push($candidate);   
            }
            elseif ($candidate->job_id == $job->job_id && $candidate->nationality == $job->nationality && $candidate->country_id != $job->country_id)
            {
                $candidate['order']=3;
                $topCandidates->push($candidate);   
            }
            if(count($topCandidates)>5)
                break;
        }
        $html = view('employer.load_more_c',compact('topCandidates'))->render();
        return ['html'=>$html,'new_last_id'=>$topCandidates->last()->id];
        }    
        catch(Exception $e) 
        {
            return redirect('/');
        }
    }
    public function getNextJobCandidates(Request $request)
    {
        try
        {
        $jobId= $request['jobId'];
        $similarJobs =\App\PostJob::where('job_id',$request['jobId'])->where('id','>',$request['post_job_id'])->get();
        $similarJobs->take(6);
        $html = view('employer.load_more_j_c',compact('similarJobs'))->render();
        return ['html'=>$html,'new_last_id'=>$similarJobs->last()->id];
        }    
        catch(Exception $e) 
        {
         return redirect('/');
        }
    }
}

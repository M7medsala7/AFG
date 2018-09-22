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
use App\SuccessStories;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Response;
use App\Country;
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
  
   
     //edit job refrences
    public function EditJobRef()
    {
          return view('Arabic.Jobs.EditJobRefrnces');
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
                        //Recomanded jobs  accoriding to 
            $jobName=Job::where('id',$CandidateInfo->job_id)->first();
                 
        $JobNames=Job::where('id',$CandidateInfo->job_id)->select('name')->first();

            $JobNameLiks=Job::where('name', 'LIKE', '%'.$JobNames->name.'%')->get();

        foreach($JobNameLiks as $JobNameLiks)
            {
                $MatchingJos = PostJob::where('job_id',$JobNameLiks->id)->get();  
              
        foreach ($MatchingJos as $Matching) {
    
        array_push($RecommandJobs, $Matching); 
       
    
        } 
      
            }      
                        //Candidates Looking For The Same Job
                        $Candidates=CandidateInfo::where('vedio_path','!=',null)
                        ->where('job_id',$CandidateInfo->job_id)
                        ->where('user_id','!=',\Auth::user()->id)
                        ->paginate(3);                  

                        //Matching job 
                        $MatchingJobs = PostJob::where('job_id',$CandidateInfo->job_id)
                        ->paginate(6); 
            }
            else
            {
                $jobName=null;
                $RecommandJobs=null;
                $Candidates=null;
                $MatchingJobs=null;

            }
        
            //dd($RecommandJobs);
            if (\Request::ajax(['job']==1)) {
                
                return Response::json(\View::make('Arabic.Candadties.matchingjobs', array('MatchingJobs' => $MatchingJobs))->render());
            }
        
        
        
    
        return view('Arabic.Candadties.CandadtiesDashboard',compact('age','Candidates','RecommandJobs','jobName','CandidateInfo'),array('MatchingJobs' => $MatchingJobs), array('Candidates' => $Candidates), array('RecommandJobs' => $RecommandJobs));
    }
    catch(Exception $e) 

    {

    return redirect('/');

    }

    }


   
    //more recommendaded jobs
    public function Recomanded(Request $request)
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
                            //Recomanded jobs  accoriding to 
                            $jobName=Job::where('id',$CandidateInfo->job_id)->first();
                    
            $JobNames=Job::where('id',$CandidateInfo->job_id)->select('name')->first();
                

                $JobNameLiks=Job::where('name', 'LIKE', '%'.$JobNames->name.'%')->get();
            foreach($JobNameLiks as $JobNameLiks)
                {
                    $MatchingJos = PostJob::where('job_id',$JobNameLiks->id)
                    ->orwhere('country_id',$CandidateInfo->country_id)->get();  
                    //dd($MatchingJos);  

            foreach ($MatchingJos as $Matching) {
        
            array_push($RecommandJobs, $Matching); 
            
    
            } 
            }
            $data = array();

            //Get current page form url e.g. &page=6
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
    
            //Create a new Laravel collection from the array data
            $collection = new Collection($RecommandJobs);
    
            //Define how many items we want to be visible in each page
            $per_page = 21;
    
            //Slice the collection to get the items to display in current page
            $currentPageResults = $collection->slice(($currentPage-1) * $per_page, $per_page)->all();
    
            //Create our paginator and add it to the data array
            $data['RecommandJobs'] = new LengthAwarePaginator($currentPageResults, count($collection), $per_page);
    
            //Set base url for pagination links to follow e.g custom/url?page=6
            $data['RecommandJobs']->setPath($request->url());
    
    $RecommandJobs=$data['RecommandJobs'];
    
        }
            else
            {
                $jobName=null;
                $RecommandJobs=null;

            }

                        
            
                    return view ('Arabic.Candadties.partialrecomanded',compact('age','Candidates','RecommandJobs','jobName','CandidateInfo'));
                }
            catch(Exception $e) 

            {

            return redirect('/');

            }
    }




    //more jobs
    public function morejobs(Request $request)
    {
    
       try
       {
            $CandidateInfo=\Auth::user()->CanInfo()->first();
        
                        $MatchingJobs = PostJob::where('job_id',$CandidateInfo->job_id)
                        ->paginate(8);                  
                        if (\Request::ajax(['job']==1)) {
                
                            return Response::json(\View::make('Arabic.Candadties.partialjobs', array('MatchingJobs' => $MatchingJobs))->render());
                        }
                    
        
             return view ('Arabic.Candadties.matchingjobs',array('MatchingJobs' => $MatchingJobs));
        
         }
            catch(Exception $e) 

            {

            return redirect('/');

            }
    }


    
    public function getNotify()
    {

        $similarJobs =\App\PostJob::where('job_id',1)->get();
        
        return json_encode($similarJobs);
    }

    
    //matching candidates
    public function dashMatchingcandidates(Request $request)
    {
    
       try
       {
            $CandidateInfo=\Auth::user()->CanInfo()->first();
        
                        //Candidates Looking For The Same Job
                        $Candidates=CandidateInfo::where('vedio_path','!=',null)
                        ->where('job_id',$CandidateInfo->job_id)
                        ->where('user_id','!=',\Auth::user()->id)
                        ->paginate(3);                  
                        if (\Request::ajax(['asd']==1)) {
                
                            return Response::json(\View::make('Arabic.Candadties.partialcandidate', array('Candidates' => $Candidates))->render());
                        }
                    
        
            return view ('Arabic.Candadties.MatchingCandidate',array('Candidates' => $Candidates));
        }
        catch(Exception $e) 

        {

        return redirect('/');

        }
    }


      //matching jobs
      public function MatchingJobs()
      {

        try
        {        $MatchingJobs=[];
                    $CandidateInfo=\Auth::user()->CanInfo()->first();
                    if($CandidateInfo->job_id!=null)
                    {
                    
                    $JobName=Job::where('id',$CandidateInfo->job_id)->select('name')->first();
                    

                    $JobNameLiks=Job::where('name', 'LIKE', '%'.$JobName->name.'%')->get();
            foreach($JobNameLiks as $JobNameLiks)
            {
                        $MatchingJo = PostJob::where('job_id',$JobNameLiks->id)->get();    

            foreach ($MatchingJo as $Matching) {
            
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
        return view('Arabic.CompanyInfo.contact');
    }


    //get jobs by country
    public function getjobsbycountry()
    {

        try
        {

            $RecommandJobs=[];
            $CandidateInfo=\Auth::user()->CanInfo()->first(); 
            
            $JobName=Job::where('id',$CandidateInfo->job_id)->select('name')->limit(2)->first();

            $JobNameLiks=Job::where('name', 'LIKE', '%'.$JobName->name.'%')->limit(2)->get();
            foreach($JobNameLiks as $JobNameLiks)
                {
                    $MatchingJos = PostJob::where('job_id',$JobNameLiks->id)
                    ->orwhere('country_id',$CandidateInfo->country_id)->with('job')->with('country')->limit(3)->get();  
                    

            foreach ($MatchingJos as $Matching) {
        
            array_push($RecommandJobs, $Matching); 
        
        
            } 
            } 
        

        

                return json_encode(['jobs'=>$RecommandJobs]);
            }
            catch(Exception $e) 

            {

            return redirect('/');

            }
                          
    }


    

    //employer dashboard
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


    //next top candidates
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
                    // 2 in common
                    elseif ($candidate->job_id == $job->job_id && $candidate->country_id == $job->country_id && $candidate->nationality != $job->nationality)
                    {
                        # code...
                        $candidate['order']=3;
                        $topCandidates->push($candidate);   
                    }
                    elseif ($candidate->job_id == $job->job_id && $candidate->nationality == $job->nationality && $candidate->country_id != $job->country_id)
                    {
                        # code...
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

    //next jobs candidates
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

    

    //smilir cansdidates and jobs 
     public function Candidate_Job(Request $request)
     { 

            $jobId= $request['jobId'];
            $similarJobs =\App\PostJob::where('job_id',$request['jobId'])->get();
            return view('employer.jobs$candidates' ,compact('similarJobs'));
     }


     //create success story form
     public function CreateSuccessStory(EmployerProfile $employer ,$id)
     {
         
         $data = $employer->find($id);
        
         return view('employer.create_successStory' ,compact('data'));
     }
 

       //stor success story of candiades
       public function SuccessStory( $id)
       {
           try
           {
                $userid=EmployerProfile::where('id',$id)->select('user_id')->first();
                
                $uid=$userid->user_id;

                SuccessStories::create([
        
                'description'=>request('description'),
                'user_id'=>$uid,
                'approval'=>0,
                'emp_id'=>$id,
                ]);
                
                return Redirect('/home');
            }
            catch(Exception $e) 

            {

            return redirect('/');

            }
       }



       
}

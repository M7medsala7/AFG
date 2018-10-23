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
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use Carbon\Carbon;
use Auth;
use DB;
use Session;
use App\User;
use Socialite;
use Mail;
use App\CandidateInfo;
class JobPostController extends Controller
{
    
    private $api;
    public function __construct(Facebook $fb)
    {
        $this->middleware(function ($request, $next) use ($fb) {
           
          //  dd($fb);
        //  $fb->setDefaultAccessToken('256a2ea30f591c082b352a85a0f2de8c');
            $this->api = $fb;
          //  dd()
            return $next($request);
        });
    }


    public function create()
    {
    	return view('employer.post_job');
    }

public function sharefb()
{




			//`id`, `access_token`, `page_id`, `page_url`, `page_name`, `isActive`
			$page_access_token = 'EAAT8wdZArTS4BAElIKMw9MItv0Rh5ha8oZA3yEIDjAEaLYtZB0pLJPHaoXUUnKaKZC1SxtuXIAsc8JxUYBBTrZAhcZA2LsZBDFI1ov24AHZAdroNRdbQmZBJCUHExQmh7ji72ZAJ7fUpYqmbMxTZCvRhQBKJG9TMnoeLPPdstCChYLN08iiDdhiObBJufuHu1LtzLih3wt7PKbykgZDZD';
			$page_id = '185519658476147';
			$url = 'http://stackoverflow.com/questions/7818667/simple-example-to-post-to-a-facebook-fan-page-via-php';

		//	$data['picture'] = "https://scontent-cdg2-1.xx.fbcdn.net/v/t1.0-9/12715358_188921771469269_1065258198462261961_n.jpg?oh=5f5acbc707271bdd7809d7a2de99b04a&oe=58F14EEB";

			$data['message'] = "Test message";
			$data['caption'] = "Caption";
			$data['description'] = "Description";

			$data['link'] = $url;
//            $data['link'] = URL::to($url);
			$data['access_token'] = $page_access_token;
           
			$post_url = 'https://graph.facebook.com/'.$page_id.'/feed';

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $post_url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$return = curl_exec($ch);
			curl_close($ch);

        dd($return);
	


   
   
      $pageId='185519658476147';
    // initialize Facebook class using your own Facebook App credentials
    // see: https://developers.facebook.com/docs/php/gettingstarted/#install
    $config = array();
    $config['appId'] = '282393199267611';
    $config['secret'] = '1d67c563390477c4559c9666936e50b2';
    $config['accessToken'] = 'EAAT8wdZArTS4BAElIKMw9MItv0Rh5ha8oZA3yEIDjAEaLYtZB0pLJPHaoXUUnKaKZC1SxtuXIAsc8JxUYBBTrZAhcZA2LsZBDFI1ov24AHZAdroNRdbQmZBJCUHExQmh7ji72ZAJ7fUpYqmbMxTZCvRhQBKJG9TMnoeLPPdstCChYLN08iiDdhiObBJufuHu1LtzLih3wt7PKbykgZDZD';
    $config['fileUpload'] = true; // optional

    
    $fb = new Facebook($config);
    $helper = $fb->getRedirectLoginHelper();
   
   
    $helper = $fb->getRedirectLoginHelper('http://www.sportsector.bg/login-callback.php');
    $accessToken = $helper->getAccessToken();  
   
    // define your POST parameters (replace with your own values)
    $params = array(
     // "access_token" => "256a2ea30f591c082b352a85a0f2de8c", // see: https://developers.facebook.com/docs/facebook-login/access-tokens/
      "message" => "Here is a blog post about auto posting on Facebook using PHP #php #facebook",
      "link" => "http://www.pontikis.net/blog/auto_post_on_facebook_with_php",
      "picture" => "http://i.imgur.com/lHkOsiH.png",
      "name" => "How to Auto Post on Facebook with PHP",
      "caption" => "www.pontikis.net",
      "description" => "Automatically post on Facebook with PHP using Facebook PHP SDK. How to create a Facebook app. Obtain and extend Facebook access tokens. Cron automation."
    );

    $page_access_token = 'EAAT8wdZArTS4BAElIKMw9MItv0Rh5ha8oZA3yEIDjAEaLYtZB0pLJPHaoXUUnKaKZC1SxtuXIAsc8JxUYBBTrZAhcZA2LsZBDFI1ov24AHZAdroNRdbQmZBJCUHExQmh7ji72ZAJ7fUpYqmbMxTZCvRhQBKJG9TMnoeLPPdstCChYLN08iiDdhiObBJufuHu1LtzLih3wt7PKbykgZDZD';
 
   // see: https://developers.facebook.com/docs/reference/php/facebook-api/
    try {

      $ret = $fb->post('/185519658476147/feed',$params,  $page_access_token);
      echo 'Successfully posted to Facebook';
    } catch(Exception $e) {
      echo $e->getMessage();
    }


    try {
        $response = $this->api->post('/185519658476147/feed', [
            'message' => "DODOd"
        ])->getGraphNode()->asArray();
        if($response['id']){
           // post created
        }
    } catch (FacebookSDKException $e) {
        dd($e); // handle exception
    }



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
            
                        }
                        else
                        {
                        $link=$post_job->link;
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
    


    public function store(Request $request)
    {
         

        try
        {
                $this->validate($request,[
                    'job_id'=>'required',
                    'industry_id'=>'required',
                    'country_id'=>'required',
                    ]);
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

            if(Auth::user() !=null)
            {
            $Like=DB::table('user_like_jobs')
                                ->where('job_id',$id)
                                ->where('user_id',\Auth::user()->id)
                                ->first();
                        if($Like!=null)
                        {
                        $color='red';
                        
                        }
            }
                if(Auth::user() !=null && Auth::user()->CanInfo !=null)
                {
                    $jobCan=PostJob::where('job_id',Auth::user()->CanInfo->job_id)->get();

                
                    


                }
                return view('Arabic.Jobs.ViewJob',compact('job','jobforcompany','jobCan','color','Skilljob'));
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

            $id=$request->selected;
            $resultQuery=CandidateInfo::join('nationalities','nationalities.id','candidate_infos.nationality_id')
            ->where('candidate_infos.job_id',$id)
            ->select( DB::raw('count(candidate_infos.nationality_id) as count ,nationalities.name') )
            ->groupBy('candidate_infos.nationality_id')->get();

            $dataresult=[];
            foreach ($resultQuery as $resultQu) {
                                                    array_push($dataresult,array(
                                                    'label' => $resultQu->name,
                                                    'y' => $resultQu->count
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

     
               return view('employer.JobsStatstics',compact('employerJobs','countrynames','citynames','employerJobsShow','jobStatstics'));

    
    }
   


}

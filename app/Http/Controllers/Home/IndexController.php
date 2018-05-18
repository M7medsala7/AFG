<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\User;
use App\CandidateInfo;
use App\PostJob;
use Goutte\Client;
use App\Job;
use App\Country;

class IndexController extends Controller
{
   public function index()
   {

   	$TotalEmpolyer= User::where('type','employer')->count();
		$TotalCandidate= User::where('type','candidate')->count();
		$TotalVideoCvs= CandidateInfo::where('vedio_path','!=',NULL)->count();
		$TotalAnsweredQuestions= DB::table('job_questions_answers')->count();

		$RecentlyAddedJobs= PostJob::join('users','users.id','=','post_jobs.created_by')
		->join('jobs','jobs.id','=','post_jobs.job_id')
		->join('countries','countries.id','=','post_jobs.country_id')
		->orderBy('post_jobs.created_at', 'DEC')->limit(4)
		->select('jobs.name AS JobName','users.name AS CompanyName','users.type','post_jobs.max_salary','countries.name AS CountryName','post_jobs.created_at AS Jobdate')->get();

		$SuccessStories =DB::table('success_stories')->join('users','users.id','=','success_stories.user_id')->orderBy('success_stories.created_at', 'DEC')->limit(4)->get();

		$TopCandidate =CandidateInfo::orderBy('candidate_infos.created_at', 'DEC')->limit(4)->get();
		
		return view('Layout.index',compact('TotalEmpolyer','TotalCandidate','TotalVideoCvs','TotalAnsweredQuestions','RecentlyAddedJobs','SuccessStories','TopCandidate'));
   }

   public function search(Request $request)
   {

   
   		$words = $request['words'];
   		$type = $request['type'];

 $GLOBALS['jobsIndeed'] =array();
  $GLOBALS['summary'] =array();
   $GLOBALS['location'] =array();
   $GLOBALS['links'] =array();
    $GLOBALS['company'] =array();
    $candidateresult=array();
   $GLOBALS['searchresulte'] =array();
   		$client = new Client();




    $crawler = $client->request('GET', 'https://www.indeed.com/jobs?q='.$words.'&l=');

    $crawler->filter('h2.jobtitle a')->each(function ($node) {
    	
 array_push( $GLOBALS['jobsIndeed'],$node->text());
// dd( $GLOBALS['jobsIndeed']);
 $link= substr($node->attr('href'),7); 
  array_push( $GLOBALS['links'],$link);




   
  
});



                $crawler->filter('span.summary ')->each(function ($node) {
                	 array_push( $GLOBALS['summary'],$node->text());

    
});


                $crawler->filter('span.location ')->each(function ($node) {
                	 array_push( $GLOBALS['location'],$node->text());

    
});

                                $crawler->filter('span.company ')->each(function ($node) {

                	 array_push( $GLOBALS['company'],$node->text());

    
});
// dd($GLOBALS['company']);
for ($i=0; $i <count( $GLOBALS['jobsIndeed']) ; $i++) { 
$jobIds = Job::where('name','=',$GLOBALS['jobsIndeed'][$i])->first();
// dd($jobIds);
if($jobIds==null)
{
	

	$job= New Job;
	
	
	$job->name=$GLOBALS['jobsIndeed'][$i];
	$job->type=1;
$job->save();
}

$LocationIds = Country::where('name','=',$GLOBALS['location'][$i])->first();
if($LocationIds==null)
{
	$location = New Country;
	$location->name =$GLOBALS['location'][$i];
$location->save();
}

$UsersIds = User::where('name','=',$GLOBALS['company'][$i])->first();
if($UsersIds==null)
{
	$user = New User;
	$user->name =$GLOBALS['company'][$i];
	$user->email =$GLOBALS['company'][$i];
$user->save();
}

$postJob= New PostJob;

	
$jobId = Job::where('name','=',$GLOBALS['jobsIndeed'][$i])->first();

$LocationId = Country::where('name','=',$GLOBALS['location'][$i])->first();
$UserId = User::where('name','=',$GLOBALS['company'][$i])->first();
	$postJob->created_by=$UserId->id;
		$postJob->country_id=$LocationId->id;
		$postJob->job_for='indeed.com';
		$postJob->job_id=$jobId->id;
		$postJob->job_descripton=$GLOBALS['summary'][$i];

		$postJob->link=$GLOBALS['links'][$i];

		$postJob->save();
	
	// dd($GLOBALS['location'][$i]);
//$locationqury=Country::where('name',$GLOBALS['location'][$i])->get();

	 // $location->name=$GLOBALS['location'][$i];
}
$candidates= collect();
   		if($type == 'employer')
		{
			$cand_infos = CandidateInfo::search($words)->get();

			
			foreach ($cand_infos as  $can_info) {

				
			$Canresult=CandidateInfo::join('jobs','jobs.id','candidate_infos.job_id')
->join('post_jobs','post_jobs.job_id','candidate_infos.job_id')->
	join('countries','countries.id','=','candidate_infos.country_id')

->join('users','users.id','=','candidate_infos.user_id')
->select('jobs.name AS JobName','post_jobs.*','users.name AS UserName','countries.Name AS CountryName')
->get();


	$candidates->push($Canresult);
}



	
			$jobcheck=0;
$count=count($candidates);


			return  view('Search.searchresult',compact('candidates','words','jobcheck','count'));
		}
		elseif($type =="candidate")
		{
			$jobs = PostJob::search($words)->get();
$jobcheck=1;
	
$count=count($jobs);
			return  view('Search.searchresult', compact('jobs','words','jobcheck','count'));
		}
		else
		{
			$result=collect();
			$count=count($result);
				return  view('Search.searchresult',compact('result','words','count') );

		}
	

   
}

 public function test()
    {
    	$client = new Client();
$words = 'housemaid';
    $crawler = $client->request('GET', 'https://www.indeed.com/jobs?q='.$words.'&l=');

    $crawler->filter('h2.jobtitle a')->each(function ($node) {
   print "<a href='".$node->attr('href')."'>".$node->text()."</a><br/>";
    // dd($node);
});

        $crawler->filter('span.location ')->each(function ($node) {
   print "<a href='".$node->attr('href')."'>".$node->text()."</a><br/>";
    // dd($node);
});

                $crawler->filter('span.summary ')->each(function ($node) {
   print "<a href='".$node->attr('href')."'>".$node->text()."</a><br/>";
    // dd($node);
});
dd($crawler);

    }

}

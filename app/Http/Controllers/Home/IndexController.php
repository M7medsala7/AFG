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
use App\Skills;
use App\Currency;
use Input;
use Khsing\World\World;
use App\SuccessStories;
use Illuminate\Support\Facades\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;



class IndexController extends Controller
{
   public function index()
   {

        $TotalJob= PostJob::count();
        $TotalCandidate= CandidateInfo::count();
        $TotalVideoCvs= CandidateInfo::where('vedio_path','!=',NULL)->count();
        $TotalAnsweredQuestions= DB::table('candidate_infos')->count()*21;

        $RecentlyAddedJobsAgg= PostJob::join('users','users.id','=','post_jobs.created_by')
        ->join('jobs','jobs.id','=','post_jobs.job_id')
        ->join('countries','countries.id','=','post_jobs.country_id')
        ->whereNotIn('job_for',['family,company,Agency'])
        ->orderBy('post_jobs.created_at', 'DEC')->limit(2)
        ->select('jobs.name AS JobName','post_jobs.job_for','post_jobs.job_descripton',
        'users.name AS CompanyName','users.type','post_jobs.max_salary',
        'countries.name AS CountryName','post_jobs.min_salary','post_jobs.currency_id',
        'post_jobs.created_at AS Jobdate','post_jobs.id'
        )
        ->get();


        $RecentlyAddedJobsCompany= PostJob::join('users','users.id','=','post_jobs.created_by')
        ->join('jobs','jobs.id','=','post_jobs.job_id')
        ->join('countries','countries.id','=','post_jobs.country_id')
        ->where('job_for','company')
        ->orderBy('post_jobs.created_at', 'DEC')->limit(1)
        ->select('jobs.name AS JobName','post_jobs.job_for','post_jobs.job_descripton',
        'users.name AS CompanyName','users.type','post_jobs.max_salary',
        'countries.name AS CountryName','post_jobs.min_salary','post_jobs.currency_id',
        'post_jobs.created_at AS Jobdate','post_jobs.id'
        )
        ->get();

      $RecentlyAddedJobsFamily= PostJob::join('users','users.id','=','post_jobs.created_by')
        ->join('jobs','jobs.id','=','post_jobs.job_id')
        ->join('countries','countries.id','=','post_jobs.country_id')
        ->where('job_for','family')
        ->orderBy('post_jobs.created_at', 'DEC')->limit(1)
        ->select('jobs.name AS JobName','post_jobs.job_for','post_jobs.job_descripton',
        'users.name AS CompanyName','users.type','post_jobs.max_salary',
        'countries.name AS CountryName','post_jobs.min_salary','post_jobs.currency_id',
        'post_jobs.created_at AS Jobdate','post_jobs.id'
        )
        ->get();
        
        $SuccessStories =SuccessStories::join('users','users.id','=','success_stories.user_id')
        ->join('employer_profiles','employer_profiles.id','=','success_stories.emp_id')
       ->orderBy('success_stories.created_at', 'DEC')
       ->where('approval',1)->get();

     // dd($SuccessStories);  

      $SuccessStoriescan =SuccessStories::join('users','users.id','=','success_stories.user_id')
      ->join('candidate_infos','candidate_infos.id','=','success_stories.can_id')
      ->join('jobs','jobs.id','=','candidate_infos.job_id')
     ->orderBy('success_stories.created_at', 'DEC')
     ->where('approval',1)->get();
     // dd($SuccessStoriescan); 

     $allSuccessStories=[];
    
  
  
     foreach($SuccessStories as $value)
     {
      array_push($allSuccessStories,array('description'=>$value->description,'logo'=>$value->logo,'name'=>$value->name,'type'=>$value->type));
    
    }

     foreach($SuccessStoriescan as $value)
     {
      array_push($allSuccessStories,array('description'=>$value->description,'logo'=>$value->logo,'name'=>$value->last_name,'type'=>$value->name));
      //dd($alljobCan);
    }
     
       
   //dd( $alljobCan); 
    
     


        $TopCandidate =CandidateInfo::orderBy('candidate_infos.created_at', 'DEC')->where('seen','=',1)->limit(4)->get();
        
        return view('Layout.index',compact('allSuccessStories','Success','TotalJob','TotalCandidate','TotalVideoCvs','TotalAnsweredQuestions','RecentlyAddedJobsFamily','RecentlyAddedJobsCompany','SuccessStories','RecentlyAddedJobsAgg','TopCandidate'));
   }



   //more
   


   public function search(Request $request)
   {
    try
    {
 
        $words = $request['words'];
        $type = $request['type'];
 $GLOBALS['jobsIndeed'] =array();
  $GLOBALS['summary'] =array();
   $GLOBALS['location'] =array();
   $GLOBALS['links'] =array();
    $GLOBALS['company'] =array();
 $GLOBALS['job_for'] =array();
 $GLOBALS['currency'] =array();
  $GLOBALS['minsalary'] =array();
   $GLOBALS['maxsalary'] =array();
   $GLOBALS['CountjobsIndeedOM'] =array();
    $GLOBALS['CountjobsIndeedSa'] =array();
    $GLOBALS['CountjobsMaidCv'] =array();
 $GLOBALS['CountjobsIndeedAE'] =array();

 $GLOBALS['CountjobsIndeedQA'] =array();

    $candidateresult=array();
        $jobtitleresult=collect();
$candidates= collect();
   $GLOBALS['searchresulte'] =array();
        




$jobfor=PostJob::select('job_for')->orderByRaw('FIELD(job_for, "Family", "Company", "Agency","Jobs In KSA","Jobs In Oman","Jobs In Qatar","Jobs In UAE","Maidcv.Com","Jobs In USA")','DESC')
 ->distinct('job_for')->get();

 if($type =="I am Candidate" )
        {
          $client = new Client();

    $crawler = $client->request('GET', 'https://www.indeed.com/jobs?q='.$words.'&l=');

    $crawler->filter('h2.jobtitle a')->each(function ($node) {
        
 array_push( $GLOBALS['jobsIndeed'],$node->text());
 //dd( $GLOBALS['jobsIndeed']);

 

array_push( $GLOBALS['job_for'],'Jobs in USA');

array_push( $GLOBALS['currency'],NULL);
array_push( $GLOBALS['minsalary'],NULL);
array_push( $GLOBALS['maxsalary'],NUll);
   
  
});



          for($i=0 ;$i<count($GLOBALS['jobsIndeed']);$i++)
{
  try
  {
$pageCrawler=$crawler->filter('h2.jobtitle a')->eq($i)->text();
$link = $crawler->selectLink($pageCrawler)->link();
  
    $lin = $client->click($link );



     $crawlerIndeedusa = $client->request('GET', $lin->baseHref);
array_push( $GLOBALS['links'],$lin->baseHref);
   $summ=$crawlerIndeedusa->filter('span.summary')->text()  ;
array_push( $GLOBALS['summary'],$summ);
  
  }

  catch(\InvalidArgumentException $e) 
  {
    array_push( $GLOBALS['links'],'Na');
     array_push( $GLOBALS['summary'],'NA');
  }

}







          for($i=0 ;$i<count($GLOBALS['jobsIndeed']);$i++)
{
  try
  {
    // dd($crawler2->filter('span.location')->eq($i)->text());
     array_push( $GLOBALS['company'],$crawler->filter('span.company')->eq($i)->text());
  }

  catch(\InvalidArgumentException $e) 
  {
     array_push( $GLOBALS['company'],'NA');
  }

}

          for($i=0 ;$i<count($GLOBALS['jobsIndeed']);$i++)
{
  try
  {
    // dd($crawler2->filter('span.location')->eq($i)->text());
     array_push( $GLOBALS['location'],$crawler->filter('span.location')->eq($i)->text());
  }

  catch(\InvalidArgumentException $e) 
  {
     array_push( $GLOBALS['location'],'NA');
  }

}





 $crawler2 = $client->request('GET', 'https://om.indeed.com/jobs?q='.$words.'&l=');

     $crawler2->filter('h2.jobtitle a')->each(function ($node) {
        
 array_push( $GLOBALS['jobsIndeed'],$node->text());
 
array_push( $GLOBALS['CountjobsIndeedOM'],$node->text());




array_push( $GLOBALS['job_for'],'Jobs in Oman');
array_push( $GLOBALS['currency'],NULL);
array_push( $GLOBALS['minsalary'],NULL);
array_push( $GLOBALS['maxsalary'],NUll);
   
  
});





          for($i=0 ;$i<count($GLOBALS['CountjobsIndeedOM']);$i++)
{
  try
  {
$pageCrawler=$crawler2->filter('h2.jobtitle a')->eq($i)->text();
$link = $crawler2->selectLink($pageCrawler)->link();
  
    $lin = $client->click($link );



     $crawlerIndeedOm = $client->request('GET', $lin->baseHref);
array_push( $GLOBALS['links'],$lin->baseHref);
   $summ=$crawlerIndeedOm->filter('span.summary')->text()  ;
array_push( $GLOBALS['summary'],$summ);
  
  }

  catch(\InvalidArgumentException $e) 
  {
    array_push( $GLOBALS['links'],'Na');
     array_push( $GLOBALS['summary'],'NA');
  }

}



          for($i=0 ;$i<count($GLOBALS['CountjobsIndeedOM']);$i++)
{
  try
  {
    // dd($crawler2->filter('span.location')->eq($i)->text());
     array_push( $GLOBALS['location'],$crawler2->filter('span.company')->eq($i)->text());
  }

  catch(\InvalidArgumentException $e) 
  {
     array_push( $GLOBALS['location'],'NA');
  }

}



          for($i=0 ;$i<count($GLOBALS['CountjobsIndeedOM']);$i++)
{
  try
  {
    // dd($crawler2->filter('span.company')->eq($i)->text());
     array_push( $GLOBALS['company'],$crawler2->filter('span.company')->eq($i)->text());
  }

  catch(\InvalidArgumentException $e) 
  {
     array_push( $GLOBALS['company'],'NA');
  }

}


 $crawler3 = $client->request('GET', 'https://sa.indeed.com/jobs?q='.$words.'&l=');




     $crawler3->filter('h2.jobtitle a')->each(function ($node) {
     
 array_push( $GLOBALS['jobsIndeed'],$node->text());
  array_push( $GLOBALS['CountjobsIndeedSa'],$node->text());


array_push( $GLOBALS['job_for'],'Jobs in KSA');

array_push( $GLOBALS['currency'],NULL);
array_push( $GLOBALS['minsalary'],NULL);
array_push( $GLOBALS['maxsalary'],NUll);

   
  
});






          for($i=0 ;$i<count($GLOBALS['CountjobsIndeedSa']);$i++)
{
  try
  {
$pageCrawler=$crawler3->filter('h2.jobtitle a')->eq($i)->text();
$link = $crawler3->selectLink($pageCrawler)->link();
  
    $lin = $client->click($link );



     $crawlerIndeedSa = $client->request('GET', $lin->baseHref);
array_push( $GLOBALS['links'],$lin->baseHref);
   $summ=$crawlerIndeedSa->filter('span.summary')->text()  ;
array_push( $GLOBALS['summary'],$summ);
  
  }

  catch(\InvalidArgumentException $e) 
  {
    array_push( $GLOBALS['links'],'Na');
     array_push( $GLOBALS['summary'],'NA');
  }

}




for($i=0 ;$i<count($GLOBALS['CountjobsIndeedSa']);$i++)
{
  try
  {
    // dd($crawler3->filter('span.location')->eq($i)->text());
     array_push( $GLOBALS['location'],$crawler3->filter('span.company')->eq($i)->text());
  }

  catch(\InvalidArgumentException $e) 
  {
     array_push( $GLOBALS['location'],'NA');
  }

}



for($i=0 ;$i<count($GLOBALS['CountjobsIndeedSa']);$i++)
{
  try
  {
    // dd($crawler3->filter('span.company')->eq($i)->text());
     array_push( $GLOBALS['company'],$crawler3->filter('span.company')->eq($i)->text());
  }

  catch(\InvalidArgumentException $e) 
  {
     array_push( $GLOBALS['company'],'NA');
  }

}
              


// dd('l');

 $crawler4 = $client->request('GET', 'https://maidcv.com/ViewJobs');




     $crawler4->filter('a.joblist_title ')->each(function ($node) {
      // dd($node->text());

 array_push( $GLOBALS['jobsIndeed'],$node->text());

  array_push( $GLOBALS['links'],'https://maidcv.com/ViewJobs');
array_push( $GLOBALS['job_for'],'maidcv.com');



   
  
});


                                $crawler4->filter('div.joblist_desc p ')->each(function ($node) {

                  array_push( $GLOBALS['summary'],$node->text());
                           

    
 });


                                $crawler4->filter('div.joblist_jobinfo  ')->each(function ($node) {


$arr = explode('at', $node->text());
$variable =$arr[2];


$variable = substr($variable, 0, strpos($variable, "\r\n"));




                  array_push( $GLOBALS['location'],$variable);
                           

    
 });


                                $crawler4->filter('div.joblist_jobinfo  ')->each(function ($node) {


$arr = explode('by', $node->text());
$variable =$arr[1];


$variable = substr($variable, 0, strpos($variable, "\r\n"));





                  array_push( $GLOBALS['company'],$variable);
                           

    
 });



           
                                $crawler4->filter('span.joblist_sal ')->each(function ($node) {

                                  if (strpos($node->text(), 'over') !== false) {
                                   
                                     $splitSalary = explode(' ', $node->text(), 3);


                                     array_push( $GLOBALS['currency'],$splitSalary[0]);
array_push( $GLOBALS['minsalary'],'0');
$splitSalary[2]= str_replace(',', '.', $splitSalary[2]);
array_push( $GLOBALS['maxsalary'],$splitSalary[2]);

   
}
else
{

                                       $splitSalary = explode('-', $node->text(), 2);
                                       $splitSalary2 = explode(' ', $splitSalary[0], 2);

  
array_push( $GLOBALS['currency'],$splitSalary2[0]);
$splitSalary2[1]= str_replace(',', '.', $splitSalary2[1]);
array_push( $GLOBALS['minsalary'],$splitSalary2[1]);
$splitSalary[1]= str_replace(',', '.', $splitSalary[1]);
array_push( $GLOBALS['maxsalary'],$splitSalary[1]);

}
                  
                        

    
 });


                   
                           
 $crawler5 = $client->request('GET', 'https://www.indeed.ae/jobs?q='.$words.'&l=');




     $crawler5->filter('h2.jobtitle a')->each(function ($node) {
     
 array_push( $GLOBALS['jobsIndeed'],$node->text());
  array_push( $GLOBALS['CountjobsIndeedAE'],$node->text());


array_push( $GLOBALS['job_for'],'Jobs in UAE');

array_push( $GLOBALS['currency'],NULL);
array_push( $GLOBALS['minsalary'],NULL);
array_push( $GLOBALS['maxsalary'],NUll);

   
  
});



          for($i=0 ;$i<count($GLOBALS['CountjobsIndeedAE']);$i++)
{
  try
  {
$pageCrawler=$crawler5->filter('h2.jobtitle a')->eq($i)->text();
$link = $crawler5->selectLink($pageCrawler)->link();
  
    $lin = $client->click($link );



     $crawlerIndeedAE = $client->request('GET', $lin->baseHref);
array_push( $GLOBALS['links'],$lin->baseHref);
   $summ=$crawlerIndeedAE->filter('span.summary')->text()  ;
array_push( $GLOBALS['summary'],$summ);
  
  }

  catch(\InvalidArgumentException $e) 
  {
    array_push( $GLOBALS['links'],'Na');
     array_push( $GLOBALS['summary'],'NA');
  }

}


for($i=0 ;$i<count($GLOBALS['CountjobsIndeedAE']);$i++)
{
  try
  {
    // dd($crawler5->filter('span.location')->eq($i)->text());
     array_push( $GLOBALS['location'],$crawler5->filter('span.company')->eq($i)->text());
  }

  catch(\InvalidArgumentException $e) 
  {
     array_push( $GLOBALS['location'],'NA');
  }

}



for($i=0 ;$i<count($GLOBALS['CountjobsIndeedAE']);$i++)
{
  try
  {
    // dd($crawler5->filter('span.company')->eq($i)->text());
     array_push( $GLOBALS['company'],$crawler5->filter('span.company')->eq($i)->text());
  }

  catch(\InvalidArgumentException $e) 
  {
     array_push( $GLOBALS['company'],'NA');
  }

}
    
 $crawler6 = $client->request('GET', 'https://qa.indeed.com/jobs?q='.$words.'&l=');

     $crawler6->filter('h2.jobtitle a')->each(function ($node) {
        
 array_push( $GLOBALS['jobsIndeed'],$node->text());
 
array_push( $GLOBALS['CountjobsIndeedQA'],$node->text());



array_push( $GLOBALS['job_for'],'Jobs in Qatar');
array_push( $GLOBALS['currency'],NULL);
array_push( $GLOBALS['minsalary'],NULL);
array_push( $GLOBALS['maxsalary'],NUll);
   
  
});





          for($i=0 ;$i<count($GLOBALS['CountjobsIndeedQA']);$i++)
{
  try
  {
$pageCrawler=$crawler6->filter('h2.jobtitle a')->eq($i)->text();
$link = $crawler6->selectLink($pageCrawler)->link();
  
    $lin = $client->click($link );



     $crawlerIndeedQa = $client->request('GET', $lin->baseHref);
array_push( $GLOBALS['links'],$lin->baseHref);
   $summ=$crawlerIndeedQa->filter('span.summary')->text()  ;
array_push( $GLOBALS['summary'],$summ);
  
  }

  catch(\InvalidArgumentException $e) 
  {

    array_push( $GLOBALS['links'],'Na');
     array_push( $GLOBALS['summary'],'NA');
  }

}



          for($i=0 ;$i<count($GLOBALS['CountjobsIndeedQA']);$i++)
{
  try
  {
    // dd($crawler2->filter('span.location')->eq($i)->text());
     array_push( $GLOBALS['location'],$crawler6->filter('span.company')->eq($i)->text());
  }

  catch(\InvalidArgumentException $e) 
  {
     array_push( $GLOBALS['location'],'NA');
  }

}



          for($i=0 ;$i<count($GLOBALS['CountjobsIndeedQA']);$i++)
{
  try
  {
    // dd($crawler6->filter('span.company')->eq($i)->text());
     array_push( $GLOBALS['company'],$crawler6->filter('span.company')->eq($i)->text());
  }

  catch(\InvalidArgumentException $e) 
  {
     array_push( $GLOBALS['company'],'NA');
  }

}



               //dd( $GLOBALS['jobsIndeed']);

for ($i=0; $i <count( $GLOBALS['jobsIndeed']) ; $i++) { 
$jobIds = Job::where('name','=',$GLOBALS['jobsIndeed'][$i])->first();

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

if($GLOBALS['currency'][$i]!=NULL)
{
  $CurrencyIds = Currency::where('name','=',$GLOBALS['currency'][$i])->first();
if($CurrencyIds==null)
{
    $Currency = New Currency;
    $Currency->name =$GLOBALS['currency'][$i];
   
$Currency ->save();
}
}


$jobId = Job::where('name','=',$GLOBALS['jobsIndeed'][$i])->first();
$postJob=PostJob::where('job_id',$jobId->id)->first();
if($postJob==null)
{
$postJob= New PostJob;

    

$CurrencyId = Currency::where('name','=',$GLOBALS['currency'][$i])->first();
$LocationId = Country::where('name','=',$GLOBALS['location'][$i])->first();
$UserId = User::where('name','=',$GLOBALS['company'][$i])->first();
    $postJob->created_by=$UserId->id;
        $postJob->country_id=$LocationId->id;
        $postJob->job_for=$GLOBALS['job_for'][$i];
        $postJob->job_id=$jobId->id;
        $postJob->job_descripton=$GLOBALS['summary'][$i];
        if($GLOBALS['currency'][$i]==NULL)
        {
           $postJob->currency_id=NULL;
        }
else
{
  $postJob->currency_id=$CurrencyId->id;
}
if($GLOBALS['minsalary'][$i]==null)
{
$postJob->min_salary=NULL;
}
else
{
$postJob->min_salary=$GLOBALS['minsalary'][$i];
}


if($GLOBALS['maxsalary'][$i]==null)
{
$postJob->max_salary=NULL;
}
else
{
$postJob->max_salary=$GLOBALS['maxsalary'][$i];
}
      

        $postJob->link=$GLOBALS['links'][$i];
//dd( $postJob);
        $postJob->save();
      }
    
    // dd($GLOBALS['location'][$i]);
//$locationqury=Country::where('name',$GLOBALS['location'][$i])->get();

     // $location->name=$GLOBALS['location'][$i];
}

}

        if($type == 'I Am Employer' && $words!=null)
        {
            
            $cand_infos = CandidateInfo::search($words)->get();

            
            foreach ($cand_infos as  $can_info) {

                
     $Canresult=CandidateInfo::with('job')
      ->with('user')
      ->with('nationality')
      ->with('getCandidateSkill')
      ->with('country')
       ->where('candidate_infos.id', $can_info->id)
       ->orderByRaw("-candidate_infos.vedio_path",'DESC') 
       ->get();




foreach ($Canresult as $Canresul) {
 $candidates->push($Canresul);
}

    


}

// dd($Canresult);
$jobtitle= CandidateInfo::search($words)->with('job')->groupBy('job_id')->get();

    $candidates=$candidates->sortByDesc('vedio_path');

            $jobcheck=0;
$count=count($candidates);

 $data = array();

        //Get current page form url e.g. &page=6
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        //Create a new Laravel collection from the array data
        $collection = new Collection($candidates);

        //Define how many items we want to be visible in each page
        $per_page = 21;

        //Slice the collection to get the items to display in current page
        $currentPageResults = $collection->slice(($currentPage-1) * $per_page, $per_page)->all();

        //Create our paginator and add it to the data array
        $data['candidates'] = new LengthAwarePaginator($currentPageResults, count($collection), $per_page);

        //Set base url for pagination links to follow e.g custom/url?page=6
        $data['candidates']->setPath($request->url());

$candidates=$data['candidates'];


if($request->ajax())
{
  return Response::json(\View::make('Search.searchpartial',compact('words','candidates','jobcheck','count','jobtitle','jobtitleresult','Country','jobfor'), array('candidates' => $candidates))->render());
}


            return  view('Search.searchresult',compact('candidates','words','jobcheck','count','jobtitle','jobtitleresult','Country','jobfor'));
        }

           if($type == 'I Am Employer' && $words==null)
        {


            $cand_infos = CandidateInfo::search($words)->get();

            
            foreach ($cand_infos as  $can_info) {

                
   $Canresult=CandidateInfo::with('job')
      ->with('user')
      ->with('nationality')
      ->with('getCandidateSkill')
      ->with('country')
       ->where('candidate_infos.id', $can_info->id)
       

      
       ->get();


foreach ($Canresult as $Canresul) {
 $candidates->push($Canresul);

}


    
}

  

$jobtitle= CandidateInfo::search($words)->with('job')->groupBy('job_id')->get();


$candidates=$candidates->sortByDesc('vedio_path');

    
            $jobcheck=0;
$count=count($candidates);

 $data = array();

        //Get current page form url e.g. &page=6
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        //Create a new Laravel collection from the array data
        $collection = new Collection($candidates);

        //Define how many items we want to be visible in each page
        $per_page = 21;

        //Slice the collection to get the items to display in current page
        $currentPageResults = $collection->slice(($currentPage-1) * $per_page, $per_page)->all();

        //Create our paginator and add it to the data array
        $data['candidates'] = new LengthAwarePaginator($currentPageResults, count($collection), $per_page);

        //Set base url for pagination links to follow e.g custom/url?page=6
        $data['candidates']->setPath($request->url());

$candidates=$data['candidates'];


if($request->ajax())
{
  return Response::json(\View::make('Search.searchpartial',compact('words','candidates','jobcheck','count','jobtitle','jobtitleresult','Country','jobfor'), array('candidates' => $candidates))->render());
}

return  view('Search.searchresult',compact('candidates','words','jobcheck','count','jobtitle','jobtitleresult','Country','jobfor'));
        }


        if($type =="I am Candidate" && $words!=null)
        {
           $alljobs=PostJob::search($words)->orderBy('created_at','DESC')->paginate(21);

               $jobs=PostJob::search($words)->orderBy('created_at','DESC')->paginate(21);
               $countjobs=PostJob::search($words)->orderBy('created_at','DESC')->get();

              
        $jobtitle=PostJob::search($words)->with('job')->groupBy('job_id')->get();
$jobcheck=1;
    
$count=count($countjobs);

       
if($request->ajax())
{
  return Response::json(\View::make('Search.searchpartial',compact('countjobs','words','jobs','jobcheck','count','jobtitle','jobtitleresult','Country','jobfor'), array('jobs' => $jobs))->render());
}
    
   
//dd("dcgcu");
   
    
            return  view('Search.searchresult', compact('countjobs','words','jobs','jobcheck','count','jobtitle','jobtitleresult','Country','jobfor'), array('jobs' => $jobs));
        }

               if($type =="I am Candidate" && $words==null)

        {
          
        $alljobs=PostJob::search($words)->orderBy('created_at','DESC')->paginate(21);

               $jobs=PostJob::search($words)->orderBy('created_at','DESC')->paginate(21);
               $countjobs=PostJob::search($words)->orderBy('created_at' ,'DESC')->get();

              
        $jobtitle=PostJob::search($words)->with('job')->groupBy('job_id')->get();
$jobcheck=1;
    
$count=count($countjobs);

       
if($request->ajax())
{
  return Response::json(\View::make('Search.searchpartial',compact('countjobs','words','jobs','jobcheck','count','jobtitle','jobtitleresult','Country','jobfor'), array('jobs' => $jobs))->render());
}
    
   
//dd("dcgcu");
   
    
            return  view('Search.searchresult', compact('countjobs','words','jobs','jobcheck','count','jobtitle','jobtitleresult','Country','jobfor'), array('jobs' => $jobs));
        }
        
        {
          
            $result=collect();
         
            $count=count($result);
                return  view('Search.searchresult',compact('countjobs','alljobs','result','words','count','jobtitle','jobtitleresult','Country','jobfor') );

        }
    
}
catch(Exception $e) 
        {
         return redirect('/');
         } 
   
}



    public function filtersearch (Request $request)
    {


        $words=$request->words;

        $jobtitle=Job::where('name', 'LIKE', '%'.$words.'%')->get();
        
$jobfor=PostJob::select('job_for')->orderByRaw('FIELD(job_for, "Family", "Company", "Agency","Jobs In KSA","Jobs In Oman","Jobs In Qatar","Jobs In UAE","Maidcv.Com","Jobs In USA")','DESC')
 ->distinct('job_for')->get();


        $Jobtitles=json_decode($request->Jobtitle);

        $country=$request->country;
        $currency=$request->currency;
        $job= PostJob::search($words)->get();

        $jobcheck=$request->jobcheck;
        $jobs=[];
        $candidates=collect();
        $salaryf=[];
        $experincef=[];
        $jobsresult=[];
        $candidate=CandidateInfo::search($words)->get();

  $employertype=json_decode($request->employertype);
$experince=json_decode($request->experince);
  $salary=json_decode($request->salary);
  $fromsalary=$request->fromsalary;
  $tosalary=$request->tosalary;

  $fromexperince=$request->fromsexperince;
  $toexperince=$request->toexperince;

  $nationality=$request->nationality;
        $skills=$request->skills;

         
if($salary != [])
{
  
  if($salary[0]!="all" && $salary !=[])
  {
    for($i=0;$i<count($salary);$i++)
    {
      if ($salary[$i]=="on")
      {
        array_push($salaryf, $fromsalary, $tosalary);
      }
      else
      {
        $splitSalary = explode('-', $salary[$i], 2);

   array_push($salaryf, $splitSalary[0],$splitSalary[1]);
      }
      
    }
  }


}
  $salaryf =array_unique($salaryf);
// dd($salary);
if($experince != [])
{
  
  if($experince[0]!="all" && $experince !=[])
  {
    for($i=0;$i<count($experince);$i++)
    {
      if ($experince[$i]=="on")
      {
        array_push($experincef, $fromexperince, $toexperince);
      }
      else
      {
        $splitexperince = explode('-', $experince[$i], 2);

   array_push($experincef, $splitexperince[0],$splitexperince[1]);
      }
      
    }
  }


}


  $experincef =array_unique($experincef);

         if($jobcheck==1)
         {
          // checkempolyer
//jobtitles

 //country
 //jobfor
 //currency
 //experince
 //salary 
  
 if( $words != null) 
 {  
  $resultQuery= PostJob::search($words)->orderBy('created_at','DESC')->get(); 
 }  
if( $words == 'undefined') 
 
 {

   $resultQuery= PostJob::orderBy('created_at','DESC')->get();
 }
 



////////////jobtitles with all//////////


if($Jobtitles !=[] && $Jobtitles[0] =="all" && $employertype==[] && $salary ==[]   && $country  =="0" && $experince ==[])
{







  foreach ($resultQuery as $resultQue) {

    
      $jobts= PostJob::where('id',$resultQue->id)
      ->orderBy('created_at','DESC')
             ->get();


  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 





}




}
///endjobtitleonly



//jobtitles and empolyertype


if($Jobtitles !=[] && $Jobtitles[0] =="all" && $employertype !=[] && $salary ==[]   && $country  =="0" && $experince ==[])
{





  foreach ($resultQuery as $resultQue) {

    
      for ($emp=0;$emp<count($employertype);$emp++) {
      $jobts= PostJob::where('id',$resultQue->id)
                      ->where('job_for',$employertype[$emp])
                      ->orderBy('created_at','DESC')
                      ->get();
  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 




}

}

}
if($Jobtitles !=[] && $Jobtitles[0] =="all" && $employertype !=[] && $salary !=[]   && $country  =="0" && $experince ==[])
{





  foreach ($resultQuery as $resultQue) {

    
      for ($emp=0;$emp<count($employertype);$emp++) {
      

      $jobts= PostJob::where('id',$resultQue->id)
          
            ->where('job_for',$employertype[$emp])
            ->whereBetween('max_salary',array(reset($salaryf),last($salaryf))) 
            //->orWhereBetween('min_salary',array(reset($salaryf),last($salaryf)))
            ->where('currency_id',$currency)
            ->orderBy('created_at','DESC')
            ->get();
  // dd($jobts);

  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 





}
}

}



if($Jobtitles !=[] && $Jobtitles[0] =="all" && $employertype !=[] && $salary !=[]   && $country  !="0" && $experince ==[])
{





  foreach ($resultQuery as $resultQue) {

    
      for ($emp=0;$emp<count($employertype);$emp++) {
      
//dd(reset($salaryf),last($salaryf));
      $jobts= PostJob::where('id',$resultQue->id)
            ->where('job_for',$employertype[$emp])
            ->where('country_id',$country)
            ->whereBetween('max_salary',array(reset($salaryf),last($salaryf))) 
            //->orWhereBetween('min_salary',array(reset($salaryf),last($salaryf)))
            ->where('currency_id',$currency)
            ->orderBy('created_at','DESC')
            
            ->get();
  // dd($jobts);

  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 





}
}

}
///experince not null

if($Jobtitles !=[] && $Jobtitles[0] =="all" && $employertype !=[] && $salary !=[]   && $country  !="0" && $experince !=[])
{





  foreach ($resultQuery as $resultQue) {

   
      for ($emp=0;$emp<count($employertype);$emp++) {
      
// dd(reset($experincef),last($experincef));
      $jobts= PostJob::where('id',$resultQue->id)
            ->where('job_for',$employertype[$emp]) 
            ->where('country_id',$country)
            ->whereBetween('max_salary',array(reset($salaryf),last($salaryf))) 
            //->orWhereBetween('min_salary',array(reset($salaryf),last($salaryf)))
            ->where('currency_id',$currency)
            ->whereBetween('experience',array(reset($experincef),last($experincef))) 
            ->orderBy('created_at','DESC')
            ->get();
  // dd($jobts);

  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 






}
}

}


if($Jobtitles !=[] && $Jobtitles[0] =="all" && $employertype ==[] && $salary ==[]   && $country  !="0" && $experince ==[])
{





  foreach ($resultQuery as $resultQue) {

   
      
      
// dd(reset($experincef),last($experincef));
      $jobts= PostJob::where('id',$resultQue->id)
           
            ->where('country_id',$country)
          ->orderBy('created_at','DESC')
            ->get();
  // dd($jobts);

  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 







}

}

if($Jobtitles !=[] && $Jobtitles[0] =="all" && $employertype !=[] && $salary ==[]   && $country  !="0" && $experince ==[])
{





  foreach ($resultQuery as $resultQue) {

   
      for ($emp=0;$emp<count($employertype);$emp++) {
      
// dd(reset($experincef),last($experincef));
      $jobts= PostJob::where('id',$resultQue->id)
            ->where('job_for',$employertype[$emp]) 
            ->where('country_id',$country)
        ->orderBy('created_at','DESC')
           
            ->get();
  // dd($jobts);

  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 






}
}

}

 /////////////////////////jobtitles without all///////////////////
if($Jobtitles !=[] && $Jobtitles[0] !="all" && $employertype==[] && $salary ==[]   && $country  =="0" && $experince ==[])
{







  foreach ($resultQuery as $resultQue) {

    for ($i=0;$i<count($Jobtitles);$i++) {
      $jobts= PostJob::where('id',$resultQue->id)->where('job_id',$Jobtitles[$i])
            
            ->orderBy('created_at','DESC') 
            ->get();


  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 




}
}




}
///endjobtitleonly



//jobtitles and empolyertype


if($Jobtitles !=[] && $Jobtitles[0] !="all" && $employertype !=[] && $salary ==[]   && $country  =="0" && $experince ==[])
{





  foreach ($resultQuery as $resultQue) {

    for ($i=0;$i<count($Jobtitles);$i++) {
      for ($emp=0;$emp<count($employertype);$emp++) {
      $jobts= PostJob::where('id',$resultQue->id)
            ->where('job_id',$Jobtitles[$i])->where('job_for',$employertype[$emp])
            ->orderBy('created_at','DESC')
             ->get();


  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 




}
}
}

}
if($Jobtitles !=[] && $Jobtitles[0] !="all" && $employertype !=[] && $salary !=[]   && $country  =="0" && $experince ==[])
{





  foreach ($resultQuery as $resultQue) {

    for ($i=0;$i<count($Jobtitles);$i++) {
      for ($emp=0;$emp<count($employertype);$emp++) {
      
//dd(reset($salaryf),last($salaryf));
      $jobts= PostJob::where('id',$resultQue->id)
            ->where('job_id',$Jobtitles[$i])
            ->where('job_for',$employertype[$emp])
            ->whereBetween('max_salary',array(reset($salaryf),last($salaryf))) 
            //->orWhereBetween('min_salary',array(reset($salaryf),last($salaryf)))
            ->where('currency_id',$currency)
            ->orderBy('created_at','DESC')
            ->get();
  // dd($jobts);

  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 





}
}
}

}



if($Jobtitles !=[] && $Jobtitles[0] !="all" && $employertype !=[] && $salary !=[]   && $country  !="0" && $experince ==[])
{





  foreach ($resultQuery as $resultQue) {

    for ($i=0;$i<count($Jobtitles);$i++) {
      for ($emp=0;$emp<count($employertype);$emp++) {
      
//dd(reset($salaryf),last($salaryf));
      $jobts= PostJob::where('id',$resultQue->id)
            ->where('job_id',$Jobtitles[$i])
            ->where('job_for',$employertype[$emp])
            ->where('country_id',$country)
            ->whereBetween('max_salary',array(reset($salaryf),last($salaryf))) 
            //->orWhereBetween('min_salary',array(reset($salaryf),last($salaryf)))
            ->where('currency_id',$currency)
            ->orderBy('created_at','DESC')
            ->get();
  // dd($jobts);

  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 





}
}
}

}
///experince not null

if($Jobtitles !=[] && $Jobtitles[0] !="all" && $employertype !=[] && $salary !=[]   && $country  !="0" && $experince !=[])
{





  foreach ($resultQuery as $resultQue) {

    for ($i=0;$i<count($Jobtitles);$i++) {
      for ($emp=0;$emp<count($employertype);$emp++) {
      
// dd(reset($experincef),last($experincef));
      $jobts= PostJob::where('id',$resultQue->id)
            ->where('job_id',$Jobtitles[$i])
            ->where('job_for',$employertype[$emp]) 
            ->where('country_id',$country)
            ->whereBetween('max_salary',array(reset($salaryf),last($salaryf))) 
            //->orWhereBetween('min_salary',array(reset($salaryf),last($salaryf)))
            ->where('currency_id',$currency)
            ->whereBetween('experience',array(reset($experincef),last($experincef))) 
            ->orderBy('created_at','DESC')
            ->get();
  // dd($jobts);

  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 





}
}
}

}



/////////////////////////endjobtitleswithoptions








///empolyertype with options
////////////////////employertypewithall//////////////////


if($Jobtitles ==[] && $employertype !=[] && $employertype[0] =="all" && $salary !=[]   && $country  !="0" && $experince !=[])
{

// dd('l');



  foreach ($resultQuery as $resultQue) {

    
     
      
// dd(reset($experincef),last($experincef));
      $jobts= PostJob::where('id',$resultQue->id)
            
           
             ->where('country_id',$country)
            ->whereBetween('max_salary',array(reset($salaryf),last($salaryf))) 
            //->orWhereBetween('min_salary',array(reset($salaryf),last($salaryf)))
            ->where('currency_id',$currency)
            ->whereBetween('experience',array(reset($experincef),last($experincef))) 
            ->orderBy('created_at','DESC')
            ->get();
  // dd($jobts);

  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 







}

}

if($Jobtitles ==[] && $employertype !=[] && $employertype[0] =="all" && $salary ==[]   && $country  !="0" && $experince !=[])
{

// dd('l');



  foreach ($resultQuery as $resultQue) {

    

      
// dd(reset($experincef),last($experincef));
      $jobts= PostJob::where('id',$resultQue->id)
           
            
             ->where('country_id',$country)
            ->whereBetween('experience',array(reset($experincef),last($experincef))) 
            ->orderBy('created_at','DESC')
            ->get();
  // dd($jobts);

  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 






}

}


if($Jobtitles ==[] && $employertype !=[] && $employertype[0] =="all" && $salary ==[]   && $country  =="0" && $experince !=[])
{

// dd('l');



  foreach ($resultQuery as $resultQue) {

   
     
      
// dd(reset($experincef),last($experincef));
      $jobts= PostJob::where('id',$resultQue->id)
           
            ->where('job_for',$employertype[$emp])
             ->whereBetween('experience',array(reset($experincef),last($experincef))) 
            ->orderBy('created_at','DESC')
            ->get();
  // dd($jobts);

  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 






}


}


if($Jobtitles ==[] && $employertype !=[] && $employertype[0] =="all" && $salary ==[]   && $country  =="0" && $experince ==[])
{

// dd('l');



  foreach ($resultQuery as $resultQue) {

   
     
      
// dd(reset($experincef),last($experincef));
      $jobts= PostJob::where('id',$resultQue->id)
            ->orderBy('created_at','DESC')
           
            
            
            ->get();
  // dd($jobts);

  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 







}

}

if($Jobtitles !=[] && $Jobtitles[0] =="all" && $employertype !=[] && $employertype[0] =="all" && $salary ==[]   && $country  =="0" && $experince ==[])
{

// dd('l');



  foreach ($resultQuery as $resultQue) {
 
   
     
      
// dd(reset($experincef),last($experincef));
      $jobts= PostJob::where('id',$resultQue->id)
            
              ->orderBy('created_at','DESC')
              ->get();
  // dd($jobts);

  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  
 

}





}

}


if($Jobtitles !=[] && $Jobtitles[0] !="all" && $employertype !=[] && $employertype[0] =="all" && $salary ==[]   && $country  =="0" && $experince ==[])
{

// dd('l');



  foreach ($resultQuery as $resultQue) {
 
   for ($i=0;$i<count($Jobtitles);$i++) {
     
      
// dd(reset($experincef),last($experincef));
      $jobts= PostJob::where('id',$resultQue->id)
            ->where('job_id',$Jobtitles[$i])
              ->orderBy('created_at','DESC')
              ->get();
  // dd($jobts);

  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  
 

}

}



}

}

//////emmployertypewithoutalll/////////////////

if($Jobtitles ==[] && $employertype !=[] && $employertype[0] !="all" && $salary !=[]   && $country  !="0" && $experince !=[])
{

 



  foreach ($resultQuery as $resultQue) {

    
      for ($emp=0;$emp<count($employertype);$emp++) {
      
// dd(reset($experincef),last($experincef));
      $jobts= PostJob::where('id',$resultQue->id)
            
            ->where('job_for',$employertype[$emp])
             ->where('country_id',$country)
            ->whereBetween('max_salary',array(reset($salaryf),last($salaryf))) 
            //->orWhereBetween('min_salary',array(reset($salaryf),last($salaryf)))
            ->where('currency_id',$currency)
            ->whereBetween('experience',array(reset($experincef),last($experincef))) 
            ->orderBy('created_at','DESC')
            ->get();
  // dd($jobts);

  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 





}

}

}

if($Jobtitles ==[] && $employertype !=[] && $employertype[0] !="all" && $salary ==[]   && $country  !="0" && $experince !=[])
{

// dd('l');



  foreach ($resultQuery as $resultQue) {

    
      for ($emp=0;$emp<count($employertype);$emp++) {
      
// dd(reset($experincef),last($experincef));
      $jobts= PostJob::where('id',$resultQue->id)
           
            ->where('job_for',$employertype[$emp])
             ->where('country_id',$country)
            ->whereBetween('experience',array(reset($experincef),last($experincef))) 
            ->orderBy('created_at','DESC')
            ->get();
  // dd($jobts);

  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 





}

}

}


if($Jobtitles ==[] && $employertype !=[] && $employertype[0] !="all" && $salary ==[]   && $country  =="0" && $experince !=[])
{

// dd('l');



  foreach ($resultQuery as $resultQue) {

   
      for ($emp=0;$emp<count($employertype);$emp++) {
      
// dd(reset($experincef),last($experincef));
      $jobts= PostJob::where('id',$resultQue->id)
           
            ->where('job_for',$employertype[$emp])
             ->whereBetween('experience',array(reset($experincef),last($experincef))) 
            ->orderBy('created_at','DESC')
            ->get();
  // dd($jobts);

  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 





}
}


}


if($Jobtitles ==[] && $employertype !=[] && $employertype[0] !="all" && $salary ==[]   && $country  =="0" && $experince ==[])
{





  foreach ($resultQuery as $resultQue) {

   
      for ($emp=0;$emp<count($employertype);$emp++) {
      
// dd(reset($experincef),last($experincef));
      $jobts= PostJob::where('id',$resultQue->id)
            
            ->where('job_for',$employertype[$emp])
            ->orderBy('created_at','DESC')
            
            ->get();
  // dd($jobts);

  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 





}

}

}

/////////////////endemployertypfliter/////////////////
/////////////////countrywithoption////////////////
if($Jobtitles ==[] && $employertype==[] && $salary ==[]   && $country  !="0" && $experince ==[])
{
// dd('l');

  foreach ($resultQuery as $resultQue) {

    
      $jobts= PostJob::where('id',$resultQue->id)->where('country_id',$country)
      ->orderBy('created_at','DESC')
             ->get();


  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 





}




}
if($Jobtitles !=[] && $employertype ==[] && $salary ==[]   && $country  !="0" && $experince ==[])
{





  foreach ($resultQuery as $resultQue) {

    for ($i=0;$i<count($Jobtitles);$i++) {
      
      $jobts= PostJob::where('id',$resultQue->id)
      ->where('job_id',$Jobtitles[$i])
      ->where('country_id',$country)
      ->orderBy('created_at','DESC')
             ->get();


  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 





}
}

}

if($Jobtitles !=[] && $employertype !=[] && $salary ==[]   && $country  !="0" && $experince ==[])
{





  foreach ($resultQuery as $resultQue) {

    for ($i=0;$i<count($Jobtitles);$i++) {
       for ($emp=0;$emp<count($employertype);$emp++) {
      $jobts= PostJob::where('id',$resultQue->id)
      ->where('job_id',$Jobtitles[$i]) 
      ->where('job_for',$employertype[$emp])
      ->where('country_id',$country)
      ->orderBy('created_at','DESC')
             ->get();


  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 

}



}
}

}

if($Jobtitles !=[] && $employertype !=[] && $salary !=[]   && $country  !="0" && $experince ==[])
{





  foreach ($resultQuery as $resultQue) {

    for ($i=0;$i<count($Jobtitles);$i++) {
       for ($emp=0;$emp<count($employertype);$emp++) {
      $jobts= PostJob::where('id',$resultQue->id)
      ->where('job_id',$Jobtitles[$i]) 
      ->where('job_for',$employertype[$emp])
      ->where('country_id',$country)
      ->whereBetween('max_salary',array(reset($salaryf),last($salaryf))) 
            //->orWhereBetween('min_salary',array(reset($salaryf),last($salaryf)))
            ->where('currency_id',$currency)
            ->orderBy('created_at','DESC')
             ->get();


  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 

}



}
}

}


if($Jobtitles !=[] && $employertype !=[] && $salary ==[]   && $country  !="0" && $experince !=[])
{





  foreach ($resultQuery as $resultQue) {

    for ($i=0;$i<count($Jobtitles);$i++) {
       for ($emp=0;$emp<count($employertype);$emp++) {
      $jobts= PostJob::where('id',$resultQue->id)
      ->where('job_id',$Jobtitles[$i]) 
      ->where('job_for',$employertype[$emp])
      ->where('country_id',$country)
       ->whereBetween('experience',array(reset($experincef),last($experincef)))
       ->orderBy('created_at','DESC') 
      
             ->get();


  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 

}



}
}

}


if($Jobtitles ==[] && $employertype !=[] && $salary ==[]   && $country  !="0" && $experince ==[])
{





  foreach ($resultQuery as $resultQue) {

    
       for ($emp=0;$emp<count($employertype);$emp++) {
      $jobts= PostJob::where('id',$resultQue->id)
  
      ->where('job_for',$employertype[$emp])
      ->where('country_id',$country)
       
      ->orderBy('created_at','DESC')
             ->get();


  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 

}




}

}

/////////////////////end country with option/////////////

///////////experince with option////////////
////////////////////////experince with all/////////////////

if($Jobtitles ==[] && $employertype==[] && $salary ==[]   && $country  =="0" && $experince !=[] &&  $experince[0] =="all")
{
// dd('l');

  foreach ($resultQuery as $resultQue) {

    
      $jobts= PostJob::where('id',$resultQue->id) 
      ->whereBetween('experience',array(reset($experincef),last($experincef))) 
      ->orderBy('created_at','DESC')
             ->get();


  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 





}




}

if($Jobtitles !=[] && $employertype ==[] && $salary ==[]   && $country  =="0" && $experince !=[] &&  $experince[0] =="all")
{





  foreach ($resultQuery as $resultQue) {

    for ($i=0;$i<count($Jobtitles);$i++) {
      
      $jobts= PostJob::where('id',$resultQue->id)
      ->where('job_id',$Jobtitles[$i])
      ->whereBetween('experience',array(reset($experincef),last($experincef))) 
      ->orderBy('created_at','DESC')
      
             ->get();


  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 





}
}

}


if($Jobtitles !=[] && $employertype !=[] && $salary ==[]   && $country  =="0" && $experince !=[] &&  $experince[0] =="all")
{





  foreach ($resultQuery as $resultQue) {

    for ($i=0;$i<count($Jobtitles);$i++) {
       for ($emp=0;$emp<count($employertype);$emp++) {
      $jobts= PostJob::where('id',$resultQue->id)
      ->where('job_id',$Jobtitles[$i]) 
      ->where('job_for',$employertype[$emp])
      ->whereBetween('experience',array(reset($experincef),last($experincef))) 
      ->orderBy('created_at','DESC')
             ->get();


  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 

}



}
}

}

if($Jobtitles !=[] && $employertype !=[] && $salary !=[]   && $country  =="0" && $experince !=[] &&  $experince[0] =="all")
{





  foreach ($resultQuery as $resultQue) {

    for ($i=0;$i<count($Jobtitles);$i++) {
       for ($emp=0;$emp<count($employertype);$emp++) {
      $jobts= PostJob::where('id',$resultQue->id)
      ->where('job_id',$Jobtitles[$i]) 
      ->where('job_for',$employertype[$emp])
      ->where('country_id',$country)
      ->whereBetween('max_salary',array(reset($salaryf),last($salaryf))) 
            //->orWhereBetween('min_salary',array(reset($salaryf),last($salaryf)))
            ->where('currency_id',$currency)
            ->whereBetween('experience',array(reset($experincef),last($experincef))) 
            ->orderBy('created_at','DESC')
             ->get();


  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 

}



}
}

}

if($Jobtitles ==[] && $employertype ==[] && $salary ==[]   && $country  !="0" && $experince !=[] &&  $experince[0] =="all")
{





  foreach ($resultQuery as $resultQue) {

    
       
      $jobts= PostJob::where('id',$resultQue->id)
  ->whereBetween('experience',array(reset($experincef),last($experincef))) 
      
      ->where('country_id',$country)
       ->orderBy('created_at','DESC')
      
             ->get();


  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 






}

}



////////////////////////experince without all/////////////////
if($Jobtitles ==[] && $employertype==[] && $salary ==[]   && $country  =="0" && $experince !=[] &&  $experince[0] !="all")
{
// dd('l');

  foreach ($resultQuery as $resultQue) {

    
      $jobts= PostJob::where('id',$resultQue->id) 
      ->whereBetween('experience',array(reset($experincef),last($experincef))) 
             
             ->orderBy('created_at','DESC')
             ->get();


  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 





}




}

if($Jobtitles !=[] && $employertype ==[] && $salary ==[]   && $country  =="0" && $experince !=[] &&  $experince[0] !="all")
{





  foreach ($resultQuery as $resultQue) {

    for ($i=0;$i<count($Jobtitles);$i++) {
      
      $jobts= PostJob::where('id',$resultQue->id)
      ->where('job_id',$Jobtitles[$i])
      ->whereBetween('experience',array(reset($experincef),last($experincef))) 
      
            ->orderBy('created_at','DESC')
             ->get();


  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 





}
}

}


if($Jobtitles !=[] && $employertype !=[] && $salary ==[]   && $country  =="0" && $experince !=[] &&  $experince[0] !="all")
{





  foreach ($resultQuery as $resultQue) {

    for ($i=0;$i<count($Jobtitles);$i++) {
       for ($emp=0;$emp<count($employertype);$emp++) {
      $jobts= PostJob::where('id',$resultQue->id)
      ->where('job_id',$Jobtitles[$i]) 
      ->where('job_for',$employertype[$emp])
      ->whereBetween('experience',array(reset($experincef),last($experincef))) 
            ->orderBy('created_at','DESC')
             ->get();


  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 

}



}
}

}

if($Jobtitles !=[] && $employertype !=[] && $salary !=[]   && $country  =="0" && $experince !=[] &&  $experince[0] !="all")
{





  foreach ($resultQuery as $resultQue) {

    for ($i=0;$i<count($Jobtitles);$i++) {
       for ($emp=0;$emp<count($employertype);$emp++) {
      $jobts= PostJob::where('id',$resultQue->id)
      ->where('job_id',$Jobtitles[$i]) 
      ->where('job_for',$employertype[$emp])
      ->where('country_id',$country)
      ->whereBetween('max_salary',array(reset($salaryf),last($salaryf))) 
            //->orWhereBetween('min_salary',array(reset($salaryf),last($salaryf)))
            ->where('currency_id',$currency)
            ->whereBetween('experience',array(reset($experincef),last($experincef)))
            ->orderBy('created_at','DESC')
                  ->get();


  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 

}



}
}

}

if($Jobtitles ==[] && $employertype ==[] && $salary ==[]   && $country  !="0" && $experince !=[] &&  $experince[0] !="all")
{





  foreach ($resultQuery as $resultQue) {

    
       
      $jobts= PostJob::where('id',$resultQue->id)
  ->whereBetween('experience',array(reset($experincef),last($experincef))) 
      
      ->where('country_id',$country)
       
      ->orderBy('created_at','DESC')
             ->get();


  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 






}

}
/////////////////////////salary flliters//////////////////



///////////////salary with all/////////////
if($Jobtitles ==[] && $employertype==[] && $salary !=[] &&  $salary[0] =="all"   && $country  =="0" && $experince ==[])
{



  foreach ($resultQuery as $resultQue) {

    
      $jobts= PostJob::where('id',$resultQue->id) 
      ->whereBetween('max_salary',array(reset($salaryf),last($salaryf))) 
            //->orWhereBetween('min_salary',array(reset($salaryf),last($salaryf)))
            ->where('currency_id',$currency)
            ->orderBy('created_at','DESC')
             ->get();


  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 





}




}

if($Jobtitles !=[] && $employertype ==[] && $salary !=[] &&  $salary[0] =="all"   && $country  =="0" && $experince ==[])
{





  foreach ($resultQuery as $resultQue) {

    for ($i=0;$i<count($Jobtitles);$i++) {
      
      $jobts= PostJob::where('id',$resultQue->id)
      ->where('job_id',$Jobtitles[$i])
      ->whereBetween('max_salary',array(reset($salaryf),last($salaryf))) 
            //->orWhereBetween('min_salary',array(reset($salaryf),last($salaryf)))
            ->where('currency_id',$currency)
      ->orderBy('created_at','DESC')
             ->get();


  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 





}
}

}


if($Jobtitles ==[] && $employertype !=[] && $salary !=[] &&  $salary[0] =="all"   && $country  =="0" && $experince !=[])
{





  foreach ($resultQuery as $resultQue) {

    
             for ($emp=0;$emp<count($employertype);$emp++) {

      $jobts= PostJob::where('id',$resultQue->id)
     
      ->where('job_for',$employertype[$emp])
      ->whereBetween('max_salary',array(reset($salaryf),last($salaryf))) 
            //->orWhereBetween('min_salary',array(reset($salaryf),last($salaryf)))
            ->where('currency_id',$currency)
            ->orderBy('created_at','DESC')
      
             ->get();


  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 





}
}

}

if($Jobtitles ==[] && $employertype !=[] && $salary !=[] &&  $salary[0] =="all"  && $country  =="0" && $experince ==[])
{





  foreach ($resultQuery as $resultQue) {

  
       for ($emp=0;$emp<count($employertype);$emp++) {
      $jobts= PostJob::where('id',$resultQue->id)
     
      ->where('job_for',$employertype[$emp])
     ->whereBetween('max_salary',array(reset($salaryf),last($salaryf))) 
            //->orWhereBetween('min_salary',array(reset($salaryf),last($salaryf)))
            ->where('currency_id',$currency)
            ->orderBy('created_at','DESC')
             ->get();


  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 

}




}

}


if($Jobtitles !=[] && $employertype !=[] && $salary !=[] &&  $salary[0] =="all"   && $country  !="0" && $experince ==[])
{





  foreach ($resultQuery as $resultQue) {

    for ($i=0;$i<count($Jobtitles);$i++) {
       for ($emp=0;$emp<count($employertype);$emp++) {
      $jobts= PostJob::where('id',$resultQue->id)
      ->where('job_id',$Jobtitles[$i]) 
      ->where('job_for',$employertype[$emp])
      ->where('country_id',$country)
      ->whereBetween('max_salary',array(reset($salaryf),last($salaryf))) 
            //->orWhereBetween('min_salary',array(reset($salaryf),last($salaryf)))
            ->where('currency_id',$currency)
            ->orderBy('created_at','DESC')
             ->get();


  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 

}



}
}

}


if($Jobtitles ==[] && $employertype ==[] && $salary !=[] &&  $salary[0] =="all"   && $country  !="0" && $experince ==[])
{





  foreach ($resultQuery as $resultQue) {

    
       
      $jobts= PostJob::where('id',$resultQue->id)
   ->whereBetween('max_salary',array(reset($salaryf),last($salaryf))) 
            //->orWhereBetween('min_salary',array(reset($salaryf),last($salaryf)))
            ->where('currency_id',$currency)
      
      ->where('country_id',$country)
       
      ->orderBy('created_at','DESC')
             ->get();


  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 






}

}

if($Jobtitles ==[] && $employertype ==[] && $salary !=[] &&  $salary[0] =="all"   && $country  !="0" && $experince !=[])
{





  foreach ($resultQuery as $resultQue) {

    
       
      $jobts= PostJob::where('id',$resultQue->id)
              ->whereBetween('max_salary',array(reset($salaryf),last($salaryf))) 
              //->orWhereBetween('min_salary',array(reset($salaryf),last($salaryf)))
              ->where('currency_id',$currency)
              ->whereBetween('experience',array(reset($experincef),last($experincef))) 

              ->where('country_id',$country)
       
             ->orderBy('created_at','DESC')
             ->get();


  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 






}

}

if($Jobtitles !=[] && $employertype !=[] && $salary !=[] &&  $salary[0] =="all"   && $country  =="0" && $experince !=[])
{





  foreach ($resultQuery as $resultQue) {

    for ($i=0;$i<count($Jobtitles);$i++) {
      for ($emp=0;$emp<count($employertype);$emp++) {
      

            $jobts= PostJob::where('id',$resultQue->id)
            ->where('job_id',$Jobtitles[$i])
            ->where('job_for',$employertype[$emp])


            ->whereBetween('max_salary',array(reset($salaryf),last($salaryf))) 
            //->orWhereBetween('min_salary',array(reset($salaryf),last($salaryf)))
            ->where('currency_id',$currency)
            ->orderBy('created_at','DESC')
            ->get();


  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 





}
}
}

}

/////////////////////////////salary withoutall///////////
if($Jobtitles ==[] && $employertype==[] && $salary !=[]  && $salary[0] !="all"  && $country  =="0" && $experince ==[])
{



  foreach ($resultQuery as $resultQue) {

    
      $jobts= PostJob::where('id',$resultQue->id) 
      ->whereBetween('max_salary',array(reset($salaryf),last($salaryf))) 
            //->orWhereBetween('min_salary',array(reset($salaryf),last($salaryf)))
            ->where('currency_id',$currency)
            ->orderBy('created_at','DESC')
             ->get();


  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 





}




}

if($Jobtitles !=[] && $employertype ==[] && $salary !=[]  && $salary[0] !="all"   && $country  =="0" && $experince ==[])
{





  foreach ($resultQuery as $resultQue) {

    for ($i=0;$i<count($Jobtitles);$i++) {
      
      $jobts= PostJob::where('id',$resultQue->id)
      ->where('job_id',$Jobtitles[$i])
      ->whereBetween('max_salary',array(reset($salaryf),last($salaryf))) 
            //->orWhereBetween('min_salary',array(reset($salaryf),last($salaryf)))
            ->where('currency_id',$currency)
      ->orderBy('created_at','DESC')
             ->get();


  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 





}
}

}


if($Jobtitles ==[] && $employertype !=[] && $salary !=[]  && $salary[0] !="all"  && $country  =="0" && $experince !=[])
{





  foreach ($resultQuery as $resultQue) {

    
             for ($emp=0;$emp<count($employertype);$emp++) {

      $jobts= PostJob::where('id',$resultQue->id)
     
      ->where('job_for',$employertype[$emp])
      ->whereBetween('max_salary',array(reset($salaryf),last($salaryf))) 
            //->orWhereBetween('min_salary',array(reset($salaryf),last($salaryf)))
            ->where('currency_id',$currency)
      ->orderBy('created_at','DESC')
             ->get();


  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 





}
}

}

if($Jobtitles ==[] && $employertype !=[] && $salary !=[]  && $salary[0] !="all"   && $country  =="0" && $experince ==[])
{





  foreach ($resultQuery as $resultQue) {

  
       for ($emp=0;$emp<count($employertype);$emp++) {
      $jobts= PostJob::where('id',$resultQue->id)
     
      ->where('job_for',$employertype[$emp])
     ->whereBetween('max_salary',array(reset($salaryf),last($salaryf))) 
            //->orWhereBetween('min_salary',array(reset($salaryf),last($salaryf)))
            ->where('currency_id',$currency)
            ->orderBy('created_at','DESC')
             ->get();


  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 

}




}

}


if($Jobtitles !=[] && $employertype !=[] && $salary !=[]  && $salary[0] !="all"   && $country  !="0" && $experince ==[])
{





  foreach ($resultQuery as $resultQue) {

    for ($i=0;$i<count($Jobtitles);$i++) {
       for ($emp=0;$emp<count($employertype);$emp++) {
      $jobts= PostJob::where('id',$resultQue->id)
      ->where('job_id',$Jobtitles[$i]) 
      ->where('job_for',$employertype[$emp])
      ->where('country_id',$country)
      ->whereBetween('max_salary',array(reset($salaryf),last($salaryf))) 
            //->orWhereBetween('min_salary',array(reset($salaryf),last($salaryf)))
            ->where('currency_id',$currency)
            ->orderBy('created_at','DESC')
             ->get();


  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 

}



}
}

}


if($Jobtitles ==[] && $employertype ==[] && $salary !=[]  && $salary[0] !="all"  && $country  !="0" && $experince ==[])
{





  foreach ($resultQuery as $resultQue) {

    
       
      $jobts= PostJob::where('id',$resultQue->id)
   ->whereBetween('max_salary',array(reset($salaryf),last($salaryf))) 
            //->orWhereBetween('min_salary',array(reset($salaryf),last($salaryf)))
            ->where('currency_id',$currency)
      
      ->where('country_id',$country)
       ->orderBy('created_at','DESC')
      
             ->get();


  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 






}

}

if($Jobtitles ==[] && $employertype ==[] && $salary !=[]  && $salary[0] !="all"   && $country  !="0" && $experince !=[])
{





  foreach ($resultQuery as $resultQue) {

    
       
      $jobts= PostJob::where('id',$resultQue->id)
              ->whereBetween('max_salary',array(reset($salaryf),last($salaryf))) 
              //->orWhereBetween('min_salary',array(reset($salaryf),last($salaryf)))
              ->where('currency_id',$currency)
              ->whereBetween('experience',array(reset($experincef),last($experincef))) 

              ->where('country_id',$country)
       ->orderBy('created_at','DESC')
      
             ->get();


  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 






}

}

if($Jobtitles !=[] && $employertype !=[] && $salary !=[]  && $salary[0] !="all"   && $country  =="0" && $experince !=[])
{





  foreach ($resultQuery as $resultQue) {

    for ($i=0;$i<count($Jobtitles);$i++) {
      for ($emp=0;$emp<count($employertype);$emp++) {
      

            $jobts= PostJob::where('id',$resultQue->id)
            ->where('job_id',$Jobtitles[$i])
            ->where('job_for',$employertype[$emp])


            ->whereBetween('max_salary',array(reset($salaryf),last($salaryf))) 
            //->orWhereBetween('min_salary',array(reset($salaryf),last($salaryf)))
            ->where('currency_id',$currency)
          ->orderBy('created_at','DESC')
      
       
      
             ->get();


  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 


}
}
}

}
/////////////////////end salary fliter
//////////////////////all fliteres selected//////////


if($Jobtitles !=[] && $employertype !=[] && $salary !=[]   && $country  !="0" && $experince !=[])
{





  foreach ($resultQuery as $resultQue) {

    for ($i=0;$i<count($Jobtitles);$i++) {
      for ($emp=0;$emp<count($employertype);$emp++) {
      

            $jobts= PostJob::where('id',$resultQue->id)
            ->where('job_id',$Jobtitles[$i])
            ->where('job_for',$employertype[$emp])


              ->where('country_id',$country)
            ->whereBetween('max_salary',array(reset($salaryf),last($salaryf))) 
            //->orWhereBetween('min_salary',array(reset($salaryf),last($salaryf)))
            ->where('currency_id',$currency)
           ->orderBy('created_at','DESC')
      
       
      
             ->get();


  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 





}
}
}

}

//////////////////all fliters null

if($Jobtitles ==[] && $employertype ==[] && $salary ==[]   && $country  =="0" && $experince ==[])
{





  foreach ($resultQuery as $resultQue) {

    
       
      $jobts= PostJob::where('id',$resultQue->id)
             ->orderBy('created_at','DESC')
             ->get();


  foreach ($jobts as$jobt) {
  
       array_push($jobs, $jobt); 
   
  
  }
 






}

}


         $count=count($jobs);
         // dd($count);

 $data = array();

        //Get current page form url e.g. &page=6
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        //Create a new Laravel collection from the array data
        $collection = new Collection($jobs);

        //Define how many items we want to be visible in each page
        $per_page = 21;

        //Slice the collection to get the items to display in current page
        $currentPageResults = $collection->slice(($currentPage-1) * $per_page, $per_page)->all();

        //Create our paginator and add it to the data array
        $data['jobs'] = new LengthAwarePaginator($currentPageResults, count($collection), $per_page);

        //Set base url for pagination links to follow e.g custom/url?page=6
        $data['jobs']->setPath($request->url());

$jobs=$data['jobs'];
 
if($request->ajax())
{
  return Response::json(\View::make('Search.searchpartial',compact('words','jobs','jobcheck','count','jobtitle','jobtitleresult','Country','jobfor'), array('jobs' => $jobs))->render());
}
// $hadeel = new Collection($jobs);
// dd($hadeel->paginate(21));
  return  view('Search.searchpartial',compact('jobs','words','count','jobtitle','jobcheck','jobfor','data') );

}
//////////////////Candidate Fliter////////////////////////////

  if($jobcheck !=1)
         {


 if( $words != null) 
 {  
  $resultQuery= CandidateInfo::search($words)->get();; 
 }  
if( $words == 'undefined') 
 
 {

   $resultQuery= CandidateInfo::all();
 }

// dd($resultQuery);

//////JobTitles With Option

if( $Jobtitles !=[] && $Jobtitles[0] =="all" && $salary ==[]   && $nationality  =="0" && $skills  =="0" && $country  =="0")


{

 



  foreach ($resultQuery as $resultQue) {



   $Canresult=CandidateInfo::with('job')
      ->with('user')
      ->with('nationality')
      ->with('getCandidateSkill')
      ->with('country')
      ->where('candidate_infos.id', $resultQue->id)
 
    
       ->get();



 

  foreach ($Canresult as$cant) {
  
        $candidates->push($cant);
  
  }
  
   

       
   
  
  }
 









}


if(  $Jobtitles !=[] && $Jobtitles[0] =="all" && $salary ==[]   && $nationality  =="0" && $skills  =="0" && $country  !="0")
{
 



  foreach ($resultQuery as $resultQue) {



   $Canresult=CandidateInfo::with('job')
      ->with('user')
      ->with('nationality')
      ->with('getCandidateSkill')
      ->with('country')
      ->where('candidate_infos.id', $resultQue->id)
  
    ->where('candidate_infos.country_id',$country)
       ->get();



 

  foreach ($Canresult as$cant) {
  
        $candidates->push($cant);
  
  }
  
   

       
   
  
  
 




}




}




if( $Jobtitles !=[] && $Jobtitles[0] =="all" && $salary !=[]   && $nationality  =="0" && $skills  =="0" && $country=="0")
{





  foreach ($resultQuery as $resultQue) {


  

       $Canresult=CandidateInfo::with('job')
      ->with('user')
      ->with('nationality')
      ->with('getCandidateSkill')
        ->with('country')
      ->where('candidate_infos.id', $resultQue->id)
      ->where('candidate_infos.job_id', $Jobtitles[$i])
          ->where('candidate_infos.CurrencyId',$currency)
      ->whereBetween('candidate_infos.salary',array(reset($salaryf),last($salaryf))) 
      ->orderByRaw("-candidate_infos.vedio_path",'DESC') 
       ->get();
 
  foreach ($Canresult as$cant) {
  
 $candidates->push($cant);   
  
  }







}

}



if( $Jobtitles !=[] && $Jobtitles[0] =="all"  && $salary !=[]   && $nationality  !="0" && $skills =="0" && $country=="0")
{





  foreach ($resultQuery as $resultQue) {


    
      



             $Canresult=CandidateInfo::with('job')
      ->with('user')
      ->with('nationality')
      ->with('getCandidateSkill')
        ->with('country')
      ->where('candidate_infos.id', $resultQue->id)
      ->where('candidate_infos.job_id', $Jobtitles[$i])
          ->where('candidate_infos.CurrencyId',$currency)
      ->whereBetween('candidate_infos.salary',array(reset($salaryf),last($salaryf))) 
       ->where('candidate_infos.nationality_id',$nationality)
      ->orderByRaw("-candidate_infos.vedio_path",'DESC') 
       ->get();


  foreach ($Canresult as$cant) {
  
        $candidates->push($cant);
   
  
  }
 







}

}

if( $Jobtitles !=[] && $Jobtitles[0] =="all" && $salary !=[]   && $nationality  !="0" && $skills !="0" && $country=="0")
{





  foreach ($resultQuery as $resultQue) {

     
      






         $Canresult=CandidateInfo::whereHas('getCandidateSkill', function($q) use($skills) {
    $q->where('skills.id', $skills);
      })->with('job')
      ->with('user')
      ->with('nationality')
     ->with('country')
      ->where('candidate_infos.id', $resultQue->id)
      ->where('candidate_infos.job_id', $Jobtitles[$i])
          ->where('candidate_infos.CurrencyId',$currency)
      ->whereBetween('candidate_infos.salary',array(reset($salaryf),last($salaryf))) 
       ->where('candidate_infos.nationality_id',$nationality)
      ->orderByRaw("-candidate_infos.vedio_path",'DESC') 
       ->get();


  foreach ($Canresult as$cant) {
  
         $candidates->push($cant);
   
  
  }







}

}







if($Jobtitles !=[] && $Jobtitles[0] =="all"  && $salary !=[]   && $nationality  !="0" && $skills !="0" && $country!="0")
{





  foreach ($resultQuery as $resultQue) {

 
     
      






         $Canresult=CandidateInfo::whereHas('getCandidateSkill', function($q) use($skills) {
    $q->where('skills.id', $skills);
      })->with('job')
      ->with('user')
      ->with('nationality')
     ->with('country')
      ->where('candidate_infos.id', $resultQue->id)
      ->where('candidate_infos.job_id', $Jobtitles[$i])
          ->where('candidate_infos.CurrencyId',$currency)
      ->whereBetween('candidate_infos.salary',array(reset($salaryf),last($salaryf))) 
       ->where('candidate_infos.nationality_id',$nationality)
  ->where('candidate_infos.country_id',$country)
       ->get();


  foreach ($Canresult as$cant) {
  
         $candidates->push($cant);
   
  
  }






}

}

///// jobtitles without all
if($Jobtitles !=[] && $Jobtitles[0] !="all" && $salary ==[]   && $nationality  =="0" && $skills  =="0" && $country  =="0")
{
 



  foreach ($resultQuery as $resultQue) {
for ($i=0;$i<count($Jobtitles);$i++) {


   $Canresult=CandidateInfo::with('job')
      ->with('user')
      ->with('nationality')
      ->with('getCandidateSkill')
      ->with('country')
      ->where('candidate_infos.id', $resultQue->id)
      ->where('candidate_infos.job_id', $Jobtitles[$i])
    
       ->get();



 

  foreach ($Canresult as$cant) {
  
        $candidates->push($cant);
  
  }
  
   

       
   
  
  }
 




}




}

if($Jobtitles !=[] && $Jobtitles[0] !="all" && $salary ==[]   && $nationality  =="0" && $skills  =="0" && $country  !="0")
{
 



  foreach ($resultQuery as $resultQue) {
for ($i=0;$i<count($Jobtitles);$i++) {


   $Canresult=CandidateInfo::with('job')
      ->with('user')
      ->with('nationality')
      ->with('getCandidateSkill')
      ->with('country')
      ->where('candidate_infos.id', $resultQue->id)
      ->where('candidate_infos.job_id', $Jobtitles[$i])
    ->where('candidate_infos.country_id',$country)
       ->get();



 

  foreach ($Canresult as$cant) {
  
        $candidates->push($cant);
  
  }
  
   

       
   
  
  }
 




}




}

if($Jobtitles !=[] && $Jobtitles[0] !="all" && $salary !=[]   && $nationality  =="0" && $skills  =="0" && $country=="0")
{





  foreach ($resultQuery as $resultQue) {

    for ($i=0;$i<count($Jobtitles);$i++) {
  

       $Canresult=CandidateInfo::with('job')
      ->with('user')
      ->with('nationality')
      ->with('getCandidateSkill')
        ->with('country')
      ->where('candidate_infos.id', $resultQue->id)
      ->where('candidate_infos.job_id', $Jobtitles[$i])
          ->where('candidate_infos.CurrencyId',$currency)
      ->whereBetween('candidate_infos.salary',array(reset($salaryf),last($salaryf))) 
      ->orderByRaw("-candidate_infos.vedio_path",'DESC') 
       ->get();
 
  foreach ($Canresult as$cant) {
  
 $candidates->push($cant);   
  
  }






}
}

}



if($Jobtitles !=[]  && $Jobtitles[0] !="all"&& $salary !=[]   && $nationality  !="0" && $skills =="0" && $country=="0")
{





  foreach ($resultQuery as $resultQue) {

    for ($i=0;$i<count($Jobtitles);$i++) {
    
      



             $Canresult=CandidateInfo::with('job')
      ->with('user')
      ->with('nationality')
      ->with('getCandidateSkill')
        ->with('country')
      ->where('candidate_infos.id', $resultQue->id)
      ->where('candidate_infos.job_id', $Jobtitles[$i])
          ->where('candidate_infos.CurrencyId',$currency)
      ->whereBetween('candidate_infos.salary',array(reset($salaryf),last($salaryf))) 
       ->where('candidate_infos.nationality_id',$nationality)
      ->orderByRaw("-candidate_infos.vedio_path",'DESC') 
       ->get();


  foreach ($Canresult as$cant) {
  
        $candidates->push($cant);
   
  
  }
 






}
}

}

if($Jobtitles !=[]  && $Jobtitles[0] !="all" && $salary !=[]   && $nationality  !="0" && $skills !="0" && $country=="0")
{





  foreach ($resultQuery as $resultQue) {

    for ($i=0;$i<count($Jobtitles);$i++) {
     
      






         $Canresult=CandidateInfo::whereHas('getCandidateSkill', function($q) use($skills) {
    $q->where('skills.id', $skills);
      })->with('job')
      ->with('user')
      ->with('nationality')
     ->with('country')
      ->where('candidate_infos.id', $resultQue->id)
      ->where('candidate_infos.job_id', $Jobtitles[$i])
          ->where('candidate_infos.CurrencyId',$currency)
      ->whereBetween('candidate_infos.salary',array(reset($salaryf),last($salaryf))) 
       ->where('candidate_infos.nationality_id',$nationality)
      ->orderByRaw("-candidate_infos.vedio_path",'DESC') 
       ->get();


  foreach ($Canresult as$cant) {
  
         $candidates->push($cant);
   
  
  }






}
}

}







if($Jobtitles !=[] && $Jobtitles[0] !="all" &&  $salary !=[]   && $nationality  !="0" && $skills !="0" && $country!="0")
{





  foreach ($resultQuery as $resultQue) {

    for ($i=0;$i<count($Jobtitles);$i++) {
     
      






         $Canresult=CandidateInfo::whereHas('getCandidateSkill', function($q) use($skills) {
    $q->where('skills.id', $skills);
      })->with('job')
      ->with('user')
      ->with('nationality')
     ->with('country')
      ->where('candidate_infos.id', $resultQue->id)
      ->where('candidate_infos.job_id', $Jobtitles[$i])
          ->where('candidate_infos.CurrencyId',$currency)
      ->whereBetween('candidate_infos.salary',array(reset($salaryf),last($salaryf))) 
       ->where('candidate_infos.nationality_id',$nationality)
  ->where('candidate_infos.country_id',$country)
       ->get();


  foreach ($Canresult as$cant) {
  
         $candidates->push($cant);
   
  
  }






}
}

}










/////////////////////nationality with option//////////////////


if($Jobtitles ==[] &&   $salary ==[]   && $nationality  !="0" && $skills =="0" && $country=="0")
{


  foreach ($resultQuery as $resultQue) {

   $Canresult=CandidateInfo::with('job')
      ->with('user')
      ->with('nationality')
     ->with('getCandidateSkill')
       ->with('country')
      ->where('candidate_infos.id', $resultQue->id)
      
       ->where('candidate_infos.nationality_id',$nationality)
      
       ->get();

       // dd($Canresult);
  foreach ($Canresult as $cant) {
  
         $candidates->push($cant);
  
  }
 





}

// dd($candidates);


}

if($Jobtitles ==[] &&   $salary ==[]   && $nationality  !="0" && $skills =="0" && $country !="0")
{
 

  foreach ($resultQuery as $resultQue) {

   $Canresult=CandidateInfo::with('job')
      ->with('user')
      ->with('nationality')
     ->with('getCandidateSkill')
       ->with('country')
      ->where('candidate_infos.id', $resultQue->id)
      
       ->where('candidate_infos.nationality_id',$nationality)
          ->where('candidate_infos.country_id',$country)
       ->get();

       // dd($Canresult);
  foreach ($Canresult as $cant) {
  
         $candidates->push($cant);
  
  }
 





}




}

if($Jobtitles !=[]  && $salary ==[]   && $nationality  !="0" && $skills =="0" && $country=="0")
{





  foreach ($resultQuery as $resultQue) {

    for ($i=0;$i<count($Jobtitles);$i++) {
      
        $Canresult=CandidateInfo::with('job')
      ->with('user')
      ->with('nationality')
      ->with('getCandidateSkill')
      ->with('country')
      ->where('candidate_infos.id', $resultQue->id)
      ->where('candidate_infos.job_id', $Jobtitles[$i])
   
       ->where('candidate_infos.nationality_id',$nationality)
     
       ->get();
  foreach ($Canresult as$cant) {
  
        $candidates->push($cant);
   
  
  }
 





}
}

}






if($Jobtitles !=[]  && $salary !=[]   && $nationality  !="0" && $skills =="0"  && $country !="0")

{






  foreach ($resultQuery as $resultQue) {

    for ($i=0;$i<count($Jobtitles);$i++) {
       
             $Canresult=CandidateInfo::with('job')
      ->with('user')
      ->with('nationality')
      ->with('getCandidateSkill')
       ->with('country')
      ->where('candidate_infos.id', $resultQue->id)
      ->where('candidate_infos.job_id', $Jobtitles[$i])
          ->where('candidate_infos.CurrencyId',$currency)
      ->whereBetween('candidate_infos.salary',array(reset($salaryf),last($salaryf))) 
       ->where('candidate_infos.nationality_id',$nationality)
      ->orderByRaw("-candidate_infos.vedio_path",'DESC') 
       ->get();


  foreach ($Canresult as$cant) {
  
       $candidates->push($cant); 
   
  
  }





}
}

}


if($Jobtitles !=[] && $salary ==[]   && $nationality  !="0" && $skills !="0" && $country !="0")
{





  foreach ($resultQuery as $resultQue) {

    for ($i=0;$i<count($Jobtitles);$i++) {

          $Canresult=CandidateInfo::whereHas('getCandidateSkill', function($q) use($skills) {
    $q->where('skills.id', $skills);
      })->with('job')
      ->with('user')
      ->with('nationality')
      ->with('country')
      ->where('candidate_infos.id', $resultQue->id)
      ->where('candidate_infos.job_id', $Jobtitles[$i])
       ->where('candidate_infos.nationality_id',$nationality)
      ->orderByRaw("-candidate_infos.vedio_path",'DESC') 
       ->get();
  foreach ($Canresult as$cant) {
  
        $candidates->push($cant);
   
  
  }
 





}
}

}




/////////////////////end nationality with option/////////////






///////////skills with option////////////
if($Jobtitles ==[]  && $salary ==[]  && $nationality  =="0" && $skills !="0" && $country=="0")
{
 // dd('l');

  foreach ($resultQuery as $resultQue) {

    
          $Canresult=CandidateInfo::
          whereHas('getCandidateSkill', function($q) use($skills) {
    $q->where('skills.id', $skills);
      })->with('job')
      ->with('user')
      ->with('nationality')
      ->with('country')

     ->where('candidate_infos.id', $resultQue->id)
      ->orderByRaw("-candidate_infos.vedio_path",'DESC') 
       ->get();
// dd($cants);
 
  foreach ($Canresult as$cant) {
  
        $candidates->push($cant);
   
  
  } 





}



}

if($Jobtitles ==[]  && $salary ==[]  && $nationality  =="0" && $skills !="0" && $country!="0")
{
 // dd('l');

  foreach ($resultQuery as $resultQue) {

    
          $Canresult=CandidateInfo::
          whereHas('getCandidateSkill', function($q) use($skills) {
    $q->where('skills.id', $skills);
      })->with('job')
      ->with('user')
      ->with('nationality')
      ->with('country')

     ->where('candidate_infos.id', $resultQue->id)
       ->where('candidate_infos.country_id', $country)
       ->get();
// dd($cants);
 
  foreach ($Canresult as$cant) {
  
        $candidates->push($cant);
   
  
  } 





}



}

if($Jobtitles !=[] &&  $salary ==[]   && $nationality  =="0" && $skills !="0" && $country=="0")

{





  foreach ($resultQuery as $resultQue) {

    for ($i=0;$i<count($Jobtitles);$i++) {
      
   $Canresult=CandidateInfo::whereHas('getCandidateSkill', function($q) use($skills) {
    $q->where('skills.id', $skills);
      })->with('job')
      ->with('user')
      ->with('nationality')
     ->with('country')
      ->where('candidate_infos.id', $resultQue->id)
      ->where('candidate_infos.job_id', $Jobtitles[$i])
    
      ->orderByRaw("-candidate_infos.vedio_path",'DESC') 
       ->get();
  foreach ($cants as$cant) {
  
        $candidates->push($cant);
   
  
  }
 





}
}

}



if($Jobtitles !=[]  && $salary !=[]   && $nationality  =="0" && $skills !="0" && $country=="0")

{





  foreach ($resultQuery as $resultQue) {

    for ($i=0;$i<count($Jobtitles);$i++) {
      
    $Canresult=CandidateInfo::whereHas('getCandidateSkill', function($q) use($skills) {
    $q->where('skills.id', $skills);
      })->with('job')
      ->with('user')
      ->with('nationality')
     ->with('country')
      ->where('candidate_infos.id', $resultQue->id)
      ->where('candidate_infos.job_id', $Jobtitles[$i])
      ->where('candidate_infos.CurrencyId',$currency)
      ->whereBetween('candidate_infos.salary',array(reset($salaryf),last($salaryf))) 
 
      ->orderByRaw("-candidate_infos.vedio_path",'DESC') 
       ->get();
  foreach ($Canresult as$cant) {
  
        $candidates->push($cant); 
   
  
  }
 





}
}

}


if($Jobtitles ==[] && $salary ==[]   && $nationality  !="0" && $skills !="0" && $country=="0")

{





  foreach ($resultQuery as $resultQue) {

    
       
      $Canresult=CandidateInfo::whereHas('getCandidateSkill', function($q) use($skills) {
    $q->where('skills.id', $skills);
      })->with('job')
      ->with('user')
      ->with('nationality')
     ->with('country')
      ->where('candidate_infos.id', $resultQue->id)
   
   
       ->where('candidate_infos.nationality_id',$nationality)
      ->orderByRaw("-candidate_infos.vedio_path",'DESC') 
       ->get();
  foreach ($Canresult as $cant) {
  
        $candidates->push($cant); 
   
  
  }
 






}

}
/////////////////////////salary flliters//////////////////


if($Jobtitles ==[]    && $salary !=[] && $salary[0] =="all" && $nationality  =="0" && $skills =="0" && $country=="0")

{
  


  foreach ($resultQuery as $resultQue) {

    
   $Canresult=CandidateInfo::with('job')
      ->with('user')
      ->with('nationality')
      ->with('getCandidateSkill')
      ->with('country')
      ->where('candidate_infos.id', $resultQue->id)

       
     
       ->get();
  foreach ($Canresult as$cant) {
  
         $candidates->push($cant);
   
  
  }
 





}




}


if($Jobtitles ==[]  && $salary !=[]&& $salary[0] =="all"  && $nationality  =="0" && $skills =="0" && $country!="0")

{


  foreach ($resultQuery as $resultQue) {

    
   $Canresult=CandidateInfo::with('job')
      ->with('user')
      ->with('nationality')
      ->with('getCandidateSkill')
      ->with('country')
      ->where('candidate_infos.id', $resultQue->id)
     
       ->where('candidate_infos.country_id',$country)
     
       ->get();
  foreach ($Canresult as$cant) {
  
         $candidates->push($cant);
   
  
  }
 





}




}

if($Jobtitles !=[]   && $salary !=[] && $salary[0] =="all" && $nationality  =="0" && $skills =="0" && $country=="0")
{





  foreach ($resultQuery as $resultQue) {

    for ($i=0;$i<count($Jobtitles);$i++) {
      
      $Canresult=CandidateInfo::with('job')
      ->with('user')
      ->with('nationality')
      ->with('getCandidateSkill')
      ->with('country')
      ->where('candidate_infos.id', $resultQue->id)
      ->where('candidate_infos.job_id', $Jobtitles[$i])
    
   

       ->get();


  foreach ($Canresult as$cant) {
  
        $candidates->push($cant);
  
  }
 





}
}

}
if($Jobtitles ==[]  && $salary !=[] &&  $salary[0] =="all" && $nationality  =="0" && $skills !="0" && $country="0")

{





  foreach ($resultQuery as $resultQue) {

    
             

        $Canresult=CandidateInfo::whereHas('getCandidateSkill', function($q) use($skills) {
    $q->where('skills.id', $skills);
      })->with('job')
      ->with('user')
      ->with('nationality')
     ->with('country')
      ->where('candidate_infos.id', $resultQue->id)
  

       ->get();
  foreach ($Canresult as$cant) {
  
      $candidates->push($cant);
   
  
  }
 






}

}





if($Jobtitles !=[]    && $salary !=[] && $salary[0] =="all" && $nationality  !="0" && $skills =="0"  && $country="0")
{





  foreach ($resultQuery as $resultQue) {

    for ($i=0;$i<count($Jobtitles);$i++) {
  
            $Canresult=CandidateInfo::with('job')
      ->with('user')
      ->with('nationality')
      ->with('getCandidateSkill')
      ->with('country')
      ->where('candidate_infos.id', $resultQue->id)
      ->where('candidate_infos.job_id', $Jobtitles[$i])
  
       ->where('candidate_infos.nationality_id',$nationality)
       
       ->get();


  foreach ($Canresult as$cant) {
  
         $candidates->push($cant);
   
  
  }
 

}




}

}


if($Jobtitles ==[]    && $salary !=[] && $salary[0] =="all"  && $nationality  !="0" && $skills =="0" && $country="0")
{





  foreach ($resultQuery as $resultQue) {

    
       
       $Canresult=CandidateInfo::with('job')
      ->with('user')
      ->with('nationality')
      ->with('getCandidateSkill')
       ->with('country')
      ->where('candidate_infos.id', $resultQue->id)
     
    
       ->where('candidate_infos.nationality_id',$nationality)
     
       ->get();

 
  foreach ($Canresult as$cant) {
  
        $candidates->push($cant);
   
  
  }
 






}

}



if($Jobtitles ==[] && $salary !=[] && $salary[0] =="all" && $nationality  !="0" && $skills !="0"  && $country=="0")
{
{





  foreach ($resultQuery as $resultQue) {

    
           $Canresult=CandidateInfo::whereHas('getCandidateSkill', function($q) use($skills) {
    $q->where('skills.id', $skills);
      })->with('job')
      ->with('user')
      ->with('nationality')
      ->with('country')
      ->where('candidate_infos.id', $resultQue->id)
     
   
       ->where('candidate_infos.nationality_id',$nationality)
   
       ->get();
 
  foreach ($Canresult as$cant) {
  
        $candidates->push($cant);
   
  
  }
 






}

}

if($Jobtitles !=[]  && $salary !=[] &&  $salary[0] =="all" && $nationality  =="0" && $skills !="0" && $country="0")





  foreach ($resultQuery as $resultQue) {

        $Canresult=CandidateInfo::whereHas('getCandidateSkill', function($q) use($skills) {
    $q->where('skills.id', $skills);
      })->with('job')
      ->with('user')
      ->with('nationality')
      ->with('country')
      ->where('candidate_infos.id', $resultQue->id)
      ->where('candidate_infos.job_id', $Jobtitles[$i])
    
   
     
       ->get();

    
  foreach ($Canresult as $cant) {
  
        $candidates->push($cant);
   
  
  }
 







}

}






////////////////salary without all//////////////
if($Jobtitles ==[]  && $salary !=[]  && $salary[0] !="all" && $nationality  =="0" && $skills =="0" && $country=="0")

{


  foreach ($resultQuery as $resultQue) {

    
   $Canresult=CandidateInfo::with('job')
      ->with('user')
      ->with('nationality')
      ->with('getCandidateSkill')
      ->with('country')
      ->where('candidate_infos.id', $resultQue->id)
       ->where('candidate_infos.CurrencyId',$currency)
      ->whereBetween('candidate_infos.salary',array(reset($salaryf),last($salaryf))) 
       
     
       ->get();
  foreach ($Canresult as$cant) {
  
         $candidates->push($cant);
   
  
  }
 





}




}


if($Jobtitles ==[]  && $salary !=[]  && $salary[0] !="all"  && $nationality  =="0" && $skills =="0" && $country!="0")

{


  foreach ($resultQuery as $resultQue) {

    
   $Canresult=CandidateInfo::with('job')
      ->with('user')
      ->with('nationality')
      ->with('getCandidateSkill')
      ->with('country')
      ->where('candidate_infos.id', $resultQue->id)
       ->where('candidate_infos.CurrencyId',$currency)
      ->whereBetween('candidate_infos.salary',array(reset($salaryf),last($salaryf))) 
       ->where('candidate_infos.country_id',$country)
     
       ->get();
  foreach ($Canresult as$cant) {
  
         $candidates->push($cant);
   
  
  }
 





}




}

if($Jobtitles !=[]  && $salary !=[]  && $salary[0] !="all" && $nationality  =="0" && $skills =="0" && $country=="0")
{





  foreach ($resultQuery as $resultQue) {

    for ($i=0;$i<count($Jobtitles);$i++) {
      
      $Canresult=CandidateInfo::with('job')
      ->with('user')
      ->with('nationality')
      ->with('getCandidateSkill')
      ->with('country')
      ->where('candidate_infos.id', $resultQue->id)
      ->where('candidate_infos.job_id', $Jobtitles[$i])
       ->where('candidate_infos.CurrencyId',$currency)
      ->whereBetween('candidate_infos.salary',array(reset($salaryf),last($salaryf))) 
   

       ->get();


  foreach ($Canresult as$cant) {
  
        $candidates->push($cant);
  
  }
 





}
}

}
if($Jobtitles ==[]  && $salary !=[]   && $salary[0] !="all" && $nationality  =="0" && $skills !="0" && $country="0")

{





  foreach ($resultQuery as $resultQue) {

    
             

        $Canresult=CandidateInfo::whereHas('getCandidateSkill', function($q) use($skills) {
    $q->where('skills.id', $skills);
      })->with('job')
      ->with('user')
      ->with('nationality')
     ->with('country')
      ->where('candidate_infos.id', $resultQue->id)
  
       ->where('candidate_infos.CurrencyId',$currency)
      ->whereBetween('candidate_infos.salary',array(reset($salaryf),last($salaryf))) 
      
      ->orderByRaw("-candidate_infos.vedio_path",'DESC') 
       ->get();
  foreach ($Canresult as$cant) {
  
      $candidates->push($cant);
   
  
  }
 






}

}





if($Jobtitles !=[] && $salary !=[]    && $salary[0] !="all" && $nationality  !="0" && $skills =="0"  && $country="0")
{





  foreach ($resultQuery as $resultQue) {

    for ($i=0;$i<count($Jobtitles);$i++) {
  
            $Canresult=CandidateInfo::with('job')
      ->with('user')
      ->with('nationality')
      ->with('getCandidateSkill')
      ->with('country')
      ->where('candidate_infos.id', $resultQue->id)
      ->where('candidate_infos.job_id', $Jobtitles[$i])
       ->where('candidate_infos.CurrencyId',$currency)
      ->whereBetween('candidate_infos.salary',array(reset($salaryf),last($salaryf))) 
       ->where('candidate_infos.nationality_id',$nationality)
      ->orderByRaw("-candidate_infos.vedio_path",'DESC') 
       ->get();


  foreach ($Canresult as$cant) {
  
         $candidates->push($cant);
   
  
  }
 

}




}

}


if($Jobtitles ==[]  && $salary !=[] && $salary[0] !="all"  && $nationality  !="0" && $skills =="0" && $country="0")
{





  foreach ($resultQuery as $resultQue) {

    
       
       $Canresult=CandidateInfo::with('job')
      ->with('user')
      ->with('nationality')
      ->with('getCandidateSkill')
       ->with('country')
      ->where('candidate_infos.id', $resultQue->id)
     
       ->where('candidate_infos.CurrencyId',$currency)
      ->whereBetween('candidate_infos.salary',array(reset($salaryf),last($salaryf))) 
       ->where('candidate_infos.nationality_id',$nationality)
      ->orderByRaw("-candidate_infos.vedio_path",'DESC') 
       ->get();

 
  foreach ($Canresult as$cant) {
  
        $candidates->push($cant);
   
  
  }
 






}

}



if($Jobtitles ==[]  && $salary !=[]  && $salary[0] !="all" && $nationality  !="0" && $skills !="0"  && $country=="0")
{
{





  foreach ($resultQuery as $resultQue) {

    
           $Canresult=CandidateInfo::whereHas('getCandidateSkill', function($q) use($skills) {
    $q->where('skills.id', $skills);
      })->with('job')
      ->with('user')
      ->with('nationality')
      ->with('country')
      ->where('candidate_infos.id', $resultQue->id)
     
       ->where('candidate_infos.CurrencyId',$currency)
      ->whereBetween('candidate_infos.salary',array(reset($salaryf),last($salaryf))) 
       ->where('candidate_infos.nationality_id',$nationality)
      ->orderByRaw("-candidate_infos.vedio_path",'DESC') 
       ->get();
 
  foreach ($Canresult as$cant) {
  
        $candidates->push($cant);
   
  
  }
 






}

}

if($Jobtitles !=[]  && $salary !=[]  && $salary[0] !="all" && $nationality  =="0" && $skills !="0" && $country="0")





  foreach ($resultQuery as $resultQue) {

        $Canresult=CandidateInfo::whereHas('getCandidateSkill', function($q) use($skills) {
    $q->where('skills.id', $skills);
      })->with('job')
      ->with('user')
      ->with('nationality')
      ->with('country')
      ->where('candidate_infos.id', $resultQue->id)
      ->where('candidate_infos.job_id', $Jobtitles[$i])
       ->where('candidate_infos.CurrencyId',$currency)
      ->whereBetween('candidate_infos.salary',array(reset($salaryf),last($salaryf))) 
   
     
       ->get();

    
  foreach ($Canresult as $cant) {
  
        $candidates->push($cant);
   
  
  }
 







}

}

////countryflliter


if($Jobtitles ==[]  && $salary ==[]   && $nationality  =="0" && $skills =="0" && $country !="0" )

{





  foreach ($resultQuery as $resultQue) {

    
       
    $Canresult=CandidateInfo::with('job')
      ->with('user')
      ->with('nationality')
      ->with('getCandidateSkill')
      ->with('country')
      ->where('candidate_infos.id', $resultQue->id)
     ->where('candidate_infos.country_id',$country)
      
       ->get();


  foreach ($Canresult as$cant) {
  
       
    $candidates->push($cant);

  
  }
 






}


}





if($Jobtitles !=[]  && $salary !=[]   && $nationality  =="0" && $skills =="0" && $country !="0" )

{





  foreach ($resultQuery as $resultQue) {

    for ($i=0;$i<count($Jobtitles);$i++) {
  
            $Canresult=CandidateInfo::with('job')
      ->with('user')
      ->with('nationality')
      ->with('getCandidateSkill')
      ->with('country')
      ->where('candidate_infos.id', $resultQue->id)
      ->where('candidate_infos.job_id', $Jobtitles[$i])
       ->where('candidate_infos.country_id',$country)
         ->where('candidate_infos.CurrencyId',$currency)
      ->whereBetween('candidate_infos.salary',array(reset($salaryf),last($salaryf))) 
       ->get();


  foreach ($Canresult as$cant) {
  
         $candidates->push($cant);
   
  
  }
 

}




}


}



if($Jobtitles !=[]  && $salary !=[]   && $nationality  !="0" && $skills =="0" && $country !="0" )

{





  foreach ($resultQuery as $resultQue) {

    for ($i=0;$i<count($Jobtitles);$i++) {
  
            $Canresult=CandidateInfo::with('job')
      ->with('user')
      ->with('nationality')
      ->with('getCandidateSkill')
      ->with('country')
      ->where('candidate_infos.id', $resultQue->id)
      ->where('candidate_infos.job_id', $Jobtitles[$i])
       ->where('candidate_infos.country_id',$country)
         ->where('candidate_infos.CurrencyId',$currency)
         ->where('candidate_infos.nationality_id',$nationality)
      ->whereBetween('candidate_infos.salary',array(reset($salaryf),last($salaryf))) 
       ->get();


  foreach ($Canresult as$cant) {
  
         $candidates->push($cant);
   
  
  }
 

}




}


}



if($Jobtitles !=[]  && $salary !=[]   && $nationality  =="0" && $skills !="0" && $country !="0" )

{





  foreach ($resultQuery as $resultQue) {

    for ($i=0;$i<count($Jobtitles);$i++) {
  
              $Canresult=CandidateInfo::whereHas('getCandidateSkill', function($q) use($skills) {
    $q->where('skills.id', $skills);
      })->with('job')
      ->with('user')
      ->with('nationality')
     ->with('country')
      ->where('candidate_infos.id', $resultQue->id)
      ->where('candidate_infos.job_id', $Jobtitles[$i])
       ->where('candidate_infos.CurrencyId',$currency)
      ->whereBetween('candidate_infos.salary',array(reset($salaryf),last($salaryf))) 
   ->where('candidate_infos.country_id',$country)
    
       ->get();


  foreach ($Canresult as$cant) {
  
         $candidates->push($cant);
   
  
  }
 

}




}


}


if($Jobtitles !=[]  && $salary ==[]   && $nationality  !="0" && $skills !="0" && $country !="0" )

{





  foreach ($resultQuery as $resultQue) {

    for ($i=0;$i<count($Jobtitles);$i++) {
  
              $Canresult=CandidateInfo::whereHas('getCandidateSkill', function($q) use($skills) {
    $q->where('skills.id', $skills);
      })->with('job')
      ->with('user')
      ->with('nationality')
     ->with('country')
      ->where('candidate_infos.id', $resultQue->id)
      ->where('candidate_infos.job_id', $Jobtitles[$i])
       ->where('candidate_infos.CurrencyId',$currency)
      ->whereBetween('candidate_infos.salary',array(reset($salaryf),last($salaryf))) 
   ->where('candidate_infos.country_id',$country)
       ->where('candidate_infos.nationality_id',$nationality)
    
       ->get();


  foreach ($Canresult as$cant) {
  
         $candidates->push($cant);
   
  
  }
 

}




}


}


if($Jobtitles ==[]  && $salary !=[]   && $nationality  !="0" && $skills !="0" && $country !="0" )

{





  foreach ($resultQuery as $resultQue) {

   
  
              $Canresult=CandidateInfo::whereHas('getCandidateSkill', function($q) use($skills) {
    $q->where('skills.id', $skills);
      })->with('job')
      ->with('user')
      ->with('nationality')
     ->with('country')
      ->where('candidate_infos.id', $resultQue->id)
      
       ->where('candidate_infos.CurrencyId',$currency)
      ->whereBetween('candidate_infos.salary',array(reset($salaryf),last($salaryf))) 
   ->where('candidate_infos.country_id',$country)
       ->where('candidate_infos.nationality_id',$nationality)
    
       ->get();


  foreach ($Canresult as$cant) {
  
         $candidates->push($cant);
   
  
  }
 

}







}


if($Jobtitles !=[]  && $salary ==[]   && $nationality  !="0" && $skills =="0" && $country !="0" )

{





  foreach ($resultQuery as $resultQue) {

   for ($i=0;$i<count($Jobtitles);$i++) {
  
              $Canresult=CandidateInfo::with('job')
      ->with('user')
      ->with('nationality')
     ->with('country')
      ->where('candidate_infos.id', $resultQue->id)
      ->where('candidate_infos.job_id', $Jobtitles[$i])
     
   ->where('candidate_infos.country_id',$country)
       ->where('candidate_infos.nationality_id',$nationality)
    
       ->get();


  foreach ($Canresult as$cant) {
  
         $candidates->push($cant);
   
  
  }
}
 

}







}

//////////////////all fliters null

if($Jobtitles ==[]  && $salary ==[]   && $nationality  =="0" && $skills =="0" && $country=="0")

{





  foreach ($resultQuery as $resultQue) {

    
       
    $Canresult=CandidateInfo::with('job')
      ->with('user')
      ->with('nationality')
      ->with('getCandidateSkill')
      ->with('country')
      ->where('candidate_infos.id', $resultQue->id)
     
      
       ->get();


  foreach ($Canresult as$cant) {
  
       
    $candidates->push($cant);

  
  }
 






}

}



  



$candidates=$candidates->sortByDesc('vedio_path');

$count=count($candidates);

 $data = array();

        //Get current page form url e.g. &page=6
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        //Create a new Laravel collection from the array data
        $collection = new Collection($candidates);

        //Define how many items we want to be visible in each page
        $per_page = 21;

        //Slice the collection to get the items to display in current page
        $currentPageResults = $collection->slice(($currentPage-1) * $per_page, $per_page)->all();

        //Create our paginator and add it to the data array
        $data['candidates'] = new LengthAwarePaginator($currentPageResults, count($collection), $per_page);

        //Set base url for pagination links to follow e.g custom/url?page=6
        $data['candidates']->setPath($request->url());

$candidates=$data['candidates'];


if($request->ajax())
{
  return Response::json(\View::make('Search.searchpartial',compact('words','candidates','jobcheck','count','jobtitle','jobtitleresult','Country','jobfor'), array('candidates' => $candidates))->render());
}


return  view('Search.searchpartial',compact('candidates','words','jobcheck','count','jobtitle','jobtitleresult','Country','jobfor'));
         }



}




 
}


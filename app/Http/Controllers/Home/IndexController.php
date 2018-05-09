<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\User;
use App\CandidateInfo;
use App\PostJob;

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
		  // dd($SuccessStories);
		return view('Layout.index',compact('TotalEmpolyer','TotalCandidate','TotalVideoCvs','TotalAnsweredQuestions','RecentlyAddedJobs','SuccessStories'));
   }

   public function search(Request $request)
   {
   		$words = $request['words'];
   		$type = $request['type'];
   		if($type == 'candidate')
		{
			$cand_infos = CandidateInfo::search($words)->get();
			$candidates = collect();
			foreach ($cand_infos as $key => $can_info) {
				# code...
				$candidates->push($can_info->user);
			}
			return $candidates;
		}
		elseif($type =="employer")
		{
			$jobs = PostJob::search($words)->get();
			return $jobs;
		}
		else
		{
			return $result=collect();
		}

   }
}

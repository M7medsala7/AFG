<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PostJob;
use App\JobLanguage;
class JobPostController extends Controller
{
    //
    public function create()
    {
    	return view('employer.post_job');
    }
    public function store(Request $request)
    {
    	// return $request->all();
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
                \App\UserSkill::create(['job_id'=>$job->id, 'skill_id'=>$skill]);
            }
        }
        return redirect('/home');
    }

    public function getCandidatedStarredJob(Request $request)
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
    public function getNextCan(Request $request,$id)
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
    public function getApplicants(Request $request)
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
    public function getNextApplicants(Request $request, $id)
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
}

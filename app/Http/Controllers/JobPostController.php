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
}

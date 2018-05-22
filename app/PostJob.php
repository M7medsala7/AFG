<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class PostJob extends Model
{
    //
    use Eloquence;
    protected $fillable = [
        'job_id', 'job_for','job_descripton','num_of_candidates','phone','created_by','country_id','max_salary','min_salary','visa_statues','living_arrangments','educational_level','religion','experience','martial_status','request_status','seen','currency_id','nationality_id','industry_id','prefered_gender','job_requirements','availability','industry_id',
    ];
 public function job()
    {
        return $this->belongsTo('App\Job');
    }
     public function Currency()
    {
        return $this->belongsTo('App\Currency');
    }
    public function user()
    {
        return $this->belongsTo('App\User','created_by');
    }

public function Industry()
    {
        return $this->belongsTo('App\Industry');
    }
    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    public function applicants()
    {
        return $this->belongsToMany('App\User','job_applications','job_post_id','user_id');
    }
    public function starred()
    {
        return $this->belongsToMany('App\User','post_job_starred','post_job_id','user_id');
    }

    public function getTopCandidatesAttribute()
    {
        $topCandidates = collect();
    	foreach (\App\CandidateInfo::all() as $key => $candidate) {
            //check if it has 3 in common
            if($candidate->job_id == $this->job_id && $candidate->nationality == $this->nationality && $candidate->country_id == $this->country_id)
            {
                $candidate['order']=1;
                $topCandidates->push($candidate);
            }
            // 2 in common
            elseif ($candidate->job_id == $this->job_id && $candidate->country_id == $this->country_id && $candidate->nationality != $this->nationality)
            {
                # code...
                $candidate['order']=3;
                $topCandidates->push($candidate);   
            }
            elseif ($candidate->job_id == $this->job_id && $candidate->nationality == $this->nationality && $candidate->country_id != $this->country_id)
            {
                # code...
                $candidate['order']=3;
                $topCandidates->push($candidate);   
            }
            if(count($topCandidates)>6)
            {
                break;
            }
        }
        return $topCandidates->SortBy('order')->take(6);
    }
    public function getSimilarJobsAttribute()
    {
        $similarJobs =\App\PostJob::where('job_id',$this->job_id)->get();
        return $similarJobs->take(3);
    }
    
    protected $searchableColumns = [
        'country.name' => 20,
        'job.name' => 25,
        'job_descripton' => 10,
        'user.name' => 25,
        'user.type' => 5,
        'visa_statues' => 10,
        'nationality' => 2,
        'job_for'=>10,
    ];
}

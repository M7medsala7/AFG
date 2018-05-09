<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;
class CandidateInfo extends Model
{
    //
    use Eloquence;
    protected $fillable = [
        'job_id','industry_id','country_id','gender','type','vedio_path','coins','user_id','nationality',
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    protected $appends = ['order'];
    public function getOrderAttribute()
    {
    	return 0;
    }
    public function country()
    {
    	return $this->belongsTo('App\Country');
    }
    public function job()
    {
        return $this->belongsTo('App\Job');
    }
   
     public function canjob()
    {
        return $this->belongsTo('App\Job');
    }
    protected $searchableColumns = [
        'country.name' => 20,
        'user.email' => 10,
        'user.name' => 25,
        'user.type' => 5,
        'gender' => 10,
        'nationality' => 2,
        'job.name' => 25,
    ];
}

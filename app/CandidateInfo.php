<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;
class CandidateInfo extends Model
{
    //
    use Eloquence;

       public $table="candidate_infos";
    protected $fillable = [
        'job_id','last_name','phone_number','religion_id','birthdate','visa_type','visa_expire_date','industry_id','country_id','gender','martial_status','type','vedio_path','cv_path','descripe_yourself','looking_for_job','coins','user_id','nationality_id','CurrencyId','Eductionlevel',
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
    public function nationality()
    {
        return $this->belongsTo('App\Nationality');
    }

        public function getCandidateSkill()
    {
        return $this->belongsToMany('App\Skills','user_skills','user_id','skill_id','user_id');
        
    }

     public function skills()
    {
        return $this->belongsToMany('App\User','job_applications','job_post_id','user_id');
    }
    protected $searchableColumns = [
        'country.name' => 20,
        'user.email' => 10,
        'user.name' => 25,
        'user.type' => 5,
        'gender' => 10,
       
        'job.name' => 25,
    ];
}

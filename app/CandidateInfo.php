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
        'job_id','last_name','phone_number','religion_id',
        'birthdate','visa_type','visa_expire_date','industry_id',
        'country_id','gender','martial_status','type','vedio_path',
        'cv_path','descripe_yourself','looking_for_job','coins',
        'user_id','Agency_ID','nationality_id','salary','MaxSalary','CurrencyId','Eductionlevel','private','keyword'
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

     public function religion()
    {
        return $this->belongsTo('App\Religion');
    }
    public function job()
    {
        return $this->belongsTo('App\Job');
    }
   
    public function industry()
    {
        return $this->belongsTo('App\Industry');
    }
    public function canjob()
    {
        return $this->belongsTo('App\Job');
    }
    public function nationality()
    {
        return $this->belongsTo('App\Nationality');
    }

 public function CanExperince()
    {
        return $this->belongsTo('App\CandidateExperience','user_id','user_id');
    }
    
    
     public function ExperinceWork()
    {
       return $this->hasMany('App\CandidateExperience','user_id','user_id');
        
        
        
    }
        public function getCandidateSkill()
    {
        return $this->belongsToMany('App\Skills','user_skills','user_id','skill_id','user_id');
        
    }

     public function getCandidateLang()
    {
 return $this->belongsToMany('App\Language','user_languages','user_id','language_id','user_id')->withPivot('degree');
        
    }

          public function getCandidatePreferedLoc()
    {
 return $this->belongsToMany('App\Country','user_prefered_locations','user_id','country_id','user_id');
        
    }

     public function skills()
    {
        return $this->belongsToMany('App\User','job_applications','job_post_id','user_id');
    }

      public function currency()
    {
        return $this->belongsTo('App\Currency','CurrencyId');
    }
    protected $searchableColumns = [
        'country.name' => 20,
        'user.email' => 10,
        'user.name' => 25,
        'user.type' => 5,
        'gender' => 10,
       
        'job.name' => 25,
    ];

    public function SuccessStory()
    {
        return $this->hasOne('App\SuccessStories');
    }

         public function getCandidateStaus()
    {
 return $this->belongsToMany('App\User','client','Can_id','Emp_id','user_id')->withPivot('AgencyStatus')
 ;
        
    }

       public function getCandidateClientStaus()
    {
 return $this->belongsToMany('App\User','SharedClient','Can_id','Client_id','Agency_id')->withPivot('AgencyStatus')
 ;
       
}



       public function getCandidateClientStaus2()
    {
 return $this->belongsToMany('App\User','SharedClient','Can_id','Client_id','Agency_id','job_id')->withPivot('AgencyStatus')
 ;
       
}


}

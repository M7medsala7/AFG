<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','type','code','logo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
  public function getAge($asd){

        $timestemp = $asd." 00:00:00";
        $year =Carbon::createFromFormat('Y-m-d H:i:s', $timestemp)->year;
        $Myage=Carbon::createFromDate($year)->diff(Carbon::now())->format('%y');
        return $Myage;
               
     }
    public function postJobs()
    {
        return $this->hasMany('App\PostJob','created_by');
    }
     public function CanInfo()
    {
        return $this->hasOne('App\CandidateInfo','user_id');
    }
     public function getUserSkill()
    {
        return $this->belongsToMany('App\Skills','user_skills','user_id','skill_id')
        ->withTimestamps();
    }
    
    public function languages()
    {
        return $this->belongsToMany('App\Language','user_languages')->withPivot('degree');
    }
    public function skills()
    {
        return $this->belongsToMany('App\Skills','user_skills','user_id','skill_id');
    }

    public function preferedLocations()
    {
        return $this->hasMany('App\PreferedLocation');
    }
    public function educational()
    {
        return $this->hasOne('App\Educational');
    }
    public function experience()
    {
        return $this->hasMany('App\CandidateExperience');
    }
    public function employer()
    {
        return $this->hasOne('App\EmployerProfile');
    }
    public function company()
    {
        return $this->hasOne('App\Company','created_by');
    }
    public function likes()
    {
        return $this->belongsToMany('App\User','user_like_candidates','employer_id','user_id');
    }
      public function likesjob()
    {
        return $this->belongsToMany('App\User','user_like_jobs','job_id','user_id');
    }
}


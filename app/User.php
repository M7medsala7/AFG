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

        $timestemp = $asd."00:00:00";
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
        return $this->hasMany('App\CandidateInfo','user_id');
    }
     public function getUserSkill()
    {
        return $this->belongsToMany('App\Skills','user_skills','user_id','skill_id')
        ->withTimestamps();
    }
    
    public function languages()
    {
        return $this->hasMany('App\Language');
    }
    public function skills()
    {
        return $this->hasMany('App\Skills');
    }
    public function preferedLocations()
    {
        return $this->hasMany('App\PreferedLocation');
    }
    public function employer()
    {
        return $this->hasOne('App\EmployerProfile');
    }
}


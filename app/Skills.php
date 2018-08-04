<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skills extends Model
{


    protected $fillable = [
        'name',
    ];
    
    public $table="skills";
     public function getSkillUser()
    {
        return $this->belongsToMany('App\User','user_skills','skill_id','user_id')
        ->withTimestamps();
    }
 public function getSkill()
    {
        return $this->belongsToMany('App\Skills','job_skills','job_id','skill_id')
        ->withTimestamps();
    }
}

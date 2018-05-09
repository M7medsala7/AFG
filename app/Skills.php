<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skills extends Model
{
    public $table="skills";
     public function getSkillUser()
    {
        return $this->belongsToMany('App\User','user_skills','skill_id','user_id')
        ->withTimestamps();
    }
}

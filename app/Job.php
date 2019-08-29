<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    //
     protected $fillable = [
        'name', 'type',
    ];


         public function getJobLanguage()
    {
        return $this->belongsToMany('App\Language','job_languages','job_id','language_id');
        
    }

         public function getJobSkill()
    {
        return $this->belongsToMany('App\Skills','job_skills','job_id','skill_id');
        
    }
}

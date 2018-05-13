<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobSkill extends Model
{
    //
    public $table="job_skills";
    protected $fillable = [
        'skill_id',
        'job_id',
    ];
}

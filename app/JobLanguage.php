<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobLanguage extends Model
{
    //
    public $table="job_languages";
    protected $fillable = [
        'language_id',
        'job_id',
    ];
}

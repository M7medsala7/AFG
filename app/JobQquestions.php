<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobQquestions extends Model
{
    public $table="job_questions";
    protected $fillable = [
        'question',
        'post_job_id',
        'weight',
    ];

    
    public function PostJob()
    {

    	return $this->belongsTo(PostJob::class);
    }
}

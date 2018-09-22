<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuccessStories extends Model
{
    protected $fillable = [
        'user_id', 'description','can_id','emp_id','approval'
    ];


    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function can()
    {
        return $this->belongsTo('App\CandidateInfo');
    }

    public function employer()
    {
        return $this->belongsTo('App\EmployerProfile');
    }
}

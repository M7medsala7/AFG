<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLikeCandidates extends Model
{
    //
    public $table="user_like_candidates";
    protected $fillable = [
        'employer_id',
        'user_id',
    ];
}

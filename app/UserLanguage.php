<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLanguage extends Model
{
    //
    public $table="user_languages";
    protected $fillable = [
        'language_id',
        'user_id',
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreferedLocation extends Model
{
    //
    public $table="user_prefered_locations";
    protected $fillable = [
        'country_id',
        'user_id',
    ];
}

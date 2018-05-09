<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployerProfile extends Model
{
    //
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'type',
        'city_id',
        'address',
        'nationality',
        'coins',
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDevicesToken extends Model
{
    public $table="user_devices_tokens";

    protected $fillable = [
        'user_id',
        'fcm_token',
    ];

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Educational extends Model
{
    //
    public $table="educational";
    protected $fillable = [
        'school',
        'level',
        'grade',
        'field',
        'fromdate',
        'todate',
        'user_id',
    ];
}

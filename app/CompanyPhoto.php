<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyPhoto extends Model
{
    //
    protected $fillable = [
        'company_id','photo_path',
        ];
}

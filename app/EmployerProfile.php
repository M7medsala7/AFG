<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployerProfile extends Model
{
    //
    public $table="employer_profiles";
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'type',
        'city_id',
        'country_id',
        'address',
        'nationality',
        'coins',
    ];

     public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function SuccessStory()
    {
        return $this->hasOne('App\SuccessStories');
    }

    public function search($query,$s)
    {
      
       return $query->where('first_name','LIKE','%'.$s.'%')
       ->orWhere('user_id','LIKE','%'.$s.'%');
    }
}


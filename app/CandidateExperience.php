<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CandidateExperience extends Model
{
    //
    public $table="candidate_experiences";
    protected $fillable = [
        'working_in',
        'start_date',
        'end_date',
        'employer_nationality_id',
        'company_name',
        'country_id',
        'salary',
        'role',
        'user_id',
    ];


     public function experincecountry()
    {
        return $this->belongsTo('App\Country','country_id');
    }

      public function Empnationality()
    {
        return $this->belongsTo('App\Nationality','employer_nationality_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
     protected $fillable = [
        'name','industry_id','country_id','Lat','lang','size','description','website','company_linkedin','company_facebook','company_twitter','company_googleplus','video_path','company_youtube','created_by',
    ];

    public function photos()
    {
    	return $this->hasMany('\App\CompanyPhoto','company_id');
    }
    public function user()
    {
    	return $this->belongsTo('\App\User','created_by');
    }
}

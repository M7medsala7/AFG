<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
     protected $fillable = [
        'name','industry_id','Country_id','lat','lang','size','description','website','company_linkedin','company_facebook','company_twitter','company_googleplus','video_path','company_youtube','Created_by',
    ];

    public function photos()
    {
    	return $this->hasMany('\App\CompanyPhoto','company_id');
    }
    public function user()
    {
    	return $this->belongsTo('\App\User','Created_by');
    }
    public function Industry()
    {
        return $this->belongsTo('App\Industry','industry_id');
    }
    public function country()
    {
        return $this->belongsTo('App\Country','Country_id');
    }
   
    
}

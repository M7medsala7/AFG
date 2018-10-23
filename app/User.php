<?php

namespace App;
use App\Notifications\RepliedToThread;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\packageattribute;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','type','code','logo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
   

    public function getcan()
    {
        $Cand=\App\EmployerProfile::all();


        $res=\App\City::where('id',$Cand)->get(); 
        // dd($Cand);
        return $res;
         //auth()->user()->notify(new RepliedToThread($similarJobs));
    }

        public function CountryName()
   {
        $countryname= EmployerProfile::
        join('countries','countries.id','=','employer_profiles.country_id')
        ->select('countries.name  AS Country_Name' )
        ->where('user_id',\Auth()->user()->id)->first();
        // dd($countryname);
        return $countryname;
   } 

    public function getMatchingjobs()
    {
       $MatchingJobs=[];
        $CandidateInfo=\Auth::user()->CanInfo()->first();
        //dd($CandidateInfo);
        if($CandidateInfo->job_id!=null)
        {
            //Matching job 

          $JobName=Job::where('id',$CandidateInfo->job_id)->select('name')->first();
        

          $JobNameLiks=Job::where('name', 'LIKE', '%'.$JobName->name.'%')->get();
        foreach($JobNameLiks as $JobNameLiks)
          {
            $MatchingJo = PostJob::where('job_id',$JobNameLiks->id)->get();    

          foreach ($MatchingJo as $Matching) {
  
               array_push($MatchingJobs, $Matching); 
   
  
           }  
        }    
        }     
        else
        {

            $MatchingJobs=null;
        } 
        return $MatchingJobs;
         //auth()->user()->notify(new RepliedToThread($similarJobs));
    }

    

      public function getMatchingcandidates()
    {
        $alljobCan=[];
        $Alljobs=\App\PostJob::where('created_by',\Auth::user()->id)->select('job_id')->get();
 
        foreach ($Alljobs as  $value)
        {
   
           array_push($alljobCan,$value->job_id);
       
        }
 //dd($alljobCan);
        $TopCandidate=\App\CandidateInfo::whereIN('job_id',$alljobCan)->get();
        
        return $TopCandidate;
    }

  public function getAge($asd){

        $timestemp = $asd." 00:00:00";
        $year =Carbon::createFromFormat('Y-m-d H:i:s', $timestemp)->year;
        $Myage=Carbon::createFromDate($year)->diff(Carbon::now())->format('%y');
        return $Myage;
               
     }
    public function postJobs()
    {
        return $this->hasMany('App\PostJob','created_by');
    }
     public function CanInfo()
    {
        return $this->hasOne('App\CandidateInfo','user_id');
    }

     public function EmpInfo()
    {
        return $this->hasOne('App\EmployerProfile','user_id');
    }
     public function getUserSkill()
    {
        return $this->belongsToMany('App\Skills','user_skills','user_id','skill_id')
        ->withTimestamps();
    }
    
    public function languages()
    {
        return $this->belongsToMany('App\Language','user_languages')->withPivot('degree');
    }
    public function skills()
    {
        return $this->belongsToMany('App\Skills','user_skills','user_id','skill_id');
    }

    public function preferedLocations()
    {
        return $this->hasMany('App\PreferedLocation');
    }
    public function educational()
    {
        return $this->hasOne('App\Educational');
    }
    public function experience()
    {
        return $this->hasMany('App\CandidateExperience');
    }
    public function employer()
    {
        return $this->hasOne('App\EmployerProfile');
    }
    public function company()
    {
        return $this->hasOne('App\Company','Created_by');
    }
    public function likes()
    {
        return $this->belongsToMany('App\User','user_like_candidates','employer_id','user_id');
    }
      public function likesjob()
    {
        return $this->belongsToMany('App\User','user_like_jobs','job_id','user_id');
    }

    public function SuccessStory()
    {
        return $this->hasOne('App\SuccessStories');
    }
    function getpackattribute($id)
   {
       $packattribute=packageattribute::join('attribute','attribute.id','=','package_attribute.attribute_id')
       ->where('packages_id',$id)
       ->select('*')->get();
       return $packattribute;
   }
}


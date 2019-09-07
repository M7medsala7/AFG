<?php
namespace App\Http\Controllers\DashboardAdmin\Dashboard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\User;
use App\CandidateInfo;
use App\PostJob;
use App\EmployerProfile;
use App\Requests;
use Input;
use App\CandidateExperience;
use App\Http\Requests\AddJobAdminFormRequest;
use App\Http\Requests\EditJobAdminFromRequests;
use Carbon\Carbon;
class DasboardController extends Controller
{

    public function index()
    {
        try
        {
          //No of Can 
        $TotalJob= PostJob::count();
        $TotalCandidate= User::with('CanInfo')->join('candidate_infos','candidate_infos.user_id','users.id')->where('type','=','candidate')->count();
        $Employer=User::whereHas('EmpInfo', function ($query)  {
    $query->orderBy('employer_profiles.created_at','DESC');
})->count();
        $Requests= Requests::count();
 
       // DateNow
       $Start=Carbon::now();
        $Date=$Start->toDateString();
        $End=$Start->addDays(-7);
        $range=array( $End->toDateString(),$Date);
        // Count this week
   
        $TotalJobweek=PostJob::wherebetween('created_at',$range)->count();
        $TotalCandidateweek=User::with('CanInfo')->join('candidate_infos','candidate_infos.user_id','users.id')->where('type','=','candidate')->wherebetween('candidate_infos.created_at',$range)->count();

$Employerweek=User::whereHas('EmpInfo', function ($query)  {
    $query->orderBy('employer_profiles.created_at','DESC');
})->wherebetween('created_at',$range)->count();



        

        $Requestsweek=Requests::wherebetween('created_at',$range)->count();

        return view('DashbordAdminPanel.Dashboard.index',compact('TotalJobweek','TotalCandidateweek','Employerweek','Requestsweek','Requests','Employer','TotalJob','TotalCandidate'));

        }
        catch(Exception $e) 
        {
        return redirect('/');
        }
    }
    
}
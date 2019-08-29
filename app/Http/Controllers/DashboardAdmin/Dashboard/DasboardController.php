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
        $TotalCandidate= CandidateInfo::count();
        $Employer= EmployerProfile::count();
        $Requests= Requests::count();
 
       // DateNow
       $Start=Carbon::now();
        $Date=$Start->toDateString();
        $End=$Start->addDays(7);
        $range=array( $Date,$End->toDateString());
        // Count this week
      
        $TotalJobweek=PostJob::wherebetween('created_at',$range)->count();
        $TotalCandidateweek=CandidateInfo::wherebetween('created_at',$range)->count();
        $Employerweek=EmployerProfile::wherebetween('created_at',$range)->count();
        $Requestsweek=Requests::wherebetween('created_at',$range)->count();

        return view('DashbordAdminPanel.Dashboard.index',compact('TotalJobweek','TotalCandidateweek','Employerweek','Requestsweek','Requests','Employer','TotalJob','TotalCandidate'));

        }
        catch(Exception $e) 
        {
        return redirect('/');
        }
    }
    
}
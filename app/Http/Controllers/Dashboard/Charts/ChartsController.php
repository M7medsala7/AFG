<?php
namespace App\Http\Controllers\Dashboard\Charts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\PostJob;
use App\CandidateInfo;
use App\EmployerProfile;
use App\Notifications\Candidate_notification;
use App\Notification;
use Carbon\Carbon;
use App\Educational;
use App\CandidateExperience;
use Socialite;
use Session;
use App\SuccessStories;
use Mail;
use Hash;
use Auth;
class ChartsController extends Controller
{  

        public function showEmpolyerChart()
        {
          
                if (Auth::check()) {
                 return view('Dashboardadmin.DashboardCharts.DasboardEmpolyer');
                }
                    
        else{
         return redirect('/login');
            }
        }

 public function showCandidateChart()
        {
          
                if (Auth::check()) {
                 return view('Dashboardadmin.DashboardCharts.DashboardCandidate');
                }
                    
        else{
         return redirect('/login');
            }
        }


         public function CandidateChart()
    {
       try
       {

         Carbon::setWeekStartsAt(Carbon::SATURDAY);
         Carbon::setWeekEndsAt(Carbon::FRIDAY);   
        $resultQuery= User::
        selectRaw('date(created_at) as date, COUNT(*) as count')->where('type','candidate')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]) ->groupBy('date')->orderBy('date', 'ASC')->get('count', 'date');


            $dataresult=[];
            foreach ($resultQuery as $resultQu) {
                                                    array_push($dataresult,array(
                                                    	    'y' => $resultQu->date,
                                                    'label' => $resultQu->count
                                                
                                                    ));
                                                
                                                }
            return \Response::json($dataresult,  200, [], JSON_NUMERIC_CHECK);
        }
        catch(Exception $e) 

        {

        return redirect('/');

        }



    }

    public function EmpolyerChart()
    {
       try
       {

         Carbon::setWeekStartsAt(Carbon::SATURDAY);
         Carbon::setWeekEndsAt(Carbon::FRIDAY);   
        $resultQuery= User::
        selectRaw('date(created_at) as date, COUNT(*) as count')->where('type','employer')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]) ->groupBy('date')->orderBy('date', 'ASC')->get('count', 'date');


            $dataresult=[];
            foreach ($resultQuery as $resultQu) {
                                                    array_push($dataresult,array(
                                                    	    'y' => $resultQu->date,
                                                    'label' => $resultQu->count
                                                
                                                    ));
                                                
                                                }
            return \Response::json($dataresult,  200, [], JSON_NUMERIC_CHECK);
        }
        catch(Exception $e) 

        {

        return redirect('/');

        }



    }


    
}
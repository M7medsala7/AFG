<?php

namespace App\Http\Controllers\DashboardAdmin\Employer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\User;
use App\CandidateInfo;
use App\PostJob;
use App\EmployerProfile;
use Input;
use App\CandidateExperience;
use App\Http\Requests\AddEmployerAdminFormRequest;
use App\Http\Requests\EditEmployerAdminFromRequests;

class EmployerController extends Controller
{
 
    public function index()
    {
     $allEmployer= User::where('type','=','employer')->orderBy('created_at','DESC')->get();
    return view('DashbordAdminPanel.employer.index',compact('allEmployer'));
    
    }



 public function deletemultipleemployer(Request $request)
 {

     $ids = $request->ids;
        User::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['status'=>true,'message'=>"Employer deleted successfully."]);
        
    }
public function employeradminstore (AddEmployerAdminFormRequest $request){

	   
              

          

           $Country=\App\Country::where('name',$request->country_id)->pluck('id')->first();
            
   $City=\App\City::where('name',$request->city_id)->pluck('id')->first();
                $lastUser =  \DB::table('users')->orderBy('id','desc')->first();
                //dd($lastUser);
                if($lastUser)
                {
                    $code = ($lastUser->code)+1;
                }
                
                $userdata = [
                    'name' => $request->First_Name,
                    'email' => $request->email,
                    'password' => \Hash::make($request->password),
                    'type'=>'employer',
                    'code'=>$code,];
            
                $usernew = new User;
                $usernew=User::create($userdata);

               
                
                $empdata = [
                    'first_name' => $request->First_Name,
                    'last_name' => $request->Last_Name,
                    'address' => $request->Address,
                    'type'=>$request->job_for,
                    //'city_id'=>$cityQuery->id,
                    'country_id'=>$Country,
                    'city_id'=>$City,
                    'user_id'=>$usernew->id, ];
        
               
                $emp = new EmployerProfile;
                $emp->create($empdata);
               
                \App\Company::create(['name'=>$request['First_Name'],'size'=>'5','country_id'=>$request['country_id'],'lat'=>'0','lang'=>'0','industry_id'=>0]);

              return redirect('/Employeradmin');
        

        
              


}


public function updateemployer($id)
{
  $employeradmin= User::FindOrFail($id);
  // dd( $candidateadmin->CanInfo->CanExperince->start_date);
   return view('DashbordAdminPanel.employer.edit',compact('employeradmin'));
}


public function employeradminedit( EditEmployerAdminFromRequests $request,$id){
	

              $Country=\App\Country::where('name',$request->Country)->pluck('id')->first();
            
   $City=\App\City::where('name',$request->City)->pluck('id')->first();     
               
        

                $user = user::find($id);
               

                          $user->update([
    'name' => $request->Name,
    'email' => $request->email,
    'password'=>$request->password,

]);
               
             
            
            
                $employer = EmployerProfile::where('user_id',$id)->first();
           if( !is_null($employer))
           {
           	      $employer->first_name = $request->Name;
                $employer->last_name = $request->Last_Name;
                $employer->address = $request->address;
                $employer->type = $request->job_for;
                $employer->user_id= $id;
                $employer->country_id = $Country;
                $employer->city_id = $City;
              
                
                $employer->save();
           }

           else
           {
           	$employernew = New EmployerProfile;

           	   $employernew->first_name = $request->Name;
                $employernew->last_name = $request->Last_Name;
                $employernew->address = $request->address;
                $employernew->type = $request->job_for;
                $employernew->user_id= $id;
                $employernew->country_id = $Country;
                $employernew->city_id = $City;
              
                
                $employernew->save();
           }
          
            
       return redirect('/Employeradmin');
}

    public function showemployer($id)
{
   $employeradmin= User::FindOrFail($id);
  // dd( $candidateadmin->CanInfo->CanExperince->start_date);
   return view('DashbordAdminPanel.employer.showemployer',compact('employeradmin'));
}


}
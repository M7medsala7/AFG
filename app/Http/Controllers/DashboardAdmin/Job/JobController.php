<?php

namespace App\Http\Controllers\DashboardAdmin\Job;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\User;
use App\CandidateInfo;
use App\PostJob;
use App\EmployerProfile;
use Input;
use App\CandidateExperience;
use App\Http\Requests\AddJobAdminFormRequest;
use App\Http\Requests\EditJobAdminFromRequests;
use Toolkito\Larasap\SendTo;
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
class JobController extends Controller
{
  

    
    public function index()
    {

        




        $allJob= PostJob::orderBy('created_at','DESC')->get();
     //   foreach( $allJob as $all)
     //   {
     //    if(is_null($all->user))
     //    {
     //        dd($all->id);
     //          $GG=PostJob::where('id','=',$all->id)->delete();
     //    }
       
     // }
    return view('DashbordAdminPanel.job.index',compact('allJob'));
    }



 public function deleteMultiplebJobs(Request $request)
 {

        $ids = $request->ids;
        PostJob::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['status'=>true,'message'=>"Jobs deleted successfully."]);
        
    }
public function jobadminstore (AddJobAdminFormRequest $request){

    

    $input = $request->all();
    
    $user=User::where('name','admin')->first();
   
       
        $postjob=PostJob::create(['job_id'=>$request['job'],
            'job_for'=>$request['job_for'],
            'created_by'=>$user->id, 'job_descripton'=>$request['job_descripton'],'country_id'=>$request['country']]);
    
            $job = EmployerProfile::create(['type'=>$request['job_for'],
            'name'=>$request['name'],'last_name'=>'.',
            'user_id'=>$user->id, 'phone'=>$request['phone']]);
           
      
         
       
        \App\Company::create(['name'=>$request['company_name'],'size'=>'5','country_id'=>$request['country'],'lat'=>'0','lang'=>'0','created_by'=>$user->id,'industry_id'=>0]);

      return redirect('/Jobadmin');
}


public function updatejob($id)
{
  $postjobadmin= PostJob::FindOrFail($id);
  // dd($postjobadmin->user->company);
   return view('DashbordAdminPanel.job.edit',compact('postjobadmin'));
}

public function jobadminedit(EditJobAdminFromRequests $request ,$id)
{

     $user=PostJob::where('id',$id)->select('created_by')->first();
   
                $jobupdate = PostJob::find($id);
        
            $jobupdate->job_id = $request->job;
            $jobupdate->job_for = $request->job_for;
            $jobupdate->num_of_candidates = $request->num_of_candidates;
            $jobupdate->phone = $request->phone;
            $jobupdate->created_by= $user->created_by;
           
            $jobupdate->country_id = $request->country;
            $jobupdate->min_salary = $request->min_salary;
            $jobupdate->max_salary = $request->maxsalary;
            $jobupdate->currency_id = $request->Currency;
            $jobupdate->prefered_gender = $request->gender;
            $jobupdate->job_requirements = $request->job_requirements;
            $jobupdate->industry_id = $request->Industry;
            $jobupdate->availability = $request->availability;
            $jobupdate->job_descripton = $request->job_descripton;
        
               if($request['Language'])
                {
                    foreach ($request['Language'] as $key => $lang) {
                        # code...
                    
        $langs=\App\JobLanguage::where('job_id',$request->job)->where('language_id',$lang)->first();
if( $langs == null)
{

            $langs= New \App\JobLanguage;
                            $langs->language_id =$lang;
                            $langs->job_id =$request->job;
                            $langs->save();
                            }



                            else
                            {
            $lan=\App\JobLanguage::where('job_id',$request->job)->where('language_id',$lang)->first();
            $lan->language_id =$lang;
            $lan->job_id =$request->job;
            $lan->save();
                            }


                       
                    }
                    
                }



                 if($request['Skills'])
                {
                    foreach ($request['Skills'] as $key => $skill) {
                        # code...
                    
        $skilln=\App\JobSkill::where('job_id',$request->job)->where('skill_id',$skill)->first();
if( $skilln == null)
{

            $skillnew= New \App\JobSkill;
                            $skillnew->skill_id =$skill;
                            $skillnew->job_id =$request->job;
                            $skillnew->save();
                            }



                            else
                            {
            $sk=\App\JobSkill::where('job_id',$request->job)->where('skill_id',$skill)->first();
            $sk->skill_id =$skill;
            $sk->job_id =$request->job;
            $sk->save();
                            }


                       
                    }
                    
                }



 
// dd($jobupdate);
            $jobupdate->save();

            $jobupdate->user->update([
    'name' => $request->Name,
    'email' => $request->email,
    'password'=>$request->password,

]);
            if($jobupdate->user->company== null)
            {

             $comp= New \App\Company;
             $comp->name=$request->company_name;
             $comp->Created_by= $user->created_by;
             $comp->save();
             // dd($comp);
            }
            else
            {
                                      $jobupdate->user->company->update([
    'name' => $request->company_name,
   

]);


            }


       return redirect('/Jobadmin');


    }


    

    public function showjob($id)
{
  $postjobadmin= PostJob::FindOrFail($id);
  // dd($postjobadmin->job->getJobLanguage);
   return view('DashbordAdminPanel.job.showjob',compact('postjobadmin'));
}

}
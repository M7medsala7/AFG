<?php

namespace App\Http\Controllers\DashboardAdmin\Candidate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\User;
use App\CandidateInfo;
use App\PostJob;
use Input;
use App\CandidateExperience;
class CandidateController extends Controller
{
 
    public function index()
    {
       $allCandidate= User::with('CanInfo')->where('type','=','candidate')->orderBy('created_at','DESC')->get();

    return view('DashbordAdminPanel.candidate.index',compact('allCandidate'));
    }

         public function candidateadminstore( Request $request)
    {
     
 //get the code value;
        $lastUser =  User::orderBy('id', 'desc')->first();
        if($lastUser)
        {
            
            $code = ($lastUser->code)+1;
             
        }
    

             $user = User::create(['name'=>$request['hf-name'],
        'email'=>$request['hf-email'],
        'password' => bcrypt($request['hf-password']),
        'type'=>'candidate','code'=>$code]);

          

 
        if($request->hasFile('file-input'))
        {

            $vedio_path = $this->saveFile($request['file-input'],$user);

            $request['file-input']=$vedio_path;
           
        }
       else
        {
            $vedio_path =  \Session::get('VideoPath');
            $input['vedio_path']=$vedio_path;
            
        }




         if($user)
        {

            $CandidateInfos=[
            'job_id'=>$request['job'],
            'industry_id'=>$request['industry'],
            'country_id'=>$request['country'],
            'gender'=>$request['gender'],
            
            'vedio_path'=>$vedio_path, 
             
            'user_id'=>$user->id];
        }
        $CandidateInfo = new CandidateInfo;
         $CandidateInfo->create($CandidateInfos);


       return redirect('/Candidateadmin');

    }

public function updatecandidate($id)
{
  $candidateadmin= User::FindOrFail($id);
  // dd( $candidateadmin->CanInfo->CanExperince->start_date);
   return view('DashbordAdminPanel.candidate.edit',compact('candidateadmin'));
}
public function candidateadminedit( Request $request)
{
      

        
               
            //*code generated*/


            //**update user
            
                

                $user = user::find($request['id']);
                $user->name = $request->Name;
                $user->email = $request->email;
                $user->password = \Hash::make($request->password);
                $user->type = 'candidate';
                $user->code =$user->code;

                $user->save();

                //**user updated
                $video_path = \Session::get('VideoPath');
                $cv_path = "";
              
        
              
                if($request->hasFile('video_file'))
                {
                    $video_path = $this->saveFile($request['video_file'],$user);
                   
                }
                if($request->hasFile('cv_path'))
                {
                    $cv_path = $this->saveUploadedFile($request['cv_path'],$user);
        
                    
                }
            
                if($request['Language'])
                {
                    foreach ($request['Language'] as $key => $lang) {
                        # code...
                    
                        $langs=\App\UserLanguage::find($request['id']);
                        $langs->language_id =$lang;
                        $langs->user_id =$user->id;
                        $langs->save();
                    }
                    
                }
                if($request['Skills'])
                {
                    foreach ($request['Skills'] as $key => $skill) {
                        # code...
                        $skills=\App\UserSkill::find($request['id']);
                        $skills->skill_id =$skill;
                        $skills->user_id =$user->id;
                        $skills->save();
                    }
                  
                }
                if($request['educational_level'])
                {
                    
                    $eduction=Educational::find($request['id']);
                        $eduction->level = $request->educational_level;
                        $eduction->user_id =$user->id;
                        $eduction->save();
                    

                }
        
        
        
    
       
        

           $id=CandidateInfo::where('user_id',$request['id'])->select('id')->first();
            
                    $candinfo=CandidateInfo::FindOrFail($id->id);
                    $candinfo->last_name = $request->LastName;
                    $candinfo->phone_number = $request->phone_number;
                    $candinfo->religion_id = $request->religion_id;
                    $candinfo->birthdate = $request->Birtdate;
                    $candinfo->visa_type = $request->visa_type;
                    $candinfo->visa_expire_date = $request->visa_expire_date;
                    $candinfo->job_id = $request->job_id;
                    $candinfo->industry_id = $request->industry_id;
                    $candinfo->country_id = $request->country_id;
                    $candinfo->gender = $request->gender;
                    $candinfo->salary = $request->salary;
                    $candinfo->CurrencyId = $request->CurrencyId;
                    $candinfo->Eductionlevel = $request->educational_level;
                    $candinfo->martial_status = $request->martial_status;
                    $candinfo->descripe_yourself = $request->descripe_yourself;
                    $candinfo->looking_for_job = $request->looking_for_job;
                    $candinfo->nationality_id = $request->Nationality;
                    $candinfo->vedio_path = $video_path;
                    $candinfo->cv_path = $cv_path;
                    $candinfo->user_id =$user->id;
                   
                // $eduction->user_id =$user->id;
                $candinfo->save();

           $idEx=CandidateExperience::where('user_id',$request['id'])->select('id')->first();
if($idEx != null)
{
      //updates in can_experinence
                $canexperience=CandidateExperience::FindOrFail($idEx->id);

                $canexperience->working_in = $request->working_in;
                $canexperience->start_date = $request->start_date;
                $canexperience->end_date = $request->end_date;
                $canexperience->employer_nationality_id = $request->employer_nationality_id;
                $canexperience->company_name = $request->company_name;
                $canexperience->country_id = $request->country_id;
                $canexperience->salary = $request->exsalary;
                $canexperience->role = $request->role;
                $canexperience->user_id = $user->id;
                  // dd($canexperience->start_date);
                $canexperience->save();
                
            //update in location
            $prefered_location = $request['prefered_location_id'];
            if($prefered_location)
            {
                $locations = [];
                array_push($locations,$prefered_location);
                //dd($prefered_location);
                if($request['prefered_location_ids'])
                {
                    foreach ($request['prefered_location_ids'] as $key => $prefered) {
                        # code...
                        array_push($locations,$prefered);
                    }
                }

                foreach (array_unique($locations) as $key => $loc) {
                    # code...
                    $location= \App\PreferedLocation::find($request['id']);
                    $location->user_id = $user->id;
                    $location->country_id = $loc;
                    $location->save();
              
                }
                
            }
}
              
                

            
            
            

            return Redirect('/Candidateadmin');
            
          
        

}

  public function deleteMultiple(Request $request){

        $ids = $request->ids;
        User::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['status'=>true,'message'=>"Canidate deleted successfully."]);
        
    }

       public function saveFile($file, $user){
       


        $filename = 'video'.time().$file->getClientOriginalName();
        $type = $file->getMimeType();
        $extension = $file->getClientOriginalExtension();
        $path = 'videos/'.$user->id;
        $destPath ='videos/'.$user->id.'/'.$filename;
        if(!\File::exists($path)) {
            // path does not exist
            \File::makeDirectory($path, $mode = 0777, true, true);
        }
        $success =$file->move($path,$filename);
       // $destPath = str_replace( $destPath);
        return $destPath;
     
    }
    
}
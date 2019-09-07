<?php

namespace App\Http\Controllers;
use App\CandidateInfo;
use App\PostJob;
use App\Job;
use Auth;
use App\User;
//use App\CandidateInfo;
use App\Skills;
use Illuminate\Http\Request;
use App\EmployerProfile; 
use App\Educational;
use App\CandidateExperience;
use Socialite;
use Session;
use Hash;

class EditCanProfileController extends Controller
{
    
    //create edit form 
    public function edit(CandidateInfo $can ,$id)
    {
        
        $data=CandidateInfo::where('user_id',$id)->first();
     
        return view('auth.Edit_Candidate_reg', compact('data'));
    
    }
    
    
    //update candidate informations
    public function updateFullReg($id,Request $request)
    {
        try
        {
          $videopoint=0;
          $logopoint=0;
          $cvgpoint=0;
          $skillpoint=0;
          $langpoint=0;
          $edupoint=0;
          $points=0;
              $code = 1000;
            
              //get the code value;
              $lastUser =  \DB::table('users')->orderBy('id', 'desc')->first();
              if($lastUser)
              {
                  $code = $lastUser->code++;
              }
              //*code generated*/
      
      
             //**update user
              $userid=CandidateInfo::where('id',$id)->select('user_id')->first();
              $uid=$userid->user_id;
            
              $user = user::find($uid);
              
              $user->name = $request->first_name;
              $user->email = $request->email;
              $user->password = Hash::make($request->password);
              $user->type = 'candidate';
              $user->code = $code;
      
              $user->save();
      
               //**user updated
               $video_path = Session::get('VideoPath');
               $cv_path = "";
               $logo = "";
       
               if($request->hasFile('logo'))
               {
                   $logo = $this->saveUploadedFile($request['logo'],$user);
                   $user->logo=$logo;
                   $user->save();
       
                   $logopoint=10;
               }
               if($request->hasFile('video_file'))
               {
                   $video_path = $this->saveFile($request['video_file'],$user);
                   $videopoint=30;
               }
               if($request->hasFile('cv_path'))
               {
                   $cv_path = $this->saveUploadedFile($request['cv_path'],$user);
       
                   $cvgpoint=10;
               }
           
               if($request['language_ids'])
               {
                   foreach ($request['language_ids'] as $key => $lang) {
                       # code...
                     
                      $langs=\App\UserLanguage::find($id);
                      $langs->language_id =$lang;
                      $langs->user_id =$user->id;
                      $langs->save();
                   }
                   $langpoint=5;
               }
               if($request['skill_ids'])
               {
                   foreach ($request['skill_ids'] as $key => $skill) {
                       # code...
                       $skills=\App\UserSkill::find($id);
                       $skills->skill_id =$skill;
                       $skills->user_id =$user->id;
                       $skills->save();
                   }
                   $skillpoint=5;
               }
               if($request['educational_level'])
               {
                  
                   $eduction=Educational::find($id);
                       $eduction->level = $request->educational_level;
                       $eduction->user_id =$user->id;
                       $eduction->save();
                   $edupoint=5;
      
               }
       
       
       
               $countcoins=['name'=>$request['first_name'],
               'email'=>$request['email'],
               'password' => bcrypt($request['password']),
               'last_name'=>$request['last_name'],
               'phone_number'=>$request['phone_number'],
               'religion_id'=>$request['religion_id'],
               'birthdate'=>$request['birthdate'],
               'visa_type'=>$request['visa_type'],
               'visa_expire_date'=>$request['visa_expire_date'],
               'job_id'=>$request['job_id'],
               'industry_id'=>$request['industry_id'],
               'country_id'=>$request['country_id'],
               'gender'=>$request['gender'],
               'martial_status'=>$request['martial_status'],
               'descripe_yourself'=>$request['descripe_yourself'],
               'looking_for_job'=>$request['looking_for_job'],
               'nationality_id'=>$request['nationality_id'],
               'working_in'=>$request['working_in'],
               'start_date'=>$request['start_date'],
               'end_date'=>$request['end_date'],
               'employer_nationality_id'=>$request['employer_nationality_id'],
               'company_name'=>$request['company_name'],
               'country_id'=>$request['work_country_id'],
               'salary'=>$request['salary'],
               'MaxSalary'=>$request['MaxSalary'],
               'role'=>$request['role'],
               $request['prefered_location_id']
       ];
         
       foreach ( $countcoins as   $value) {
       
           if($value != null && $value !="0")
           {
       
               $points ++;
           }
       
       }
       
       $totalpoints=$points*5+$cvgpoint+$logopoint+$edupoint+$skillpoint+$videopoint+$langpoint;
     
       
                  $candinfo=CandidateInfo::find($id);
                  $candinfo->last_name = $request->last_name;
                  $candinfo->phone_number = $request->phone_number;
                  $candinfo->religion_id = $request->religion_id;
                  $candinfo->salary = $request->salary;
                  $candinfo->MaxSalary = $request->MaxSalary;
                  $candinfo->birthdate = $request->birthdate;
                  $candinfo->visa_type = $request->visa_type;
                  $candinfo->visa_expire_date = $request->visa_expire_date;
                  $candinfo->job_id = $request->job_id;
                  $candinfo->industry_id = $request->industry_id;
                  $candinfo->country_id = $request->country_id;
                  $candinfo->gender = $request->gender;
                  $candinfo->CurrencyId = $request->CurrencyId;
                  $candinfo->Eductionlevel = $request->Eductionlevel;
                  $candinfo->martial_status = $request->martial_status;
                  $candinfo->descripe_yourself = $request->descripe_yourself;
                  $candinfo->looking_for_job = $request->looking_for_job;
                  $candinfo->nationality_id = $request->nationality_id;
                 
                  $candinfo->user_id =$user->id;
                  $candinfo->coins = $totalpoints;
                
                 $candinfo->save();
            
                 return redirect('/home');
            
        }    
        catch(Exception $e) 
            {
             return redirect('/');
             }
         }



            //save video
            public function saveFile($file, $user)
            {
                try
                {
                    $filename = 'video'.time().$file->getClientOriginalName();
                    $type = $file->getMimeType();
                    $extension = $file->getClientOriginalExtension();
                    $path = 'videos/'.$user->id;
                    $destPath = 'videos/'.$user->id.'/'.$filename;
                    if(!\File::exists($path)) {
                        // path does not exist
                        \File::makeDirectory($path, $mode = 0777, true, true);
                    }
                    $success =$file->move($path,$filename);
                    return $destPath;
                }
                catch(Exception $e) 
    
                {
    
                return redirect('/');
    
                }
            }
        


            //save uploaded video
            public function saveUploadedFile($file, $user)
            {
                try
                {
                    $filename = time().$file->getClientOriginalName();
                    $type = $file->getMimeType();
                    $extension = $file->getClientOriginalExtension();
                    $path = 'uploads/'.$user->id;
                    $destPath = 'uploads/'.$user->id.'/'.$filename;
                    if(!\File::exists($path)) {
                        // path does not exist
                        \File::makeDirectory($path, $mode = 0777, true, true);
                    }
                    $success =$file->move($path,$filename);
                    return $destPath;
                }
                catch(Exception $e) 
    
                {
    
                return redirect('/');
    
                }
            }
        

        
            //update image
            public function  updateimage( Request $request)
        
             {
                 try
                 {
                  
                    $file = $request['file'];
                        
                    $images = $request->file('images');
                    
            
                        $id =  $request->get('id');
            
                    $imageName = $images->getClientOriginalName();
            
            
                            $path=("upload/imgageslogo").$imageName;
                        
                        // notation octale : valeur du mode correcte
                            
            
                            if (!file_exists($path)) {
                            $images->move(("upload/imgageslogo"),$imageName);
                            
                            $q =User::join('candidate_infos','candidate_infos.user_id','users.id')->where('candidate_infos.id', $id)
                            ->select('users.id AS UID','users.logo')->first();
                        
            
            if ($q)
            {
                $user = User::find($q->UID);
            
            
                $user->logo = "upload/imgageslogo/".$imageName;
            
                $user->save();
                
            }
                            }
                            else
                            {
                            $random_string = md5(microtime());
                            $images->move(public_path("upload/imgageslogo"),$random_string.".jpg");
                            
                                $q =User::join('candidate_infos','candidate_infos.user_id','users.id')->where('candidate_infos.id', $id) ->select('users.id AS UID','users.logo')->first();
                                                
                            if ($q)
                            {
                                $user = User::find($q->UID);
                            
                            
                                $user->logo = "/upload/imgageslogo/".$random_string.".jpg";
                            
                                $user->save();
                                
                            }
                            
                            }
                        }
                        catch(Exception $e) 
            
                        {
            
                        return redirect('/');
            
                        }
                }
        
        

                //edit video
                public function EditStoreVideo(request $request)
                {
                     try
                {
                    $blobInput = $request->file('data');
        
                    $VideoName =  $request->get('name');
                    $id=$request->get('id');
        
                    $path=("upload/video").$VideoName;
                    if (!file_exists($path)) {
                    $random_string = md5(microtime());
        
                    $blobInput->move(("upload/video"),$VideoName);
                   $q= CandidateInfo::
                where('id', $id)  // find your user by their email
                ->limit(1)  // optional - to ensure only one record is updated.
                ->update(array('vedio_path' => "/upload/video/".$VideoName));
                    }
                    else
                    {
                    $random_string = md5(microtime());
                    $blobInput->move(public_path("/upload/video"),$random_string.".webm");
        
                       $q= CandidateInfo::
                where('id', $id)  // find your user by their email
                ->limit(1)  // optional - to ensure only one record is updated.
                ->update(array('vedio_path' => "/upload/video/".$random_string.".webm "));
        
                   
                    }
                }    
            catch(Exception $e) 
                {
                   return redirect('/home');
                } 
                }
        
        
        

                //edit uploaded video
                public function EditUploadVideo(request $request)
                {
                  try
                  {
                  
                            $blobInput = $request->file('video');
                        
                        
                            $id=$request->get('id');
                        
                        $VideoName= $blobInput->getClientOriginalName();
                
                            $path=("upload/video").$VideoName;
                            if (!file_exists($path)) {
                            $random_string = md5(microtime());
                            $blobInput->move(("upload/video"),$VideoName);
                        $q= CandidateInfo::
                        where('id', $id)  // find your user by their email
                        ->limit(1)  // optional - to ensure only one record is updated.
                        ->update(array('vedio_path' => "upload/video/".$VideoName));
                            }
                            else
                            {
                            $random_string = md5(microtime());
                            $blobInput->move(("upload/video"),$random_string.".webm");
                
                            $q= CandidateInfo::
                        where('id', $id)  // find your user by their email
                        ->limit(1)  // optional - to ensure only one record is updated.
                        ->update(array('vedio_path' => "upload/video/".$random_string.".webm "));
                
                        
                            }
                }    
            catch(Exception $e) 
                {
                   return redirect('/home');
                } 
                }


                //edit uploaded logo
                public function EditUploadlogo(request $request)
                {
                     try
                     {
                        
                            $blobInput = $request->file('logo');
                        
                        
                            $id=$request->get('id');
                        
                        $VideoName= $blobInput->getClientOriginalName();
                
                            $path=("upload/logo").$VideoName;
                            if (!file_exists($path)) {
                            $random_string = md5(microtime());
                            $blobInput->move(("upload/logo"),$VideoName);
                        $q= CandidateInfo::
                        where('id', $id)  // find your user by their email
                        ->limit(1)  // optional - to ensure only one record is updated.
                        ->update(array('logo' => "upload/logo/".$VideoName));
                            }
                            else
                            {
                            $random_string = md5(microtime());
                            $blobInput->move(("upload/logo"),$random_string.".webm");
                
                            $q= CandidateInfo::
                        where('id', $id)  // find your user by their email
                        ->limit(1)  // optional - to ensure only one record is updated.
                        ->update(array('logo' => "upload/logo/".$random_string.".webm "));
                
                        
                            }
                }    
            catch(Exception $e) 
                {
                   return redirect('/home');
                } 
                }
        }
       
       
    
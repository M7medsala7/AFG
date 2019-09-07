<?php
namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use App\User;
use App\CandidateInfo;
use App\SuccessStories;
use Illuminate\Http\Request;
use App\Country;
use App\City;
use App\EmployerProfile;
use DB;

class ClientController extends Controller
{
   public function SharedClient() 
    {
  //All

      $all= DB::table('SharedClient')
            ->where('Client_id',\Auth::user()->id)
            ->where('SharedClient.seen',1)
            ->count();

        $Shortlisted= DB::table('SharedClient')
        ->where('Client_id',\Auth::user()->id)
        ->where('ClientStatus','=','Shortlisted')
         ->where('SharedClient.seen',1)
        ->count();

        $Rejected= DB::table('SharedClient')
        ->where('Client_id',\Auth::user()->id)
         ->where('SharedClient.seen',1)
        ->where('ClientStatus','=','Rejected')
        ->count();

        $Interview= DB::table('SharedClient')
         ->where('SharedClient.seen',1)
        ->where('Client_id',\Auth::user()->id)
        ->where('ClientStatus','=','Interview')
        ->count();

     
        $ReferenceCheck= DB::table('SharedClient')
         ->where('SharedClient.seen',1)
        ->where('Client_id',\Auth::user()->id)
        ->where('ClientStatus','=','Reference Check')
        ->count();
$SalaryFinalization= DB::table('SharedClient')
 ->where('SharedClient.seen',1)
        ->where('Client_id',\Auth::user()->id)
        ->where('ClientStatus','=','Salary Finalization')
        ->count();
$SendItegration= DB::table('SharedClient')
 ->where('SharedClient.seen',1)
            ->where('Client_id',\Auth::user()->id)
            ->where('ClientStatus','=','Send to Itegration')
            ->count();
       $data =CandidateInfo::join('SharedClient','SharedClient.Can_id','candidate_infos.user_id')
                     ->where('Client_id',\Auth::user()->id)
                      ->where('SharedClient.seen',1)
                     ->select('*')
                     ->get();

                     return view('Client.SharedClient',compact('data','all','Shortlisted','Rejected','Interview','ReferenceCheck','SalaryFinalization','SendItegration'));


    }
    public function saveUploadedFile($file, $user){
        $filename = time().$file->getClientOriginalName();
        $type = $file->getMimeType();
        $extension = $file->getClientOriginalExtension();
        $path = 'uploads/'.$user->id;
        $destPath ='uploads/'.$user->id.'/'.$filename;
        if(!\File::exists($path)) {
            // path does not exist
            \File::makeDirectory($path, $mode = 0777, true, true);
        }
        $success =$file->move($path,$filename);
       // $destPath = str_replace( $destPath);
        return $destPath;
    }
 
    public function clientStore(Request $request)
    {
    try
    {

        $code = 1000;
        $points=0;
        $countcoins=['name'=>$request['name'],
        'email'=>$request['email'],
        'password' => bcrypt($request['password']),
        'last_name'=>$request['name'],
        'country_id'=>$request['country_id'],
        'city_id'=>$request['city_id'],
        'type'=>'employer',   
        ];
        foreach ( $countcoins as   $value) 
        {
            if($value != null && $value !="0")
            {
             $points ++;
            }
        }
    $totalpoints=$points*5;
    $country=$request['country_id'];
    $city=$request['city_id'];
    $countryQuery=Country::where('name',$country)->first();

  if( $countryQuery== null)
  {
    $location = New Country;
    $location->name =$request['country_id'];
    $location->save();
  }

   $countryQueryCityID=Country::where('name',$country)->first();
   $citynam = New City;
   $citynam->name =$city;
   $citynam->country_id=$countryQueryCityID->id;
   $citynam->save();


   $cityQuery=City::where('name',$city)->first();
        //get the code value;
        $lastUser =  \DB::table('users')->orderBy('id', 'desc')->first();
        if($lastUser)
        {
            $code = $lastUser->code++;
        }
    //*code generated*/

    //**create user
        $user = User::create(['name'=>$request['name'],
        'email'=>$request['email'],'password' => bcrypt($request['password']),
        'type'=>'client','code'=>$code]);
    //**user created
        $input = $request->all();
        if($user)
        {
            $EmployerProfile=EmployerProfile::where('user_id',\Auth::user()->id)->first();  
            $emptype= EmployerProfile::create(['city_id'=>$cityQuery->id,
            'type'=>'employer','first_name'=>$request['name'],
            'last_name'=>$request['name'],'country_id'=>$countryQueryCityID->id,
            'user_id'=>$user->id,'Agency_ID'=>\Auth::user()->id,'phone'=>$EmployerProfile->phone,'coins'=>$totalpoints]);
        }
        if($request->hasFile('logo'))
        {
            $logo = $this->saveUploadedFile($request['logo'],$user);
            $user->logo=$logo;
            $user->save();
            $logopoint=10;
        }
     \App\Company::create(['name'=>$request['name'],'size'=>'5','Country_id'=>$countryQueryCityID->id,'lat'=>'0','lang'=>'0','Created_by'=>$user->id,'industry_id'=>'0']);
        // $user->notify(new AddEmployer($emptype));
        //Sending Mail after adding
         $data=array('Email'=>$request['email']);
         // Mail::send('emails.NewJob', $data, function($message) use ($data) {
         // $message->to('Social@maidandhelper.com');
         // $message->subject('new job is added ');
 
       //  });
        //Sending Mail after regestration
        $data=array('Email'=>$request['email']);
        // Mail::send('emails.RegestrationSucess', $data, function($message) use ($data) {
        // $message->to($data['Email']);
        // $message->subject('registeration completed');
        // });
         return redirect('/clients');     
          }    
    catch(Exception $e) 
        {
         return redirect('/');
         }  
    }
  public function clientShow () {
        $data=[];
        $allclient=EmployerProfile::
         where('Agency_ID',\Auth::user()->id)
        ->where('DeletedByAgency',0)
        ->get();
       
        foreach($allclient as $value)
        {

            $Shortlisted= DB::table('SharedClient')
            ->where('Client_id',$value->user_id)
            ->where('ClientStatus','=','Shortlisted')
            ->count();

            $Rejected= DB::table('SharedClient')
            ->where('Client_id',$value->user_id)
            ->where('ClientStatus','=','Rejected')
            ->count();

            $Interview= DB::table('SharedClient')
            ->where('Client_id',$value->user_id)
            ->where('ClientStatus','=','Interview')
            ->count();

         
            $ReferenceCheck= DB::table('SharedClient')
            ->where('Client_id',$value->user_id)
            ->where('ClientStatus','=','Reference Check')
            ->count();
$SalaryFinalization= DB::table('SharedClient')
            ->where('Client_id',$value->user_id)
            ->where('ClientStatus','=','Salary Finalization')
            ->count();
$SendItegration= DB::table('SharedClient')
                ->where('Client_id',$value->user_id)
                ->where('ClientStatus','=','Send to Itegration')
                ->count();

          //country name
            $country=Country::where('id',$value->country_id)->first();
            $city=City::where('id',$value->city_id)->first();

            //city name
            //image for client
            $image=User::where('id',$value->user_id)->first();

            
            array_push($data,array(
            'name'=>$value->first_name,
            'user_id'=>$value->user_id,
            'country'=>$country->name,
            'city'=>$city->name,
            'Shortlisted'=>$Shortlisted,
            'Interview'=>$Interview,
            'Rejected'=>$Rejected,

            'ReferenceCheck'=>$ReferenceCheck,
            'SendItegration'=>$SendItegration,
            'SalaryFinalization'=>$SalaryFinalization,
            'image'=>$image->logo

            ));
  
        }


  return view('Client.client',compact('data'));
    }
    
    public function  updatestatusagency(Request $request)
    {


            $update = \DB::table('SharedClient')
            ->where('Client_id', $request->Client_id)
            ->where('Agency_id',\Auth::user()->id)
            ->where('Can_id',$request->userid) ->limit(1)
            ->update( ['AgencyStatus' => $request->status,
            'CommentAgency' => $request->comment]); 

        return redirect()->back()->with('success', 'Status Updated'); 
    }
  public function  updatestatusclient(Request $request)
    {


            $update = \DB::table('SharedClient')
            ->where('Agency_id', $request->agenid)
            ->where('Client_id',\Auth::user()->id)
            ->where('Can_id',$request->userid) ->limit(1)
            ->update( [ 'ClientStatus' => $request->status,
            'CommentClient' => $request->comment]); 

        return redirect()->back()->with('success', 'Status Updated'); 
    }
 public function clientcontroll($id)
    {
      //All 
      $all= DB::table('SharedClient')
            ->where('Client_id',$id)
->where('SharedClient.seen',1)
            ->count();

        $Shortlisted= DB::table('SharedClient')
                    ->where('Client_id',$id)
->where('SharedClient.seen',1)
                    ->where('ClientStatus','=','Shortlisted')
                    ->count();

        $Rejected= DB::table('SharedClient')
->where('SharedClient.seen',1)
                    ->where('Client_id',$id)
                    ->where('ClientStatus','=','Rejected')
->where('SharedClient.seen',1)
                    ->count();

        $Interview= DB::table('SharedClient')
                    ->where('Client_id',$id)
->where('SharedClient.seen',1)
                    ->where('ClientStatus','=','Interview')
                    ->count();
        $ReferenceCheck= DB::table('SharedClient')
                    ->where('Client_id',$id)
->where('SharedClient.seen',1)
                    ->where('ClientStatus','=','Reference Check')
                    ->count();
        $SalaryFinalization= DB::table('SharedClient')
->where('SharedClient.seen',1)
                    ->where('Client_id',$id)
                    ->where('ClientStatus','=','Salary Finalization')
                    ->count();
        $SendItegration= DB::table('SharedClient')
->where('SharedClient.seen',1)
                        ->where('Client_id',$id)
                        ->where('ClientStatus','=','Send to Itegration')
                        ->count();           


        $data =CandidateInfo::join('SharedClient','SharedClient.Can_id','candidate_infos.user_id')
        ->where('Client_id',$id)
->where('SharedClient.seen',1)
        ->select('*')
        ->get();

        $client=User::where('id',$id)->first();
       
       return view('Client.ClientStatusControll',compact('client','data','all','Shortlisted','Rejected','Interview','ReferenceCheck','SalaryFinalization','SendItegration'));
    }
 public function Candiateclient(Request $request)
    {

        if($request->status=='All')
        {
            $data =CandidateInfo::join('SharedClient','SharedClient.Can_id','candidate_infos.user_id')
            ->where('Client_id',$request->clientid)
            ->where('SharedClient.Agency_id',\Auth::user()->id)
            ->select('*')
            ->get();
        }
        else{
            $data =CandidateInfo::join('SharedClient','SharedClient.Can_id','candidate_infos.user_id')
            ->where('Client_id',$request->clientid)
            ->where('SharedClient.Agency_id',\Auth::user()->id)
            ->select('*')
            ->where('ClientStatus','=',$request->status)
            ->get(); 
        }
        $client=User::where('id',$request->clientid)->first();
       
    return view('Client.myclientpartial',compact('client','data'));
    }
    public function deletemultipleclient(Request $request)
    {
        $ids = $request->ids;
        $id=explode(",",$ids);

        $n=count($id);
        for($i=0;$i<$n;$i++)
        {
            $update = \DB::table('employer_profiles')
            ->where('user_id',$id[$i])
            ->update( [ 'DeletedByAgency' =>1]); 
        return response()->json(['status'=>true,'message'=>"Client deleted successfully."]);
        }
        
    }
 public function deletemultipleCandidatebyagency(Request $request)
    {
        $ids = $request->ids;
        $id=explode(",",$ids);

        $n=count($id);
        for($i=0;$i<$n;$i++)
        {
            $update = \DB::table('candidate_infos')
            ->where('Agency_ID',\Auth::user()->id)
            ->where('user_id',$id[$i])
            ->update(['IsDeletedAgency' =>1]); 
        }
        return response()->json(['status'=>true,'message'=>"Candidate deleted successfully."]);
        
    }

 public function deletemultiplesharedclient(Request $request)
    {
        $ids = $request->ids;
        $id=explode(",",$ids);

        $n=count($id);
        for($i=0;$i<$n;$i++)
        {
            $update = \DB::table('SharedClient')
            ->where('Client_id',\Auth::user()->id)
            ->where('Can_id',$id[$i])
            ->update(['seen' =>0]); 
        }
        return response()->json(['status'=>true,'message'=>"Client deleted successfully."]);
        
    }
public function updatemultipleclientstatus(Request $request)
    {
        $ids = $request->ids;
        $id=explode(",",$ids);
        $n=count($id);
        for($i=0;$i<$n;$i++)
        {
            $update = \DB::table('SharedClient')
            ->where('Agency_id',\Auth::user()->id)
            ->where('Client_id',$request->Client_id)
            ->where('Can_id',$id[$i]) ->limit(1)
            ->update( [ 'AgencyStatus' => $request->status,
            'CommentAgency' => $request->comment]); 

        
        }
return response()->json(['status'=>true,'message'=>"Client updated successfully."]);
        
    }


public function updatemultipleclientstatusshared(Request $request)
    {
        $ids = $request->ids;
        $id=explode(",",$ids);
        $n=count($id);
        for($i=0;$i<$n;$i++)
        {
            $update = \DB::table('SharedClient')
            ->where('Client_id',\Auth::user()->id)
           // ->where('Agency_id',$request->Client_id)
            ->where('Can_id',$id[$i]) ->limit(1)
            ->update( [ 'ClientStatus' => $request->status,
            'CommentClient' => $request->comment]); 

        
        }
return response()->json(['status'=>true,'message'=>"Client updated successfully."]);
        
    }

public function Candiateclientshsred (Request $request)
{
  
    if($request->status=='All')
    {
        $data =CandidateInfo::join('SharedClient','SharedClient.Can_id','candidate_infos.user_id')
        ->where('Client_id',\Auth::user()->id)
->where('SharedClient.seen',1)
       // ->where('SharedClient.Agency_id',\Auth::user()->id)
        ->select('*')
        ->get();
    }
    else{
        $data =CandidateInfo::join('SharedClient','SharedClient.Can_id','candidate_infos.user_id')
        ->where('Client_id',\Auth::user()->id)
->where('SharedClient.seen',1)
        //->where('SharedClient.Agency_id',\Auth::user()->id)
        ->select('*')
        ->where('ClientStatus','=',$request->status)
        ->get(); 
    }
   
return view('Client.sharedclientpartial',compact('data'));  
}

}
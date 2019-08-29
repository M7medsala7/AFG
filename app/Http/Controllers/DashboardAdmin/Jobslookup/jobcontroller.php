<?php
namespace App\Http\Controllers\DashboardAdmin\Jobslookup;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\User;
use App\Job;
class jobcontroller extends Controller
{
    public function index()
    {
      //
      $Job=Job::all();
      return view('DashbordAdminPanel.Jobslook.index',compact('Job'));  
    }
    public function deleteMultiplejob(Request $request){
      
        $ids = $request->ids;
        Job::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['status'=>true,'message'=>"Skills  delete sucessfuly"]);
    }
    public function editjob(Request $req)
    {
        try
        {
              $Skillsupdate = Job::find($req['id']);
              $Skillsupdate->name=$req['name'];
              $Skillsupdate->save();
              return redirect ('/jobsadmin');
            //  return Redirect()->back()->withFlashMessage('Updated Done');
        }
        catch(Exception $e) 
        {
        return redirect('/');
        }
    }


    public function ShowEditjob($id)
    {
        $Job=Job::where('id',$id)->first();
        //dd($skills);
        return view('DashbordAdminPanel.Jobslook.edit',compact('Job'));  
    }
    public function addjob(Request $request)
    {
        try
        {
            $Job =new Job;
            $Job->name=$request['name'];
            $Job->save();
            return redirect ('/jobsadmin');
            
        }
        catch(Exception $e) 

        {
        return redirect('/');

        }
    }
}

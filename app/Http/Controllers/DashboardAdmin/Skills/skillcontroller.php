<?php
namespace App\Http\Controllers\DashboardAdmin\Skills;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\User;
use App\Skills;
class skillcontroller extends Controller
{
    public function index()
    {
      //
      $skills=Skills::all();
      return view('DashbordAdminPanel.Skills.index',compact('skills'));  
    }
    public function deleteMultipleSkill(Request $request){
        $ids = $request->ids;
        $id=explode(",",$ids);
        $n=count($id);
        $check='';
        for($i=0;$i<$n;$i++)
        {
            $skilljob=DB::table('job_skills')->where('skill_id',$id[$i])->first();
            $skillsuser=DB::table('user_skills')->where('skill_id',$id[$i])->first();
            if($skillsuser==[] || $skillsuser==null)
            {
                if($skilljob==[] || $skilljob==null)
                {
                    Skills::where('id',$id[$i])->delete();
                    $check='1';
                }
                else
                {
                    return response()->json(['status'=>true,'message'=>"Skills cannot delete it"]); 
                }   
            }
            else
            {
                return response()->json(['status'=>true,'message'=>"Skills cannot delete it"]);
            }
        }
        if( $check=='1')
        {
            return response()->json(['status'=>true,'message'=>"Skills  delete sucessfuly"]);
        }
    }
    public function editskills(Request $req)
    {
        try
        {
              $Skillsupdate = Skills::find($req['id']);
              $Skillsupdate->name=$req['name'];
              $Skillsupdate->save();
              return redirect ('/skillsadmin');
            //  return Redirect()->back()->withFlashMessage('Updated Done');
        }
        catch(Exception $e) 
        {
        return redirect('/');
        }
    }


    public function ShowEditSkill($id)
    {
        $skills=Skills::where('id',$id)->first();
        //dd($skills);
        return view('DashbordAdminPanel.Skills.edit',compact('skills'));  
    }
    public function addskill(Request $request)
    {
        try
        {
            $Skills =new Skills;
            $Skills->name=$request['name'];
            $Skills->save();
            return redirect ('/skillsadmin');
            
        }
        catch(Exception $e) 

        {
        return redirect('/');

        }
    }
}

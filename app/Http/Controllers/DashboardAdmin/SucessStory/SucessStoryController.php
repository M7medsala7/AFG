<?php

namespace App\Http\Controllers\DashboardAdmin\SucessStory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\User;
use App\CandidateInfo;
use App\SuccessStories;
use Input;
use App\Http\Requests\AddCandidateAdminFormRequest;
use App\Http\Requests\EditCanAdminFromRequests;
use App\Requests;
use App\EmployerProfile;

use Session;
class SucessStoryController extends Controller
{
    public function index(SuccessStories $story)
    { 
      $story = $story->all();
      $candidate=User::where('type','candidate')->get();
      $employer=User::where('type','employer')->get();
      return view('DashbordAdminPanel.SucessStory.index',compact('story','candidate','employer'));
    } 
    public function deleteMultiple(Request $request){

        $ids = $request->ids;
        SuccessStories::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['status'=>true,'message'=>"Story deleted successfully."]);
        
    }
    public function addEmpStory(Request $request)
    {
      $userid=EmployerProfile::where('user_id',$request['name'][0])->first();
      if($userid !=null || $userid!=[])
     {
      $uid=$userid->id;
      // dd( $uid);
       SuccessStories::create([
         'description'=>request('description'),
         'emp_id'=>$uid,
         'approval'=>1,
         'user_id'=>$request['name'][0]]);
     }
        return Redirect('/Storyadmin');
 
    }
    public function addCanStory(Request $request)
    {
  
      $userid=CandidateInfo::where('user_id',$request['name'][0])->first();
     if($userid !=null || $userid!=[])
     {
      $uid=$userid->id;
      // dd( $uid);
       SuccessStories::create([
         'description'=>request('description'),
         'can_id'=>$uid,
         'approval'=>1,
         'user_id'=>$request['name'][0]]);
     }
        return Redirect('/Storyadmin');
    }
    public function update(Request $req) 
    {
     
      try
      {
            $storyupdate = SuccessStories::find($req['id']);
            $storyupdate->fill($req->all())->save();
            Session::flash('flash', "Updated Done");
            $Url='/showedit/'.$req['id'];
            return redirect ($Url);
          //  return Redirect()->back()->withFlashMessage('Updated Done');
      }

      catch(Exception $e) 
      {
      return redirect('/');
      }
   }

    public function edit(SuccessStories $story ,$id) 
    {
        try
        {
        $data = $story->find($id);
       return view('DashbordAdminPanel.SucessStory.edit', compact('data'));
    }

    catch(Exception $e) 
    {
    return redirect('/');
    }

    }
    public function updateStory(Request $request) 
    {
    
    try
    {
   
       $SuccessStories = SuccessStories::find($request['id']);
        $SuccessStories->approval =$request['active'];
        $SuccessStories->save();
       //]] return Redirect()->back()->withFlashMessage(' Approval Added');
    }

    catch(Exception $e) 
    {
    return redirect('/');
    }
}
}

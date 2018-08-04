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

class EditCanProfileController extends Controller
{
    public function  editFullReg(User $user, $id)
    {
       // $cans = User::find($id);
        $data = $user->find($id);
        //dd($data);
       // $cans = CandidateInfo::find($id);
        $cans=\Auth::user()->CanInfo()->first();
        //dd($cans);
        return view('auth.Edit_Candidate_reg',compact('data','cans'));
    }

    public function updateFullReg($id,Request $request)
    {
     // $user->update($request->all());
     // $userupdate = User::find($id);
      //$userupdate->fill($request->all())->save();
        $data = User::find($id);
        dd($user);
        $data->name = $request->name;
      
		$data->email = $request->email;
		$data->logo = $request->logo;

		$data->save();
        return redirect('/EditCandidate/{id}')->withFlashMessage('updated done');
    }
}

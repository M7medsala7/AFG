<?php

namespace App\Http\Controllers;
use App\User;
use App\CandidateInfo;
use Illuminate\Http\Request;

class CandidatesController extends Controller
{
    //

    public function profile($id)
    {

    	$candidate = User::find($id);
    	if(\Auth::user() !=null){
    	 $liked =\App\UserLikeCandidates::where('employer_id',\Auth::user()->id)->where('user_id',$id)->first();
    	}
    	
 $liked=null;
 $color='black';
    	if($liked !=null)
        {
            $color='red';
        }
    	if($candidate->type == "candidate")
        {
           
            
       if ($candidate->CanInfo->birthdate !=null)
        $age=$candidate->getAge($candidate->CanInfo->birthdate);
        else
        $age=" ";
  
            $simialr_candidates = CandidateInfo::where('job_id',$candidate->CanInfo->job_id)->where('country_id',$candidate->CanInfo->country_id)->where('id','!=',$candidate->CanInfo->id)->get();
            return view('candidates.profile',compact('candidate','simialr_candidates','age','color'));
        }
    	else
    		return "null";
    }

    public function EditRefrnces($id)
    {

    	$candidate = User::find($id);
    	if(\Auth::user() !=null){
    	 $liked =\App\UserLikeCandidates::where('employer_id',\Auth::user()->id)->where('user_id',$id)->first();
    	}
    	
 $liked=null;
 $color='black';
    	if($liked !=null)
        {
            $color='red';
        }
    	if($candidate->type == "candidate")
        {
           
            
       if ($candidate->CanInfo->birthdate !=null)
        $age=$candidate->getAge($candidate->CanInfo->birthdate);
        else
        $age=" ";
  
            $simialr_candidates = CandidateInfo::where('job_id',$candidate->CanInfo->job_id)->where('country_id',$candidate->CanInfo->country_id)->where('id','!=',$candidate->CanInfo->id)->get();
            return view('Arabic.Jobs.EditJobRefrnces',compact('candidate','simialr_candidates','age','color'));
        }
    	else
    		return "null";
    }

  
    public function liked(Request $request)
    {

    if(\Auth::user()==null)
        {
            return redirect('/login');
        }
     else
        {
            $liked = \App\UserLikeCandidates::where('employer_id',\Auth::user()->id)->where('user_id',$request['user_id'])->first();
            if(!$liked)
            {
            \App\UserLikeCandidates::create(['employer_id'=>\Auth::user()->id,'user_id'=>$request['user_id']]);
            return "true";
            }
            else
            {
            $liked->delete();
            return "false";
            }

        }

       
        
    }
    public function getLikes()
    {
        $topCandidates= \Auth::user()->likes->take(6);
        $html = view('employer.starred',compact('topCandidates'))->render();
        $number_of_pages = ceil(count(\Auth::user()->likes)/6);
        $urls = [];
        for ($i=1; $i <= $number_of_pages ; $i++) { 
            # code...
            array_push($urls,'/next_likes/'.\Auth::user()->likes->take(6*$i)->last()->id);
        }
        

        return [$html,$number_of_pages,$urls];
    }

    public function getNextLikes($id)
    {
        $topCandidates= \Auth::user()->likes->where('id','>',$id)->take(4);
        $html = view('employer.starred',compact('topCandidates'))->render();
        return $html;
    }
}

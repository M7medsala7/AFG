<?php
namespace App\Http\Controllers\Candidate;
use App\Http\Controllers\Controller;
use App\User;
use App\CandidateInfo;
use App\SuccessStories;
use Illuminate\Http\Request;
class CandidatesController extends Controller
{
    //Candidate profile
    public function profile($id)
    {
        try
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
        catch(Exception $e) 

        {
            return redirect('/');
        }
    }
    //likes 
    public function liked(Request $request)
    {
    try
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
    catch(Exception $e) 
    {
    return redirect('/');
    }
        
    }
    public function getLikes()
    {
       try
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
      catch(Exception $e) 
      {
        return redirect('/');
       }

    }
    //next likes
    public function getNextLikes($id)
    {
      try
      {  
        $topCandidates= \Auth::user()->likes->where('id','>',$id)->take(4);
        $html = view('employer.starred',compact('topCandidates'))->render();
        return $html;
      }
      catch(Exception $e) 
      {
      return redirect('/');
      }
    }
    //create success story form
    public function CreateSuccessStory(CandidateInfo $can ,$id)
    {
        
        $data = $can->find($id);
        return view('candidates.create_successStory' ,compact('data'));
    }
      //stor success story of candiades
    public function AddSuccessStory(Request $request, $id)
    {
        try
        {
                $userid=CandidateInfo::where('id',$id)->select('user_id')->first();
                $uid=$userid->user_id;
                SuccessStories::create([
                'description'=>request('description'),
                'can_id'=>$id,
                'user_id'=>$uid]);
                return redirect('/home');
        }
        catch(Exception $e) 
        {
        return redirect('/');
        }
          
    }
	  //edit job refernces
	public function EditRefrnces($id)
    {
       try
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
        catch(Exception $e) 
        {
         return redirect('/');
        }
    }
}

<?php

namespace App\Http\Controllers\Employer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Company;
use App\CompanyPhoto;
class companiesController extends Controller
{
    //create company profile
    public function create($id)
    {
        $company = Company::find($id);
	    return view('employer.company_profile',compact('company'));
    	
    }


    //edit candidate register
    public function create2()
    {
	    return view('auth.Edit_Candidate_reg');
    }

    public function store(Request $request)
    {

         try
            {
                $this->validate($request,[
                    'industry_id'=>'required',
                    'size'=>'required',
                    ]);
                $input  = $request->all();
                $company = \Auth::user()->company;
                if($request->hasFile('video_path'))
                {
                    $vedio_path = $this->saveFile($request['video_path'],\Auth::user());
                    $input['video_path']=$vedio_path;
                }
                $input['created_by'] = \Auth::user()->id;
                $input['name'] = \Auth::user()->name;
                $company->update($input);
                if($request->hasFile('photos'))
                {
                    foreach ($request['photos'] as $key => $photo) {
                        # code...   
                        $photo_path = $this->savePhotoFile($photo,$company);
                        CompanyPhoto::create(['company_id'=>$company->id,'photo_path'=>$photo_path]);
                    }
                }
                return redirect('/company_profile/'.$company->id);
            }
            catch(Exception $e) 
            {
            return redirect('/');
            }   

    }



    public function show($id ,Request $request)
    {
    
        $company = Company::find($id);
    	return view('employer.company_profile_show',compact('company'));
    }




    public function saveFile($file, $user)
    {

        try
        {
            $filename = 'video'.time().$file->getClientOriginalName();
            $type = $file->getMimeType();
            $extension = $file->getClientOriginalExtension();
            $path = public_path().'/videos/'.$user->id;
            $destPath = public_path().'/videos/'.$user->id.'/'.$filename;
            if(!\File::exists($path)) {
                // path does not exist
                \File::makeDirectory($path, $mode = 0777, true, true);
            }
            $success =$file->move($path,$filename);
            $destPath = str_replace(public_path(), "", $destPath);
            return $destPath;
        }
        catch(Exception $e) 

        {

        return redirect('/');

        }
    }



     public function savePhotoFile($file, $user)
     {

        try
        {

            $filename = 'picture'.time().$file->getClientOriginalName();
            $type = $file->getMimeType();
            $extension = $file->getClientOriginalExtension();
            $path = public_path().'/pictures/'.$user->id;
            $destPath = public_path().'/pictures/'.$user->id.'/'.$filename;
            if(!\File::exists($path)) {
                // path does not exist
                \File::makeDirectory($path, $mode = 0777, true, true);
            }
            $success =$file->move($path,$filename);
            $destPath = str_replace(public_path(), "", $destPath);
            return $destPath;

        }
        catch(Exception $e) 

        {

        return redirect('/');

        }
    }
}

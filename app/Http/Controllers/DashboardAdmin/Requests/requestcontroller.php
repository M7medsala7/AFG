<?php

namespace App\Http\Controllers\DashboardAdmin\Requests;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\User;
use App\CandidateInfo;
use App\PostJob;
use Input;
use App\CandidateExperience;
use App\Http\Requests\AddCandidateAdminFormRequest;
use App\Http\Requests\EditCanAdminFromRequests;
use App\Requests;
use App\Blog;
class requestcontroller extends Controller
{
    public function index()
    {
       $allrequests= Requests::orderBy('created_at','DESC')->get();
    return view('DashbordAdminPanel.Requests.index',compact('allrequests'));
    }
    public function showBlogsadmin()
    {
        $blog=Blog::all();
        return view('DashbordAdminPanel.Requests.Blog',compact('blog'));
    }
    public function showBlogsuser()
    {
        $blog=Blog::all();
        return view('CompanyInfo.Blogshow',compact('blog'));
    }
    public function EditBlog($id)
    {
        $blog=Blog::where('id',$id)->first();
        return view('DashbordAdminPanel.Requests.blogEdit',compact('blog'));
    }
    
    public function updateblog(Request $req) 
    {
     
      try
      {
            $blogupdate = Blog::find($req['id']);
            $blogupdate->name=$req['name'];
            $blogupdate->body=$req['body'];
            $images = $req->file('filename');
          
            if($images !=null)
                {
                    $imageName = $images->getClientOriginalName();
                    $path=("upload/blogs/").$imageName;
                    if (!file_exists($path)) {
                    $images->move(("upload/blogs/"),$imageName);
                    $blogupdate->image ='upload/blogs/'.$imageName;
                    }
                }
            $blogupdate->save();
            return redirect ('/Blogsadmin');
          //  return Redirect()->back()->withFlashMessage('Updated Done');
      }

      catch(Exception $e) 
      {
      return redirect('/');
      }
   }

    public function delmulblog(Request $request)
    {
        $ids = $request->ids;
        Blog::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['status'=>true,'message'=>"blog deleted successfully."]);
    }
    public function addblog(Request $request)
    {
        try
        {
            $Blog =new Blog;
            $Blog->name=$request['title'];
            $Blog->body=$request['body'];
            $images = $request->file('filename');
            if($images !=null)
                {
                    $imageName = $images->getClientOriginalName();
                    $path=("upload/blogs/").$imageName;
                    if (!file_exists($path)) {
                    $images->move(("upload/blogs/"),$imageName);
                    $Blog->image ='upload/blogs/'.$imageName;
                    }
                }
            $Blog->save();
            return redirect ('/Blogsadmin');
        }
        catch(Exception $e) 
        {
        return redirect('/');
        }
    }



    public function updatestatus($id)
    {
    $updateval=DB::table('allrequests')
    ->where('id',$id)
    ->update(['status'=>'Closed']);
    return redirect('/Requestsadmin');
    }
}
<?php

namespace App\Http\Controllers\DashboardAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\User;
use App\CandidateInfo;
use App\PostJob;
use Input;
class loginController extends Controller
{
 
    public function login(Request $request)
    {
        if($request['email']=="admin@maidandhelper.com" && $request['pass']=="asdasd123")
        {
            return view('DashbordAdminPanel.layout.master');
        }
        else{
          //  dd("fvrev");
            return redirect('/adminmaster');
        }
     
    }
}
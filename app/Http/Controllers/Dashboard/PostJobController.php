<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class PostJobController extends Controller
{
	 public function index()
    { 
          
      return view('Dashboardadmin.Postjob.index');
    }
    
    
}
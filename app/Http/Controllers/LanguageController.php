<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App;
use Lang;
use Session;
use Config;
class LanguageController extends Controller
{
    public function changelanguage(Request $request)
    { 
      if($request->ajax())
      {
          
          Session::put('locale',$request->locale);
          if($request->locale == "en"){
             App::setlocale('en');
             return 1;
          }
          else if($request->locale == "ar"){
            
             App::setlocale('ar');
             return 1;
          }
         
         
         
      }

    }


}

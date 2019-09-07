<?php

namespace App\Http\Middleware;
use Closure, Session, Auth,Config;
use App;
use Illuminate\Foundation\Http\Middleware\Language as Middleware;

class Language 
{
    public function handle($request, Closure $next)
    {
                    
          if(!Session::has('locale'))
        {
          if($request->locale == "en"){
             App::setlocale('en');
           
          }
          else if($request->locale == "ar"){
            
             App::setlocale('ar');
             //return 1;
          }
        }
        else{
          $locale='en';
        }
       
         return $next($request);
    }
}

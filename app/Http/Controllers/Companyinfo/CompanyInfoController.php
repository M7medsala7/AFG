<?php

namespace App\Http\Controllers\Companyinfo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\User;
use App\CandidateInfo;
use App\PostJob;
use Input;
class CompanyInfoController extends Controller
{
  
    public function fn_sendmail()
    {
      try
      {
            
          $data = array(
                
                'Email' => input::get('email'),

          );
      
              \Mail::send('emails.RegestrationSucess', $data, function($message) use ($data) {
            $message->to('doaa.elgheny88@hotmail.com');
          $message->subject('Contactus');

          });
          
        }
        catch(Exception $e) 

        {

        return redirect('/');

        }
          
    }

   	
}

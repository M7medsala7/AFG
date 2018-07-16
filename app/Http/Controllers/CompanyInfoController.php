<?php

namespace App\Http\Controllers\CompanyInfo;

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
      $data = array(
            
            
            'Email' => input::get('email'),

      );
      // dd($data);
  


          \Mail::send('emails.RegestrationSucess', $data, function($message) use ($data) {
        $message->to('doaa.elgheny88@hotmail.com');
       $message->subject('Contactus');

      });
          
    }

   	
}

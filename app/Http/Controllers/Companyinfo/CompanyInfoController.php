<?php

namespace App\Http\Controllers\Companyinfo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use App\User;
use App\CandidateInfo;
use App\PostJob;
use Input;
use Mail;
use App\Requests;
use Session;
class CompanyInfoController extends Controller
{
    public function sendyourrequest(Request $request)
    {
        try
        {   $Requests =new Requests;
            $Requests->name=$request['name'];
            $Requests->email=$request['email'];
            $Requests->phone=$request['phone'];
            $Requests->message=$request['message'];
            $Requests->status='open';
            $Requests->save();
            $data=array('Email'=>$request['email']);
            Mail::send('emails.Requests', $data, function($message) use ($data) {
            $message->to('Social@maidandhelper.com');
            $message->subject('new Requests');
            });

            //
            Session::flash('flash_message', "your request has been sent ,thank you");
            return redirect ('/Requests');
            //بعد ما اسيف ارسل الايميل 

            
            
            //بعد ما اسيف ارسل الايميل 

            
        }
        catch(Exception $e) 

        {
        return redirect('/');

        }

    }
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

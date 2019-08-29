<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditCanAdminFromRequests extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        return [
        	  
            'Name'=>'required',
            'email' => 'email|required|unique:users' .$this->id.',id',
            
            
           'password'=>'required',
           'phone_number'=>'required',
           'visa_type'=>'required',
           'Nationality'=>'required',
           
            'gender' =>'required',
            'visa_type'=>'required',
            'looking_for_job'=>'required',
           
        ];
    }

      public function messages()
    {
        return [
        	  
          'looking_for_job.required' => 'This is Required',
          'visa_type.required' => 'The Visa type is Required',
           'nationality_id.required' => 'The Nationality is Required',
            
        ];
    }
}

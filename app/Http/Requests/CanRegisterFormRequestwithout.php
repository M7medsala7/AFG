<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CanRegisterFormRequestwithout extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
        	  
         'job_id' => 'required',
            'industry_id'=>'required',
            'Fullname'=>'required',
        // 'asd'=>'required|email|unique:users',
            'password'=>'required',
            'country_id'=>'required',
            'phone'=>'required',
            'nationality_id'=>'required',
            'logo'=>'required',
            
        ];
    }

      public function messages()
    {
        return [
        	  
          'job_id.required' => 'The Job Is Required',
          'industry_id.required' => 'The Industry Is Required',
          'country_id.required' => 'The Country Is Required',
          'nationality_id.required' => 'The Natinality Is Required',
            'logo.required' => 'Your picture is required',
        ];
    }
}

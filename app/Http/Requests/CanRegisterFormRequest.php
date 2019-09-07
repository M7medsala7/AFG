<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CanRegisterFormRequest extends FormRequest
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
            'name'=>'required',
            'gender' =>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required',
            'country_id'=>'required',
        ];
    }

      public function messages()
    {
        return [
        	  
          'job_id.required' => 'The Job Is Required',
          'industry_id.required' => 'The Industry Is Required',
          'country_id.required' => 'The Country Is Required',
            
        ];
    }
}

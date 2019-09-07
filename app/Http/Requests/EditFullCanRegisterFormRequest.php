<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditFullCanRegisterFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
        	  
            'first_name'=>'required',
            'email'=>'required:email', Rule::unique('users')->ignore($this->id),
            
            
           'password'=>'required',
           'phone_number'=>'required',
           'visa_type'=>'required',
           'nationality_id'=>'required',
           
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

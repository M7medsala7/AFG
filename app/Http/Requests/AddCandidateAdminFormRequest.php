<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCandidateAdminFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
        	  
            'job' => 'required',
            'industry'=>'required',
            'name'=>'required',
            'gender' =>'required',
            'nationality'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required',
            'country'=>'required',
        ];
    }

      public function messages()
    {
        return [
        	  
          'job.required' => 'The Job Is Required',
          'industry.required' => 'The Industry Is Required',
          'country.required' => 'The Country Is Required',
            
        ];
    }
}

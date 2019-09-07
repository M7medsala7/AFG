<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddPostJobFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
        	  
            'job_id'=>'required',
           'industry_id'=>'required',
           'country_id'=>'required',
           
            
            
      
        ];
    }

      public function messages()
    {
        return [
        	  
          'job_id.required' => 'The Job is Required',
          'industry_id.required' => 'The Industry is Required',
        'country_id.required' => 'The Job Location is Required',
            
        ];
    }
}

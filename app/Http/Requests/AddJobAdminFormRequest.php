<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddJobAdminFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        return [
         
          'job' => 'required',
            'country'=>'required',
            'job_descripton'=>'required',
            'company_name'=>'required',
            'phone'=>'required|numeric',
            
            'email'=>'required|email|unique:users',
            'password'=>'required',
        ];
    }

    
}

<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        return [
         
          'job_id' => 'required',
            'country_id'=>'required',
            'job_descripton'=>'required',
            'name'=>'required',
            'phone'=>'required|numeric',
            'num_of_candidates'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required',
        ];
    }

    
}

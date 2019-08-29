<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditJobAdminFromRequests extends FormRequest

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
            'company_name'=>'required',
             'email'=>'required|email|unique:users'.$this->id.',id',
            'password'=>'required',
        ];
    }

    
}

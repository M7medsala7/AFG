<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditEmployerAdminFromRequests extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        return [
         
          'Name' => 'required',
          'Last_Name'=>'required',
           
            
         
            
            'email'=>'required|email|unique:users'.$this->id.',id',


            'password'=>'required',
        ];
    }

    
}

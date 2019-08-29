<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddEmployerAdminFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        return [
         
          'First_Name' => 'required',
          'Last_Name'=>'required',
           
            
         
            
            'email'=>'required|email|unique:users',


            'password'=>'required',
        ];
    }

    
}

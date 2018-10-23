<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpRegisterFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        return [
         
          'first_name' => 'required',
          'last_name'=>'required',
            'country_id'=>'required',
            'city_id'=>'required',
            
         
            
            'email'=>'required|email|unique:users|confirmed',


            'password'=>'required',
        ];
    }

    
}

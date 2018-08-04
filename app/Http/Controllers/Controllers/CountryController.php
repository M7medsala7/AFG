<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\City;
class CountryController extends Controller
{
    //
    public function  getCities($id)
    {
    	return City::where('country_id',$id)->get();
    }
}

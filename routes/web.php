<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'Home\IndexController@index');
Route::get('/country', 'Home\IndexController@CountryName');
Route::get('/MatchingCandidates', 'Home\IndexController@index2');
Route::get('/getNotify', 'HomeController@getNotify');
Route::get('/point', 'HomeController@reg');
Route::get('/full_register/candidate/{id}','EditCanProfileController@editFullReg');
Route::post('/update_register/candidate/{id}','EditCanProfileController@updateFullReg');

Route::group(['middleware' => 'guest'], function () {
    Route::post('/registeremployer', '\App\Http\Controllers\Auth\RegisterController@emplyReg');
	Route::post('/registercandidate', '\App\Http\Controllers\Auth\RegisterController@candReg');
	Route::get('/register/type','Auth\RegisterController@empFullRegType');
	Route::get('/f_register/employeer','Auth\RegisterController@empFullReg');
	Route::post('/f_reg/employer','Auth\RegisterController@f_reg_emp');
	Route::get('/f_register/candidate','Auth\RegisterController@candFullReg');
	//Route::get('/full_register/candidate','HomeController@editFullReg');
	Route::post('/f_reg/candidate','Auth\RegisterController@f_reg_cand');

	Route::get('/signup', function () {
	    return view('auth.signup');
	});
	Route::get('/register/employeer', function () {
	    return view('auth.employer_type');
	});
	Route::get('/register/candidates', function () {
	    return view('auth.candidate_register');
	});
	Route::get('/register/employer', function () {

	    return view('auth.employer_register');
	});
	Route::get('/congrats', function () {

	    return view('auth.congratulation');
	});
	
	Route::get('/getCities/{id}','CountryController@getCities');

});
Route::any('/StoreVideo', '\App\Http\Controllers\Auth\RegisterController@StoreVideo');
Route::get('/getNextTopCandidates/{id?}','HomeController@getNextTopCandidates');
Route::get('/getNextJobCandidates/{id?}','HomeController@getNextJobCandidates');


Auth::routes();
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/EditJobRef', 'HomeController@EditJobRef');
Route::get('//MatchingJobs', 'HomeController@MatchingJobs');
//Route::get('/home3', 'HomeController@CanadatiesDashboard3');

Route::get('/company_profile/edit/{id}', 'companiesController@create');
//Route::get('/company_profile/edit', 'companiesController@create2');
Route::get('/company_profile/{id}', 'companiesController@show');

//***************************Employer Regestration Facebook and google*************************

Route::get('/auth/facebook/{id}','\App\Http\Controllers\Auth\RegisterController@redirectToProvider')->name('login.facebook');
Route::get('/facebook/callback','\App\Http\Controllers\Auth\RegisterController@handleProvider');
Route::get('/auth/google/{id}','\App\Http\Controllers\Auth\RegisterController@redirectToProviderGoogle')->name('login.google');
Route::get('/google/callback','\App\Http\Controllers\Auth\RegisterController@handleProviderGooglr');

Route::get('/auth/twitter/{id}','\App\Http\Controllers\Auth\RegisterController@redirectToProvidertwitter')->name('login.twitter');
Route::get('/twitter/callback','\App\Http\Controllers\Auth\RegisterController@handleProvidertwitter');

/*************************************************************************/


/*********
**Search**
**********/
Route::get('/search','Home\IndexController@search');
Route::any('/filtersearch', 'Home\IndexController@filtersearch');

/***********************************Admin routes**************************************/
Route::get('/PostJob','\App\Http\Controllers\Dashboard\PostJobController@index');
Route::get('/getjobsbycountry','HomeController@getjobsbycountry');
Route::get('/fregister/candidate','\App\Http\Controllers\Dashboard\CandidatesController@index');
Route::post('/fregcand','\App\Http\Controllers\Dashboard\CandidatesController@fregcand');
////eidtindasboardcandidate
Route::any('/updateimage', '\App\Http\Controllers\Dashboard\CandidatesController@updateimage');
Route::any('/EditStoreVideo', '\App\Http\Controllers\Dashboard\CandidatesController@EditStoreVideo');
Route::any('/EditUploadVideo', '\App\Http\Controllers\Dashboard\CandidatesController@EditUploadVideo');


/*************************************************************************/
Route::group(['middleware'=>'auth'],function(){
	Route::get('/addPostJob','JobPostController@create');
	Route::post('/postJob/store','JobPostController@store');
	Route::get('/getCandidatesStaredJob','JobPostController@getCandidatedStarredJob');
	Route::get('/next_can/{id}','JobPostController@getNextCan');
	Route::get('/getApplicants','JobPostController@getApplicants');
	Route::get('/next_applicants/{id}','JobPostController@getNextApplicants');
	Route::post('/likeCandidate','CandidatesController@liked');
	Route::get('/getLikes','CandidatesController@getLikes');
	Route::get('/next_likes/{id}','CandidatesController@getNextLikes');
	Route::post('/company_store', 'companiesController@store');

});
Route::get('/candidate2/{id}','CandidatesController@profile2');
Route::get('/candidate/{id}','CandidatesController@profile');
Route::get('/EditCandidate/{id}','CandidatesController@EditRefrnces');
Route::get('/ViewJob/{id}','JobPostController@ViewJob');

Route::get('/ApplyJob/{id}','JobPostController@ApplyJob');
Route::get('/ApplyOk','JobPostController@ApplyOk');
Route::get('/likejob/{id}','JobPostController@likejob');
//


/*************************************************************************/


Route::get('/contact', function () {
    return view('Arabic.CompanyInfo.contact');
});

Route::get('/aboutus', function () {
    return view('Arabic.CompanyInfo.aboutus');
}); 
Route::post('/sendemail', 'CompanyInfoController@fn_sendmail')->name('sendemail');


/************************chartempolyerdashboard*************************************************/

Route::any('/logoutandregister','JobPostController@logoutandregister');
Route::post('/empolyerCount','JobPostController@empolyerCount');

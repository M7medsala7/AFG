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

//************************************Candaties*********************  */
Route::get('/candidate2/{id}','Candidates\CandidatesController@profile2');
Route::get('/candidate/{id}','Candidates\CandidatesController@profile');
Route::get('/EditCandidate/{id}','Candidates\CandidatesController@EditRefrnces');
Route::get('/full_register/candidate/{id}/edit','Candidates\EditCanProfileController@edit');
Route::post('/update_register/candidate/{id}','Candidates\EditCanProfileController@updateFullReg');
Route::any('/StoreVideo', '\App\Http\Controllers\Auth\RegisterController@StoreVideo');
Route::get('/getNextTopCandidates/{id?}','HomeController@getNextTopCandidates');
Route::get('/getNextJobCandidates/{id?}','HomeController@getNextJobCandidates');
//************************************Employers*********************  */
Route::get('/company_profile/edit/{id}', 'Employer\companiesController@create');
Route::get('/company_profile/{id}', 'Employer\companiesController@show');
//*/chartempolyerdashboard
Route::any('/logoutandregister','JobPostController@logoutandregister');
Route::post('/empolyerCount','JobPostController@empolyerCount');
//Employer Regestration Facebook and google
Route::get('/auth/facebook/{id}','\App\Http\Controllers\Auth\RegisterController@redirectToProvider')->name('login.facebook');
Route::get('/facebook/callback','\App\Http\Controllers\Auth\RegisterController@handleProvider');
Route::get('/auth/google/{id}','\App\Http\Controllers\Auth\RegisterController@redirectToProviderGoogle')->name('login.google');
Route::get('/google/callback','\App\Http\Controllers\Auth\RegisterController@handleProviderGooglr');
Route::get('/auth/twitter/{id}','\App\Http\Controllers\Auth\RegisterController@redirectToProvidertwitter')->name('login.twitter');
Route::get('/twitter/callback','\App\Http\Controllers\Auth\RegisterController@handleProvidertwitter');

//************************************Postjob*********************  */
Route::get('/ViewJob/{id}','PostJob\JobPostController@ViewJob');
Route::get('/ApplyJob/{id}','PostJob\JobPostController@ApplyJob');
Route::get('/ApplyOk','PostJob\JobPostController@ApplyOk');
Route::get('/likejob/{id}','PostJob\JobPostController@likejob');
Route::get('/EditJobRef', 'HomeController@EditJobRef');
Route::get('//MatchingJobs', 'HomeController@MatchingJobs');
//************************************Payment*********************  */
Route::get('/Payment', function ()
    {
	    return view('employer.Payment');
	});
/*****************************Company Info********************************************/
Route::get('/contact', function () {
    return view('CompanyInfo.contact');
});
Route::get('/aboutus', function () {
    return view('Arabic.CompanyInfo.aboutus');
}); 
Route::post('/sendemail', 'CompanyInfoController@fn_sendmail')->name('sendemail');

/*****************************Search and Home********************************************/
Route::get('/search','Home\IndexController@search');
Route::any('/filtersearch', 'Home\IndexController@filtersearch');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/home', 'HomeController@index')->name('home');
/*****************************Videochat********************************************/
Route::get('/videochat', function ()
 {
	return view('Video.videochat');
 });
//**********************************Auth Routes**********////////////////////////////////////
Route::get('/', 'Home\IndexController@index');
Route::get('/country', 'Home\IndexController@CountryName');
Route::get('/MatchingCandidates', 'Home\IndexController@MatchingCandidates');
Route::get('/getNotify', 'HomeController@getNotify');
Route::get('/point', 'HomeController@reg');
Route::group(['middleware' => 'guest'], function () {
    Route::post('/registeremployer', '\App\Http\Controllers\Auth\RegisterController@emplyReg');
	Route::post('/registercandidate', '\App\Http\Controllers\Auth\RegisterController@candReg');
	Route::get('/register/type','Auth\RegisterController@empFullRegType');
	Route::get('/f_register/employeer','Auth\RegisterController@empFullReg');
	Route::post('/f_reg/employer','Auth\RegisterController@f_reg_emp');
	Route::get('/f_register/candidate','Auth\RegisterController@candFullReg');
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
Auth::routes();
/*************************************************************************/
Route::group(['middleware'=>'auth'],function(){
	Route::get('/addPostJob','PostJob\JobPostController@create');
	Route::post('/postJob/store','PostJob\JobPostController@store');
	Route::get('/getCandidatesStaredJob','PostJob\JobPostController@getCandidatedStarredJob');
	Route::get('/next_can/{id}','PostJob\JobPostController@getNextCan');
	Route::get('/getApplicants','PostJob\JobPostController@getApplicants');
	Route::get('/next_applicants/{id}','PostJob\JobPostController@getNextApplicants');
	Route::post('/likeCandidate','Candidates\CandidatesController@liked');
	Route::get('/getLikes','Candidates\CandidatesController@getLikes');
	Route::get('/next_likes/{id}','Candidates\CandidatesController@getNextLikes');
	Route::post('/company_store', 'Employer\companiesController@store');

});


/***********************************Admin Dashboard routes**************************************/
/***employer */
Route::resource('/adminpanel/employer', '\App\Http\Controllers\Dashboard\Employers\EmployerController');
Route::get('/adminpanel/employer/{id}/delete', '\App\Http\Controllers\Dashboard\Employers\EmployerController@destroy');
Route::get('/adminpanel/employer/create','\App\Http\Controllers\Dashboard\Employers\EmployerController@CreateEmployer');
Route::post('/adminpanel/employer/stor','\App\Http\Controllers\Dashboard\Employers\EmployerController@add');
Route::post('/adminpanel/employer/update/{id}', '\App\Http\Controllers\Dashboard\Employers\EmployerController@update');
Route::post('/adminpanel/employer/search', '\App\Http\Controllers\Dashboard\Employers\EmployerController@search');
Route::post('/adminpanel/deleteid', '\App\Http\Controllers\Dashboard\Employers\EmployerController@deleteid');
/******candidate */
Route::get('/adminpanel', '\App\Http\Controllers\Dashboard\Candidates\CandidatesController@showpanel');
Route::resource('/adminpanel/candidate', '\App\Http\Controllers\Dashboard\Candidates\CandidatesController');
Route::get('/adminpanel/candidate/{id}/delete', '\App\Http\Controllers\Dashboard\Candidates\CandidatesController@destroy');
Route::get('/adminpanel/candidates/create','\App\Http\Controllers\Dashboard\Candidates\CandidatesController@CreateCandidates');
Route::post('/adminpanel/candidates/stor','\App\Http\Controllers\Dashboard\Candidates\CandidatesController@add');
Route::post('/adminpanel/candidates/update/{id}', '\App\Http\Controllers\Dashboard\Candidates\CandidatesController@update');
Route::post('/adminpanel/candidates/search', '\App\Http\Controllers\Dashboard\Candidates\CandidatesController@search');
Route::post('/adminpanel/deleteid/candidates', '\App\Http\Controllers\Dashboard\Candidates\CandidatesController@deleteid');
/******postjob */
Route::resource('/adminpanel/postjob', '\App\Http\Controllers\Dashboard\PostJob\PostJobController');
Route::get('/adminpanel/postjob/{id}/delete', '\App\Http\Controllers\Dashboard\PostJob\PostJobController@destroy');
Route::get('/adminpanel/postjob/create','\App\Http\Controllers\Dashboard\PostJob\PostJobController@Create');
Route::post('/adminpanel/postjob/stor','\App\Http\Controllers\Dashboard\PostJob\PostJobController@add');
Route::post('/adminpanel/postjob/update/{id}', '\App\Http\Controllers\Dashboard\PostJob\PostJobController@update');
Route::get('/adminpanel/postjob/maidhelper/create','\App\Http\Controllers\Dashboard\PostJob\PostJobController@CreateMaidhelper');
Route::post('/adminpanel/postjob/maidhelper/stor','\App\Http\Controllers\Dashboard\PostJob\PostJobController@addMaidhelper');
Route::get('/adminpanel/postjob/{id}/edit2','\App\Http\Controllers\Dashboard\PostJobPostJob\Controller@edit2');
Route::post('/adminpanel/postjob/stor/{id}','\App\Http\Controllers\Dashboard\PostJob\PostJobController@addQuestion');
Route::post('/adminpanel/postjob/search', '\App\Http\Controllers\Dashboard\PostJob\PostJobController@search');
Route::post('/adminpanel/deleteid/postjob', '\App\Http\Controllers\Dashboard\PostJob\PostJobController@deleteid');
/************questions */
Route::resource('/adminpanel/questions', '\App\Http\Controllers\Dashboard\PostJob\QuestionController');
Route::get('/adminpanel/question/{id}/delete', '\App\Http\Controllers\Dashboard\PostJob\QuestionController@destroy');
Route::post('/adminpanel/question/update/{id}', '\App\Http\Controllers\Dashboard\PostJob\QuestionController@update');
Route::get('/adminpanel/question/{id}/edit','\App\Http\Controllers\Dashboard\PostJob\QuestionController@edit');
Route::post('/adminpanel/question/search', '\App\Http\Controllers\Dashboard\PostJob\QuestionController@search');
Route::post('/adminpanel/deleteid/question', '\App\Http\Controllers\Dashboard\PostJob\QuestionController@deleteid');
////////////////////////////////////////End of admin panel//////////////////////////////////










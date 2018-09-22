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


///*********************Candidates************************ */
Route::get('/full_register/candidate/{id}/edit','Candidate\EditCanProfileController@edit');
Route::post('/update_register/candidate/{id}','Candidate\EditCanProfileController@updateFullReg');
Route::any('/StoreVideo', '\App\Http\Controllers\Auth\RegisterController@StoreVideo');
Route::get('/getNextTopCandidates/{id?}','HomeController@getNextTopCandidates');
Route::get('/getNextJobCandidates/{id?}','HomeController@getNextJobCandidates');
Route::get('/candidate2/{id}','Candidate\CandidatesController@profile2');
Route::get('/candidate/{id}','Candidate\CandidatesController@profile');
Route::get('/EditCandidate/{id}','Candidate\CandidatesController@EditRefrnces');
Route::get('/register/candidates', function () {
	return view('auth.candidate_register');
});
Route::get('/congrats', function () {
	return view('auth.congratulation');
});
///*********************Employer**************************** */
Route::get('/register/employer', function () {
	return view('auth.employer_register');
});
Route::get('/register/employeer', function () {
	return view('auth.employer_type');
});
Route::get('/company_profile/edit/{id}', 'Companyinfo\companiesController@create');
Route::get('/company_profile/{id}', 'Companyinfo\companiesController@show');
Route::get('/auth/facebook/{id}','\App\Http\Controllers\Auth\RegisterController@redirectToProvider')->name('login.facebook');
Route::get('/facebook/callback','\App\Http\Controllers\Auth\RegisterController@handleProvider');
Route::get('/auth/google/{id}','\App\Http\Controllers\Auth\RegisterController@redirectToProviderGoogle')->name('login.google');
Route::get('/google/callback','\App\Http\Controllers\Auth\RegisterController@handleProviderGooglr');
Route::get('/auth/twitter/{id}','\App\Http\Controllers\Auth\RegisterController@redirectToProvidertwitter')->name('login.twitter');
Route::get('/twitter/callback','\App\Http\Controllers\Auth\RegisterController@handleProvidertwitter');

//**********************Jobs********************************* */
Route::get('/ViewJob/{id}','Jobs\JobPostController@ViewJob');
Route::get('/ApplyJob/{id}','Jobs\JobPostController@ApplyJob');
Route::get('/ApplyOk','Jobs\JobPostController@ApplyOk');
Route::get('/likejob/{id}','Jobs\JobPostController@likejob');
Route::any('/logoutandregister','Jobs\JobPostController@logoutandregister');
Route::post('/empolyerCount','Jobs\JobPostController@empolyerCount');
Route::get('/EditJobRef', 'HomeController@EditJobRef');
//*********************CompanyInfo*************************** */
Route::get('/contact', function () {
    return view('CompanyInfo.contact');
});
Route::get('/aboutus', function () {
    return view('CompanyInfo.aboutus');
}); 
Route::post('/sendemail', 'Companyinfo\CompanyInfoController@fn_sendmail')->name('sendemail');
Route::get('/Requests', function () {
    return view('CompanyInfo.Requests');
});
Route::post('/sendyourrequest', 'Companyinfo\CompanyInfoController@sendyourrequest')->name('sendyourrequest');
//*************************Payment************************ */
Route::resource('/Payment', 'Payment\PaymentController');
Route::any('/checkPayvalid', 'Payment\PaymentController@checkPayvalid');
//********************************************************* */
//*********************search******************************* */
Route::get('/search','Home\IndexController@search');
Route::any('/filtersearch', 'Home\IndexController@filtersearch');

//*************************General Route************************ */
Route::post('/morejobs', 'IndexController@loadmore');
Route::get('/', 'Home\IndexController@index');
Route::get('/country', 'Home\IndexController@CountryName');
Route::get('/MatchingCandidates', 'Home\IndexController@MatchingCandidates');
Route::get('/getNotify', 'HomeController@getNotify');
Route::get('/point', 'HomeController@reg');
Route::any('/jobs', 'HomeController@CanadatiesDashboard');
Route::any('/candidates', 'HomeController@dashMatchingcandidates');
Route::any('/cand', 'HomeController@dashMatchingcandidates');
Route::any('/alljobs', 'Home\IndexController@filtersearch');
Route::any('/morejobs', 'HomeController@morejobs');
Route::any('/recomanded', 'HomeController@Recomanded');
Route::any('/morecandidates', 'Home\IndexController@MoreCandidates');
Route::any('/jobs_candidates', 'HomeController@Candidate_Job');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/MatchingJobs', 'HomeController@MatchingJobs');
//********************************************************* */
//********************Video chat******************************* */
Route::get('/videochat', function () {
	return view('Video.videochat');
});
//*************************************************************** */

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
	Route::get('/getCities/{id}','CountryController@getCities');
});
Auth::routes();
/***********************************Admin routes**************************************/
Route::get('/adminpanel', '\App\Http\Controllers\Dashboard\Candidate\CandidatesController@showpanel');
/***employer */
Route::resource('/adminpanel/employer', '\App\Http\Controllers\Dashboard\EmployerController');
Route::get('/adminpanel/employer/{id}/delete', '\App\Http\Controllers\Dashboard\EmployerController@destroy');
Route::get('/adminpanel/employer/create','\App\Http\Controllers\Dashboard\EmployerController@CreateEmployer');
Route::post('/adminpanel/employer/stor','\App\Http\Controllers\Dashboard\EmployerController@add');
Route::post('/adminpanel/employer/update/{id}', '\App\Http\Controllers\Dashboard\EmployerController@update');
Route::post('/adminpanel/employer/search', '\App\Http\Controllers\Dashboard\EmployerController@search');
Route::post('/adminpanel/deleteid', '\App\Http\Controllers\Dashboard\EmployerController@deleteid');
Route::get('/adminpanel/employerstory/{id}/addstory','\App\Http\Controllers\Dashboard\EmployerController@addstory');
Route::post('/adminpanel/employerstory/stor/{id}','\App\Http\Controllers\Dashboard\EmployerController@SuccessStory');
/******candidate */
Route::resource('/adminpanel/candidate', '\App\Http\Controllers\Dashboard\Candidate\CandidatesController');
Route::get('/adminpanel/candidate/{id}/delete', '\App\Http\Controllers\Dashboard\Candidate\CandidatesController@destroy');
Route::get('/adminpanel/candidates/create','\App\Http\Controllers\Dashboard\Candidate\CandidatesController@CreateCandidates');
Route::post('/adminpanel/candidates/stor','\App\Http\Controllers\Dashboard\Candidate\CandidatesController@add');
Route::post('/adminpanel/candidates/update/{id}', '\App\Http\Controllers\Dashboard\Candidate\CandidatesController@update');
Route::post('/adminpanel/candidates/search', '\App\Http\Controllers\Dashboard\Candidate\CandidatesController@search');
Route::post('/adminpanel/deleteid/candidates', '\App\Http\Controllers\Dashboard\Candidate\CandidatesController@deleteid');
Route::get('/adminpanel/story/{id}/addstory','\App\Http\Controllers\Dashboard\Candidate\CandidatesController@addstory');
Route::post('/adminpanel/story/stor/{id}','\App\Http\Controllers\Dashboard\Candidate\CandidatesController@SuccessStory');

/******postjob */
Route::resource('/adminpanel/postjob', '\App\Http\Controllers\Dashboard\PostJobController');
Route::get('/adminpanel/postjob/{id}/delete', '\App\Http\Controllers\Dashboard\PostJobController@destroy');
Route::get('/adminpanel/postjob/create','\App\Http\Controllers\Dashboard\PostJobController@Create');
Route::post('/adminpanel/postjob/stor','\App\Http\Controllers\Dashboard\PostJobController@add');
Route::post('/adminpanel/postjob/update/{id}', '\App\Http\Controllers\Dashboard\PostJobController@update');
Route::get('/adminpanel/postjob/maidhelper/create','\App\Http\Controllers\Dashboard\PostJobController@CreateMaidhelper');
Route::post('/adminpanel/postjob/maidhelper/stor','\App\Http\Controllers\Dashboard\PostJobController@addMaidhelper');
Route::get('/adminpanel/postjob/{id}/edit2','\App\Http\Controllers\Dashboard\PostJobController@edit2');
Route::post('/adminpanel/postjob/stor/{id}','\App\Http\Controllers\Dashboard\PostJobController@addQuestion');
Route::post('/adminpanel/postjob/search', '\App\Http\Controllers\Dashboard\PostJobController@search');
Route::post('/adminpanel/deleteid/postjob', '\App\Http\Controllers\Dashboard\PostJobController@deleteid');
/************questions */
Route::resource('/adminpanel/questions', 'Dashboard\QuestionController');
Route::get('/adminpanel/question/{id}/delete', 'Dashboard\QuestionController@destroy');
Route::post('/adminpanel/question/update/{id}', 'Dashboard\QuestionController@update');
Route::get('/adminpanel/question/{id}/edit','Dashboard\QuestionController@edit');
Route::post('/adminpanel/question/search', 'Dashboard\QuestionController@search');
Route::post('/adminpanel/deleteid/question', 'Dashboard\QuestionController@deleteid');

/************success stories */
Route::resource('/adminpanel/stories', 'Dashboard\SucessStoriesController');
Route::get('/adminpanel/employer/creates','\App\Http\Controllers\Dashboard\EmployerController@CreateStory');
Route::post('/adminpanel/employer/story','\App\Http\Controllers\Dashboard\EmployerController@addstorys');
Route::get('/adminpanel/candidate/create','\App\Http\Controllers\Dashboard\Candidate\CandidatesController@CreateStory');
Route::post('/adminpanel/candidate/story','\App\Http\Controllers\Dashboard\Candidate\CandidatesController@addstorys');
Route::post('/adminpanel/story/search', 'Dashboard\SucessStoriesController@search');
Route::post('/adminpanel/deleteid/story', 'Dashboard\SucessStoriesController@deleteid');
Route::get('/approvalSuccessStories', '\App\Http\Controllers\Dashboard\EmployerController@updateStory');
Route::post('/adminpanel/story/update/{id}', 'Dashboard\SucessStoriesController@update');
Route::get('/adminpanel/story/{id}/edit','Dashboard\SucessStoriesController@edit');
/***********************end of stories */
Route::get('/getjobsbycountry','HomeController@getjobsbycountry');
/*************************************************************************/
Route::group(['middleware'=>'auth'],function(){
	Route::get('/addPostJob','Jobs\JobPostController@create');
	Route::post('/postJob/store','Jobs\JobPostController@store');
	Route::get('/getCandidatesStaredJob','Jobs\JobPostController@getCandidatedStarredJob');
	Route::get('/next_can/{id}','Jobs\JobPostController@getNextCan');
	Route::get('/getApplicants','Jobs\JobPostController@getApplicants');
	Route::get('/next_applicants/{id}','Jobs\JobPostController@getNextApplicants');
	Route::post('/likeCandidate','Candidate\CandidatesController@liked');
	Route::get('/getLikes','Candidate\CandidatesController@getLikes');
	Route::get('/next_likes/{id}','Candidate\CandidatesController@getNextLikes');
	Route::get('/SuccessStory','Candidate\CandidatesController@CreateSuccessStorys');
	Route::post('/SuccessStory/store','Candidate\CandidatesController@AddSuccessStorys');
	/***for adding success stories */
	Route::get('/SuccessStory/{id}/CreateSuccessStory','Candidate\CandidatesController@CreateSuccessStory');
	Route::post('/SuccessStory/store/{id}','Candidate\CandidatesController@AddSuccessStory');
    Route::get('/EmployerSuccessStory/{id}/CreateSuccessStory','HomeController@CreateSuccessStory');
	Route::post('/SuccessStory/employerstory/{id}','HomeController@SuccessStory');
    /**end stories */
	Route::post('/company_store', 'companiesController@store');
});

/*************************************************************************/








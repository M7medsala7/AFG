<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");   
 // header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
 header('Access-Control-Allow-Credentials: true');  
/*

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
Route::any('/StoreVideo2', '\App\Http\Controllers\Auth\AgencyCandidateController@StoreVideo2');

Route::get('/getNextTopCandidates/{id?}','HomeController@getNextTopCandidates');
Route::get('/getNextJobCandidates/{id?}','HomeController@getNextJobCandidates');
Route::get('/candidate2/{id}','Candidate\CandidatesController@profile2');
Route::get('/candidate/{id}','Candidate\CandidatesController@profile');
Route::get('/EditCandidate/{id}','Candidate\CandidatesController@EditRefrnces');
Route::post('/EditStoreVideo','Candidate\EditCanProfileController@EditStoreVideo');
Route::get('/register/candidates', function () {
	return view('auth.candidate_register');
});
Route::get('/RegisterWithAgency', function () {
	
	return view('auth.RegisterWithAgency');
});
///*********************Congrats************************ */
Route::post('/congrats','Home\IndexController@congrats');
Route::post('/congratscan','Home\IndexController@congratscan');
///*********************Employer**************************** */
Route::get('/register/employer', function () {
auth()->logout();
	return view('auth.employer_register');
});
Route::get('/register/employeer', function () {
	return view('auth.employer_type');
});
Route::get('/loginEmployer', function () {
    return view('auth.loginemp');
});
Route::get('/company_profile/edit/{id}', 'Employer\CompaniesController@create');
Route::get('/company_profile/{id}', 'Employer\CompaniesController@show');
Route::get('/auth/facebook/{id}','\App\Http\Controllers\Auth\RegisterController@redirectToProvider')->name('login.facebook');
Route::get('/facebook/callback','\App\Http\Controllers\Auth\RegisterController@handleProvider');
Route::get('/auth/google/{id}','\App\Http\Controllers\Auth\RegisterController@redirectToProviderGoogle')->name('login.google');
Route::get('/google/callback','\App\Http\Controllers\Auth\RegisterController@handleProviderGooglr');
Route::get('/auth/twitter/{id}','\App\Http\Controllers\Auth\RegisterController@redirectToProvidertwitter')->name('login.twitter');
Route::get('/twitter/callback','\App\Http\Controllers\Auth\RegisterController@handleProvidertwitter');
Route::any('/ShowAllJob/{id}', '\App\Http\Controllers\Jobs\JobPostController@showalljob');

Route::any('/showcandidatejob/{id}/{userid}', '\App\Http\Controllers\Jobs\JobPostController@showcandidatejob');
Route::any('/updatestatus', '\App\Http\Controllers\Jobs\JobPostController@updatestatus');
Route::any('/reloadtable', '\App\Http\Controllers\Jobs\JobPostController@reloadtable');
Route::any('/shareclient', '\App\Http\Controllers\Jobs\JobPostController@shareclient');
Route::any('/sharejobtocandidate', '\App\Http\Controllers\Jobs\JobPostController@sharejobtocandidate');
//**********************Jobs********************************* */
Route::get('/ViewJob/{id}','Jobs\JobPostController@ViewJob');
Route::get('/ApplyJob/{id}','Jobs\JobPostController@ApplyJob');
Route::get('/ApplyOk','Jobs\JobPostController@ApplyOk');
Route::get('/likejob/{id}','Jobs\JobPostController@likejob');
Route::any('/logoutandregister','Jobs\JobPostController@logoutandregister');
Route::post('/empolyerCount','Jobs\JobPostController@empolyerCount');
Route::get('/EditJobRef', 'HomeController@EditJobRef');
Route::post('/jobStatstics', 'Jobs\JobPostController@jobStatstics');
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
Route::post('/sendyourrequest', 'Companyinfo\CompanyInfoController@sendyourrequest');
//*************************Payment************************ */
Route::resource('/Payment', 'Payment\PaymentController');

Route::get('/Checkpaymentauth/{id}/{type}', 'Payment\PaymentController@Checkpaymentauth');
Route::any('/PayMethod/{id}/{type}', 'Payment\PaymentController@PayMethod');
Route::any('/CheckCountattribute/{id}/{attribute}', 'Payment\PaymentController@CheckCountattribute');

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
Route::any('/updateimage', 'Candidate\EditCanProfileController@updateimage');
Route::post('/share','Home\IndexController@share');
Route::post('/sharejob','Home\IndexController@sharejob');
Route::post('/sendemailcan','Home\IndexController@sendemail');
Route::post('/sendemailjob','Home\IndexController@sendemailjob');

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


/*************************language************************ */
Route::post('/language-chooser','LanguageController@changelanguage');

Route::post('/language/', array (
    'before'=>'csrf',
    'as'=>'/language-chooser',
    'uses'=>'LanguageController@changelanguage',));
    
    
    

/*************************newadminpanl************************ */
Route::get('/adminmaster', function () {
    return view('DashbordAdminPanel.login.login');
});
Route::get('/loginadmin', function () {
    return view('DashbordAdminPanel.login.login');
});


Route::get('/Blogsadmin', '\App\Http\Controllers\DashboardAdmin\Requests\requestcontroller@showBlogsadmin');
Route::post('/addblog', '\App\Http\Controllers\DashboardAdmin\Requests\requestcontroller@addblog');
Route::post('/delmulblog', '\App\Http\Controllers\DashboardAdmin\Requests\requestcontroller@delmulblog');
Route::get('/showBlogsuser', '\App\Http\Controllers\DashboardAdmin\Requests\requestcontroller@showBlogsuser');
Route::get('/EditBlog/{id}', '\App\Http\Controllers\DashboardAdmin\Requests\requestcontroller@EditBlog');
Route::post('/updateblog', '\App\Http\Controllers\DashboardAdmin\Requests\requestcontroller@updateblog');

//Skils admin//

Route::get('/skillsadmin', '\App\Http\Controllers\DashboardAdmin\Skills\skillcontroller@index');
Route::post('/addskill', '\App\Http\Controllers\DashboardAdmin\Skills\skillcontroller@addskill');
Route::post('/deleteMultipleSkill', '\App\Http\Controllers\DashboardAdmin\Skills\skillcontroller@deleteMultipleSkill');
Route::get('/ShowEditSkill/{id}', '\App\Http\Controllers\DashboardAdmin\Skills\skillcontroller@ShowEditSkill');
Route::post('/editskills', '\App\Http\Controllers\DashboardAdmin\Skills\skillcontroller@editskills');

//job admin//
Route::get('/jobsadmin', '\App\Http\Controllers\DashboardAdmin\Jobslookup\jobcontroller@index');
Route::post('/addjob', '\App\Http\Controllers\DashboardAdmin\Jobslookup\jobcontroller@addjob');
Route::post('/deleteMultiplejob', '\App\Http\Controllers\DashboardAdmin\Jobslookup\jobcontroller@deleteMultiplejob');
Route::get('/ShowEditjob/{id}', '\App\Http\Controllers\DashboardAdmin\Jobslookup\jobcontroller@ShowEditjob');
Route::post('/editjob', '\App\Http\Controllers\DashboardAdmin\Jobslookup\jobcontroller@editjob');


Route::any('/loginadmin', '\App\Http\Controllers\DashboardAdmin\loginController@login');
//////////******************candidateadmin**************//
Route::resource('/Candidateadmin', '\App\Http\Controllers\DashboardAdmin\Candidate\CandidateController');
Route::post('/candidateadminstore', '\App\Http\Controllers\DashboardAdmin\Candidate\CandidateController@candidateadminstore');

Route::any('/candidate/{candidate}/update',  ['as' => 'candidateadminedit', 'uses' => '\App\Http\Controllers\DashboardAdmin\Candidate\CandidateController@candidateadminedit']);

Route::get('/Candidate/{id}/edit', '\App\Http\Controllers\DashboardAdmin\Candidate\CandidateController@updatecandidate');
Route::any('/deletemultiplecandidate','\App\Http\Controllers\DashboardAdmin\Candidate\CandidateController@deleteMultiple');
//////////******************Jobadmin**************//

Route::resource('/Jobadmin', '\App\Http\Controllers\DashboardAdmin\Job\JobController');

Route::any('/deletemultiplejobs','\App\Http\Controllers\DashboardAdmin\Job\JobController@deleteMultiplebJobs');

Route::post('/jobadminstore', '\App\Http\Controllers\DashboardAdmin\Job\JobController@jobadminstore');

Route::get('/Job/{id}/edit', '\App\Http\Controllers\DashboardAdmin\Job\JobController@updatejob');
Route::any('/job/{job}/update',  ['as' => 'jobadminedit', 'uses' => '\App\Http\Controllers\DashboardAdmin\Job\JobController@jobadminedit']);

Route::get('/Job/{id}/show', '\App\Http\Controllers\DashboardAdmin\Job\JobController@showjob');

//////////******************employeradmin**************//
Route::resource('/Employeradmin', '\App\Http\Controllers\DashboardAdmin\Employer\EmployerController');

Route::any('/deletemultipleemployer','\App\Http\Controllers\DashboardAdmin\Employer\EmployerController@deletemultipleemployer');

Route::post('/employeradminstore', '\App\Http\Controllers\DashboardAdmin\Employer\EmployerController@employeradminstore');

Route::get('/Employer/{id}/edit', '\App\Http\Controllers\DashboardAdmin\Employer\EmployerController@updateemployer');
Route::any('/Employer/{Employer}/update',  ['as' => 'employeradminedit', 'uses' => '\App\Http\Controllers\DashboardAdmin\Employer\EmployerController@employeradminedit']);

Route::get('/Employer/{id}/show', '\App\Http\Controllers\DashboardAdmin\Employer\EmployerController@showemployer');


Route::resource('/PackagesAdmin', '\App\Http\Controllers\DashboardAdmin\Packages\PackagesController');
Route::get('/Packages/{id}/edit', '\App\Http\Controllers\DashboardAdmin\Packages\PackagesController@updatePackages');
Route::post('/packagesedit', '\App\Http\Controllers\DashboardAdmin\Packages\PackagesController@packagesedit');
Route::get('/Delattribute/{attrid}/{packid}', '\App\Http\Controllers\DashboardAdmin\Packages\PackagesController@Delattribute');
Route::post('/addNewattribute', '\App\Http\Controllers\DashboardAdmin\Packages\PackagesController@addNewattribute');
Route::post('/updateattrval', '\App\Http\Controllers\DashboardAdmin\Packages\PackagesController@updateattrval');
Route::post('/updateattrvalyear', '\App\Http\Controllers\DashboardAdmin\Packages\PackagesController@updateattrvalyear');
Route::get('/updatestatus/{id}', '\App\Http\Controllers\DashboardAdmin\Requests\requestcontroller@updatestatus');

Route::resource('/Storyadmin', '\App\Http\Controllers\DashboardAdmin\SucessStory\SucessStoryController');
Route::get('/approvalStories', '\App\Http\Controllers\DashboardAdmin\SucessStory\SucessStoryController@updateStory');
Route::post('/delmulstory', '\App\Http\Controllers\DashboardAdmin\SucessStory\SucessStoryController@deleteMultiple');
Route::resource('/Requestsadmin', '\App\Http\Controllers\DashboardAdmin\Requests\requestcontroller');
Route::get('/showedit/{id}', '\App\Http\Controllers\DashboardAdmin\SucessStory\SucessStoryController@edit');
Route::post('/editsucessstory', '\App\Http\Controllers\DashboardAdmin\SucessStory\SucessStoryController@update');

Route::post('/addEmpStory', '\App\Http\Controllers\DashboardAdmin\SucessStory\SucessStoryController@addEmpStory');
Route::post('/addCanStory', '\App\Http\Controllers\DashboardAdmin\SucessStory\SucessStoryController@addCanStory');

Route::resource('/Dashboard', '\App\Http\Controllers\DashboardAdmin\Dashboard\DasboardController');


/***********************************Admin routes**************************************/
Route::get('/adminpanel', '\App\Http\Controllers\Dashboard\CandidatesController@showpanel');
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
Route::resource('/adminpanel/candidate', '\App\Http\Controllers\Dashboard\CandidatesController');
Route::get('/adminpanel/candidate/{id}/delete', '\App\Http\Controllers\Dashboard\CandidatesController@destroy');
Route::get('/adminpanel/candidates/create','\App\Http\Controllers\Dashboard\CandidatesController@CreateCandidates');
Route::post('/adminpanel/candidates/stor','\App\Http\Controllers\Dashboard\CandidatesController@add');
Route::post('/adminpanel/candidates/update/{id}', '\App\Http\Controllers\Dashboard\CandidatesController@update');
Route::post('/adminpanel/candidates/search', '\App\Http\Controllers\Dashboard\CandidatesController@search');
Route::post('/adminpanel/deleteid/candidates', '\App\Http\Controllers\Dashboard\CandidatesController@deleteid');
Route::get('/adminpanel/story/{id}/addstory','\App\Http\Controllers\Dashboard\CandidatesController@addstory');
Route::post('/adminpanel/story/stor/{id}','\App\Http\Controllers\Dashboard\CandidatesController@SuccessStory');

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
/************************************charts of dashboar*************************************/
Route::get('/showEmpolyerChart','\App\Http\Controllers\Dashboard\Charts\ChartsController@showEmpolyerChart');

Route::get('/showCandidateChart','\App\Http\Controllers\Dashboard\Charts\ChartsController@showCandidateChart');

	Route::any('/CandidateChart','\App\Http\Controllers\Dashboard\Charts\ChartsController@CandidateChart');

	Route::any('/EmpolyerChart','\App\Http\Controllers\Dashboard\Charts\ChartsController@EmpolyerChart');

/*************************************************************************/
Route::any('/registercandidateagency', '\App\Http\Controllers\Auth\AgencyCandidateController@registercandidateagency');
Route::any('/registerwithout', '\App\Http\Controllers\Auth\AgencyCandidateController@registerwithout');

Route::any('/owncandidate', '\App\Http\Controllers\Auth\AgencyCandidateController@owncandidate');

//client
Route::any('/sharedClient', '\App\Http\Controllers\Client\ClientController@SharedClient');
Route::any('/clients', '\App\Http\Controllers\Client\ClientController@clientShow');
Route::any('/addNewclient', '\App\Http\Controllers\Client\ClientController@clientStore');
Route::any('/updatestatusclient', '\App\Http\Controllers\Client\ClientController@updatestatusclient');
Route::any('/clientcontroll/{clientid}', '\App\Http\Controllers\Client\ClientController@clientcontroll');
Route::any('/updatestatusagency', '\App\Http\Controllers\Client\ClientController@updatestatusagency');
Route::any('/Candiateclient', '\App\Http\Controllers\Client\ClientController@Candiateclient');
Route::any('/deletemultipleclient', '\App\Http\Controllers\Client\ClientController@deletemultipleclient');
Route::any('/updatemultipleclientstatus', '\App\Http\Controllers\Client\ClientController@updatemultipleclientstatus');
Route::any('/Candiateclientshsred', '\App\Http\Controllers\Client\ClientController@Candiateclientshsred');
Route::any('/deletemultiplesharedclient', '\App\Http\Controllers\Client\ClientController@deletemultiplesharedclient');
Route::any('/updatemultipleclientstatusshared', '\App\Http\Controllers\Client\ClientController@updatemultipleclientstatusshared');
Route::any('/deletemultipleCandidatebyagency', '\App\Http\Controllers\Client\ClientController@deletemultipleCandidatebyagency');

Route::any('/yourfavouritejobs', '\App\Http\Controllers\Jobs\JobPostController@yourfavouritejobs');
Route::any('/yourappliedjobs', '\App\Http\Controllers\Jobs\JobPostController@yourappliedjobs');
Route::any('/applyWithoutRegestration/{id}', '\App\Http\Controllers\Jobs\JobPostController@applyWithoutRegestration');

Route::any('/favouritecan', '\App\Http\Controllers\Jobs\JobPostController@favouritecan');






















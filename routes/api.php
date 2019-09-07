<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");   
 // header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
 header('Access-Control-Allow-Credentials: true');
  
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('skills', 'apicontroller@allskills');
Route::get('countries', 'apicontroller@allcountry');
Route::get('industries', 'apicontroller@allidustry');
Route::get('currencies', 'apicontroller@allcurrency');
Route::get('religion', 'apicontroller@allreligion');
Route::get('jobs', 'apicontroller@alljobs');
Route::get('employer_type', 'apicontroller@employertype');
Route::get('exprience', 'apicontroller@allexprience');
Route::get('top_candidate', 'apicontroller@topcandidate');
Route::get('nationality', 'apicontroller@allnationality');
Route::get('language', 'apicontroller@language');

Route::post('login', 'apicontroller@login');
Route::post('searchjobs', 'apicontroller@searchjobs');
Route::post('cities', 'apicontroller@allcity');
Route::post('viewjob', 'apicontroller@viewjob');
Route::post('viewprofile', 'apicontroller@viewprofile');
Route::post('revlant_jobs', 'apicontroller@revlantjob');
Route::post('register_candidate', 'apicontroller@easycanreg');
Route::post('updateimage', 'apicontroller@updateimage');
Route::post('updatecover', 'apicontroller@updatecover');



Route::post('updatemainvideo', 'apicontroller@updatemainvideo');
Route::post('newvideo', 'apicontroller@newvideo');
Route::post('deletevideo', 'apicontroller@deletevideo');
Route::post('employer_registation', 'apicontroller@employerregistation');
Route::post('revlant_withoutreg', 'apicontroller@revlantjobwithoutReg');
Route::post('update_Candidate', 'apicontroller@updateFullReg');
Route::post('Company', 'apicontroller@Company');
Route::post('save_job', 'apicontroller@savejob');
Route::post('favourite_candidate', 'apicontroller@likecandidate');
Route::post('get_favourite_job', 'apicontroller@yourfavouritejobs');
Route::post('who_favourite_job', 'apicontroller@whofavouritejobs');

Route::post('get_favourite_candidate', 'apicontroller@favouritecan');
Route::post('job_by_employer', 'apicontroller@jobbyemployer');


Route::post('candidate_Videos', 'apicontroller@candidateVideos');
Route::post('search_candidate', 'apicontroller@searchcandidate');

Route::post('add_sucessstory_Emp', 'apicontroller@addsucessstoryEmp');
Route::post('add_sucessstory_Can', 'apicontroller@addsucessstoryCan');
Route::get('get_all_sucess', 'apicontroller@getallsucess');
Route::post('get_sucess_byuser', 'apicontroller@getsucessbyuser');

Route::post('get_jobs_application','apicontroller@getappliesjob');
Route::post('get_applies_candidate_forjob','apicontroller@getappliescandidateforjob');

Route::post('applyjob','apicontroller@applyjob');
Route::post('get_Matching_candidates','apicontroller@getMatchingcandidates');
Route::post('get_Matching_candidates_certainjon','apicontroller@getMatchingcandidatescertainjon');

Route::post('get_Matchingjobs_register','apicontroller@getMatchingjobsregister');


Route::post('post_job','apicontroller@postjob');
Route::post('confirmation_mail','apicontroller@confirmationmail');

Route::post('make_main_video','apicontroller@makemainvideo');
Route::post('uploadCV','apicontroller@uploadCV');


Route::post('update_video_title','apicontroller@updatevidetitle');
Route::post('update_mainvideo_title','apicontroller@updatemainvidetitle');


Route::post('add_setting','apicontroller@addsetting');
Route::post('get_user_setting','apicontroller@getusersetting');

Route::post('add_seen_profile','apicontroller@seenprofile');
Route::post('get_seen_profile','apicontroller@getseenprofile');
Route::post('get_seenprofile_groupdate','apicontroller@getseenprofilegroupdate');

Route::post('get_seen_profile_bydate','apicontroller@getseenprofilebydate');

Route::post('add_seen_job','apicontroller@seenjob');
Route::post('get_seen_job','apicontroller@getseenjob');
Route::post('get_seen_job_bydate','apicontroller@getseenjobbydate');

Route::post('delete_user_language','apicontroller@deleteuserlanguage');
Route::post('delete_user_skill','apicontroller@deleteuserskill');
Route::post('delete_user_location','apicontroller@deleteuserlocation');

Route::post('check_password','apicontroller@checkpassword');
Route::post('update_password','apicontroller@updatepassword');


Route::post('add_work_exprience','apicontroller@addworkexprience');
Route::post('update_work_exprience','apicontroller@updateworkexprience');
Route::post('delete_work_exprience','apicontroller@deleteworkexprience');
Route::post('get_work_exprience','apicontroller@getworkexprience');

//--------------------------
Route::post('employer_profile','apicontroller@employerprofile');
Route::post('delete_job','apicontroller@deletejob');
Route::post('update_postjob','apicontroller@updatepostjob');

Route::post('delete_language_postjob','apicontroller@deletelanguagepostjob');
Route::post('delete_skill_postjob','apicontroller@deleteskillpostjob');

Route::post('add_language_postjob','apicontroller@addlanguagepostjob');
Route::post('add_skill_postjob','apicontroller@addskillpostjob');

Route::post('update_postjob_status','apicontroller@updatepostjobstatus');
Route::post('job_application_status','apicontroller@updatejobapplicationstatus');

Route::post('add_can_byagency','apicontroller@addcanbyagency');
Route::post('get_can_byagency','apicontroller@getcanbyagency');

Route::post('client_Store','apicontroller@clientStore');
Route::post('client_agency','apicontroller@clientShow');
Route::post('share_candidate_toclient','apicontroller@sharecandidatetoclient');
Route::post('delete_client','apicontroller@deleteclient');
Route::post('get_candidate_client','apicontroller@getcandidateclient');
Route::post('delete_Candidate_byagency','apicontroller@deleteCandidatebyagency');

Route::post('status_orcomment_byagenyorclient_tocandidate','apicontroller@updatestatusorcommentbyagenytocandidate');

//packages 

Route::get('packages','apicontroller@getpackages');
Route::post('choose_packages','apicontroller@choosepackages');
Route::post('get_user_packages','apicontroller@getuserpackages');

Route::post('update_employer_profile','apicontroller@updateemployerprofile');
Route::post('candidate_employer','apicontroller@candidateoremployer');
Route::post('notify_user','apicontroller@notifyuser');


Route::post('shared_jobtoclient','apicontroller@sharedjobtoclient');
Route::post('get_shared_jobtoclient','apicontroller@getsharedjobtoclient');









































<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {return $request->user();});


//All Documents List
Route::get('get_exam_document_name','AjaxController@get_exam_document_name');
Route::get('get_state_by_country_id','AjaxController@get_state_by_country_id');
Route::get('get-state-by-country-id-pluck','AjaxController@get_state_by_country_id_pluck');
Route::get('get-countries','api\ApiController@countries_by_name');
Route::get('get-state-by-country-name-pluck','api\ApiController@get_state_by_country_name_pluck');

  /* Retrieve all Data From Database */
//course names
Route::get('/all-course-names','api\ApiController@getCourseJson');
//subject names
Route::get('/all-subject-names','api\ApiController@getSubjectsJson');
//study Level
Route::get('/all-study-level','api\ApiController@getStudyLevelJson');
//country name
Route::get('/countries','api\ApiController@countries');
Route::get('/countries_name','api\ApiController@countries_by_name');
Route::get('/all-countries','api\ApiController@getCountriesJson');
//university name
Route::get('/all-universities','api\ApiController@getUniversityJson');
//get-course
Route::get('/get-course','api\ApiController@getCourse');

Route::get('articles/category','ArticleController@all_category');
Route::get('articles','ArticleController@all_articles');
Route::post('articles/category','ArticleController@store');

Route::get('eligibility-criteria-by-application-id','api\ApiController@eligibility_criteria_by_application_id');
Route::get('document-check-list-by-application-id','api\ApiController@document_check_list_by_application_id');
Route::get('student-application-document-list-application-id','api\ApiController@application_document_by_application_id');

Route::get('agent-student-application-document-list-application-id','api\ApiController@agent_application_document_by_application_id');

Route::get('student-payment-status-application-id','api\ApiController@paymentStatusOfStudent');
Route::post('student-payment-status-application-id-update','api\ApiController@updatePaymentStatusOfStudent');
Route::get('/student-acceptance-letter-application-id','api\ApiController@viewAcceptanceLetterOfStudent');

Route::get('agent-student-payment-status-application-id','api\ApiController@agentpaymentStatusOfStudent');
Route::post('agent-student-payment-status-application-id-update','api\ApiController@agentupdatePaymentStatusOfStudent');
Route::get('/agent-student-acceptance-letter-application-id','api\ApiController@agentviewAcceptanceLetterOfStudent');


Route::post('/student-acceptance-letter-application-id-update','api\ApiController@updateAcceptanceStatusOfStudent');
Route::post('/agent-student-acceptance-letter-application-id-update','api\ApiController@agentupdateAcceptanceStatusOfStudent');


Route::get('get-all-document-for-application','api\ApiController@get_all_document_for_application');
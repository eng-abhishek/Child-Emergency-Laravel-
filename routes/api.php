<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('login', [App\Http\Controllers\API\UserController::class, 'login'])->name('login');

Route::post('check-otp', [App\Http\Controllers\API\UserController::class, 'check_otp'])->name('check-otp');

Route::post('register', [App\Http\Controllers\API\UserController::class, 'register'])->name('register');

Route::post('create_user_profile', [App\Http\Controllers\API\UserController::class, 'create_user_profile'])->name('create_user_profile');


Route::group(['middleware' => 'auth:api'], function(){

Route::post('details', [App\Http\Controllers\API\UserController::class, 'details'])->name('details');


Route::post('create_child_profile', [App\Http\Controllers\API\UserController::class, 'create_child_profile'])->name('create_child_profile');


Route::post('create_parent_profile', [App\Http\Controllers\API\UserController::class, 'create_parent_profile'])->name('create_parent_profile');


Route::post('medical_detail_level_one', [App\Http\Controllers\API\UserController::class, 'Medical_detail_level_one'])->name('medical_detail_level_one');


Route::post('medical_detail_level_two', [App\Http\Controllers\API\UserController::class, 'Medical_detail_level_two'])->name('medical_detail_level_two');

Route::post('child_care_provider_details', [App\Http\Controllers\API\UserController::class, 'child_care_provider_details'])->name('child_care_provider_details');

Route::post('child_school_details_level_one', [App\Http\Controllers\API\UserController::class, 'child_school_details_level_one'])->name('child_school_details_level_one');

Route::post('getUserInformation', [App\Http\Controllers\API\UserController::class, 'getUserInformation'])->name('getUserInformation');

Route::post('getChildInformation', [App\Http\Controllers\API\UserController::class, 'getChildInformation'])->name('getChildInformation');

Route::post('getParentProfile', [App\Http\Controllers\API\UserController::class, 'getParentProfile'])->name('getParentProfile');

Route::post('getChildMeDetailLevelOne', [App\Http\Controllers\API\UserController::class, 'getChildMeDetailLevelOne'])->name('getChildMeDetailLevelOne');

Route::post('getChildMeDetailLevelTwo', [App\Http\Controllers\API\UserController::class, 'getChildMeDetailLevelTwo'])->name('getChildMeDetailLevelTwo');

Route::post('getChild_care_provider_details', [App\Http\Controllers\API\UserController::class, 'getChild_care_provider_details'])->name('getChild_care_provider_details');

Route::post('getchild_school_details_level_one', [App\Http\Controllers\API\UserController::class, 'getchild_school_details_level_one'])->name('getchild_school_details_level_one');

Route::post('child_school_details_level_two', [App\Http\Controllers\API\UserController::class, 'child_school_details_level_two'])->name('child_school_details_level_two');

Route::post('getChild_school_details_level_two', [App\Http\Controllers\API\UserController::class, 'getChild_school_details_level_two'])->name('getChild_school_details_level_two');


Route::post('child_extra_curriculam_detail', [App\Http\Controllers\API\UserController::class, 'child_extra_curriculam_detail'])->name('child_extra_curriculam_detail');


Route::post('getChild_extra_curriculam_detail', [App\Http\Controllers\API\UserController::class, 'getChild_extra_curriculam_detail'])->name('getChild_extra_curriculam_detail');


Route::post('child_about_detail', [App\Http\Controllers\API\UserController::class, 'child_about_detail'])->name('child_about_detail');

Route::post('getChild_about_detail', [App\Http\Controllers\API\UserController::class, 'getChild_about_detail'])->name('getChild_about_detail');


Route::post('child_insurance_detail', [App\Http\Controllers\API\UserController::class, 'child_insurance_detail'])->name('child_insurance_detail');

Route::post('getChild_insurance_detail', [App\Http\Controllers\API\UserController::class, 'getChild_insurance_detail'])->name('getChild_insurance_detail');


Route::post('child_support_detail', [App\Http\Controllers\API\UserController::class, 'child_support_detail'])->name('child_support_detail');

Route::post('getChild_support_detail', [App\Http\Controllers\API\UserController::class, 'getChild_support_detail'])->name('getChild_support_detail');


Route::post('document_details', [App\Http\Controllers\API\UserController::class, 'document_details'])->name('document_details');


Route::post('getChild_document_detail', [App\Http\Controllers\API\UserController::class, 'getChild_document_detail'])->name('getChild_document_detail');


Route::post('child_legal_detail', [App\Http\Controllers\API\UserController::class, 'child_legal_detail'])->name('child_legal_detail');


Route::post('getChild_legal_detail', [App\Http\Controllers\API\UserController::class, 'getChild_legal_detail'])->name('getChild_legal_detail');



});



Route::get('get_immulization', [App\Http\Controllers\API\UserController::class, 'get_immulization'])->name('get_immulization');


Route::post('getOTPForSignUPProcess', [App\Http\Controllers\API\UserController::class, 'getOTPForSignUPProcess'])->name('getOTPForSignUPProcess');




Route::get('sendSMS', [App\Http\Controllers\UserController::class, 'sendSMS'])->name('sendSMS');

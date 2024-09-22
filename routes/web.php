<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware'=>['adminLoginAuth']],function(){

Route::get('admin-login', [App\Http\Controllers\AdminController::class, 'login'])->name('admin-login');
Route::post('admin-login-post', [App\Http\Controllers\AdminController::class, 'login_post'])->name('admin-login-post');
});


Route::group(['middleware'=>['adminBasicAuth']],function(){

Route::get('admin-dashboard', [App\Http\Controllers\AdminController::class, 'admin_dashboard'])->name('admin-dashboard');


/*------- user management --------*/

Route::get('user', [App\Http\Controllers\AdminController::class, 'index'])->name('user');

Route::get('add-user', [App\Http\Controllers\AdminController::class, 'add_user'])->name('add-user');

Route::post('post-add-user', [App\Http\Controllers\AdminController::class, 'post_add_user'])->name('post-add-user');

Route::get('update-user/{id}', [App\Http\Controllers\AdminController::class, 'update_user'])->name('update-user');

Route::post('post-update-user', [App\Http\Controllers\AdminController::class, 'post_update'])->name('post-update-user');

Route::get('delete-user/{id}', [App\Http\Controllers\AdminController::class, 'delete_user'])->name('delete-user');

/*------- end user management --------*/



/*------- child management --------*/

Route::get('child', [App\Http\Controllers\AdminController::class, 'index_child'])->name('child');

Route::get('add-child', [App\Http\Controllers\AdminController::class, 'add_child'])->name('add-child');

Route::post('post-add-child', [App\Http\Controllers\AdminController::class, 'post_add_child'])->name('post-add-child');

Route::get('update-child/{id}', [App\Http\Controllers\AdminController::class, 'update_child'])->name('update-child');

Route::post('post-update-child', [App\Http\Controllers\AdminController::class, 'post_update_child'])->name('post-update-child');

Route::get('delete-child/{id}', [App\Http\Controllers\AdminController::class, 'delete_child'])->name('delete-child');

/*------- end child management --------*/


/*------- parent management --------*/

Route::get('parent', [App\Http\Controllers\AdminController::class, 'index_parent'])->name('parent');

Route::get('add-parent', [App\Http\Controllers\AdminController::class, 'add_parent'])->name('add-parent');

Route::post('post-add-parent', [App\Http\Controllers\AdminController::class, 'post_add_parent'])->name('post-add-parent');

Route::get('update-parent/{id}', [App\Http\Controllers\AdminController::class, 'update_parent'])->name('update-parent');

Route::post('post-update-parent', [App\Http\Controllers\AdminController::class, 'post_update_parent'])->name('post-update-parent');

Route::get('delete-parent/{id}', [App\Http\Controllers\AdminController::class, 'delete_parent'])->name('delete-parent');

Route::post('getChild', [App\Http\Controllers\AdminController::class, 'getChild'])->name('getChild');

Route::get('parent-detail/{id}', [App\Http\Controllers\AdminController::class, 'parent_detail'])->name('parent-detail');
/*------- end parent management --------*/



/*------- parent management --------*/

Route::get('medical-level-one', [App\Http\Controllers\AdminController::class, 'index_medical_level_one'])->name('medical-level-one');

Route::get('add-medical-level-one', [App\Http\Controllers\AdminController::class, 'add_medical_level_one'])->name('add-medical-level-one');

Route::post('post-add-medical-level-one', [App\Http\Controllers\AdminController::class, 'post_add_medical_level_one'])->name('post-add-medical-level-one');

Route::get('update-medical-level-one/{id}', [App\Http\Controllers\AdminController::class, 'update_medical_level_one'])->name('update-medical-level-one');

Route::post('post-update-medical-level-one', [App\Http\Controllers\AdminController::class, 'post_update_medical_level_one'])->name('post-update-medical-level-one');

Route::get('delete-medical-level-one/{id}', [App\Http\Controllers\AdminController::class, 'delete_medical_level_one'])->name('delete-medical-level-one');

Route::get('medical-level-one-detail/{id}', [App\Http\Controllers\AdminController::class, 'medical_level_one_detail'])->name('medical-level-one-detail');


/*------- end parent management --------*/

/*------- parent management --------*/

Route::get('medical-level-two', [App\Http\Controllers\AdminController::class, 'index_medical_level_two'])->name('medical-level-two');

Route::get('add-medical-level-two', [App\Http\Controllers\AdminController::class, 'add_medical_level_two'])->name('add-medical-level-two');

Route::post('post-add-medical-level-two', [App\Http\Controllers\AdminController::class, 'post_add_medical_level_two'])->name('post-add-medical-level-two');

Route::get('update-medical-level-two/{id}', [App\Http\Controllers\AdminController::class, 'update_medical_level_two'])->name('update-medical-level-two');

Route::post('post-update-medical-level-two', [App\Http\Controllers\AdminController::class, 'post_update_medical_level_two'])->name('post-update-medical-level-two');

Route::get('delete-medical-level-two/{id}', [App\Http\Controllers\AdminController::class, 'delete_medical_level_two'])->name('delete-medical-level-two');

Route::get('medical-level-two-detail/{id}', [App\Http\Controllers\AdminController::class, 'medical_level_two_detail'])->name('medical-level-two-detail');

/*------- end medical management --------*/


/*------- care provider management --------*/

Route::get('care-provider', [App\Http\Controllers\AdminController::class, 'index_care_provider'])->name('care-provider');

Route::get('add-care-provider', [App\Http\Controllers\AdminController::class, 'add_care_provider'])->name('add-care-provider');

Route::post('post-add-care-provider', [App\Http\Controllers\AdminController::class, 'post_add_care_provider'])->name('post-add-care-provider');

Route::get('update-care-provider/{id}', [App\Http\Controllers\AdminController::class, 'update_care_provider'])->name('update-care-provider');

Route::post('post-update-care-provider', [App\Http\Controllers\AdminController::class, 'post_update_care_provider'])->name('post-update-care-provider');

Route::get('delete-care-provider/{id}', [App\Http\Controllers\AdminController::class, 'delete_care_provider'])->name('delete-care-provider');

Route::get('detail-care-provider/{id}', [App\Http\Controllers\AdminController::class, 'detail_care_provider'])->name('detail-care-provider');
/*------- care provider management --------*/

/*------- school detail level one management --------*/

Route::get('school-detail-level-one', [App\Http\Controllers\AdminController::class, 'index_school_detail_level_one'])->name('school-detail-level-one');

Route::get('add-school-detail-level-one', [App\Http\Controllers\AdminController::class, 'add_school_detail_level_one'])->name('add-school-detail-level-one');

Route::post('post-add-school-detail-level-one', [App\Http\Controllers\AdminController::class, 'post_add_school_detail_level_one'])->name('post-add-school-detail-level-one');

Route::get('update-school-detail-level-one/{id}', [App\Http\Controllers\AdminController::class, 'update_school_detail_level_one'])->name('update-school-detail-level-one');

Route::post('post-update-school-detail-level-one', [App\Http\Controllers\AdminController::class, 'post_update_school_detail_level_one'])->name('post-update-school-detail-level-one');

Route::get('delete-school-detail-level-one/{id}', [App\Http\Controllers\AdminController::class, 'delete_school_detail_level_one'])->name('delete-school-detail-level-one');

Route::get('detail-school-detail-level-one/{id}', [App\Http\Controllers\AdminController::class, 'detail_school_detail_level_one'])->name('detail-school-detail-level-one');


/*------- end school detail level one management --------*/

/*------- school detail level two management --------*/

Route::get('school-detail-level-two', [App\Http\Controllers\AdminController::class, 'index_school_detail_level_two'])->name('school-detail-level-two');

Route::get('add-school-detail-level-two', [App\Http\Controllers\AdminController::class, 'add_school_detail_level_two'])->name('add-school-detail-level-two');

Route::post('post-add-school-detail-level-two', [App\Http\Controllers\AdminController::class, 'post_add_school_detail_level_two'])->name('post-add-school-detail-level-two');

Route::get('update-school-detail-level-two/{id}', [App\Http\Controllers\AdminController::class, 'update_school_detail_level_two'])->name('update-school-detail-level-two');

Route::post('post-update-school-detail-level-two', [App\Http\Controllers\AdminController::class, 'post_update_school_detail_level_two'])->name('post-update-school-detail-level-two');

Route::get('delete-school-detail-level-two/{id}', [App\Http\Controllers\AdminController::class, 'delete_school_detail_level_two'])->name('delete-school-detail-level-two');

Route::get('detail-school-detail-level-two/{id}', [App\Http\Controllers\AdminController::class, 'detail_school_detail_level_two'])->name('detail-school-detail-level-two');

/*------- end school detail level two management --------*/


/*------- school detail level two management --------*/

Route::get('extra-curricular', [App\Http\Controllers\AdminController::class, 'index_extra_curricular'])->name('extra-curricular');

Route::get('add-extra-curricular', [App\Http\Controllers\AdminController::class, 'add_extra_curricular'])->name('add-extra-curricular');

Route::post('post-add-extra-curricular', [App\Http\Controllers\AdminController::class, 'post_add_extra_curricular'])->name('post-add-extra-curricular');

Route::get('update-extra-curricular/{id}', [App\Http\Controllers\AdminController::class, 'update_extra_curricular'])->name('update-extra-curricular');

Route::post('post-update-extra-curricular', [App\Http\Controllers\AdminController::class, 'post_update_extra_curricular'])->name('post-update-extra-curricular');

Route::get('delete-extra-curricular/{id}', [App\Http\Controllers\AdminController::class, 'delete_extra_curricular'])->name('delete-extra-curricular');

Route::get('detail-extra-curricular/{id}', [App\Http\Controllers\AdminController::class, 'detail_extra_curricular'])->name('detail-extra-curricular');

/*------- end school detail level two management --------*/


/*------- about detail management --------*/

Route::get('about-details', [App\Http\Controllers\AdminController::class, 'index_about_details'])->name('about-details');

Route::get('add-about-details', [App\Http\Controllers\AdminController::class, 'add_about_details'])->name('add-about-details');

Route::post('post-add-about-details', [App\Http\Controllers\AdminController::class, 'post_add_about_details'])->name('post-add-about-details');

Route::get('update-about-details/{id}', [App\Http\Controllers\AdminController::class, 'update_about_details'])->name('update-about-details');

Route::post('post-update-about-details', [App\Http\Controllers\AdminController::class, 'post_update_about_details'])->name('post-update-about-details');

Route::get('delete-about-details/{id}', [App\Http\Controllers\AdminController::class, 'delete_about_details'])->name('delete-about-details');

Route::get('detail-about-details/{id}', [App\Http\Controllers\AdminController::class, 'detail_about_details'])->name('detail-about-details');
/*------- end about detail management --------*/


/*------- insurance detail management --------*/

Route::get('insurance-details', [App\Http\Controllers\AdminController::class, 'index_insurance_details'])->name('insurance-details');

Route::get('add-insurance-details', [App\Http\Controllers\AdminController::class, 'add_insurance_details'])->name('add-insurance-details');

Route::post('post-add-insurance-details', [App\Http\Controllers\AdminController::class, 'post_add_insurance_details'])->name('post-add-insurance-details');

Route::get('update-insurance-details/{id}', [App\Http\Controllers\AdminController::class, 'update_insurance_details'])->name('update-insurance-details');

Route::post('post-update-insurance-details', [App\Http\Controllers\AdminController::class, 'post_update_insurance_details'])->name('post-update-insurance-details');

Route::get('delete-insurance-details/{id}', [App\Http\Controllers\AdminController::class, 'delete_insurance_details'])->name('delete-insurance-details');

Route::get('detail-insurance-details/{id}', [App\Http\Controllers\AdminController::class, 'detail_insurance_details'])->name('detail-insurance-details');
/*------- end insurance detail management --------*/

/*------- insurance detail management --------*/

Route::get('support-details', [App\Http\Controllers\AdminController::class, 'index_support_details'])->name('support-details');

Route::get('add-support-details', [App\Http\Controllers\AdminController::class, 'add_support_details'])->name('add-support-details');

Route::post('post-add-support-details', [App\Http\Controllers\AdminController::class, 'post_add_support_details'])->name('post-add-support-details');

Route::get('update-support-details/{id}', [App\Http\Controllers\AdminController::class, 'update_support_details'])->name('update-support-details');

Route::post('post-update-support-details', [App\Http\Controllers\AdminController::class, 'post_update_support_details'])->name('post-update-support-details');

Route::get('delete-support-details/{id}', [App\Http\Controllers\AdminController::class, 'delete_support_details'])->name('delete-support-details');

Route::get('detail-support-details/{id}', [App\Http\Controllers\AdminController::class, 'detail_support_details'])->name('detail-support-details');
/*------- end insurance detail management --------*/


/*------- document detail management --------*/

Route::get('document-details', [App\Http\Controllers\AdminController::class, 'index_document_details'])->name('document-details');

Route::get('add-document-details', [App\Http\Controllers\AdminController::class, 'add_document_details'])->name('add-document-details');

Route::post('post-add-document-details', [App\Http\Controllers\AdminController::class, 'post_add_document_details'])->name('post-add-document-details');

Route::get('update-document-details/{id}', [App\Http\Controllers\AdminController::class, 'update_document_details'])->name('update-document-details');

Route::post('post-update-document-details', [App\Http\Controllers\AdminController::class, 'post_update_document_details'])->name('post-update-document-details');

Route::get('delete-document-details/{id}', [App\Http\Controllers\AdminController::class, 'delete_document_details'])->name('delete-document-details');

Route::get('detail-document-details/{id}', [App\Http\Controllers\AdminController::class, 'detail_document_details'])->name('detail-document-details');


/*------- end document detail management --------*/

/*------- document detail management --------*/

Route::get('legal-details', [App\Http\Controllers\AdminController::class, 'index_legal_details'])->name('legal-details');

Route::get('add-legal-details', [App\Http\Controllers\AdminController::class, 'add_legal_details'])->name('add-legal-details');

Route::post('post-add-legal-details', [App\Http\Controllers\AdminController::class, 'post_add_legal_details'])->name('post-add-legal-details');

Route::get('update-legal-details/{id}', [App\Http\Controllers\AdminController::class, 'update_legal_details'])->name('update-legal-details');

Route::post('post-update-legal-details', [App\Http\Controllers\AdminController::class, 'post_update_legal_details'])->name('post-update-legal-details');

Route::get('delete-legal-details/{id}', [App\Http\Controllers\AdminController::class, 'delete_legal_details'])->name('delete-legal-details');

Route::get('detail-legal-details/{id}', [App\Http\Controllers\AdminController::class, 'detail_legal_details'])->name('detail-legal-details');


/*------- end document detail management --------*/


});


Route::get('admin-logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('admin-logout');

/*------ User Controller -------*/
/*---- For Testing ---*/ 
Route::get('index', [App\Http\Controllers\UserController::class, 'index'])->name('index');
/*---- end For Testing ---*/


/*------ Admin Controller -------*/

/*---- For Testing ---*/ 




/*---- end For Testing ---*/
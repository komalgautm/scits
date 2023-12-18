<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontEnd\UserController;
use App\Http\Controllers\frontEnd\DashboardController;
use App\Http\Controllers\frontEnd\LockAccountController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [UserController::class, 'login']);
Route::post('/login',[UserController::class, 'login_check']);
// ->middleware('PreventBack');
Route::get('get-homes/{company_name}', [UserController::class, 'get_homes']);

//lockscreen (not required to saved in db)
Route::get('lock',[LockAccountController::class, 'lock']);
Route::get('lockscreen',[LockAccountController::class, 'lockscreen']);
Route::post('lockscreen',[LockAccountController::class, 'unlock']);


// Route::get('lock', 'App\Http\Controllers\frontEnd\LockAccountController@lock');
// Route::get('lockscreen', 'App\Http\Controllers\frontEnd\LockAccountController@lockscreen');
// Route::post('lockscreen', 'App\Http\Controllers\frontEnd\LockAccountController@unlock');


Route::group(['middleware'=>['checkUserAuth','lock']],function(){

	Route::get('/', [DashboardController::class, 'dashboard']);
	Route::post('/add-incident-report', 'App\Http\Controllers\frontEnd\DashboardController@add_incident_report');

	// ------------- Personal Management - My profile ---------------------// 
	Route::get('/my-profile/{user_id}', 'App\Http\Controllers\frontEnd\PersonalManagement\ProfileController@index');
	Route::post('/my-profile/edit', 'App\Http\Controllers\frontEnd\PersonalManagement\ProfileController@edit_profile_setting');
	
	Route::match(['get','post'], '/profile/change-password', 'App\Http\Controllers\frontEnd\PersonalManagement\ChangePasswordController@change_password');

	// Weekly money module
	Route::post('weekly-allowance/update','App\Http\Controllers\frontEnd\ServiceUserManagement\MoneyController@update_home_weekly_allowance');
	
	//----12 jun 2018----
	Route::post('shopping_budget/add','App\Http\Controllers\frontEnd\ServiceUserManagement\MoneyController@add_shopping_bugdet');
	
	//add petty cash for home 
	Route::post('/profile/petty_cash/add-cash','App\Http\Controllers\frontEnd\PersonalManagement\PettyCashController@add_petty_cash');
	Route::get('/profile/petty-cash/view/{petty_cash_id}', 'App\Http\Controllers\frontEnd\PersonalManagement\PettyCashController@view');
	Route::match(['get','post'],'/profile/petty_cash/check-balance','App\Http\Controllers\frontEnd\PersonalManagement\PettyCashController@get_petty_balance');
	Route::match(['get','post'],'/profile/petty-cashes', 'App\Http\Controllers\frontEnd\PersonalManagement\PettyCashController@index');

	// location history
	Route::match(['get','post'], '/service/location-history/{service_user_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\LocationHistoryController@index');
	Route::post('/service/location-history/location/add', 'App\Http\Controllers\frontEnd\ServiceUserManagement\LocationHistoryController@add_location');

    Route::match(['get', 'post'],'/service/location-history/location/edit/{location_history_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\LocationHistoryController@edit_location');

	Route::get('/service/location-history/location/delete/{location_history_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\LocationHistoryController@delete_location');
	Route::post('/service/location-history/restriction-type/change', 'App\Http\Controllers\frontEnd\ServiceUserManagement\LocationHistoryController@change_location_restriction_type');


	//Sick Leave
	Route::match(['get', 'post'], '/my-profile/sick-leaves/view/{manager_id}', 'App\Http\Controllers\frontEnd\PersonalManagement\SickLeaveController@index');
	//Route::match(['get', 'post'], '/my-profile/sick-leaves/delete/{sick_leave_id}', 'App\Http\Controllers\frontEnd\PersonalManagement\SickLeaveController@delete');
	Route::match(['get', 'post'], '/my-profile/sick-leaves/view-record/{sick_leave_id}', 'App\Http\Controllers\frontEnd\PersonalManagement\SickLeaveController@view_sick_record');
	
	//Annual Leave
	Route::match(['get', 'post'], '/my-profile/annual-leaves/view/{manager_id}', 'App\Http\Controllers\frontEnd\PersonalManagement\AnnualLeaveController@index');
	Route::match(['get', 'post'], '/my-profile/annual-leaves/view-record/{annual_leave_id}', 'App\Http\Controllers\frontEnd\PersonalManagement\AnnualLeaveController@view_annual_record');
	//Task Allocation
	Route::match(['get', 'post'], '/my-profile/task-allocation/view/{manager_id}', 'App\Http\Controllers\frontEnd\PersonalManagement\TaskAllocationController@index');

	// -------- Header ------------------------//
	//Dynamic forms
	//Route::match(['get','post'], '/system/plans/', 'App\Http\Controllers\frontEnd\SystemManagement\PlanBuilderController@index');
	
	//not
	Route::match(['get', 'post'],'/service/dynamic-forms', 'App\Http\Controllers\frontEnd\ServiceUserManagement\DynamicFormController@index');
	
	Route::post('/service/dynamic-form/save', 'App\Http\Controllers\frontEnd\ServiceUserManagement\DynamicFormController@save_form');
	Route::post('/service/dynamic-form/edit', 'App\Http\Controllers\frontEnd\ServiceUserManagement\DynamicFormController@edit_form');
	Route::post('/service/dynamic-form/view/pattern', 'App\Http\Controllers\frontEnd\ServiceUserManagement\DynamicFormController@view_form_pattern');
	Route::post('/service/patterndataformio', 'App\Http\Controllers\frontEnd\ServiceUserManagement\DynamicFormController@patterndataformio');
	Route::post('/service/patterndataformiovaule', 'App\Http\Controllers\frontEnd\ServiceUserManagement\DynamicFormController@patterndataformiovalue');
	Route::get('/service/dynamic-form/view/data/{dynamic_form_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\DynamicFormController@view_form_data');
	Route::get('/service/dynamic-form/delete/{dynamic_form_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\DynamicFormController@delete_form');
	Route::post('/service/dynamic-form/edit-details', 'App\Http\Controllers\frontEnd\ServiceUserManagement\DynamicFormController@edit_details');
	Route::post('/service/dynamic-form/daily-log', 'App\Http\Controllers\frontEnd\ServiceUserManagement\DynamicFormController@su_daily_log_add');

	// Route::match(['get','post'], '/system/plans/edit', 'App\Http\Controllers\frontEnd\SystemManagement\PlanBuilderController@edit');
	// Route::match(['get','post'], '/system/plans/delete/{plan_id}', 'App\Http\Controllers\frontEnd\SystemManagement\PlanBuilderController@delete');

	// -------- Service Management ------------------------//

	Route::match(['get','post'], '/service-user-management', 'App\Http\Controllers\frontEnd\ServiceUserManagementController@service_users');
	Route::match(['get','post'], '/service/user-profile/{service_user_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\ProfileController@index');

	Route::get('/service/user/afc-status/{service_user_id}','App\Http\Controllers\frontEnd\ServiceUserManagement\ProfileController@get_afc_status');
	
	// status change of su_profile pic
	Route::match(['get','post'],'/service/user-profile/afc-status/update/{service_user_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\ProfileController@update_afc_status');

	//notifications
	Route::match(['get','post'], '/service/notifications/', 'App\Http\Controllers\frontEnd\ServiceUserManagement\ProfileController@show_notifications');

	Route::match(['get','post'], '/system-management', 'App\Http\Controllers\frontEnd\SystemManagementController@system_management');
 
	Route::match(['get','post'], '/add-service-user', 'App\Http\Controllers\frontEnd\SystemManagementController@add_service_user');
	Route::match(['get','post'], '/add-staff-user', 'App\Http\Controllers\frontEnd\SystemManagementController@add_staff_user');
	Route::get('user/qualification/delete/{id}','App\Http\Controllers\frontEnd\SystemManagementController@delete_certificate');

	//Daily Record in ServiceUserManagement
	Route::match(['get','post'], '/service/daily-records/{service_user_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\DailyRecordController@index');
	Route::match(['get','post'], '/service/daily-record/add', 'App\Http\Controllers\frontEnd\ServiceUserManagement\DailyRecordController@add');
	Route::match(['get','post'], '/service/daily-record/edit', 'App\Http\Controllers\frontEnd\ServiceUserManagement\DailyRecordController@edit');
	Route::match(['get','post'], '/service/daily-record/delete/{su_daily_record_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\DailyRecordController@delete');
	Route::match(['get','post'], '/service/daily-record/calendar/add/{su_daily_record_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\DailyRecordController@add_to_calendar');
	/*Route::match(['get','post'], '/service/daily-record/status/{daily_record_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\DailyRecordController@update_status');*/

	//Daily Logs in ServiceUserManagement
	Route::match(['get','post'], '/service/daily-logs', 'App\Http\Controllers\frontEnd\ServiceUserManagement\DailyLogsController@index');

	//Backend Logs Download
	Route::get('/service/logbook/download', 'App\Http\Controllers\frontEnd\ServiceUserManagement\PDFLogsController@download');

	//health record
	Route::get('/service/health-records/{service_user_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\HealthRecordController@index');
	Route::post('/service/health-record/add', 'App\Http\Controllers\frontEnd\ServiceUserManagement\HealthRecordController@add');
	Route::post('/service/health-record/edit', 'App\Http\Controllers\frontEnd\ServiceUserManagement\HealthRecordController@edit');
	Route::get('/service/health-record/delete/{su_health_record_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\HealthRecordController@delete');

	//risks
	Route::post('/service/risk/status/change', 'App\Http\Controllers\frontEnd\ServiceUserManagement\RiskController@change_risk_status');
	Route::get('/service/risks/{su_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\RiskController@index');
	Route::get('/service/risk/view/{risk_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\RiskController@view');
	Route::get('/service/risk/risksfilter', 'App\Http\Controllers\frontEnd\ServiceUserManagement\RiskController@risksfilter');
	//risk RMP
	Route::post('/service/risk/rmp/add', 'App\Http\Controllers\frontEnd\ServiceUserManagement\RiskController@add_rmp_risk');
	Route::get('/service/risk/rmp/view/{su_risk_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\RiskController@view_rmp_risk');
	//edit only a single records info
	Route::post('/service/risk/rmp/edit/{su_rmp_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\RiskController@edit_rmp_risk');
	
	Route::get('/service/risk/inc-rec/view/{su_risk_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\RiskController@view_inc_rec_risk');
	//edit multiple records at a time - details, review etc. 

	//risk Incident Report
	Route::post('/service/risk/inc-rep/add', 'App\Http\Controllers\frontEnd\ServiceUserManagement\RiskController@add_inc_rep');
	Route::post('/service/risk/inc-rep/edit', 'App\Http\Controllers\frontEnd\ServiceUserManagement\RiskController@edit_inc_rep');

	//File Manager
	Route::match(['get','post'], '/service/file-managers/{service_user_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\FileController@index');
	Route::match(['get','post'], '/service/file-manager/add', 'App\Http\Controllers\frontEnd\ServiceUserManagement\FileController@add_files');
	Route::get('/service/file-manager/delete/{file_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\FileController@delete');
	Route::post('/service/file-manager/upload/add', 'App\Http\Controllers\frontEnd\ServiceUserManagement\FileController@add_file');
	Route::post('/service/file-manager/email', 'App\Http\Controllers\frontEnd\ServiceUserManagement\FileController@file_email');

	//care team serviceUserManagement
	Route::match(['get','post'], '/service/care_team/add/{service_user_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\ProfileController@add_care_team');
	Route::match(['get','post'], '/service/care_team/edit', 'App\Http\Controllers\frontEnd\ServiceUserManagement\ProfileController@edit_care_team');
	Route::match(['get','post'], '/service/care_team/delete/{care_team_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\ProfileController@delete_care_team');

	//careHistory serviceUserManagement
	Route::match(['get','post'], '/service/care_history/add/{service_user_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\ProfileController@add_care_history');
	Route::match(['get','post'], '/service/care_history/edit', 'App\Http\Controllers\frontEnd\ServiceUserManagement\ProfileController@edit_care_history');
	Route::match(['get','post'], '/service/care_history/delete/{care_history_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\ProfileController@delete_care_history');
	
	Route::match(['get','post'], '/service/care-history/delete-file/{su_care_history_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\ProfileController@delete_hist_file');
	
	//location info
	Route::post('/service/user/edit-location-details', 'App\Http\Controllers\frontEnd\ServiceUserManagement\ProfileController@edit_location_info');
	Route::post('/service/user/edit-contact-details', 'App\Http\Controllers\frontEnd\ServiceUserManagement\ProfileController@edit_contact_info');
	
	//contact_us
	Route::post('/service/user/contact-person/edit', 'App\Http\Controllers\frontEnd\ServiceUserManagement\ProfileController@edit_contact_person');
	Route::get('/service/user/contact-person/delete/{contact_us_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\ProfileController@delete_contact_person');

	//earning scheme	
	Route::match(['get','post'], '/service/earning-scheme/{service_user_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\EarningSchemeController@index');
	Route::match(['get','post'], '/service/earning-scheme/view_incentive/{earning_category_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\EarningSchemeController@view_incentive');
	Route::match(['get','post'], '/service/earning-scheme/incentive/add', 'App\Http\Controllers\frontEnd\ServiceUserManagement\EarningSchemeController@add_to_calendar');
	Route::post('/service/earning-scheme/star/remove/{service_user_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\EarningSchemeController@remove_star');
	
	Route::post('/service/earning/set-target', 'App\Http\Controllers\frontEnd\ServiceUserManagement\EarningSchemeController@set_su_earning_target');

	//suspend incentive
	Route::post('/service/earning-scheme/incentive/suspend', 'App\Http\Controllers\frontEnd\ServiceUserManagement\EarningSchemeController@incentive_suspend');
	Route::get('/service/earning-scheme/incentive/suspend/view/{suspended_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\EarningSchemeController@view_suspension');
	/*Route::post('/service/earning-scheme/incentive/suspend/edit', 'App\Http\Controllers\frontEnd\ServiceUserManagement\EarningSchemeController@edit_suspension');*/
	Route::get('/service/earning-scheme/incentive/suspend/delete', 'App\Http\Controllers\frontEnd\ServiceUserManagement\EarningSchemeController@remove_suspension');

	//Living Skill in ServiceUserManagement
	Route::match(['get', 'post'], '/service/living-skills/{service_user_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\LivingSkillController@index');
	Route::match(['get','post'], '/service/living-skill/add', 'App\Http\Controllers\frontEnd\ServiceUserManagement\LivingSkillController@add');
	Route::match(['get','post'], '/service/living-skill/edit', 'App\Http\Controllers\frontEnd\ServiceUserManagement\LivingSkillController@edit');
	Route::match(['get','post'], '/service/living-skill/delete/{su_living_skill_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\LivingSkillController@delete');
	Route::match(['get','post'], '/service/living-skill/calendar/add/{su_living_skill_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\LivingSkillController@add_to_calendar');
	
	//Education Record in ServiceUserManagement
	Route::match(['get','post'], '/service/education-records/{service_user_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\EducationRecordController@index');
	Route::match(['get','post'], '/service/education-record/add', 'App\Http\Controllers\frontEnd\ServiceUserManagement\EducationRecordController@add');
	Route::match(['get','post'], '/service/education-record/edit', 'App\Http\Controllers\frontEnd\ServiceUserManagement\EducationRecordController@edit');
	Route::match(['get','post'], '/service/education-record/delete/{su_edu_record_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\EducationRecordController@delete');
	Route::match(['get','post'], '/service/education-record/calendar/add/{su_edu_record_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\EducationRecordController@add_to_calendar');

	//MFC Records in ServiceUserManagement
	Route::match(['get','post'], '/service/mfc-records/{service_user_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\MFCController@index');
	Route::get('/service/mfc/view/{su_mfc_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\MFCController@view_mfc_rcrd');
	Route::post('/service/mfc/add', 'App\Http\Controllers\frontEnd\ServiceUserManagement\MFCController@add');
	Route::match(['get', 'post'], '/service/mfc/edit/{su_mfc_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\MFCController@edit');
	Route::match(['get','post'], '/service/mfc/delete/{su_mfc_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\MFCController@delete');

	//BMP_RMP in  Daily Record ServiceUserManagement
	Route::match(['get','post'], '/service/bmp-rmps/{service_user_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\BmpRmpController@index'); 
	Route::post('/service/bmp-rmp/add', 'App\Http\Controllers\frontEnd\ServiceUserManagement\BmpRmpController@add'); 
	Route::post('/service/bmp-rmp/edit', 'App\Http\Controllers\frontEnd\ServiceUserManagement\BmpRmpController@edit');
	Route::get('/service/bmp-rmp/delete/{bmp_rmp_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\BmpRmpController@delete');

	Route::match(['get','post'], '/service/bmp-rmp/view/{bmp_rmp_risk_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\BmpRmpController@view_detail');

	Route::post('/service/user/edit-details', 'App\Http\Controllers\frontEnd\ServiceUserManagement\ProfileController@edit_detail_info');
	/*Route::match(['get','post'], '/service/daily-records-bmp-rmp/{service_user_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\BmpRmpController@service_users_list');*/ 

    //Body Map

	Route::match(['get','post'],'/service/body-map/{risk_id}','App\Http\Controllers\frontEnd\ServiceUserManagement\BodyMapController@index');
	Route::match(['get','post'],'/service/body-map/injury/add','App\Http\Controllers\frontEnd\ServiceUserManagement\BodyMapController@addInjury');
	Route::match(['get','post'],'/service/body-map/injury/remove/{service_user_id}','App\Http\Controllers\frontEnd\ServiceUserManagement\BodyMapController@removeInjury');

	//calender paths
	Route::match(['get','post'], '/service/calendar/{service_user_id}', 'App\Http\Controllers\frontEnd\CalendarController@index');
	Route::match(['get','post'], '/service/calendar/daily-records/{serv_usr_id}', 'App\Http\Controllers\frontEnd\CalendarController@daily_records');
	Route::match(['get','post'], '/service/calendar/health-records/{serv_usr_id}', 'App\Http\Controllers\frontEnd\CalendarController@health_records');
	Route::match(['get','post'], '/service/calendar/daily-records/delete/{daily_record_id}', 'App\Http\Controllers\frontEnd\CalendarController@delete_daily_record');

	//calendar drag & drop events
	Route::match(['get','post'],'/service/calendar/event/add', 'App\Http\Controllers\frontEnd\CalendarController@add_event');
	Route::match(['get','post'], '/service/calendar/event/move', 'App\Http\Controllers\frontEnd\CalendarController@move_event');
	

	//calendar entries
	Route::get('/service/calendar/entry/display-form/{plan_bulider_id}', 'App\Http\Controllers\frontEnd\CalendarEntryController@display_form');
	Route::post('/service/calendar/entry/add', 'App\Http\Controllers\frontEnd\CalendarEntryController@add');
	
	// calendar add notes
	Route::post('/service/calendar/note/add', 'App\Http\Controllers\frontEnd\CalendarEntryController@add_note');
	Route::post('/service/calendar/mandatory_leave/add', 'App\Http\Controllers\frontEnd\CalendarEntryController@add_mandatory_leave');

	// calendar view event details
	Route::match(['get','post'], '/service/calendar/event/view', 'App\Http\Controllers\frontEnd\CalendarEventController@index');
	Route::match(['get','post'], '/service/calendar/event/edit', 'App\Http\Controllers\frontEnd\CalendarEventController@edit');
	Route::match(['get','post'], '/service/calendar/event/remove/{calendar_id}', 'App\Http\Controllers\frontEnd\CalendarEventController@delete');

    //Weekly and Monthly Report
    Route::match(['get','post'], '/select/report', 'App\Http\Controllers\frontEnd\ServiceUserManagement\ReportController@index');
    Route::match(['get','post'], '/monthly/report/detail/{log_book_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\ReportController@monthly_report_detail');
    Route::match(['get','post'], '/edit/report/detail', 'App\Http\Controllers\frontEnd\ServiceUserManagement\ReportController@edit_report_detail');
    Route::match(['get','post'], '/send/mail/careteam/{log_book_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\ReportController@send_mail_to_careteam');

	//EventChange Request
	Route::get('/service/event-requests/{service_user_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\EventRequestController@index');
	Route::get('/service/event-request/{req_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\EventRequestController@view');
	Route::post('/service/event-request/update', 'App\Http\Controllers\frontEnd\ServiceUserManagement\EventRequestController@update');

	//placement plan - service usr mngment
	Route::match(['get','post'], '/service/placement-plans/{su_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\PlacementPlanController@index');
	Route::match(['get','post'], '/service/placement-plan/add', 'App\Http\Controllers\frontEnd\ServiceUserManagement\PlacementPlanController@add');
	Route::match(['get','post'], '/service/placement-plan/completed-targets/{su_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\PlacementPlanController@completed_targets');
	Route::match(['get','post'], '/service/placement-plan/active-targets/{su_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\PlacementPlanController@active_targets');
	Route::match(['get','post'], '/service/placement-plan/pending-targets/{su_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\PlacementPlanController@pending_targets');
	Route::match(['get','post'], '/service/placement-plan/mark-complete/{target_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\PlacementPlanController@mark_complete');
	Route::match(['get','post'], '/service/placement-plan/mark-active/{target_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\PlacementPlanController@mark_active');

	Route::match(['get','post'], '/service/placement-plan/target/view/{act_tar_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\PlacementPlanController@view_target');
	Route::post('/service/placement-plan/edit', 'App\Http\Controllers\frontEnd\ServiceUserManagement\PlacementPlanController@edit');
	
	Route::post('/service/placement-plan/add-qqa-review', 'App\Http\Controllers\frontEnd\ServiceUserManagement\PlacementPlanController@add_qqa_review');

	//RMP
	Route::match(['get','post'],'/service/rmp/view/{service_user_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\RmpController@index');
	Route::get('/service/rmp/view_rmp/{su_rmp_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\RmpController@view_rmp');
	Route::post('/service/rmp/add', 'App\Http\Controllers\frontEnd\ServiceUserManagement\RmpController@add_rmp');
	Route::match(['get','post'],'/service/rmp/edit_rmp/{su_rmp_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\RmpController@edit_rmp');
	Route::get('/service/rmp/delete/{su_rmp_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\RmpController@delete');
	Route::match(['get','post'], '/service/rmp/edit', 'App\Http\Controllers\frontEnd\ServiceUserManagement\RmpController@edit');

	//BMP
	Route::match(['get','post'], '/service/bmp/view/{service_user_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\BmpController@index');
	Route::post('/service/bmp/add', 'fApp\Http\Controllers\frontEnd\ServiceUserManagement\BmpController@add_bmp');
	Route::match(['get','post'],'/service/bmp/edit', 'App\Http\Controllers\frontEnd\ServiceUserManagement\BmpController@edit');
	Route::get('/service/bmp/delete/{su_bmp_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\BmpController@delete');
	Route::get('/service/bmp/view_bmp/{su_bmp_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\BmpController@view_bmp');
	Route::post('/service/rmp/edit_bmp/{su_bmp_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\BmpController@edit_bmp');

	//IncidentReport
	Route::match(['get','post'], '/service/incident-report/views/{service_user_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\IncidentController@index');
	Route::get('/service/incident-report/view_incident/{su_incident_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\IncidentController@view_incident');
	Route::post('/service/incident-report/add', 'App\Http\Controllers\frontEnd\ServiceUserManagement\IncidentController@add_incident');
	Route::post('/service/incident-report/edit_incident/{su_incident_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\IncidentController@edit_incident');
	Route::get('/service/incident-report/delete/{su_incident_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\IncidentController@delete');

	//ServiceUser LogBook
	Route::match(['get','post'], '/service/logsbook/{service_user_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\LogBookController@index');
	Route::post('/service/logbook/add', 'App\Http\Controllers\frontEnd\ServiceUserManagement\LogBookController@add');
	Route::get('/service/logbook/view/{log_book_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\LogBookController@view');

	/**
	 * BaseUrl: 
	 */
	$LogBookCommentsController = 'App\Http\Controllers\frontEnd\ServiceUserManagement\LogBookComments\LogBookCommentsController@';
	Route::get('/service/logbook/comments', $LogBookCommentsController.'index');
	Route::post('/service/logbook/comments', $LogBookCommentsController.'store');

	// Route::get('/service/logbook/view/{service_user_id}/{log_book_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\LogBookController@view');
	Route::get('/service/logbook/Calendar/add', 'App\Http\Controllers\frontEnd\ServiceUserManagement\LogBookController@add_to_calendar');

	//handover point
	Route::get('/staff-user-list', 'App\Http\Controllers\frontEnd\ServiceUserManagement\LogBookController@staffuserlist');
	Route::post('/handover/service/log', 'App\Http\Controllers\frontEnd\ServiceUserManagement\LogBookController@log_handover_to_staff_user');
	Route::match(['get','post'], '/handover/daily/log', 'App\Http\Controllers\frontEnd\HandoverController@index');
	Route::match(['get','post'], '/handover/daily/log/edit', 'App\Http\Controllers\frontEnd\HandoverController@handover_log_edit');

    //add to weekly
    Route::match(['get','post'], '/weekly/report/{log_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\LogBookController@weekly_report');
    Route::match(['get','post'], '/weekly/rprt/edit/{service_user_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\LogBookController@weekly_report_edit');
    
	// su Moods listing
	Route::get('/service/moods/{service_user_id}', 'App\Http\Controllers\frontEnd\ServiceUserManagement\MoodController@index');
	Route::post('/service/mood/suggestion/add', 'App\Http\Controllers\frontEnd\ServiceUserManagement\MoodController@add');

	// my money requests of user
	Route::get('service/money-requests/{service_user_id}','App\Http\Controllers\frontEnd\ServiceUserManagement\MoneyController@index');
	Route::get('service/money-request/{money_request_id}','App\Http\Controllers\frontEnd\ServiceUserManagement\MoneyController@view_detail');
	Route::post('service/money-request/update','App\Http\Controllers\frontEnd\ServiceUserManagement\MoneyController@update');	

    Route::match(['get','post'],'notif/response','App\Http\Controllers\frontEnd\ServiceUserManagementController@notif_response');


	// -------- System Management ------------------------//
    //-------------shalinder----------------------------------------------------------------------//
    Route::match(['get','post'], '/system/earning-scheme/tasks/{label_id}','App\Http\Controllers\frontEnd\SystemManagement\EarningSchemeTaskController@index');
    Route::match(['get','post'],'/system/earning-scheme/task/add/{label_id}','App\Http\Controllers\frontEnd\SystemManagement\EarningSchemeTaskController@add');
    Route::match(['get','post'], '/system/earning-scheme/task/edit/{label_id}', 'App\Http\Controllers\frontEnd\SystemManagement\EarningSchemeTaskController@edit');
    Route::match(['get','post'],'/system/earning-scheme/task/delete/{daily_record_id}', 'App\Http\Controllers\frontEnd\SystemManagement\EarningSchemeTaskController@delete');
    Route::match(['get','post'],'/system/earning-scheme/task/status/{daily_record_id}', 'App\Http\Controllers\frontEnd\SystemManagement\EarningSchemeTaskController@update_status');
    Route::match(['get','post'],'/system/earning-scheme/del-daily-records', 'App\Http\Controllers\frontEnd\SystemManagement\EarningSchemeTaskController@delete_daily_records');
    //---------------------------------------------------------------------------------------------//

	//Daily Records in SystemManagement
	Route::match(['get','post'], '/system/daily-records/', 'App\Http\Controllers\frontEnd\SystemManagement\DailyRecordController@index');
	Route::match(['get','post'], '/system/daily-records/add', 'App\Http\Controllers\frontEnd\SystemManagement\DailyRecordController@add');
	Route::match(['get','post'], '/system/daily-records/delete/{daily_record_id}', 'App\Http\Controllers\frontEnd\SystemManagement\DailyRecordController@delete');
	Route::match(['get','post'], '/system/daily-records/status/{daily_record_id}', 'App\Http\Controllers\frontEnd\SystemManagement\DailyRecordController@update_status');
	Route::match(['get','post'], '/system/daily-records/edit', 'App\Http\Controllers\frontEnd\SystemManagement\DailyRecordController@edit');
	Route::match(['get','post'], '/system/del-daily_records', 'App\Http\Controllers\frontEnd\SystemManagement\DailyRecordController@delete_daily_records');
	// Daily Records in SystemManagement end
	
	//MFC in SystemManagement May19
	Route::match(['get','post'], '/system/mfc/', 'App\Http\Controllers\frontEnd\SystemManagement\MFCController@index');
	Route::match(['get','post'], '/system/mfc/add', 'App\Http\Controllers\frontEnd\SystemManagement\MFCController@add');
	Route::match(['get','post'], '/system/mfc/edit', 'App\Http\Controllers\frontEnd\SystemManagement\MFCController@edit');
	Route::match(['get','post'], '/system/mfc/delete/{mfc_id}', 'App\Http\Controllers\frontEnd\SystemManagement\MFCController@delete');
	Route::match(['get','post'], '/system/mfc/status/{mfc_id}', 'App\Http\Controllers\frontEnd\SystemManagement\MFCController@update_status');

	//Risk Controller in SystemManagement
	Route::match(['get','post'], '/system/risk/add', 'App\Http\Controllers\frontEnd\SystemManagement\RiskController@add');
	Route::match(['get','post'], '/system/risk/index', 'App\Http\Controllers\frontEnd\SystemManagement\RiskController@index');
	Route::match(['get','post'], '/system/risk/delete/{risk_id}', 'App\Http\Controllers\frontEnd\SystemManagement\RiskController@delete');
	Route::match(['get','post'], '/system/risk/status/{risk_id}', 'App\Http\Controllers\frontEnd\SystemManagement\RiskController@update_status');
	Route::match(['get','post'], '/system/risk/edit', 'App\Http\Controllers\frontEnd\SystemManagement\RiskController@edit');
	Route::match(['get','post'], '/system/del-risk', 'App\Http\Controllers\frontEnd\SystemManagement\RiskController@risk_delete');
	//Risk Controller in SystemManagement End

	//Earning Scheme in SystemManagement
	Route::match(['get','post'], '/system/earning/index', 'App\Http\Controllers\frontEnd\SystemManagement\EarningSchemeController@index');
	Route::match(['get','post'], '/system/earning/add', 'App\Http\Controllers\frontEnd\SystemManagement\EarningSchemeController@add');
	Route::match(['get','post'], '/system/earning/edit', 'App\Http\Controllers\frontEnd\SystemManagement\EarningSchemeController@edit');
	Route::match(['get','post'], '/system/earning/delete/{earn_id}', 'App\Http\Controllers\frontEnd\SystemManagement\EarningSchemeController@delete');
	Route::match(['get','post'], '/system/earning/status/{earn_id}', 'App\Http\Controllers\frontEnd\SystemManagement\EarningSchemeController@update_status');
	//Multidelete earning schemes (Not Use)
	Route::match(['get','post'], '/system/del-earn', 'App\Http\Controllers\frontEnd\SystemManagement\EarningSchemeController@earning_scheme_delete');
	Route::match(['get','post'], '/system/earning/add_incentive', 'App\Http\Controllers\frontEnd\SystemManagement\EarningSchemeController@add_incentive');
	Route::match(['get','post'], '/system/earning/delete_incentive/{incentive_id}', 'App\Http\Controllers\frontEnd\SystemManagement\EarningSchemeController@delete_incentive');
	Route::match(['get','post'], '/system/earning/update_incentive_status/{incentive_id}', 'App\Http\Controllers\frontEnd\SystemManagement\EarningSchemeController@update_incentive_status');
	
	//Incentive View in Earning Scheme
	Route::match(['get','post'], '/system/earning/view_incentive/{incentive_id}', 'App\Http\Controllers\frontEnd\SystemManagement\EarningSchemeController@view_incentive');
	Route::match(['get','post'], '/system/earning/edit_incentive', 'App\Http\Controllers\frontEnd\SystemManagement\EarningSchemeController@edit_incentive');

	//Health Records in SystemManagement
	Route::match(['get','post'], '/system/health-records/', 'App\Http\Controllers\frontEnd\SystemManagement\HealthRecordController@index');
	/*Route::match(['get','post'], '/system/health-records/pagination', 'App\Http\Controllers\frontEnd\SystemManagement\HealthRecordController@pagination');*/

	//SupportTicket in SystemManagement
	Route::match(['get','post'], '/system/support-ticket', 'App\Http\Controllers\frontEnd\SystemManagement\SupportTicketController@index');
	Route::match(['get','post'], '/system/support-ticket/add', 'App\Http\Controllers\frontEnd\SystemManagement\SupportTicketController@add');
	Route::match(['get','post'], '/system/support-ticket/view/{ticket_id}', 'App\Http\Controllers\frontEnd\SystemManagement\SupportTicketController@view_ticket');
	Route::match(['get','post'], '/system/support-ticket/view-msg/add', 'App\Http\Controllers\frontEnd\SystemManagement\SupportTicketController@add_ticket_mesg');
	Route::match(['get','post'], '/system/support-ticket/ticket_status/{support_id}', 'App\Http\Controllers\frontEnd\SystemManagement\SupportTicketController@ticket_status');
	
	//Appointments / Plans in SystemManagement
	Route::match(['get','post'], '/system/plans/', 'App\Http\Controllers\frontEnd\SystemManagement\PlanBuilderController@index');
	Route::match(['get','post'], '/system/plans/add', 'App\Http\Controllers\frontEnd\SystemManagement\PlanBuilderController@add');
	Route::match(['get','post'], '/system/plans/view/{plan_builder_id}', 'App\Http\Controllers\frontEnd\SystemManagement\PlanBuilderController@view');
	Route::match(['get','post'], '/system/plans/edit', 'App\Http\Controllers\frontEnd\SystemManagement\PlanBuilderController@edit');
	Route::match(['get','post'], '/system/plans/delete/{plan_id}', 'App\Http\Controllers\frontEnd\SystemManagement\PlanBuilderController@delete');
	Route::match(['get','post'], '/system/del/plans', 'App\Http\Controllers\frontEnd\SystemManagement\PlanBuilderController@delete_plan');

	//Calendar in SystemManagement
		Route::match(['get','post'], '/system/calendar', 'App\Http\Controllers\frontEnd\SystemManagement\CalendarController@index');

		//calendar drag & drop events
		Route::match(['get','post'],'/system/calendar/event/add', 'App\Http\Controllers\frontEnd\SystemManagement\CalendarController@add_event');
		Route::match(['get','post'], '/system/calendar/event/move', 'App\Http\Controllers\frontEnd\SystemManagement\CalendarController@move_event');

		//calendar entries
		Route::get('/system/calendar/entry/display-form/{plan_bulider_id}', 'App\Http\Controllers\frontEnd\CalendarEntryController@display_form');
		Route::post('/system/calendar/entry/add', 'App\Http\Controllers\frontEnd\CalendarEntryController@add');

		// calendar add notes
		Route::post('/system/calendar/note/add', 'App\Http\Controllers\frontEnd\CalendarEntryController@add_note');

		// calendar view event details
		Route::match(['get','post'], '/system/calendar/event/view', 'App\Http\Controllers\frontEnd\CalendarEventController@index');
		Route::match(['get','post'], '/system/calendar/event/edit', 'App\Http\Controllers\frontEnd\CalendarEventController@edit');
		Route::match(['get','post'], '/system/calendar/event/remove/{calendar_id}', 'App\Http\Controllers\frontEnd\CalendarEventController@delete');
		Route::post('/system/calendar/select/member', 'App\Http\Controllers\frontEnd\SystemManagement\CalendarController@select_member');
	
		//Living Skills in SystemManagement
		Route::match(['get','post'], '/system/living-skills/', 'App\Http\Controllers\frontEnd\SystemManagement\LivingSkillController@index');
		Route::match(['get','post'], '/system/living-skill/add', 'App\Http\Controllers\frontEnd\SystemManagement\LivingSkillController@add');
		Route::match(['get','post'], '/system/living-skill/edit', 'App\Http\Controllers\frontEnd\SystemManagement\LivingSkillController@edit');
		Route::match(['get','post'], '/system/living-skill/delete/{living_skill_id}', 'App\Http\Controllers\frontEnd\SystemManagement\LivingSkillController@delete');
		Route::match(['get','post'], '/system/living-skill/status/{living_skill_id}', 'App\Http\Controllers\frontEnd\SystemManagement\LivingSkillController@update_status');
		Route::match(['get','post'], '/system/del/living-skill/', 'App\Http\Controllers\frontEnd\SystemManagement\LivingSkillController@living_skill_delete');
		//Living Skills in SystemManagement end
		
		//Education Training in SystemManagement 
		Route::match(['get','post'], '/system/education-records/', 'App\Http\Controllers\frontEnd\SystemManagement\EducationRecordController@index');
		Route::match(['get','post'], '/system/education-record/add', 'App\Http\Controllers\frontEnd\SystemManagement\EducationRecordController@add');
		Route::match(['get','post'], '/system/education-record/edit', 'App\Http\Controllers\frontEnd\SystemManagement\EducationRecordController@edit');
		Route::match(['get','post'], '/system/education-record/delete/{edu_rec_id}', 'App\Http\Controllers\frontEnd\SystemManagement\EducationRecordController@delete');
		Route::match(['get','post'], '/system/education-record/status/{edu_rec_id}', 'App\Http\Controllers\frontEnd\SystemManagement\EducationRecordController@update_status');
		Route::match(['get','post'], '/system/del/education-record', 'App\Http\Controllers\frontEnd\SystemManagement\EducationRecordController@edu_record_delete');
		//Education Training in SystemManagement May15 end

	//if user is not autorized to anything then send request to admin
	Route::match('post', '/send-modify-request', 'App\Http\Controllers\frontEnd\DashboardController@send_modify_request');

	//Route::match(['post','get'], '/bug-report', 'Controller@bug_report');
	Route::match(['post','get'], '/bug-report', 'App\Http\Controllers\frontEnd\BugReportController@index');
	Route::match(['post','get'], '/bug-report/add', 'App\Http\Controllers\frontEnd\BugReportController@add');

	// -------- Staff Management ------------------------//

    Route::match(['get', 'post'], '/staff-management', 'App\Http\Controllers\frontEnd\StaffManagementController@staff_member');
    Route::match(['get', 'post'], '/staff/profile/{staff_id}', 'App\Http\Controllers\frontEnd\StaffManagement\ProfileController@index');
    Route::match(['get', 'post'], '/staff/member/edit-settings', 'App\Http\Controllers\frontEnd\StaffManagement\ProfileController@edit_staff_setting');

	/*Route::post('/staff/member/edit-profile', 'App\Http\Controllers\frontEnd\StaffManagement\ProfileController@edit_staff_detail_info');
    Route::post('/staff/member/edit-location', 'App\Http\Controllers\frontEnd\StaffManagement\ProfileController@edit_staff_location_info');
    Route::post('/staff/member/edit-contact', 'App\Http\Controllers\frontEnd\StaffManagement\ProfileController@edit_staff_contact_info');*/
    
	//TaskAllocation
	Route::match(['get', 'post'], '/staff/member/task-allocation/add', 'App\Http\Controllers\frontEnd\StaffManagement\TaskAllocationController@add');
	Route::match(['get', 'post'], '/staff/member/task-allocation/view/{staff_member_id}', 'App\Http\Controllers\frontEnd\StaffManagement\TaskAllocationController@index');
	Route::match(['get','post'], '/staff/member/task-allocation/delete/{task_id}', 'App\Http\Controllers\frontEnd\StaffManagement\TaskAllocationController@delete');
	Route::match(['get', 'post'], '/staff/member/task-allocation/edit', 'App\Http\Controllers\frontEnd\StaffManagement\TaskAllocationController@edit');
	Route::match(['get','post'], '/staff/member/task-allocation/status-update/{task_id}', 'App\Http\Controllers\frontEnd\StaffManagement\TaskAllocationController@update_status');

	//Manage SickLeave
	Route::match(['get','post'], '/staff/member/sick-leave/view/{staff_member_id}', 'App\Http\Controllers\frontEnd\StaffManagement\SickLeaveController@index');
	Route::match(['get','post'], '/staff/member/sick-leave/view-record/{sick_leave_id}', 'App\Http\Controllers\frontEnd\StaffManagement\SickLeaveController@view_sick_record');
	Route::post('/staff/member/sick-leave/add', 'App\Http\Controllers\frontEnd\StaffManagement\SickLeaveController@add');
	Route::post('/staff/member/sick-leave/edit', 'App\Http\Controllers\frontEnd\StaffManagement\SickLeaveController@edit');	
	Route::get('/staff/member/sick-leave/delete/{sick_leave_id}', 'App\Http\Controllers\frontEnd\StaffManagement\SickLeaveController@delete');

	//Manage AnnualLeave
	Route::match(['get', 'post'], '/staff/annual-leaves/{staff_member_id}','App\Http\Controllers\frontEnd\StaffManagement\AnnualLeaveController@index');
	Route::match(['get','post'], '/staff/annual-leave/view-annual/{annual_leave_id}', 'App\Http\Controllers\frontEnd\StaffManagement\AnnualLeaveController@view_annual_record');
	Route::post('/staff/annual-leave/add', 'App\Http\Controllers\frontEnd\StaffManagement\AnnualLeaveController@add');
	Route::post('/staff/annual-leave/edit', 'App\Http\Controllers\frontEnd\StaffManagement\AnnualLeaveController@edit');
	Route::get('/staff/annual-leave/delete/{annual_leave_id}', 'App\Http\Controllers\frontEnd\StaffManagement\AnnualLeaveController@delete');

	//Staff Rota
	Route::match(['get','post'], '/staff/rota/view', 'App\Http\Controllers\frontEnd\StaffManagement\RotaController@index');
	Route::post('/staff/rota/add-shift', 'App\Http\Controllers\frontEnd\StaffManagement\RotaController@add_shift');
	Route::get('/staff/rota/delete-shift/{rota_id}', 'App\Http\Controllers\frontEnd\StaffManagement\RotaController@delete');
	Route::post('/staff/rota/add-rota', 'App\Http\Controllers\frontEnd\StaffManagement\RotaController@add_rota');

	Route::get('/staff/rota/shift/view/{rota_id}', 'App\Http\Controllers\frontEnd\StaffManagement\RotaController@view_rota');
	Route::post('/staff/rota/shift/edit', 'App\Http\Controllers\frontEnd\StaffManagement\RotaController@edit_shift');
	
	Route::get('/staff/rota/print', 'App\Http\Controllers\frontEnd\StaffManagement\RotaController@print_rota');
	Route::get('/staff/rota/copy', 'App\Http\Controllers\frontEnd\StaffManagement\RotaController@copy_rota');

	/*------- staff Training ------- */
	Route::get('/staff/trainings', 'App\Http\Controllers\frontEnd\StaffManagement\TrainingController@index');
	Route::post('/staff/training/add','App\Http\Controllers\frontEnd\StaffManagement\TrainingController@add');
	Route::get('/staff/training/view/{id}','App\Http\Controllers\frontEnd\StaffManagement\TrainingController@view');
	Route::get('/staff/training/completed/view/{id}','App\Http\Controllers\frontEnd\StaffManagement\TrainingController@completed_training');
	Route::get('/staff/training/not-completed/view/{id}','App\Http\Controllers\frontEnd\StaffManagement\TrainingController@not_completed_training');
	Route::get('/staff/training/active/view/{id}','App\Http\Controllers\frontEnd\StaffManagement\TrainingController@active_training');
	Route::get('/staff/training/status/update/{training_id}','App\Http\Controllers\frontEnd\StaffManagement\TrainingController@status_update');
	//Route::get('/staff/training/status/update/{training_id}/{status}','App\Http\Controllers\frontEnd\StaffManagement\TrainingController@status_update');
	Route::post('/staff/training/staff/add','App\Http\Controllers\frontEnd\StaffManagement\TrainingController@add_user_training');
	Route::get('/staff/training/view_fields/{traini_id}','App\Http\Controllers\frontEnd\StaffManagement\TrainingController@view_fields');
	Route::post('/staff/training/edit_fields','App\Http\Controllers\frontEnd\StaffManagement\TrainingController@edit_fields');
	Route::get('/staff/training/delete/{training_id}', 'App\Http\Controllers\frontEnd\StaffManagement\TrainingController@delete');

	// -------- general admin ------------------------//
	Route::match(['get','post'], '/general-admin', 'App\Http\Controllers\frontEnd\GeneralAdminController@index');

	//LogBook
	Route::match(['get', 'post'], '/general/logsbook', 'App\Http\Controllers\frontEnd\GeneralAdmin\LogBookController@index');
	Route::match(['get', 'post'], '/general/logbook/add', 'App\Http\Controllers\frontEnd\GeneralAdmin\LogBookController@add');
	Route::get('/service-user-list', 'App\Http\Controllers\frontEnd\GeneralAdmin\LogBookController@serviceuserlist');
	Route::post('/service-user-add-log', 'App\Http\Controllers\frontEnd\GeneralAdmin\LogBookController@service_user_add_log');
	Route::match(['get','post'],'/general/logbook/calendar/add', 'App\Http\Controllers\frontEnd\GeneralAdmin\LogBookController@add_to_calendar');
	
		
	//PettyCash Report
	Route::match(['get', 'post'], '/general/petty-cashes', 'App\Http\Controllers\frontEnd\GeneralAdmin\PettyCashController@index');
	Route::get('/general/petty-cash/view/{petty_cash_id}', 'App\Http\Controllers\frontEnd\GeneralAdmin\PettyCashController@view');
	Route::post('/general/petty-cash/add', 'App\Http\Controllers\frontEnd\GeneralAdmin\PettyCashController@add');
	Route::post('/general/petty-cash/edit', 'App\Http\Controllers\frontEnd\GeneralAdmin\PettyCashController@edit');
	Route::match(['get','post'],'/general/petty_cash/check-balance','App\Http\Controllers\frontEnd\GeneralAdmin\PettyCashController@get_petty_balance');

	//Policies & Procedures
	Route::match(['get','post'], '/policies', 'App\Http\Controllers\frontEnd\PoliciesController@index');
	Route::match(['get','post'], '/policies/add-multiple', 'App\Http\Controllers\frontEnd\PoliciesController@add_multiple');
	Route::post('/policies/add-single', 'App\Http\Controllers\frontEnd\PoliciesController@add_single');
	Route::get('/policies/delete/{policy_id}', 'App\Http\Controllers\frontEnd\PoliciesController@delete'); //delete new added
	Route::get('/policy/delete/{policy_id}','App\Http\Controllers\frontEnd\PoliciesController@delete_policy'); //delete from logged
	Route::get('/policy/accept/{policy_id}','App\Http\Controllers\frontEnd\PoliciesController@accept_policy');
	Route::post('/policy/update', 'App\Http\Controllers\frontEnd\PoliciesController@update_policy');

	//AgendaMeetingController
	Route::match(['get','post'], '/staff/meetings', 'App\Http\Controllers\frontEnd\GeneralAdmin\AgendaMeetingController@index');
	Route::get('/staff/meeting/view/{meeting_id}', 'App\Http\Controllers\frontEnd\GeneralAdmin\AgendaMeetingController@view');
	Route::post('staff/meeting/add', 'App\Http\Controllers\frontEnd\GeneralAdmin\AgendaMeetingController@add');
	Route::post('staff/meeting/edit', 'App\Http\Controllers\frontEnd\GeneralAdmin\AgendaMeetingController@edit');
	Route::get('staff/meeting/delete/{meeting_id}', 'App\Http\Controllers\frontEnd\GeneralAdmin\AgendaMeetingController@delete');

	//------------- View Reports ---------------//
	Route::match(['get','post'], '/view-reports', 'App\Http\Controllers\frontEnd\ViewReportController@index');
    // 	Route::get('/users/{user_type_id}', 'App\Http\Controllers\frontEnd\ViewReportController@get_user');
    Route::get('/users', 'App\Http\Controllers\frontEnd\ViewReportController@get_user');
	Route::match(['get','post'], '/user/record','App\Http\Controllers\frontEnd\ViewReportController@record');

	//---------------------------Rota Controller------------------------------//
	Route::get('/rota-dashboard','App\Http\Controllers\Rota\RotaController@index');
	Route::get('/rota','App\Http\Controllers\Rota\RotaController@create');
	Route::post('/add-rota-data','App\Http\Controllers\Rota\RotaController@store');
	Route::get('/rota-planner','App\Http\Controllers\Rota\RotaController@rota_calender_view');
	Route::post('/add-shift-data','App\Http\Controllers\Rota\RotaController@add_shift_data');
	Route::post('/get-all-users','App\Http\Controllers\Rota\RotaController@get_all_users');
	Route::post('/assign_rota_users','App\Http\Controllers\Rota\RotaController@assign_rota_users');
	Route::post('/update_rota_name','App\Http\Controllers\Rota\RotaController@update_rota_name');
	Route::post('/publish_rota_employee','App\Http\Controllers\Rota\RotaController@publish_rota_employee');
	Route::post('/unpublish_rota_employee','App\Http\Controllers\Rota\RotaController@unpublish_rota_employee');
	Route::get('/calendar','App\Http\Controllers\Rota\RotaController@calender_view');
	Route::get('/absence/type={id}','App\Http\Controllers\Rota\RotaController@annual_leave_view');
	Route::post('/get-all-users-search','App\Http\Controllers\Rota\RotaController@get_all_users_search');
	Route::get('/get-all-users-edit','App\Http\Controllers\Rota\RotaController@get_all_users_edit');
	Route::post('/delete_rota_employee','App\Http\Controllers\Rota\RotaController@delete_rota_employee');
	Route::get('/edit_rota/{id}','App\Http\Controllers\Rota\RotaController@edit_rota');
	Route::post('/publish_unpublish_rota','App\Http\Controllers\Rota\RotaController@publish_unpublish_rota');
	Route::post('/add-leave','App\Http\Controllers\Rota\RotaController@add_leave');
	Route::post('/date_validation_for_user','App\Http\Controllers\Rota\RotaController@date_validation_for_user');
	Route::get('/pending-request','App\Http\Controllers\Rota\RotaController@leave_pending');
	Route::post('/pending-request-data','App\Http\Controllers\Rota\RotaController@pending_request_data');
	Route::get('/get_all_leave','App\Http\Controllers\Rota\RotaController@get_all_leave');
	Route::get('/employee','App\Http\Controllers\Rota\RotaController@employee_view');
	Route::post('/get_rota_employee','App\Http\Controllers\Rota\RotaController@get_rota_employee');
	Route::post('/get_all_shift','App\Http\Controllers\Rota\RotaController@get_all_shift');
	Route::post('/edit_shift_data_get','App\Http\Controllers\Rota\RotaController@edit_shift_data_get');
	Route::post('/update-shift-data','App\Http\Controllers\Rota\RotaController@update_shift_data');
	Route::post('/approve_leave','App\Http\Controllers\Rota\RotaController@approve_leave');
	Route::post('/get_leave_record_for_1_week','App\Http\Controllers\Rota\RotaController@get_leave_record_for_1_week');
	Route::post('/get_record_of_rota','App\Http\Controllers\Rota\RotaController@get_record_of_rota');
	Route::get('/get_all_rota_data','App\Http\Controllers\Rota\RotaController@get_all_rota_data');
	Route::post('/delete-shift-data','App\Http\Controllers\Rota\RotaController@delete_shift_data');
	Route::get('/recruitment', 'App\Http\Controllers\Rota\RotaController@recruitment_index');
	Route::get('/jobs', 'App\Http\Controllers\Rota\RotaController@jobs_index');
	Route::get('/create-jobs', 'App\Http\Controllers\Rota\RotaController@create_jobs');
	Route::get('/permissions', 'App\Http\Controllers\Rota\RotaController@permission_index');
	Route::post('/check_users_add_in_shift', 'App\Http\Controllers\Rota\RotaController@check_users_add_in_shift');
	//---------------------------Rota Controller End------------------------------//
	
});

	
Route::get('/set-password/{user_id}/{security_code}',[UserController::class, 'show_set_password_form']);
Route::post('users/set-password',[UserController::class, 'set_password']);




//______________________________________________________BACKEND_ROUTES_START______________________________________________________________//

Route::match(['get','post'],'admin/login', 'App\Http\Controllers\backEnd\AdminController@login');
Route::match(['get','post'], 'admin/logout', 'App\Http\Controllers\backEnd\AdminController@logout');
Route::match(['get','post'], 'admin/check-email-exists', 'App\Http\Controllers\backEnd\ForgotPasswordController@check_admin_email_exists');
Route::match(['get','post'], 'admin/forgot-password', 'App\Http\Controllers\backEnd\ForgotPasswordController@send_forgot_pass_link_mail');

Route::get('admin/get-homes/{company_name}', 'App\Http\Controllers\backEnd\WelcomeController@get_homes');

Route::group(['prefix' => 'admin', 'middleware'=>'CheckAdminAuth'], function(){
	//download form  As PDF 
	Route::match(['get','post'],'/DownloadFormpdf/{id}','App\Http\Controllers\backEnd\superAdmin\UserController@DownloadFormpdf');
    Route::get('/', 'App\Http\Controllers\backEnd\AdminController@dashboard');
    Route::match(['get','post'],'/dashboard', 'App\Http\Controllers\backEnd\AdminController@dashboard');

	
	//personal Mangement(profile)
	Route::get('/profile', 'App\Http\Controllers\backEnd\myProfile\ProfileController@profile');
	Route::match(['get', 'post'], '/profile/edit', 'App\Http\Controllers\backEnd\myProfile\ProfileController@edit');
	Route::match(['get','post'], '/profile/change-password', 'App\Http\Controllers\backEnd\myProfile\ProfileController@change_password');

	Route::match(['get','post'], '/welcome', 'App\Http\Controllers\backEnd\WelcomeController@welcome');
	Route::get('/welcome/get-homes/{company_name}', 'App\Http\Controllers\backEnd\WelcomeController@welcome_get_homes');

    //backEnd Manager in SuperAdmin
    Route::match(['get','post'],'/company-managers', 'App\Http\Controllers\backEnd\superAdmin\companyManager\ManagerController@index');
    Route::match(['get','post'], '/company-manager/add', 'App\Http\Controllers\backEnd\superAdmin\companyManager\ManagerController@add');
    Route::match(['get','post'], '/company-manager/edit/{id}', 'App\Http\Controllers\backEnd\superAdmin\companyManager\ManagerController@edit');
    Route::match(['get','post'], '/company-manager/delete/{id}', 'App\Http\Controllers\backEnd\superAdmin\companyManager\ManagerController@delete');
    Route::match(['get','post'], '/company-manager/send-set-pass-link/{user_id}', 'App\Http\Controllers\backEnd\superAdmin\companyManager\ManagerController@send_user_set_pass_link_mail'); 
    Route::match(['get','post'], '/company-manager/check_username_unique', 'App\Http\Controllers\backEnd\UserController@check_username_exist');
	
    //backEnd SystemAdmin in SuperAdmin 
	Route::match(['get','post'],'/system-admins', 'App\Http\Controllers\backEnd\superAdmin\AdminController@system_admins');
	Route::match(['get','post'],'/system-admin/add', 'App\Http\Controllers\backEnd\superAdmin\AdminController@add');
	Route::match(['get','post'],'/system-admin/edit/{sa_id}', 'App\Http\Controllers\backEnd\superAdmin\AdminController@edit');
	Route::match(['get','post'],'/system-admin/delete/{sa_id}', 'App\Http\Controllers\backEnd\superAdmin\AdminController@delete');
	Route::match(['get','post'], '/system-admin/send-set-pass-link/{system_admin_id}', 'App\Http\Controllers\backEnd\superAdmin\AdminController@send_system_admin_set_pass_link_mail');
    Route::match(['get','post'], '/system-admin/package/detail/{sa_id}', 'App\Http\Controllers\backEnd\superAdmin\AdminController@package_detail');
    
	//backEnd company charges in SuperAdmin
	Route::match(['get','post'],'/company-charges', 'App\Http\Controllers\backEnd\superAdmin\CompanyChargesController@index');
	Route::match(['get','post'],'/company-charge/edit/{package_id}', 'App\Http\Controllers\backEnd\superAdmin\CompanyChargesController@edit');
	Route::match(['get','post'],'/company-charge/validate-home-range', 'App\Http\Controllers\backEnd\superAdmin\CompanyChargesController@validate_home_range');
	Route::match(['get','post'],'/company-charge/validate-range-gap', 'App\Http\Controllers\backEnd\superAdmin\CompanyChargesController@validate_range_gap');

	//backEnd SystemAdmin in SuperAdmin Home
	Route::match(['get','post'],'/system-admin/homes/{system_admin_id}', 'App\Http\Controllers\backEnd\superAdmin\HomeController@index');
	Route::match(['get','post'],'/system-admin/homes/add/{system_admin_id}', 'App\Http\Controllers\backEnd\superAdmin\HomeController@add');
	Route::match(['get','post'],'/system-admin/home/edit/{home_id}', 'App\Http\Controllers\backEnd\superAdmin\HomeController@edit');
	Route::match(['get','post'],'/system-admin/home/delete/{home_id}', 'App\Http\Controllers\backEnd\superAdmin\HomeController@delete');
	Route::match(['get','post'],'/system-admin/home/undo-delete/{home_id}', 'App\Http\Controllers\backEnd\superAdmin\HomeController@undo_delete');
	Route::match(['get','post'],'/system-admin/home/company-package-type', 'App\Http\Controllers\backEnd\superAdmin\HomeController@company_package_type');
	Route::match(['get','post'],'/system-admin/home/card-detail', 'App\Http\Controllers\backEnd\superAdmin\HomeController@card_detail_save');
	

	Route::match(['get','post'],'/users', 'App\Http\Controllers\backEnd\UserController@users');
	Route::match(['get','post'], '/users/add', 'App\Http\Controllers\backEnd\UserController@add');
	Route::match(['get','post'], '/users/edit/{id}', 'App\Http\Controllers\backEnd\UserController@edit');
	Route::match(['get','post'], '/users/delete/{id}', 'App\Http\Controllers\backEnd\UserController@delete');
	Route::get('/users/certificates/delete/{id}', 'App\Http\Controllers\backEnd\UserController@delete_certificates');
	Route::match(['get','post'], '/users/send-set-pass-link/{user_id}', 'App\Http\Controllers\backEnd\UserController@send_user_set_pass_link_mail');

	//User TaskAllocation
	Route::match(['get', 'post'], '/user/task-allocations/{user_id}', 'App\Http\Controllers\backEnd\user\TaskAllocationController@index');
	Route::match(['get', 'post'], '/user/task-allocation/add/{user_id}', 'App\Http\Controllers\backEnd\user\TaskAllocationController@add');
	Route::match(['get', 'post'], '/user/task-allocation/edit/{u_task_alloc_id}', 'App\Http\Controllers\backEnd\user\TaskAllocationController@edit');
	Route::match(['get','post'], '/user/task-allocation/delete/{u_task_alloc_id}', 'App\Http\Controllers\backEnd\user\TaskAllocationController@delete');

	//User SickLeave
	Route::match(['get','post'], '/user/sick-leaves/{staff_member_id}', 'App\Http\Controllers\backEnd\user\SickLeaveController@index');
	Route::match(['get','post'], '/user/sick-leave/add/{staff_member_id}', 'App\Http\Controllers\backEnd\user\SickLeaveController@add');
	Route::match(['get','post'], '/user/sick-leave/edit/{u_sick_leave_id}', 'App\Http\Controllers\backEnd\user\SickLeaveController@edit');	
    Route::get('/user/sick-leave/delete/{u_sick_leave_id}', 'App\Http\Controllers\backEnd\user\SickLeaveController@delete');
    Route::match(['get','post'], '/user/sick-leave/sanction/{u_sick_leave_id}', 'App\Http\Controllers\backEnd\user\SickLeaveController@sanction_leave');
    Route::match(['get','post'], '/user/sick-leave/user-list/{home_id}/{user_id}', 'App\Http\Controllers\backEnd\user\SickLeaveController@staff_user_list');
	Route::match(['get','post'], '/user/rota', 'App\Http\Controllers\backEnd\user\SickLeaveController@get_staff_rota');
	
	//User Annual Leave
	Route::match(['get','post'], '/user/annual-leaves/{staff_member_id}', 'App\Http\Controllers\backEnd\user\AnnualLeaveController@index');
	Route::match(['get','post'], '/user/annual-leave/add/{staff_member_id}', 'App\Http\Controllers\backEnd\user\AnnualLeaveController@add');
	Route::match(['get','post'], '/user/annual-leave/edit/{u_annual_leave_id}', 'App\Http\Controllers\backEnd\user\AnnualLeaveController@edit');
	Route::get('/user/annual-leave/delete/{u_sick_leave_id}', 'App\Http\Controllers\backEnd\user\AnnualLeaveController@delete');	

	//backEnd ServiceUserController
	Route::match(['get','post'],'/service-users', 'App\Http\Controllers\backEnd\serviceUser\ServiceUserController@index');
	Route::match(['get','post'], '/service-users/add', 'App\Http\Controllers\backEnd\serviceUser\ServiceUserController@add');
	Route::match(['get','post'], '/service-users/edit/{su_id}', 'App\Http\Controllers\backEnd\serviceUser\ServiceUserController@edit');
	Route::match(['get','post'], '/service-users/delete/{su_id}', 'App\Http\Controllers\backEnd\serviceUser\ServiceUserController@delete');
	Route::get('/service-users/send-set-pass-link/{su_id}', 'App\Http\Controllers\backEnd\serviceUser\ServiceUserController@send_set_pass_link_mail');

	//backEnd Service Users Care History
	Route::match(['get','post'],'/service-users/care-history/{su_id}', 'App\Http\Controllers\backEnd\serviceUser\CareHistoryController@index');
	Route::match(['get','post'],'/service-users/care-history/add/{su_id}', 'App\Http\Controllers\backEnd\serviceUser\CareHistoryController@add');
	Route::match(['get','post'],'/service-users/care-history/edit/{care_id}', 'App\Http\Controllers\backEnd\serviceUser\CareHistoryController@edit');
	Route::match(['get','post'],'/service-users/care-history/delete/{care_id}', 'App\Http\Controllers\backEnd\serviceUser\CareHistoryController@delete');
	Route::match(['get','post'], '/service-users/care-history/delete-file/{su_care_history_id}', 'App\Http\Controllers\backEnd\serviceUser\CareHistoryController@delete_hist_file');

	//backEnd careTeam in serviceUser
	Route::match(['get','post'], '/service-user/careteam/{su_id}', 'App\Http\Controllers\backEnd\serviceUser\CareTeamController@team_list');
	Route::match(['get','post'], '/service-user/careteam/add/{su_id}', 'App\Http\Controllers\backEnd\serviceUser\CareTeamController@add');
	Route::match(['get','post'], '/service-user/careteam/delete/{team_member_id}', 'App\Http\Controllers\backEnd\serviceUser\CareTeamController@delete');
	Route::match(['get','post'], '/service-user/careteam/edit/{team_member_id}', 'App\Http\Controllers\backEnd\serviceUser\CareTeamController@edit');

	//backEnd serviceUser contacts
	Route::match(['get','post'],'/service-users/contacts/{su_id}','App\Http\Controllers\backEnd\serviceUser\ContactsController@team_list');
	Route::match(['get','post'], '/service-users/contacts/add/{su_id}', 'App\Http\Controllers\backEnd\serviceUser\ContactsController@add');
	Route::match(['get','post'], '/service-users/contacts/delete/{team_member_id}', 'App\Http\Controllers\backEnd\serviceUser\ContactsController@delete');
	Route::match(['get','post'], '/service-users/contacts/edit/{team_member_id}', 'App\Http\Controllers\backEnd\serviceUser\ContactsController@edit');

	//backEnd ServiceUser Moods
	Route::match(['get', 'post'], '/service-user/moods/{su_id}', 'App\Http\Controllers\backEnd\serviceUser\MoodController@index');
	Route::match(['get', 'post'], '/service-user/mood/add/{su_id}', 'App\Http\Controllers\backEnd\serviceUser\MoodController@add');
	Route::match(['get', 'post'], '/service-user/mood/edit/{su_mood_id}', 'App\Http\Controllers\backEnd\serviceUser\MoodController@edit');
	Route::match(['get', 'post'], '/service-user/mood/delete/{su_mood_id}', 'App\Http\Controllers\backEnd\serviceUser\MoodController@delete');

	//backEnd ServiceUser External Service
	Route::match(['get', 'post'], '/service-user/external-service/{su_id}', 'App\Http\Controllers\backEnd\serviceUser\ExternalServiceController@index');
	Route::match(['get', 'post'], '/service-user/external-service/add/{su_id}', 'App\Http\Controllers\backEnd\serviceUser\ExternalServiceController@add');
	Route::match(['get', 'post'], '/service-user/external-service/edit/{ext_service_id}', 'App\Http\Controllers\backEnd\serviceUser\ExternalServiceController@edit');
	Route::match(['get', 'post'], '/service-user/external-service/delete/{ext_service_id}', 'App\Http\Controllers\backEnd\serviceUser\ExternalServiceController@delete');
	
	
	//backEnd ServiceUser DailyLog

	Route::match(['get', 'post'], '/service-user/logbooks/{su_id}', 'App\Http\Controllers\backEnd\serviceUser\LogBookController@index');
	Route::get('/service-user/logbook/view/{log_book_id}', 'App\Http\Controllers\backEnd\serviceUser\LogBookController@view');
	Route::get('/service-user/logbook/download', 'App\Http\Controllers\backEnd\serviceUser\LogBookController@download');
	
	//backEnd ServiceUser Independent LivingSkills
	Route::match(['get', 'post'], '/service-user/living-skills/{su_id}', 'App\Http\Controllers\backEnd\serviceUser\LivingSkillController@index');
	Route::get('/service-user/living-skill/view/{su_living_skill_id}', 'App\Http\Controllers\backEnd\serviceUser\LivingSkillController@view');

	//backEnd ServiceUser Calendar
	Route::match(['get', 'post'], '/service-user/calendar/{su_id}', 'App\Http\Controllers\backEnd\serviceUser\CalendarController@index');
    Route::match(['get','post'], '/service-user/calendar/event/view', 'App\Http\Controllers\backEnd\serviceUser\CalendarController@event_detail');
    
    //backEnd ServiceUser RMP
    Route::match(['get', 'post'], '/service-user/rmps/{su_id}', 'App\Http\Controllers\backEnd\serviceUser\RmpController@index');
    Route::match(['get', 'post'], '/service-user/rmp/view/{d_rmp_form_id}', 'App\Http\Controllers\backEnd\serviceUser\RmpController@view');

     //backEnd ServiceUser BMP
    Route::match(['get', 'post'], '/service-user/bmps/{su_id}', 'App\Http\Controllers\backEnd\serviceUser\BmpController@index');
    Route::match(['get', 'post'], '/service-user/bmp/view/{d_bmp_form_id}', 'App\Http\Controllers\backEnd\serviceUser\BmpController@view');

    //backEnd ServiceUser Risk
    Route::match(['get', 'post'], '/service-user/risks/{su_id}', 'App\Http\Controllers\backEnd\serviceUser\RiskController@index');
    Route::match(['get', 'post'], '/service-user/risk/view/{su_risk_id}', 'App\Http\Controllers\backEnd\serviceUser\RiskController@view');

    //backEnd ServiceUser Earning Scheme
    Route::match(['get', 'post'], '/service-user/earning-schemes/{su_id}', 'App\Http\Controllers\backEnd\serviceUser\EarningSchemeController@index');
    Route::match(['get','post'], '/service/earning-scheme/view_incentive/{earning_category_id}', 'App\Http\Controllers\backEnd\serviceUser\EarningSchemeController@view_incentive');
    Route::match(['get','post'], '/service/earning-scheme/daily-records/{su_id}/{label_id}', 'App\Http\Controllers\backEnd\serviceUser\EarningSchemeController@daily_record');
    Route::match(['get','post'], '/service/earning-scheme/daily-record/view/{daily_record_id}/{label_type}', 'App\Http\Controllers\backEnd\serviceUser\EarningSchemeController@daily_record_view');
    Route::match(['get','post'], '/service/earning-scheme/living-skills/{su_id}', 'App\Http\Controllers\backEnd\serviceUser\EarningSchemeController@living_skill');
    Route::match(['get','post'], '/service/earning-scheme/living_skill/view/{daily_record_id}', 'App\Http\Controllers\backEnd\serviceUser\EarningSchemeController@living_skill_view');
    Route::match(['get','post'], '/service/earning-scheme/education-records/{su_id}', 'App\Http\Controllers\backEnd\serviceUser\EarningSchemeController@education_record');
    Route::match(['get','post'], '/service/earning-scheme/education-record/view/{education_record_id}', 'App\Http\Controllers\backEnd\serviceUser\EarningSchemeController@education_record_view');
    Route::match(['get','post'], '/service/earning-scheme/mfcs/{su_id}', 'App\Http\Controllers\backEnd\serviceUser\EarningSchemeController@mfc');
    Route::match(['get','post'], '/service/earning-scheme/mfc/view/{d_mfc_id}', 'App\Http\Controllers\backEnd\serviceUser\EarningSchemeController@mfc_view');
    Route::match(['get','post'], '/service-user/earning-scheme-label/add/{service_user_id}/{earning_scheme_label_id}','App\Http\Controllers\backEnd\serviceUser\EarningSchemeController@add_earning_scheme_label');
    Route::match(['get','post'], '/service-user/earning-scheme-label/delete/{service_user_id}/{earning_scheme_label_id}','App\Http\Controllers\backEnd\serviceUser\EarningSchemeController@delete_earning_scheme_label');

	
	//backEnd incidentReport in serviceUser service-users/incident-reports (not)
	Route::match(['get','post'], '/service-user/incident-reports/{su_id}', 'App\Http\Controllers\backEnd\serviceUser\IncidentReportController@index');
	Route::match(['get','post'], '/service-user/incident/add/{su_id}', 'App\Http\Controllers\backEnd\serviceUser\IncidentReportController@add');
	Route::match(['get','post'], '/service-user/incident/edit/{inc_rep_id}', 'App\Http\Controllers\backEnd\serviceUser\IncidentReportController@edit');
	Route::get('/service-user/incident/delete/{inc_rep_id}', 'App\Http\Controllers\backEnd\serviceUser\IncidentReportController@delete');

	//backEnd Agent
	Route::match(['get','post'],'/agents', 'App\Http\Controllers\backEnd\AgentController@agents');
	Route::match(['get','post'],'/agents/add', 'App\Http\Controllers\backEnd\AgentController@add');
	Route::match(['get','post'],'/agents/edit/{agent_id}', 'App\Http\Controllers\backEnd\AgentController@edit');
	Route::match(['get','post'],'/agents/delete/{agent_id}', 'App\Http\Controllers\backEnd\AgentController@delete');
	Route::match(['get','post'],'/agents/send-set-pass-link/{agent_id}', 'App\Http\Controllers\backEnd\AgentController@send_user_set_pass_link_mail');
	//agent access rights
	Route::get('agents/access-rights/{agent_id}', 'App\Http\Controllers\backEnd\AccessRightController@agent_index');
	Route::match(['get','post'], 'agents/access-right/update', 'App\Http\Controllers\backEnd\AccessRightController@agent_update');



	//backEnd DailyRecord
	Route::match(['get','post'], '/daily-record', 'App\Http\Controllers\backEnd\DailyRecordController@index');
	Route::match(['get','post'], '/daily-record/add', 'App\Http\Controllers\backEnd\DailyRecordController@add');
	Route::match(['get','post'], '/daily-record/edit/{id}', 'App\Http\Controllers\backEnd\DailyRecordController@edit');
	Route::match(['get','post'], '/daily-record/delete/{id}', 'App\Http\Controllers\backEnd\DailyRecordController@delete');

	//backEnd Daily Record Score
	Route::match(['get','post'], '/daily-record-scores', 'App\Http\Controllers\backEnd\DailyRecordScoreController@index');
	Route::match(['get','post'], '/daily-record-score/edit/{dr_score_id}', 'App\Http\Controllers\backEnd\DailyRecordScoreController@edit');

	//backEnd Risks
	Route::match(['get','post'], '/risk', 'App\Http\Controllers\backEnd\RiskController@risk');
	Route::match(['get','post'], '/risk/add', 'App\Http\Controllers\backEnd\RiskController@add');
	Route::match(['get','post'], '/risk/edit/{id}', 'App\Http\Controllers\backEnd\RiskController@edit');
	Route::match(['get','post'], '/risk/delete/{id}', 'App\Http\Controllers\backEnd\RiskController@delete');

	//backEnd EarningScheme 
	Route::match(['get','post'], '/earning-scheme', 'App\Http\Controllers\backEnd\EarningSchemeController@earning_scheme');
	Route::match(['get','post'], '/earning-scheme/add', 'App\Http\Controllers\backEnd\EarningSchemeController@add');
	Route::match(['get','post'], '/earning-scheme/edit/{id}', 'App\Http\Controllers\backEnd\EarningSchemeController@edit');
	Route::match(['get','post'], '/earning-scheme/delete/{id}', 'App\Http\Controllers\backEnd\EarningSchemeController@delete');

	//backEnd EarningScheme -- Incentive
	Route::match(['get','post'], '/earning-scheme/incentive/{id}', 'App\Http\Controllers\backEnd\IncentiveController@incentive');
	Route::match(['get','post'], '/earning-scheme/incentive/add/{id}', 'App\Http\Controllers\backEnd\IncentiveController@add');
	Route::match(['get','post'], '/earning-scheme/incentive/edit/{id}', 'App\Http\Controllers\backEnd\IncentiveController@edit');
	Route::match(['get','post'], '/earning-scheme/incentive/delete/{id}', 'App\Http\Controllers\backEnd\IncentiveController@delete');

	//backEnd Incentive
	Route::match(['get','post'], '/earning-scheme/incentive/{id}', 'App\Http\Controllers\backEnd\IncentiveController@incentive');

    //Earning scheme labels
    Route::any('earning-scheme-labels','App\Http\Controllers\backEnd\EarningSchemeLabelController@index');
    Route::any('/earning-scheme-label/add','App\Http\Controllers\backEnd\EarningSchemeLabelController@add');
    Route::any('/earning-scheme-label/edit/{label_id}','App\Http\Controllers\backEnd\EarningSchemeLabelController@edit');
    Route::any('/earning-scheme-label/delete/{label_id}','App\Http\Controllers\backEnd\EarningSchemeLabelController@delete');

	//backEnd Homelist
	Route::match(['get','post'],'/homelist', 'App\Http\Controllers\backEnd\homeManage\HomeController@index');
	Route::match(['get','post'],'/homelist/add', 'App\Http\Controllers\backEnd\homeManage\HomeController@add');
	Route::match(['get','post'],'/homelist/edit/{home_id}', 'App\Http\Controllers\backEnd\homeManage\HomeController@edit');
	Route::match(['get','post'],'/homelist/delete/{home_id}', 'App\Http\Controllers\backEnd\homeManage\HomeController@delete');
	Route::match(['get','post'],'/homelist/undo-delete/{home_id}', 'App\Http\Controllers\backEnd\homeManage\HomeController@undo_delete');
	Route::match(['get','post'],'/homelist/company-package-type', 'App\Http\Controllers\backEnd\homeManage\HomeController@company_package_type');
	Route::match(['get','post'],'/homelist/payment/success/{admin_id}', 'App\Http\Controllers\backEnd\homeManage\HomeController@success');

	//backend homelist-admins		
	Route::match(['get','post'],'/homelist/home-admin/{home_id}','App\Http\Controllers\backEnd\homeManage\AdminController@index');
	Route::match(['get','post'],'/homelist/home-admin/add/{home_id}','App\Http\Controllers\backEnd\homeManage\AdminController@add');
	Route::match(['get','post'],'/homelist/home-admin/edit/{home_admin_id}','App\Http\Controllers\backEnd\homeManage\AdminController@edit');
	Route::match(['get','post'],'/homelist/home-admin/delete/{home_admin_id}','App\Http\Controllers\backEnd\homeManage\AdminController@delete');
	Route::match(['get','post'],'/homelist/home-admin/send-set-pass-link/{home_admin_id}','App\Http\Controllers\backEnd\homeManage\AdminController@send_set_password_link_mail');

	//access rights
	Route::get('users/access-rights/{user_id}', 'App\Http\Controllers\backEnd\AccessRightController@index');
	Route::match(['get','post'], 'users/access-right/update', 'App\Http\Controllers\backEnd\AccessRightController@update');

	//support ticket
	Route::match(['get','post'], '/support-ticket', 'App\Http\Controllers\backEnd\SupportTicketController@index');
	Route::match(['get','post'], '/support-ticket/add/msg', 'App\Http\Controllers\backEnd\SupportTicketController@add_ticket_mesg');
	Route::match(['get','post'], '/support-ticket/view/{ticket_id}', 'App\Http\Controllers\backEnd\SupportTicketController@view_ticket');
	// Route::match(['get','post'], '/support-ticket/edit/{user_id}', 'App\Http\Controllers\backEnd\SupportTicketController@edit');
	Route::match(['get','post'], '/support-ticket/delete/{user_id}', 'App\Http\Controllers\backEnd\SupportTicketController@delete');
	
	//backEnd Placement Plan	
	Route::match(['get','post'], '/placement-plan', 'App\Http\Controllers\backEnd\PlacementPlanController@index');
	Route::match(['get','post'], '/placement-plan/add', 'App\Http\Controllers\backEnd\PlacementPlanController@add');
	Route::match(['get','post'], '/placement-plan/edit/{target_id}', 'App\Http\Controllers\backEnd\PlacementPlanController@edit');
	Route::match(['get','post'], '/placement-plan/delete/{target_id}', 'App\Http\Controllers\backEnd\PlacementPlanController@delete');	
	
	//form-builder
	Route::match(['get','post'], '/form-builder', 'App\Http\Controllers\backEnd\systemManage\FormBuilderController@index');	
	Route::match(['get','post'], '/form-builder/add', 'App\Http\Controllers\backEnd\systemManage\FormBuilderController@add');	
	Route::match(['get','post'], '/form-builder/edit/{form_id}', 'App\Http\Controllers\backEnd\systemManage\FormBuilderController@edit');	
	Route::match(['get','post'], '/form-builder/delete/{form_id}', 'App\Http\Controllers\backEnd\systemManage\FormBuilderController@delete');	

	// labels
	Route::get('/labels', 'App\Http\Controllers\backEnd\HomeLabelController@index');	
	Route::get('/label/view/{label_tag}', 'App\Http\Controllers\backEnd\HomeLabelController@view');	
	Route::post('/label/edit', 'App\Http\Controllers\backEnd\HomeLabelController@edit');	

	// categories
	Route::get('/categories', 'App\Http\Controllers\backEnd\HomeCategoriesController@index');	
	Route::get('/categories/view/{category_tag}', 'App\Http\Controllers\backEnd\HomeCategoriesController@view');	
	Route::post('/categories/edit', 'App\Http\Controllers\backEnd\HomeCategoriesController@edit');
	Route::match(['get','post'], '/categories/add', 'App\Http\Controllers\backEnd\HomeCategoriesController@add');	

	// Backend unique username for user,service user,agent & admin
	Route::match(['get','post'], '/users/check_username_unique', 'App\Http\Controllers\backEnd\UserController@check_username_exist');
	Route::match(['get','post'], '/service-users/check_username_exists', 'App\Http\Controllers\backEnd\serviceUser\ServiceUserController@check_username_exist');

	Route::match(['get','post'], '/service-users/check-serviceuser-email-exists', 'App\Http\Controllers\backEnd\serviceUser\ServiceUserController@check_serviceuser_email_exists');


	Route::match(['get','post'], '/system-admin/check_user_username_exists', 'App\Http\Controllers\backEnd\superAdmin\AdminController@check_username_exist');
	Route::match(['get','post'], '/agents/check_username_unique', 'App\Http\Controllers\backEnd\AgentController@check_username_exist');

	// migrations 
	Route::match(['get','post'],'/service-users/migrations/{service_user_id}', 'App\Http\Controllers\backEnd\serviceUser\MigrationController@index');	
	Route::get('/service-users/migration/send-request/{service_user_id}', 'App\Http\Controllers\backEnd\serviceUser\MigrationController@show_form');	
	Route::post('/service-users/migration/send-request', 'App\Http\Controllers\backEnd\serviceUser\MigrationController@save_request');	

	Route::get('/service-users/migration/view/{su_migration_id}', 'App\Http\Controllers\backEnd\serviceUser\MigrationController@view');	
	Route::get('/service-users/migration/cancel-request/{su_migration_id}', 'App\Http\Controllers\backEnd\serviceUser\MigrationController@cancel_request');	
	//get homes by id
	Route::get('/migration/get-company/{admin_id}', 'App\Http\Controllers\backEnd\serviceUser\MigrationController@get_homes');	
	
	//backEnd ModifyRequest
	Route::match(['get','post'], '/modification-requests', 'App\Http\Controllers\backEnd\ModificationRequestController@index');
	Route::match(['get','post'], '/modification-request/edit/{request_id}', 'App\Http\Controllers\backEnd\ModificationRequestController@edit');
	Route::match(['get','post'], '/modification-request/delete/{request_id}', 'App\Http\Controllers\backEnd\ModificationRequestController@delete');

	//backEnd LivingSkills 
	Route::match(['get', 'post'], '/living-skill', 'App\Http\Controllers\backEnd\LivingSkillController@index');
	Route::match(['get', 'post'], '/living-skill/add', 'App\Http\Controllers\backEnd\LivingSkillController@add');
	Route::match(['get', 'post'], '/living-skill/edit/{skill_id}', 'App\Http\Controllers\backEnd\LivingSkillController@edit');
	Route::match(['get','post'],  '/living-skill/delete/{skill_id}', 'App\Http\Controllers\backEnd\LivingSkillController@delete');

	//backEnd MFC 
	Route::match(['get', 'post'], '/mfc-records', 'App\Http\Controllers\backEnd\MFCController@index');
	Route::match(['get', 'post'], '/mfc/add', 'App\Http\Controllers\backEnd\MFCController@add');
	Route::match(['get', 'post'], '/mfc/edit/{mfc_id}', 'App\Http\Controllers\backEnd\MFCController@edit');
	Route::get('/mfc/delete/{mfc_id}', 'App\Http\Controllers\backEnd\MFCController@delete');	

	//backEnd Education Training
	Route::match(['get', 'post'], '/education-trainings', 'App\Http\Controllers\backEnd\EducationTrainingController@index');
	Route::match(['get', 'post'], '/education-training/add', 'App\Http\Controllers\backEnd\EducationTrainingController@add');
	Route::match(['get', 'post'], '/education-training/edit/{edu_tr_id}', 'App\Http\Controllers\backEnd\EducationTrainingController@edit');
	Route::match(['get', 'post'], '/education-training/delete/{edu_tr_id}', 'App\Http\Controllers\backEnd\EducationTrainingController@delete');

	//backEnd CareTeam-JobTitle
	Route::match(['get', 'post'], '/care-team-job-titles', 'App\Http\Controllers\backEnd\homeManage\CareTeamJobTitleController@index');
	Route::match(['get', 'post'], '/care-team-job-title/add', 'App\Http\Controllers\backEnd\homeManage\CareTeamJobTitleController@add');
	Route::match(['get', 'post'], '/care-team-job-title/edit/{job_title_id}', 'App\Http\Controllers\backEnd\homeManage\CareTeamJobTitleController@edit');
	Route::match(['get', 'post'], '/care-team-job-title/delete/{job_title_id}', 'App\Http\Controllers\backEnd\homeManage\CareTeamJobTitleController@delete');

	//backEnd Moods
	Route::match(['get', 'post'], '/moods', 'App\Http\Controllers\backEnd\homeManage\MoodController@index');
	Route::match(['get', 'post'], '/mood/add', 'App\Http\Controllers\backEnd\homeManage\MoodController@add');
	Route::match(['get', 'post'], '/mood/edit/{mood_id}', 'App\Http\Controllers\backEnd\homeManage\MoodController@edit');
	Route::match(['get', 'post'], '/mood/delete/{mood_id}', 'App\Http\Controllers\backEnd\homeManage\MoodController@delete');

	//Access levels
	Route::get('/home/access-levels', 'App\Http\Controllers\backEnd\homeManage\AccessLevelController@index');
	
	Route::match(['get', 'post'],'/home/access-level/add', 'App\Http\Controllers\backEnd\homeManage\AccessLevelController@add');
	Route::match(['get','post'], '/home/access-level/edit/{access_level_id}', 'App\Http\Controllers\backEnd\homeManage\AccessLevelController@edit');
	Route::match(['get', 'post'],'/home/access-level/delete/{access_level_id}', 'App\Http\Controllers\backEnd\homeManage\AccessLevelController@delete');
	Route::get('/home/access-level/rights/view/{access_level_id}', 'App\Http\Controllers\backEnd\homeManage\AccessLevelController@view_rights');
	Route::post('/home/access-level/rights/update', 'App\Http\Controllers\backEnd\homeManage\AccessLevelController@update_rights');
	
	//Staff Rota
	Route::match(['get', 'post'], '/home/rota-shift', 'App\Http\Controllers\backEnd\homeManage\RotaShiftController@index');
	//Route::match(['get', 'post'], '/home/rota-shift/view/{shift_id}', 'App\Http\Controllers\backEnd\homeManage\RotaShiftController@view');
	Route::match(['get', 'post'], '/home/rota-shift/add', 'App\Http\Controllers\backEnd\homeManage\RotaShiftController@add');
	//(not saved)
	Route::match(['get', 'post'], '/home/rota-shift/edit/{shift_id}', 'App\Http\Controllers\backEnd\homeManage\RotaShiftController@edit');
	Route::match(['get', 'post'], '/home/rota-shift/delete/{shift_id}', 'App\Http\Controllers\backEnd\homeManage\RotaShiftController@delete');

	//backEnd System Guide Category
	Route::match(['get', 'post'], '/system-guide-category', 'App\Http\Controllers\backEnd\systemGuide\SystemGuideCategoryController@index');
	Route::match(['get', 'post'], '/system-guide/view/{sg_ctgry_id}', 'App\Http\Controllers\backEnd\systemGuide\SystemGuideController@index');
	
	//backEnd System Guide 
	Route::match(['get','post'],'/system-guide/add/{sg_ctgry_id}', 'App\Http\Controllers\backEnd\systemGuide\SystemGuideController@add');
	Route::match(['get','post'],'/system-guide/edit/{sys_guide_id}', 'App\Http\Controllers\backEnd\systemGuide\SystemGuideController@edit');
	Route::match(['get','post'],'/system-guide/delete/{sys_guide_id}', 'App\Http\Controllers\backEnd\systemGuide\SystemGuideController@delete');

	// backEnd managers
	Route::match(['get', 'post'], '/managers', 'App\Http\Controllers\backEnd\ManagersController@index');
	Route::match(['get', 'post'], '/managers/add', 'App\Http\Controllers\backEnd\ManagersController@add');
	Route::match(['get', 'post'], '/managers/edit/{manager_id}', 'App\Http\Controllers\backEnd\ManagersController@edit');
	Route::match(['get', 'post'], '/managers/delete/{manager_id}', 'App\Http\Controllers\backEnd\ManagersController@delete');
	Route::match(['get', 'post'], '/manager/change-status', 'App\Http\Controllers\backEnd\ManagersController@change_status');
	Route::match(['get', 'post'], '/manager/check-email-exists', 'App\Http\Controllers\backEnd\ManagersController@check_email_exists');
	Route::match(['get', 'post'], '/manager/check-contact-no-exists', 'App\Http\Controllers\backEnd\ManagersController@check_contact_no_exists');

	//backEnd Service User Dynamic Forms
	Route::match(['get', 'post'], '/service-user/dynamic-forms/{su_id}', 'App\Http\Controllers\backEnd\serviceUser\DynamicFormController@index');
	Route::match(['get', 'post'], '/service-user/dynamic-forms/view/{d_form_id}', 'App\Http\Controllers\backEnd\serviceUser\DynamicFormController@view');
	Route::post('/service-user/dynamic-form/edit', 'App\Http\Controllers\backEnd\serviceUser\DynamicFormController@edit');
	Route::get('/service-user/dynamic-form/delete/{d_form_id}', 'App\Http\Controllers\backEnd\serviceUser\DynamicFormController@delete');

	//backEnd Service User File Manager
	Route::match(['get', 'post'], '/service-user/file-managers/{su_id}', 'App\Http\Controllers\backEnd\serviceUser\FileManagerController@index');
	Route::match(['get','post'], '/service-user/file-manager/add/{service_user_id}', 'App\Http\Controllers\backEnd\serviceUser\FileManagerController@add');
	Route::get('/service-user/file-manager/delete/{file_id}','App\Http\Controllers\backEnd\serviceUser\FileManagerController@delete');

	//backEnd Service User My Money History
	Route::match(['get','post'], '/service-user/my-money/history/{su_id}', 'App\Http\Controllers\backEnd\serviceUser\MyMoneyHistoryController@index');

	//backEnd Service User My Money Request
	Route::match(['get','post'], '/service-user/my-money/request/{su_id}', 'App\Http\Controllers\backEnd\serviceUser\MyMoneyRequestController@index');
	Route::match(['get','post'], '/service-user/my-money/request-view/{money_request_id}', 'App\Http\Controllers\backEnd\serviceUser\MyMoneyRequestController@view');

	//backEnd Policies&Procedure
	Route::match(['get', 'post'], '/home/policies', 'App\Http\Controllers\backEnd\homeManage\PoliciesController@index');
	Route::match(['get','post'], '/home/policies/add', 'App\Http\Controllers\backEnd\homeManage\PoliciesController@add');
	Route::get('/home/policies/delete/{policy_id}', 'App\Http\Controllers\backEnd\homeManage\PoliciesController@delete');
	Route::match(['get','post'],'/home/policies/staff/accepted/{policy_id}', 'App\Http\Controllers\backEnd\homeManage\PoliciesController@policy_accepted_staff');
	Route::match(['get','post'],'/home/policies/staff/to-agree/{policy_id}', 'App\Http\Controllers\backEnd\homeManage\PoliciesController@to_agree_policy');

	//------ backEnd General Admin ---------- //
	//Agenda Meetings
	Route::match(['get', 'post'], '/general-admin/agenda/meetings', 'App\Http\Controllers\backEnd\generalAdmin\AgendaMeetingController@index');
	Route::match(['get', 'post'], '/general-admin/agenda/meeting-view/{meeting_id}', 'App\Http\Controllers\backEnd\generalAdmin\AgendaMeetingController@view');
	//Petty Cash
	Route::match(['get','post'], '/general-admin/petty/cash', 'App\Http\Controllers\backEnd\generalAdmin\PettyCashController@index');
	Route::match(['get','post'], '/general-admin/petty/cash-view/{petty_id}', 'App\Http\Controllers\backEnd\generalAdmin\PettyCashController@view');
	//Log Book
	Route::match(['get','post'], '/general-admin/log/book', 'App\Http\Controllers\backEnd\generalAdmin\LogBookController@index');
	Route::match(['get','post'], '/general-admin/log/book-view/{log_book_id}', 'App\Http\Controllers\backEnd\generalAdmin\LogBookController@view');
	//Weekly Allowance 
	Route::match(['get','post'], '/general-admin/allowance/weekly', 'App\Http\Controllers\backEnd\generalAdmin\WeeklyAllowanceController@index');
	//Staff Training
	Route::match(['get','post'], '/general-admin/staff/training', 'App\Http\Controllers\backEnd\generalAdmin\StaffTrainingController@index');
	Route::match(['get','post'], '/general-admin/staff/training-view/{training_id}', 'App\Http\Controllers\backEnd\generalAdmin\StaffTrainingController@view');
});
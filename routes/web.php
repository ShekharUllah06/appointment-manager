<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


//Home Page Route
Route::get('/', ['as' => 'front.home',   'uses' => 'Front\PagesController@getHome']);

//Public Front-end Route
Route::get('/help', ['as' => 'front.help',   'uses' => 'Front\helpController@getHelp']);
Route::get('/help/faq', ['as' => 'front.faq',   'uses' => 'Front\helpController@getHelp']);

//Doctor's public Profile Route
Route::get('/doctor_profile/{doctorID}/{calanderMonth?}', ['as' => 'doctorProfile',   'uses' => 'Front\PagesController@getDoctorPublicProfile']);
//Route::get('/doctor_profile/{doctorID}', ['as' => 'doctorProfile',   'uses' => 'Front\PagesController@getDoctorPublicProfile']);

//
//Doctor Route
//Section
//Starts here.
//
        //Doctor's Panel Route
        Route::get('/doctor', ['as' => 'doctor.dashboard', 'uses' => 'doctor\PagesController@getDashboard', 'middleware' => 'auth']);
        //Accounts Setting Change Route
        Route::post('/doctor/account', ['as' => 'doctorAccountSettings', 'uses' => 'doctor\AccountSettingsController@showAccountSettings']);
        Route::post('doctor/account/information', ['as' => 'doctorChangeInfo', 'uses' => 'doctor\AccountSettingsController@changeInformation']);
        Route::post('doctor/account/password', ['as' => 'doctorChangePassword', 'uses' => 'doctor\AccountSettingsController@changePassword']);

        //Doctor Pannel Route Groups
        Route::group(['prefix' => 'doctor', 'middleware' => 'auth'], function(){


            //schedule Page Route
            Route::group(['namespace' => 'doctor'], function(){

                //Schedule Page Route
                Route::get('schedule', ['as' => 'doctorSchedule', 'uses' => 'ScheduleController@viewScheduleList']);

                //Schedule New Route
                Route::get('schedule/new', ['as' => 'doctorScheduleNew', 'uses' => 'ScheduleController@newScheduleForm']);

               //Schedule Edit Route
                Route::get('schedule/edit/{scheduleId}', ['as' => 'doctorScheduleEdit', 'uses' => 'ScheduleController@editScheduleForm']);

                //Schedule Save Route
                Route::post('schedule/save', ['as' => 'doctorScheduleSave', 'uses' => 'ScheduleController@saveSchedule']);

                //Schedule Remove Route
                Route::get('schedule/remove/{scheduleId}', ['as' => 'doctorScheduleRemove', 'uses' => 'ScheduleController@removeSchedule']);

            });


            //
            //
            //Settings Sub-Menu routes
            //
            //


            //chamber Page Route
            Route::group(['namespace' => 'doctor', 'prefix' => 'settings/chamber'], function(){

                        Route::get('/', ['as' => 'doctorChamber', 'uses' => 'ChamberController@viewChamberList']);

                    //chamber New Route
                        Route::get('/new', ['as' => 'doctorChamberNew', 'uses' => 'ChamberController@newChamberForm']);

                    //chamber Edit Route
                        Route::get('/edit/{cId}', ['as' => 'doctorChamberEdit', 'uses' => 'ChamberController@editChamberForm']);

                    //chamber Save Route
                        Route::post('/save', ['as' => 'doctorChamberSave', 'uses' => 'ChamberController@saveChamber']);

                    //chamber Remove Route
                        Route::get('/remove/{cId}', ['as' => 'doctorChamberRemove', 'uses' => 'ChamberController@removeChamber']);

            });


            //education Page Route
            Route::group(['namespace' => 'doctor', 'prefix' => 'settings/education'], function(){

                        Route::get('/', ['as' => 'doctorEducation', 'uses' => 'EducationController@viewEducationList']);

                    //educating New Route
                        Route::get('/new', ['as' => 'doctorEducationNew', 'uses' => 'EducationController@newEducationForm']);

                    //educating Edit Route
                        Route::get('/edit/{degreeName}', ['as' => 'doctorEducationEdit', 'uses' => 'EducationController@editEducationForm']);\

                    //educating Save Route
                        Route::post('/save', ['as' => 'doctorEducationSave', 'uses' => 'EducationController@saveEducation']);

                    //educating Remove Route
                        Route::get('/remove/{degreeName}', ['as' => 'doctorEducationRemove', 'uses' => 'EducationController@removeEducation']);
            });


            //personal-info Page Route
            Route::group(['namespace' => 'doctor', 'prefix' => 'settings/personal-info'], function(){
                    //view route
                        Route::get('/', ['as' => 'doctorPersonalInfo', 'uses' => 'PersonalInfoController@viewPersonalInfo']);

                    //personal-info information Save Route
                        Route::post('/save', ['as' => 'doctorPersonalInfoSave', 'uses' => 'PersonalInfoController@savePersonalInfo']);

                    //personal-info avatar/image Save Route
                        Route::post('/save_avatar', ['as' => 'doctorPersonalInfoSave', 'uses' => 'PersonalInfoController@saveAvatar']);
            });


            //work history Routes
            Route::group(['namespace' => 'doctor', 'prefix' => 'settings/work-history'], function(){

                        Route::get('/', ['as' => 'doctorWorkHistory', 'uses' => 'workHistoryController@viewWorkHistory']);

                    //work-history  New Route
                        Route::get('/new', ['as' => 'doctorWorkHistoryNew', 'uses' => 'workHistoryController@newWorkHistoryForm']);

                    //work-history  Edit Route
                        Route::get('/edit/{workHistoryId}', ['as' => 'doctorWorkHistoryEdit', 'uses' => 'workHistoryController@editWorkHistoryForm']);\

                    //work-history  Save Route
                        Route::post('/save', ['as' => 'doctorWorkHistorySave', 'uses' => 'workHistoryController@saveWorkHistory']);

                    //work-history  Remove Route
                        Route::get('/remove/{workHistoryId}', ['as' => 'doctorWorkHistoryRemove', 'uses' => 'workHistoryController@removeWorkHistory']);
            });


            //Specialty Routes
            Route::group(['namespace' => 'doctor', 'prefix' => 'settings/specialties'], function(){

                        Route::get('/', ['as' => 'doctorSpecialty', 'uses' => 'specialtyController@viewSpecialty']);

                    //work-history  Save Route
                        Route::post('/save', ['as' => 'doctorSpecialtySave', 'uses' => 'specialtyController@saveSpecialty']);

                    //work-history  Remove Route
                        Route::get('/remove/{specialtyName}', ['as' => 'doctorSpecialtyRemove', 'uses' => 'specialtyController@removeSpecialty']);
            });

        });
//End Doctor Rout Section

//
//Patient's Panel Route
//
        //Patient's Panel Route
        Route::get('/patient', ['as' => 'patient.dashboard', 'uses' => 'patient\PagesController@getDashboard', 'middleware' => 'auth']);

        //Patient Pannel Route Groups
        Route::group(['prefix' => 'patient', 'middleware' => 'auth'], function(){

            //Patient Pannel Route Group
            Route::group(['namespace' => 'patient'], function(){

                //Patient Search/Browse Route
                Route::get('search', ['as' => 'searchDoctor', 'uses' => 'SearchDoctorController@viewSearchPage']);

                //Patient filter pagination Route
                Route::get('search/result/{pageNo}/{specialty}/{districtName}/{thanaName}/{area}', ['as' => 'searchDoctor', 'uses' => 'SearchDoctorController@viewSearchPage']);

                //Patient Thana/Sub-District Ajax Call Route
                Route::get('search/ajax/{districtVal}', ['as' => 'searchDoctorThanaList', 'uses' => 'SearchDoctorController@returnThanaList']);

                //Patient Filter Form Submission Route
                Route::post('search/result', ['as' => 'filterDoctorList', 'uses' => 'SearchDoctorController@viewSearchPage']);

                //Registered Patient Appointment Route
                Route::post('appointment', ['as' => 'doctorAppointment', 'uses' => 'doctorAppointmentController@registeredAppointment']);

                //Registered Patient Appointment Schedule ajax query Route
                Route::get('appointment/getAjaxSchedule/{scheduleID}', ['as' => 'doctorAjaxSchedule', 'uses' => 'doctorAppointmentController@getAjaxSchedule']);

                //Registered Patient Appointment Save Route
                Route::post('appointment/save', ['as' => 'doctorAppointmentSave', 'uses' => 'doctorAppointmentController@registeredAppointmentSave']);

                //Registered Patient Appointment Cancel Route
                Route::get('appointment/cancel/{appointmentID}', ['as' => 'doctorAppointmentSave', 'uses' => 'doctorAppointmentController@registeredAppointmentCancel']);

                //Registered Patient My Appointments Route
                Route::get('myappointments/{pageNumber?}', ['as' => 'myAppointments', 'uses' => 'doctorAppointmentController@myAppointments']);
            });
        });



// auth routes setup
Auth::routes();

// registration activation routes
Route::get('activation/key/{activation_key}', ['as' => 'activation_key', 'uses' => 'Auth\ActivationKeyController@activateKey']);
Route::get('activation/resend', ['as' =>  'activation_key_resend', 'uses' => 'Auth\ActivationKeyController@showKeyResendForm']);
Route::post('activation/resend', ['as' =>  'activation_key_resend.post', 'uses' => 'Auth\ActivationKeyController@resendKey']);

// username forgot_username
Route::get('username/reminder', ['as' =>  'username_reminder', 'uses' => 'Auth\ForgotUsernameController@showForgotUsernameForm']);
Route::post('username/reminder', ['as' =>  'username_reminder.post', 'uses' => 'Auth\ForgotUsernameController@sendUserameReminder']);

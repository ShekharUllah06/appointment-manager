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

//home Page Route
Route::get('/doctor', ['as' => 'doctor.dashboard', 'uses' => 'doctor\PagesController@getDashboard', 'middleware' => 'auth']);


//Doctor Pannel Route Groups
Route::group(['prefix' => 'doctor', 'middleware' => 'auth'], function(){
//    //home Page Route
//    Route::get('/', ['as' => 'admin.dashboard', 'uses' => 'PagesController@getDashboard']);
    
    
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
        
                Route::get('/', ['as' => 'doctorPersonalInfo', 'uses' => 'PersonalInfoController@viewPersonalInfo']);

            //personal-info Save Route    
                Route::post('/save', ['as' => 'doctorPersonalInfoSave', 'uses' => 'PersonalInfoController@savePersonalInfo']);
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

});



//Route::get('admin/settings/work-history', ['as' => 'adminWorkHistory', 'uses' => 'doctor\workHistoryController@viewWorkHistory']);

// auth routes setup
Auth::routes();

// registration activation routes
Route::get('activation/key/{activation_key}', ['as' => 'activation_key', 'uses' => 'Auth\ActivationKeyController@activateKey']);
Route::get('activation/resend', ['as' =>  'activation_key_resend', 'uses' => 'Auth\ActivationKeyController@showKeyResendForm']);
Route::post('activation/resend', ['as' =>  'activation_key_resend.post', 'uses' => 'Auth\ActivationKeyController@resendKey']);

// username forgot_username
Route::get('username/reminder', ['as' =>  'username_reminder', 'uses' => 'Auth\ForgotUsernameController@showForgotUsernameForm']);
Route::post('username/reminder', ['as' =>  'username_reminder.post', 'uses' => 'Auth\ForgotUsernameController@sendUserameReminder']);

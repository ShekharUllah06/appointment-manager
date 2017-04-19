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

//Admin Pannel Routes
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'auth'], function()
{
    //home Page Route
    Route::get('/', ['as' => 'admin.dashboard', 'uses' => 'PagesController@getDashboard']);
    //home Page Route
    Route::get('schedule', ['as' => 'adminSchedule', 'uses' => 'PagesController@viewSchedule']);

//
//
//Settings Sub-Menu routes    
//
//
//chamber Page Route
            Route::get('settings/chamber', ['as' => 'adminChamber', 'uses' => 'PagesController@viewChamberList']);

        //chamber New Route     
            Route::get('settings/chamber/new', ['as' => 'adminChamberNew', 'uses' => 'PagesController@newChamberForm']);

        //chamber Edit Route     
            Route::get('settings/chamber/edit/{cId}', ['as' => 'adminChamberEdit', 'uses' => 'PagesController@editChamberForm']);    

        //chamber Save Route     
            Route::post('settings/chamber/save', ['as' => 'adminChamberSave', 'uses' => 'PagesController@saveChamber']);

        //chamber Remove Route     
            Route::get('settings/chamber/remove/{cId}', ['as' => 'adminChamberRemove', 'uses' => 'PagesController@removeChamber']);\ 
            
//educating Page Route
            Route::get('settings/education', ['as' => 'adminEducation', 'uses' => 'PagesController@viewEducationList']);
            
        //educating New Route     
            Route::get('settings/education/new', ['as' => 'adminEducationNew', 'uses' => 'PagesController@newEducationForm']);

        //educating Edit Route     
            Route::get('settings/education/edit/{degreeName}', ['as' => 'adminEducationEdit', 'uses' => 'PagesController@editEducationForm']);\      

        //educating Save Route     
            Route::post('settings/education/save', ['as' => 'adminEducationSave', 'uses' => 'PagesController@saveEducation']);

        //educating Remove Route     
            Route::get('/settings/education/remove/{degreeName}', ['as' => 'adminEducationRemove', 'uses' => 'PagesController@removeEducation']);            

            
//personal-info Page Route
            Route::get('settings/personal-info', ['as' => 'adminPersonalInfo', 'uses' => 'PagesController@viewPersonalInfo']);

        //personal-info Save Route    
            Route::post('settings/personal-info/save', ['as' => 'adminPersonalInfoSave', 'uses' => 'PagesController@savePersonalInfo']);

            
//work-history Page Route
            Route::get('settings/work-history', ['as' => 'adminWorkHistory', 'uses' => 'PagesController@viewWorkHistory']);
                        
        //work-history  New Route     
            Route::get('settings/work-history/new', ['as' => 'adminWorkHistoryNew', 'uses' => 'PagesController@newWorkHistoryForm']);

        //work-history  Edit Route     
            Route::get('settings/work-history/edit/{workHistoryId}', ['as' => 'adminWorkHistoryEdit', 'uses' => 'PagesController@editWorkHistoryForm']);\      

        //work-history  Save Route     
            Route::post('settings/work-history/save', ['as' => 'adminWorkHistorySave', 'uses' => 'PagesController@saveWorkHistory']);

        //work-history  Remove Route     
            Route::get('/settings/work-history/remove/{workHistoryId}', ['as' => 'adminWorkHistoryRemove', 'uses' => 'PagesController@removeWorkHistory']);  
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

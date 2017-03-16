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
    Route::get('schedule', ['as' => 'admin.schedule', 'uses' => 'PagesController@getSchedule']);
    
//Settings Sub-Menu routes    
    //chamber Page Route
    Route::get('settings/chamber', ['as' => 'admin.settings.chamber', 'uses' => 'PagesController@getChamber']);
    //educating Page Route
    Route::get('settings/education', ['as' => 'admin.settings.education', 'uses' => 'PagesController@getEducalion']);
    //personal-info Page Route
    Route::get('settings/personal-info', ['as' => 'admin.settings.personal-info', 'uses' => 'PagesController@getPersonalInfo']);
    //work-history Page Route
    Route::get('settings/work-history', ['as' => 'admin.settings.work-history', 'uses' => 'PagesController@getWorkHistory']);
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

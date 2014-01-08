<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@showWelcome');

// Authentication
Route::get('login', 'AuthController@showLogin');
Route::post('login', array('before' => 'csrf', 'uses' => 'AuthController@postLogin'));
Route::get('logout', 'AuthController@getLogout');

// Secure-Routes
Route::group(array('before' => 'auth'), function()
{
    Route::get('dashboard', 'DashboardController@showOverview');
    Route::get('dashboard/documents', 'DashboardController@showDocuments');
    Route::get('dashboard/projects', 'DashboardController@showProjects');
    Route::get('dashboard/entities', 'DashboardController@showEntities');
});

// Error handling
App::missing(function($exception)
{
    return Response::view('errors.404', array(), 404);
});
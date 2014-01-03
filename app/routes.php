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
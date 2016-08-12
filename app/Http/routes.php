<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/





Route::group(['middleware' => ['auth'],'prefix'=>'employee'], function () {

			Route::get('new/sub', function(){
				return view('employee/new_submission');
			});

});


Route::group(['middleware' => ['auth']], function () {

			Route::get('/', function(){
				return view('home');
			});

			Route::get('/home', function(){
				return redirect('/');
			});
			Route::resource('submissions','SubmissionController');
			Route::get('submissions/{id?}',function(){
				return view('employee_subs');
			});

			Route::get('submission/view/{id}',function(){
				return view('view_sub');
			});

			Route::get('notifications',function(){
				return view('notifications');
			});

			Route::get('reports',function(){
				return view('home');
			});

});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

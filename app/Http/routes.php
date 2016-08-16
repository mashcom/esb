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




	Route::group(['middleware' => ['auth']], function () {
				Route::resource('submissions','SubmissionController');
				Route::get('submissions/{action}/{id}','SubmissionController@approval');
				Route::get('submissions/{id?}',function(){
					return view('employee_subs');
				});

				Route::get('submissions/single/user/{id}','SubmissionController@employeeSubs');

				Route::get('submission/view/{id}',function(){
					return view('view_sub');
				});

				//report routes
				Route::resource('reports','ReportController');
				Route::resource('reports/custom/filter','ReportController@filter');

				//notifications routes
				Route::resource('notifications','NotificationController');
				Route::get('notifications/folder/{folder}','NotificationController@index');
				Route::get('notifications/compose/message','NotificationController@compose');


	});

	Route::get('/', function(){
		return view('welcome');
	});

	Route::get('/home', function(){
		return redirect('/');
	});




	Route::controllers([
		'auth' => 'Auth\AuthController',
		'password' => 'Auth\PasswordController',
	]);

/*
Route::get('secret',function(){
	return view('auth.crypt');
});

Route::get('secret/mockingbird','Auth\AuthController@vaultNow');
*/

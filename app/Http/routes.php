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


				Route::get('submissions/create/new','SubmissionController@create');
				Route::post('submissions/store/new','SubmissionController@store');
				Route::group(['middleware'=>['auth']], function(){

					Route::resource('submissions','SubmissionController');
					Route::get('submissions/{action}/{id}','SubmissionController@approval');
					//report routes
					Route::resource('reports','ReportController');
					Route::resource('reports/custom/filter','ReportController@filter');
				});

					Route::get('submissions/{id?}',function(){
					return view('employee_subs');
				});
				Route::get('submissions/single/user/{id}','SubmissionController@employeeSubs');

				Route::get('submission/view/{id}',function(){
					return view('view_sub');
				});



				//notifications routes
				Route::resource('notifications','NotificationController');
				Route::get('notifications/folder/{folder}','NotificationController@index');
				Route::get('notifications/compose/message','NotificationController@compose');

				Route::get('employee',function(){
					return redirect('/submissions/single/user/'.Auth::user()->id);
				});


	});

	Route::get('/', function(){
		return view('welcome');
	});

	Route::get('/home', function(){
		return redirect('/auth/success');
	});

	Route::any('/auth/success',function(){
		$is_admin = Auth::user()->is_admin;
		if($is_admin){
			return redirect('/submissions');
		}
		return redirect('/employee');
	});

	Route::any('/authorised',function(){
		return view('errors.401');
	});
	Route::controllers([
		'auth' => 'Auth\AuthController',
		'password' => 'Auth\PasswordController',
	]);

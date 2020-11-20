<?php

use Illuminate\Http\Request;


Route::post('/login', 'AuthController@login');


// json
Route::get('/specialties', 'SpecialtyController@index');
Route::get('/specialties/{specialty}/doctors', 'SpecialtyController@doctors');
Route::get('/schedule/hours', 'ScheduleController@hours');

Route::middleware('auth:api')->group( function(){
    
    Route::get('/user', 'UserController@show');
    Route::post('/user', 'UserController@update');
    Route::post('/logout', 'AuthController@logout');
    
   // appointments
	Route::get('/appointments', 'AppointmentController@index');
	Route::post('/appointments', 'AppointmentController@store');
});
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



Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/', function () {return view('welcome');});

Route::get('/test', function () {return 'test';});



//get
Route::get('/lists', 'ListController@index');

Route::get('/lists/{todo}', 'ListController@show');

// export todos
Route::get('/lists/{todo}/excel', 'ListController@excel');

Route::get('/lists/{todo}/zip', 'ListController@zip');


// create
Route::post('/lists/{todo}', 'TaskController@store');

Route::post('/lists', 'ListController@store');

//update status ajax
Route::post('/lists/{todo}/ajax', 'TaskController@ajax');

// delete
Route::get('/lists/{id}/delete', 'ListController@destroy');

Route::get('/tasks/{id}/delete', 'TaskController@destroy');


// admin

Route::get('/admin/tasks', 'TaskController@index')->middleware('AuthUser');

//Route::get('/lists/{id}/edit', 'ListController@edit');

//Route::patch('/lists', 'ListController@update');

//Route::delete('/lists{id}', 'ListController@destroy');




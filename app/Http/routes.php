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

// App/Secured Routes
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', "NotesController@getNotes");
    Route::get('/notes/add', "NotesController@addNote");
    Route::post('/notes/add', "NotesController@createNote");
    Route::get('/notes/{note_id}', "NotesController@viewNote");
    Route::post('/notes/{note_id}/comments', "NotesController@postComment");

    Route::get('/profile', "UserController@getMyProfile");
    Route::post('/profile/picture', "UserController@updateProfilePicture");
    Route::post('/profile/details', "UserController@updateProfileDetails");
});

//Authentication/Registration
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');
Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register', 'Auth\AuthController@postRegister');


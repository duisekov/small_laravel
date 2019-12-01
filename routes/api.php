<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// login => obtain token and scope
Route::post('login', 'Api\UserController@login');

// actions that allowed for all users
Route::group(['middleware' => 'auth:api'], function(){
    Route::get('tickets', 'Api\TicketController@index');
    Route::get('tickets/{id}', 'Api\TicketController@show');

    Route::get('tickets/{ticketId}/messages', 'Api\MessageController@index');
    Route::get('tickets/{ticketId}/message', 'Api\MessageController@showLastMessage');
    Route::post('tickets/{ticketId}/messages', 'Api\MessageController@store');

    Route::post('logout', 'Api\UserController@logout');
});

// actions that allowed for clients: create ticket
Route::group(['middleware' => ['auth:api', 'scopes:client']], function(){
    Route::post('tickets', 'Api\TicketController@store');
});

// actions that allowed for moderators: close ticket
Route::group(['middleware' => ['auth:api', 'scopes:moderator']], function(){
    Route::put('tickets/{id}', 'Api\TicketController@update');
});

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

    Route::post('login', 'API\AuthController@login');
    Route::post('register', 'API\AuthController@register');

Route::get('countries','CountryController@view');

Route::get('country/{id}','CountryController@viewsingle');

Route::post('country/{id}','CountryController@store');

Route::put('country/{id}','CountryController@edit');

Route::delete('country/{id}','CountryController@destroy');



<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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


Route::get('posts','API\PostController@index');

Route::get('categories','API\CategoryController@index');

Route::get('districts','API\DistrictController@index');

Route::group(['prefix'=>'comment'],function (){
    Route::get('/','API\CommentController@index');
    Route::post('/{id}','API\CommentController@store');
    Route::put('/{id}','API\CommentController@update');
    Route::delete('/{id}','API\CommentController@destroy');
});






<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=> 'admin', 'middleware' => 'auth' ], function(){

    Route::resource('countries','CountryController');
    Route::resource('states','StateController');
    Route::resource('districts','DistrictController');
    Route::resource('categories','CategoryController');
    Route::resource('posts','PostController');
    Route::resource('galleries','GalleryController');
    Route::resource('roles','RoleController',['except'=> ['destroy']]);
    Route::resource('permissions','PermissionController',['only' => ['index', 'show']]);
    Route::resource('users','UserController',['except'=> ['destroy']]);

});

Route::get('dropdownlist','DynamicDependent@index');
Route::get('get-state-list','DynamicDependent@getStateList');



// Get Data


Route::group(['middleware' => 'auth','prefix' => 'dataset'], function () {
    // User needs to be authenticated to enter here.
    Route::get('getCategory', 'CategoryController@getCategory');
    Route::get('getCountry', 'CountryController@getCountry');
    Route::get('getGallery', 'GalleryController@getGallery');
    Route::get('getDistrict', 'DynamicDependent@getDistrict');
    Route::get('getState', 'StateController@getState');
    Route::get('getPosts', 'PostController@getPosts');
    Route::get('getRoles', 'RoleController@getRoles');
    Route::get('getUsers', 'UserController@getUsers');

});


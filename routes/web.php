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
// admin routes
Route::get('/dashboard','DashboardController@index')->name('dashboard')->middleware('auth');

//resources route for controller in admin pannel
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
    Route::resource('events','EventController');
    Route::resource('pages','PageController');

});
//ajax controller
//Route::get('dropdownlist','DynamicDependent@index');
//Route::get('get-state-list','DynamicDependent@getStateList');
Route::get('get-state-list','DistrictController@getStateList');
Route::get('getDistrictList','HomeController@getDistrictList');

//Route::get('/','HomeController@index');


//// front end routes html
Route::get('getStateList','HomeController@getStateList');
Route::get('/single-news/{id}', 'newsController@singleNewsInfo');
Route::get('/category-news/{id}', 'newsController@categoryNewsInfo');
Route::get('/state-news/{id}', 'newsController@StateNews');
Route::get('/district-news/{id}', 'newsController@DistrictNews');

//testing news count
Route::get('news','NewsViewController@index')->name('newsindex');
Route::get('show/{slug}','NewsViewController@show')->name('newsview');
Route::get('todaypost', 'PostController@todaypost')->name('todayposts');
Route::get('breakingnews', 'PostController@breakingnews')->name('breakingnews');


//position route
Route::post('categories/index', 'CategoryController@updateOrder')->name('orderupdate');
Route::post('categories','CategoryController@updateOrder')->name('sort');





// Data tables
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
    Route::get('getEvents','EventController@getEvents');
    Route::get('getPages', 'PageController@getPages');

});


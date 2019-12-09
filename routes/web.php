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

Route::delete("/delete/{id}", "GuzzleController@delete")->name("delete_guzzle");
Route::put("/guzzle_update/{id}", "GuzzleController@update")->name("update_guzzle");
Route::get("/guzzle_edit/{id}", "GuzzleController@edit")->name("guzzle_edit");
Route::post("/gStore", "GuzzleController@store")->name("add_guzzle");
Route::get("/gCreate", "GuzzleController@create")->name("add_create");
Route::get("/gData", "GuzzleController@index")->name("gData");
Route::get("/phoneall", "PhoneController@all_phone");
Route::get("/userall", "UserController@all_user");
Route::post("/execute", "AdvanceController@make_payment")->name("ex_payment");
Route::get("/execute-holas", "AdvanceController@ex_payments");
Route::get("/welcome", "AdvanceController@holaview");
Route::get("/regis", "AdvanceController@view")->name("registration")->middleware("auth");
Route::get("/regis1", "AdvanceController@show_data")->name("show_data")->middleware("auth");
Route::post("/regis", "AdvanceController@ad_regis")->name("ad_regis")->middleware("auth");
Route::get("/edit/{id}", "AdvanceController@edit")->name("edit")->middleware("auth");
Route::patch("/update/{id}", "AdvanceController@update")->name("update")->middleware("auth");
Route::get("reservations", "reservationController@get_data");
Route::get("sum", "reservationController@getAllData");
Route::get("coll", "holaController@check_collection");
Route::get("ad", "holaController@advancers");




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/show_redis_data', 'AdvanceController@show_redis_data');
Route::get("redis_in", function(){
    $redis = app()->make('redis');
    $redis->set("key","bbro");
    return $redis->get("key");
});
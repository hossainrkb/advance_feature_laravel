<?php


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


Route::get("show_create", "reservationController@show_create")->name("json_insert");
Route::post("show_create", "reservationController@json_store")->name("json_store");
Route::get("create_flight", "reservationController@create_flight");


Auth::routes();
Route::get("/prac_index", "GuzzleController@prac_index");

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/show_redis_data', 'AdvanceController@show_redis_data');
Route::get("redis_in", function(){
    $redis = app()->make('redis');
    $redis->set("key","bbro");
    return $redis->get("key");
});

Route::get('contactdata/postdata', 'reservationController@postdata')->name('contact.postdata');
Route::post('flight_reservation', 'reservationController@flight_reservation')->name('flight_reservation');

//service controller
Route::get('service_controller', 'ServiceController@store')->name('sc');
Route::get('facade', 'ServiceController@facade');
Route::get('OauthPassport', 'OauthPassportController@check')->middleware('client');
Route::get('adminlogin', 'HolaadminController@login_page');
Route::post('adminlogin', 'HolaadminController@login')->name("admin.login.submit");

Route::get('bros', 'HolaadminController@index')->name("hola_bros")->middleware("hola_middleware");
Route::get('/emni', function () {
    return "emni";
})->middleware("hola_middleware");
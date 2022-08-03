<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BarbersController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminController;

//Puplic

Route::get("category", "CategoryController@index");
Route::get("category/{id}", "CategoryController@show");

Route::get("barbers", "BarbersController@index");
Route::get("barbers/{id}", "BarbersController@show");

Route::get("posts", "PostsController@index");
Route::get("posts/{id}", "PostsController@show");

//Registretion

Route::post("admin/login", "AdminController@login");
Route::post("admin/register", "AdminController@register");

Route::post("user/login", "UsersController@login");
Route::post("user/register", "UsersController@register");

Route::post("barber/login", "BarbersController@login");
Route::post("barber/register", "BarbersController@register");

//Private

Route::middleware(['auth:sanctum', 'type.user'])->group(function () {

    Route::post("user/payments", "PaymentController@store");
    Route::put("user/payments/{id}", "PaymentController@update");
    Route::delete("user/payments/{id}", "PaymentController@destroy");

    Route::post("users/{id}", "UsersController@update");
    Route::post("/logout", "UsersController@logout");
});

Route::middleware(['auth:sanctum', 'type.barber'])->group(function () {

    Route::post("barber/{id}", "BarbersController@update");
    Route::post("/logout", "BarbersController@logout");

    Route::post("barber/posts", "PostsController@store");
    Route::put("barber/posts/{id}", "PostsController@update");
    Route::put("barber/posts/{id}", "PostsController@destroy");

});

Route::middleware(['auth:sanctum', 'type.admin'])->group(function () {

    Route::post("admin/category", "CategoryController@store");
    Route::put("admin/category/{id}", "CategoryController@update");
    Route::delete("admin/category/{id}", "CategoryController@destroy");

    Route::delete("admin/posts/{id}", "PostsController@destroy");

    Route::delete("admin/barber/{id}", "BarbersController@destroy");

    Route::get("admin/users", "UsersController@index");
    Route::delete("admin/users/{id}", "UsersController@destroy");

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

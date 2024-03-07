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

Route::namespace("Api")->group(function (){

    /*------- User Api -------*/
    $prefix = "user";
    $controllerName = "user";
    Route::prefix($prefix)->name($controllerName . ".")->group(function () use ($controllerName){
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get("/", $controller . "index")->name("index");
        Route::post("them-user", $controller . "store")->name("store");
    });

    /*------- Product Api -------*/
    $prefix = "san-pham";
    $controllerName = "product";
    Route::prefix($prefix)->name($controllerName . ".")->group(function () use ($controllerName){
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get("/", $controller . "index")->name("index");
        Route::post("them-san-pham", $controller . "store");
    });

    /*------- Product Category Api -------*/
    $prefix = "danh-sach-san-pham";
    $controllerName = "product_category";
    Route::prefix($prefix)->name($controllerName . ".")->group(function () use ($controllerName){
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get("/", $controller . "index")->name("index");
    });
});

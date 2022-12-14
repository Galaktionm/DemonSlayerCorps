<?php

use App\Http\Controllers\Auth\DemonSlayerLoginController;
use App\Http\Controllers\Auth\HashiraLoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DemonSlayerController;
use App\Http\Controllers\HashiraController;
use Illuminate\Support\Facades\Route;

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
    return view('index');
});

Route::controller(RegisterController::class)->group(function(){
    Route::get("/register", "showRegistrationForm");
    Route::post("/register", "register");
});

Route::controller(HashiraLoginController::class)->group(function(){
    Route::get("/hashira/login", "showLoginForm");
    Route::post("/hashira/login", "login");
    Route::post("/hashira/logout", "logout");
});

Route::controller(DemonSlayerLoginController::class)->group(function(){
    Route::get("/demonSlayer/login", "showLoginForm");
    Route::post("/demonSlayer/login", "login");
    Route::post("/demonSlayer/logout", "logout");
});


Route::controller(HashiraController::class)->group(function(){
    Route::get("/hashira/account", "showHashiraView");
    Route::post("/hashira/account", "sendMessages");
});

Route::controller(DemonSlayerController::class)->group(function(){
    Route::get("/demonSlayer/account", "showDemonSlayerView");
    Route::post("/demonSlayer/account", "queueAssignJob");
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

<?php

use App\Http\Controllers\ChatsController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
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

Route::view('/', 'frontend.pages.welcome');
Route::view('/test', 'frontend.pages.chat');

Route::get("blocked", [HomeController::class, "blocked"])->name("blocked");





Route::middleware("auth")->group(function () {
//    Broadcast::channel('chat', function ($user) {
//        return Auth::check();
//    });

    Route::get('/home', [ChatsController::class, 'index'])->name('home');
    Route::get('/messages', [ChatsController::class, 'fetchMessages']);
    Route::post('/messages', [ChatsController::class, 'sendMessage']);
});

Auth::routes();


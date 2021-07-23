<?php

use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes();

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('getMessages',[App\Http\Controllers\HomeController::class,'getMessagesList'])->name('getMessages');
Route::post('sendMessage',[App\Http\Controllers\HomeController::class,'create'])->name('message.send');

//

Route::get('/chat',function () {return view('index');});

Route::get('/chat/rooms',[App\Http\Controllers\ChatController::class,'rooms']);
Route::get('/chat/rooms',[App\Http\Controllers\ChatController::class,'rooms']);
Route::get('/chat/room/{roomId}/messages',[App\Http\Controllers\ChatController::class,'messages']);
Route::post('/chat/room/{roomId}/message',[App\Http\Controllers\ChatController::class,'newMessage']);

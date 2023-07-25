<?php

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});


Route::get('/login', function () {
    return view('register');
});


Route::get('/users', 'App\Http\Controllers\Controller@getAllUser');

Route::post('/process_register', 'App\Http\Controllers\Controller@postUser');

Route::get('/history', 'App\Http\Controllers\Controller@getAllHistory');
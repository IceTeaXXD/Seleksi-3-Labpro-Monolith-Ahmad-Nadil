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


Route::get('/register', function () {
    return view('register');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/catalog', function () {
    return view('catalog');
});

Route::get('/purchase', function () {
    return view('purchase');
});

Route::get(
    '/users',
    'App\Http\Controllers\GetController@getAllUser'
);

Route::get(
    '/history',
    'App\Http\Controllers\GetController@getAllHistory'
);

Route::get(
    '/logout',
    'App\Http\Controllers\GetController@getLogout'
);

Route::post(
    '/process_register',
    'App\Http\Controllers\PostController@postUser'
);

Route::post(
    '/process_login',
    'App\Http\Controllers\PostController@postLogin'
);

Route::post(
    '/process_purchase',
    'App\Http\Controllers\PostController@postPurchase'
);

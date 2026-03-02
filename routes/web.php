<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/profile', function () {
    return view('auth.profile');
})->name('profile');


// admin restriction will be added to api routes
Route::get('/admin', function () {
    return view('admin.home');
})->name('admin');

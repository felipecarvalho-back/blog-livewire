<?php

use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Support\Facades\Route;

Route::livewire('/', 'pages::home')->name('home');
Route::livewire('/login', 'pages::login')->name('login');
Route::livewire('/register', 'pages::register')->name('register');

Route::get('/logout', LogoutController::class)->name('logout');

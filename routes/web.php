<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SingleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::resource('/', HomeController::class)->name('index', 'home');

Route::get('/single/{post}', [SingleController::class, 'index'])->name('single');

Route::post('/single/{post}/comment', [SingleController::class, 'comment'])
    ->middleware('auth:web')
    ->name('single.comment');

Auth::routes();

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

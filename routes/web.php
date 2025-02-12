<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminAuthMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/event/{id}', [HomeController::class, 'event'])->name('event.detail');
Route::get('/daily-schedule/{date}', [HomeController::class, 'daily'])->name('daily.schedule');
    
Route::get('/admin', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin');
Route::post('/admin/input', [AdminController::class, 'input'])->name('input');

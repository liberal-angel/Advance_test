<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::get('/',[ContactController::class, 'index']);
Route::post('/check',[ContactController::class, 'check']);
Route::post('/send',[ContactController::class, 'send']);
Route::get('/search',[ContactController::class, 'search']);
Route::post('/search',[ContactController::class, 'search_post']);
Route::post('/delete/{id}',[ContactController::class, 'delete']);
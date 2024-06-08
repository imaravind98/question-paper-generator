<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout']);
Route::middleware('auth')->group(function () {
    Route::resource('users', UserController::class);

    Route::resource('chapters', ChapterController::class);

    Route::resource('classes', ClassController::class);
    
    Route::resource('subjects', SubjectController::class);
    
    Route::resource('questions', QuestionController::class);
});
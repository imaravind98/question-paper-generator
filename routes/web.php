<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\GroupMiddleware;
use Illuminate\Support\Facades\Route;


Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout']);
Route::middleware('auth')->group(function () {

    Route::middleware(GroupMiddleware::class)->group(function(){
        Route::resource('users', UserController::class);
    });
    
    Route::resource('chapters', ChapterController::class);

    Route::resource('classes', ClassController::class);
    
    Route::resource('subjects', SubjectController::class);
    
    Route::resource('questions', QuestionController::class);

    Route::get('export', [ExportController::class, 'index']);
    Route::post('export', [ExportController::class, 'export']);
});
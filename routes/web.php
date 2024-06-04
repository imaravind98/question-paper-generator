<?php

use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;

Route::resource('chapters', ChapterController::class);

Route::resource('classes', ClassController::class);

Route::resource('subjects', SubjectController::class);
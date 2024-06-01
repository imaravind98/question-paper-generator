<?php

use App\Http\Controllers\ChapterController;
use Illuminate\Support\Facades\Route;

Route::resource('chapters', ChapterController::class);

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProgressController;

Route::get('/api/progress', [ProgressController::class, 'index']);

Route::get('/api/progress/{userId}', [ProgressController::class, 'show'])->where('userId', '[0-9]+');

Route::get('/initDb', [ProgressController::class, 'initDb']);
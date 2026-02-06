<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AnalyzeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/dashboard/{key}', [HomeController::class, 'dashboard'])->name('dashboard');

Route::prefix('api')->name('api.')->group(function() {
    Route::post('analyze', [AnalyzeController::class, 'index'])->name('analyze');
});
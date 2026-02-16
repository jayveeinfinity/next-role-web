<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AnalyzeController;
use App\Http\Controllers\DocumentController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/dashboard/{key}', [HomeController::class, 'dashboard'])->name('dashboard');

Route::prefix('api')->name('api.')->group(function() {
    Route::post('portfolio/upload', [DocumentController::class, 'store'])->name('store');
    Route::post('analyze', [AnalyzeController::class, 'index'])->name('analyze');
});
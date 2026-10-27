<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Страница отображения графика/формы с поддержкой выбранного времени
Route::get('/services', [SiteController::class, 'repairForm'])->name('services.form');

// Обработка отправки формы
Route::post('/services', [SiteController::class, 'storeRepair'])->name('services.store');

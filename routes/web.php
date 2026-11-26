<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\SiteController;

use App\Http\Controllers\CountryController;

Route::get('/', function () {
    return redirect()->route('country.index');
});

Route::resource('country', CountryController::class);

// Главная страница
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::resource('services', AppointmentController::class)->names([
    'index' => 'services.index',
    'store' => 'services.store',
])->parameters([
    'services' => 'appointment'
]);

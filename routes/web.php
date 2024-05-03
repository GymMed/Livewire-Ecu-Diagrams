<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;

Route::get('/', function () {
    return view('components.general.pages.home.home');
    //return view('welcome');
});

Route::get('home', function () {
    return view('components.general.pages.home.home');
})->name('home');

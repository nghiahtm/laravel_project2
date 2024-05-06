<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\View\V1\HomeController;

Route::get('/', function () {
    return view('welcome');
});

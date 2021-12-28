<?php

use App\Http\Controllers\Web\SearchFlightController;
use Illuminate\Support\Facades\Route;

Route::get('', [SearchFlightController::class, 'index']);
Route::post('', [SearchFlightController::class, 'search']);

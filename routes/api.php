<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/relief-data', [\App\Http\Controllers\ReliefRequestController::class, 'getMapData']);

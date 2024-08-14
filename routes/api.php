<?php

use App\Http\Controllers\Api\EventFlowController;
use Illuminate\Support\Facades\Route;

// Ideally these would be their own controller and following the RESTful conventions, so instead of custom controller methods, they would be in their own controller and use the store method.
Route::post('harvested', [EventFlowController::class, 'harvested'])->name('harvested');
Route::post('sale', [EventFlowController::class, 'sale'])->name('sale');

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivestockController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get(
    '/livestock',
    [LivestockController::class, 'index']
);

Route::post(
    '/livestock',
    [LivestockController::class, 'store']
);

Route::put(
    '/livestock/{id}',
    [LivestockController::class, 'update']
);

Route::delete(
    '/livestock/{id}',
    [LivestockController::class, 'destroy']
);
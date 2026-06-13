<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan; // Ditambahkan untuk menjalankan perintah artisan
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

// Rute khusus untuk memicu pembuatan folder storage link di Railway
Route::get('/bikin-storage', function () {
    try {
        Artisan::call('storage:link');
        return response()->json([
            'status' => 'sukses', 
            'message' => 'Folder storage berhasil dihubungkan atau sudah ada!'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'gagal', 
            'message' => $e->getMessage()
        ]);
    }
});
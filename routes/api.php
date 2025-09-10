<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoadController;

Route::get('/', function () {
    return response()->json([
        'message' => 'I am working'
    ]);
});

Route::prefix('v1')->group(function () {
    Route::post('loads', [LoadController::class, 'calculate'])->name('v1.loads.calculate');
});

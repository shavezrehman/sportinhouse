<?php

use App\Http\Controllers\CourtController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\CourtApiController;

Route::prefix('admin')->group(function () {
    // Admin API Routes for Courts

    // Get all courts
    Route::get('/courts', [CourtApiController::class, 'index'])->name('admin.courts.index');

    // Create new court
    Route::post('/courts', [CourtApiController::class, 'store'])->name('admin.courts.store');

    // Get court by ID (for edit)
    Route::get('/courts/{id}', [CourtApiController::class, 'show'])->name('admin.courts.show');

    // Update court
    Route::put('/courts/{id}', [CourtApiController::class, 'update'])->name('admin.courts.update');

    // Delete court
    Route::delete('/courts/{id}', [CourtApiController::class, 'destroy'])->name('admin.courts.destroy');
});



Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:api')->get('user', function (Request $request) {
    return $request->user();
});

// Routes for authenticated users
Route::middleware('auth:api')->get('user', function (Request $request) {
    return $request->user();
});


Route::get('courts', [CourtController::class, 'index']); // Get all courts
Route::get('courts/category/{categoryId}', [CourtController::class, 'showCourts']); // Get courts by category
Route::post('courts', [CourtController::class, 'store']); // Store a new court
Route::put('courts/{id}', [CourtController::class, 'update']); // Update an existing court
Route::delete('courts/{id}', [CourtController::class, 'destroy']); // Delete a court

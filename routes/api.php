<?php

use App\Http\Controllers\CourtController;

Route::get('courts', [CourtController::class, 'index']); // Get all courts
Route::get('courts/category/{categoryId}', [CourtController::class, 'showCourts']); // Get courts by category
Route::post('courts', [CourtController::class, 'store']); // Store a new court
Route::put('courts/{id}', [CourtController::class, 'update']); // Update an existing court
Route::delete('courts/{id}', [CourtController::class, 'destroy']); // Delete a court

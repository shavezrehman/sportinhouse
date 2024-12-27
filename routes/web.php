<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourtController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourtApiController;
use App\Models\Court;
use Illuminate\Http\Request;


Route::get('/', function () {
    return view('welcome'); // Homepage view
})->name('welcome'); // Route name for easy reference in views

Route::get('/dashboard', function () {
    return view('dashboard'); // Admin Dashboard view
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/booking', function () {
    return view('booking');
})->name('booking');

// Contact Page Route
Route::get('/contact', function () {
    return view('contact'); // Contact page view
})->name('contact');

// Admin Routes for courts and categories
Route::prefix('admin')->group(function () {
    // Courts Admin Routes
    Route::get('/courts', [CourtController::class, 'adminIndex'])->name('admin.courts.index'); // Admin view for all courts
    Route::get('/courts/create', [CourtController::class, 'create'])->name('admin.courts.create'); // Create court form
    Route::post('/courts', [CourtController::class, 'store'])->name('admin.courts.store'); // Store new court
    Route::get('/courts/{id}/edit', [CourtController::class, 'edit'])->name('admin.courts.edit'); // Edit court form
    Route::put('/courts/{id}', [CourtController::class, 'update'])->name('admin.courts.update'); // Update court
    Route::delete('/courts/{id}', [CourtController::class, 'destroy'])->name('admin.courts.destroy'); // Delete court

    // Categories Admin Routes
    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories.index'); // View categories list
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create'); // Create category form
    Route::post('/categories', [CategoryController::class, 'store'])->name('admin.categories.store'); // Store new category
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit'); // Edit category form
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('admin.categories.update'); // Update category
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy'); // Delete category
});


// web.php
Route::get('/courts', [PageController::class, 'courtsByCategory'])->name('courts');

// Route for searching courts
Route::get('/search-courts', function (Request $request) {
    $query = $request->query('query', '');

    // Filter courts based on the search query
    $courts = Court::where('court_name', 'like', '%' . $query . '%')
        ->orWhere('location', 'like', '%' . $query . '%')  // Also search by location
        ->get();

    // Prepare the data for the response
    $courtsData = $courts->map(function ($court) {
        return [
            'id' => $court->id,
            'court_name' => $court->court_name,
            'location' => $court->location,
            'capacity' => $court->capacity,
            'price_per_hour' => $court->price_per_hour,
            'image' => $court->image ? asset($court->image) : '/images/default-court.jpg',
        ];
    });

    return response()->json([
        'courts' => $courtsData,
    ]);
});

// Authenticated User Profile Routes
Route::middleware(['auth'])->group(function () {
    // View Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    
    // Edit Profile
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    
    // Update Profile
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__.'/auth.php';

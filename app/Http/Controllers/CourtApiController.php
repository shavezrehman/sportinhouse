<?php

namespace App\Services;
namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Storage;

use App\Models\Court;

class CourtService
{
    // Get all courts
    public function getAllCourts()
    {
        return Court::all(); // Return all courts from the database
    }

    // Get courts by category
    public function getCourtsByCategory($categoryId)
    {
        return Court::where('category_id', $categoryId)->get(); // Return courts by category
    }

    // Store a new court
    public function storeCourt($data)
    {
        // Handle image upload and storing of court
        $imagePath = $data['image']->store('courts', 'public'); // Store the image

        // Create and return the new court record
        return Court::create([
            'court_name' => $data['court_name'],
            'location' => $data['location'],
            'capacity' => $data['capacity'],
            'price_per_hour' => $data['price_per_hour'],
            'category_id' => $data['category_id'],
            'image' => $imagePath,
        ]);
    }

    // Update an existing court
    public function updateCourt(Court $court, $data)
    {
        // Handle image update if new image is provided
        if (isset($data['image'])) {
            $imagePath = $data['image']->store('courts', 'public');
            $court->image = $imagePath;
        }

        $court->court_name = $data['court_name'];
        $court->location = $data['location'];
        $court->capacity = $data['capacity'];
        $court->price_per_hour = $data['price_per_hour'];
        $court->category_id = $data['category_id'];

        $court->save(); // Save the updated court record
    }

    // Delete a court
    public function deleteCourt(Court $court)
    {
        // Delete the image file from storage if necessary
        if ($court->image) {
            Storage::disk('public')->delete($court->image);

        }

        $court->delete(); // Delete the court from the database
    }
}

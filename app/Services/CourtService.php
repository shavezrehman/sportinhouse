<?php

namespace App\Services;

use App\Models\Court;
use App\Models\Category;
use Illuminate\Support\Facades\File;

class CourtService
{
    // Fetch all courts for the admin panel
    public function getAllCourts()
    {
        return Court::all();  // Return all courts
    }

    // Get court by ID
    public function getCourtById($id)
    {
        return Court::findOrFail($id);  // Fetch a court by its ID
    }

    // Create a new court
    public function createCourt(array $data)
    {
        $court = new Court();
        $court->court_name = $data['court_name'];
        $court->location = $data['location'];
        $court->capacity = $data['capacity'];
        $court->price_per_hour = $data['price_per_hour'];
        $court->category_id = $data['category_id'];  // Assign category ID

        // Handle image upload
        if (isset($data['image'])) {
            $imageName = time() . '.' . $data['image']->getClientOriginalExtension();
            $data['image']->move(public_path('img'), $imageName);
            $court->image = 'img/' . $imageName;
        }

        $court->save();  // Save the court in the database
    }

    // Update an existing court
    public function updateCourt($id, array $data)
    {
        $court = Court::findOrFail($id);
        $court->court_name = $data['court_name'];
        $court->location = $data['location'];
        $court->capacity = $data['capacity'];
        $court->price_per_hour = $data['price_per_hour'];
        $court->category_id = $data['category_id'];  // Update category ID

        // If a new image is uploaded, handle the image update
        if (isset($data['image'])) {
            // Delete the old image if it exists
            if ($court->image && File::exists(public_path($court->image))) {
                File::delete(public_path($court->image));  // Delete the old image
            }

            // Upload the new image
            $imageName = time() . '.' . $data['image']->getClientOriginalExtension();
            $data['image']->move(public_path('img'), $imageName);
            $court->image = 'img/' . $imageName;
        }

        $court->save();  // Save the updated court
    }

    // Delete a court
    public function deleteCourt($id)
    {
        $court = Court::findOrFail($id);
        
        // Delete the image file from storage if it exists
        if ($court->image && File::exists(public_path($court->image))) {
            File::delete(public_path($court->image));  // Delete the old image
        }

        $court->delete();  // Delete the court from the database
    }

    // Filter courts based on search term and category
    public function filterCourts($searchTerm = null, $categoryId = null)
    {
        $query = Court::query();

        if ($searchTerm) {
            $query->where('court_name', 'like', '%' . $searchTerm . '%');  // Filter by court name
        }

        if ($categoryId) {
            $query->where('category_id', $categoryId);  // Filter by category
        }

        return $query->get();  // Return the filtered list of courts
    }
}

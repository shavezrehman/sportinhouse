<?php

namespace App\Http\Controllers;

use App\Models\Court;
use App\Models\Category;  // Import the Category model
use Illuminate\Http\Request;

class CourtController extends Controller
{
    // Display the list of courts
    public function adminIndex()
    {
        $courts = Court::all();  // Get all courts
        return view('courts.index', compact('courts'));  // Admin view
    }

    public function showCourts($categoryId)
    {
        // Fetch the category by ID
        $category = Category::findOrFail($categoryId);
    
        // Fetch the courts related to this category
        $courts = Court::where('category_id', $categoryId)->get();
    
        // Return the view with the category and courts data
        return view('courts', compact('category', 'courts'));
    }


    // Show the form to create a new court
    public function create()
    {
        $categories = Category::all();  // Get all categories
        return view('courts.create', compact('categories'));  // Pass categories to the view
    }

    public function store(Request $request)
    {
        // Validate the input data including the image and category_id
        $validated = $request->validate([
            'court_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'price_per_hour' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id', // Ensure category exists
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Create a new court
        $court = new Court();
        $court->court_name = $validated['court_name'];
        $court->location = $validated['location'];
        $court->capacity = $validated['capacity'];
        $court->price_per_hour = $validated['price_per_hour'];
        $court->category_id = $validated['category_id']; // Save the category_id
    
        // Handle the image upload
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('img'), $imageName); // Store in public/img
            $court->image = 'img/' . $imageName; // Save the image path in the database
        }
    
        $court->save();  // Save the court to the database
    
        // Redirect with a success message
        return redirect()->route('admin.courts.index')->with('success', 'Court added successfully.');
    }

    public function update(Request $request, $id)
    {
        // Validate the input data including the image and category_id
        $validated = $request->validate([
            'court_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'price_per_hour' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id', // Ensure category exists
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // image is optional for update
        ]);

        // Find the court by ID
        $court = Court::findOrFail($id);

        // Update court details
        $court->court_name = $validated['court_name'];
        $court->location = $validated['location'];
        $court->capacity = $validated['capacity'];
        $court->price_per_hour = $validated['price_per_hour'];
        $court->category_id = $validated['category_id']; // Save the updated category_id

        // If there's an image, handle the upload
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($court->image && file_exists(public_path($court->image))) {
                unlink(public_path($court->image)); // Delete the old image from the public/img folder
            }

            // Upload the new image
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('img'), $imageName); // Store in public/img
            $court->image = 'img/' . $imageName; // Save the new image path in the database
        }

        // Save the updated court
        $court->save();

        // Redirect back with success message
        return redirect()->route('admin.courts.index')->with('success', 'Court updated successfully.');
    }

    // Show the form to edit a court
    public function edit($id)
    {
        $court = Court::findOrFail($id);
        $categories = Category::all();  // Get all categories
        return view('courts.edit', compact('court', 'categories'));  // Pass categories to the view
    }

    
    // Delete a court
    public function destroy($id)
    {
        $court = Court::findOrFail($id);
        $court->delete();

        return redirect()->route('admin.courts.index')->with('success', 'Court deleted successfully');
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Services\CourtService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category; // Import Category model

class CourtApiController extends Controller
{
    protected $courtService;

    public function __construct(CourtService $courtService)
    {
        $this->courtService = $courtService; // Inject CourtService into the controller
    }

    // Fetch all courts for the admin panel
    public function adminIndex()
    {
        $courts = $this->courtService->getAllCourts();  // Get all courts using the service
        return view('courts.index', compact('courts'));  // Return the admin view
    }

    // Show the form to create a new court
    public function create()
    {
        $categories = Category::all();  // Fetch all categories
        return view('courts.create', compact('categories'));  // Return the create court form
    }

    // Store a new court in the database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'court_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'price_per_hour' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',  // Validate category ID
            'image' => 'nullable    |image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Validate image upload
        ]);

        $this->courtService->createCourt($validated);  // Call service to create court
        return redirect()->route('admin.courts.index')->with('success', 'Court added successfully.');  // Redirect to index with success message
    }

    // Show the form to edit an existing court
    public function edit($id)
    {
        $court = $this->courtService->getCourtById($id);  // Fetch court by ID
        $categories = Category::all();  // Fetch all categories
        return view('courts.edit', compact('court', 'categories'));  // Return the edit court form
    }

    // Update an existing court
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'court_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'price_per_hour' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',  // Validate category ID
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Image is optional for update
        ]);

        $this->courtService->updateCourt($id, $validated);  // Call service to update court
        return redirect()->route('admin.courts.index')->with('success', 'Court updated successfully.');  // Redirect to index with success message
    }

    // Delete a court
    public function destroy($id)
    {
        $this->courtService->deleteCourt($id);  // Call service to delete court
        return redirect()->route('admin.courts.index')->with('success', 'Court deleted successfully.');  // Redirect to index with success message
    }

    // Filter courts by search term or category (for admin or user view)
    public function filter(Request $request)
    {
        $searchTerm = $request->input('searchTerm');
        $categoryId = $request->input('category');

        $courts = $this->courtService->filterCourts($searchTerm, $categoryId);  // Filter courts based on search or category
        return view('courts.index', compact('courts'));  // Return filtered list of courts in the admin view
    }
}

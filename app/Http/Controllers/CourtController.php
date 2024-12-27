<?php

namespace App\Http\Controllers;

use App\Services\CourtService;
use App\Models\Category;
use App\Models\Court;
use Illuminate\Http\Request;

class CourtController extends Controller
{
    protected $courtService;

    public function __construct(CourtService $courtService)
    {
        $this->courtService = $courtService;  // Inject the CourtService
    }

    // Display the list of courts for the admin panel
    public function adminIndex()
    {
        $courts = $this->courtService->getAllCourts();  // Get all courts
        return view('courts.index', compact('courts'));  // Return the admin panel view with courts
    }

    // Show the form to create a new court
    public function create()
    {
        $categories = Category::all();  // Fetch all categories for the category dropdown
        return view('courts.create', compact('categories'));  // Return view to create a court with categories
    }

    // Store a new court
    public function store(Request $request)
    {
        // Validate the input data including the image and category_id
        $validated = $request->validate([
            'court_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'price_per_hour' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',  // Ensure category exists
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Call the service to create a new court
        $this->courtService->createCourt($validated);
        
        // Redirect back to the court index with a success message
        return redirect()->route('admin.courts.index')->with('success', 'Court added successfully.');
    }

    // Show the form to edit an existing court
    public function edit($id)
    {
        $court = $this->courtService->getCourtById($id);  // Fetch court by ID
        $categories = Category::all();  // Fetch all categories for the category dropdown
        return view('courts.edit', compact('court', 'categories'));  // Return view to edit the court
    }

    // Update an existing court
    public function update(Request $request, $id)
    {
        // Validate the input data including the image and category_id
        $validated = $request->validate([
            'court_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'price_per_hour' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',  // Ensure category exists
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image is optional for updates
        ]);

        // Call the service to update the court
        $this->courtService->updateCourt($id, $validated);
        
        // Redirect back to the court index with a success message
        return redirect()->route('admin.courts.index')->with('success', 'Court updated successfully.');
    }

    // Delete a court
    public function destroy($id)
    {
        // Call the service to delete the court
        $this->courtService->deleteCourt($id);
        
        // Redirect back to the court index with a success message
        return redirect()->route('admin.courts.index')->with('success', 'Court deleted successfully');
    }

    public function filterCourts(Request $request)
    {
        // Get the search query and selected category from the request
        $searchQuery = $request->input('searchQuery');
        $categoryId = $request->input('categoryId');
    
        // Start with all courts
        $courts = Court::query();
    
        // Apply search filter
        if ($searchQuery) {
            $courts->where('court_name', 'like', '%' . $searchQuery . '%');
        }
    
        // Apply category filter
        if ($categoryId && $categoryId !== 'all') {
            $courts->where('category_id', $categoryId);
        }
    
        // Fetch the filtered courts
        $courts = $courts->get();
    
        // Prepare courts data for response
        $courtsData = $courts->map(function ($court) {
            return [
                'id' => $court->id,
                'court_name' => $court->court_name,
                'location' => $court->location,
                'capacity' => $court->capacity,
                'price_per_hour' => $court->price_per_hour,
                'image' => $court->image ? asset($court->image) : null,
                'category_id' => $court->category_id,
            ];
        });
    
        return response()->json(['courts' => $courtsData]);
    }
    
    // Show courts for a specific category (frontend)
    public function showCourts($categoryId)
    {
        // Fetch the courts for the selected category
        $category = Category::findOrFail($categoryId);
        $courts = $this->courtService->filterCourts(null, $categoryId);
        
        // Return the view with the courts and category data
        return view('courts', compact('category', 'courts'));
    }
}
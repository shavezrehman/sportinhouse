<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CourtService; // Import the CourtService
use App\Models\Court;
use Illuminate\Http\Request;

class CourtApiController extends Controller
{
    protected $courtService;

    // Inject the CourtService
    public function __construct(CourtService $courtService)
    {
        $this->courtService = $courtService;
    }

    // Get all courts
    public function index()
    {
        $courts = $this->courtService->getAllCourts(); // Use the service to fetch all courts
        return response()->json($courts, 200);
    }

    // Get courts by category
    public function showCourts($categoryId)
    {
        $courts = $this->courtService->getCourtsByCategory($categoryId); // Get courts by category
        return response()->json($courts, 200);
    }

    // Store a new court
    public function store(Request $request)
    {
        $validated = $request->validate([
            'court_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'price_per_hour' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $court = $this->courtService->storeCourt($request->all()); // Use service to store the court
        return response()->json($court, 201); // Return the newly created court with 201 status
    }

    // Update an existing court
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'court_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'price_per_hour' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $court = Court::findOrFail($id);
        $this->courtService->updateCourt($court, $request->all()); // Use service to update court
        return response()->json($court, 200); // Return the updated court
    }

    // Delete a court
    public function destroy($id)
    {
        $court = Court::findOrFail($id);
        $this->courtService->deleteCourt($court); // Use service to delete court
        return response()->json(null, 204); // Return a no-content response
    }
}

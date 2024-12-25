<?php
// PageController.php
namespace App\Http\Controllers;

use App\Models\Category; // Import the Category model
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function courtsByCategory()
    {
        // Get all categories with their associated courts
        $categories = Category::with('courts')->get();

        // Pass the categories variable to the view
        return view('courts', compact('categories'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Display a list of categories (for admin)
    public function index()
    {
        // Fetch all categories from the database
        $categories = Category::all();

        // Return the view with categories data (for admin view)
        return view('categories.index', compact('categories'));
    }

    // Show the form to create a new category (for admin)
    public function create()
    {
        $categories = Category::all();
        return view('categories.create'); // Ensure this points to the correct Blade file in the admin section
    }

    // Store a new category in the database (for admin)
    public function store(Request $request)
    {
        // Validate the input fields
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Create a new category
        Category::create($request->all());

        // Redirect to the category index page with a success message
        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    // Show the form to edit an existing category (for admin)
    public function edit($id)
    {
        // Find the category by ID
        $category = Category::findOrFail($id);

        // Return the edit view with the category data
        return view('categories.edit', compact('category'));
    }

    // Update an existing category (for admin)
    public function update(Request $request, $id)
    {
        // Validate the input fields
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Find the category by ID and update it
        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        // Redirect to the categories index with a success message
        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    // Delete an existing category (for admin)
    public function destroy($id)
    {
        // Find the category by ID
        $category = Category::findOrFail($id);

        // Delete the category
        $category->delete();

        // Redirect to the categories index with a success message
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}

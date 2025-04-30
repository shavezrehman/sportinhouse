<?php

namespace App\Http\Controllers;

use App\Models\Category; 
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function courtsByCategory(Request $request)
    {
        $query = $request->input('query');

        $categories = Category::with(['courts' => function ($queryBuilder) use ($query) {
            if ($query) {
                $queryBuilder->where('court_name', 'like', "%{$query}%")
                             ->orWhere('location', 'like', "%{$query}%");
            }
        }])->get();

        // Pass the categories and query to the view
        return view('courts', compact('categories', 'query'));
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Court extends Model
{
    use HasFactory;

    // Define fillable attributes
    protected $fillable = ['court_name', 'location', 'capacity', 'price_per_hour', 'image', 'category_id']; // Include category_id in fillable attributes

    /**
     * Define the inverse relationship with the Category model.
     */
    public function category()
    {
        return $this->belongsTo(Category::class); // Each court belongs to one category
    }
}

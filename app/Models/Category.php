<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Fillable attributes for mass assignment
    protected $fillable = ['name', 'description'];

    /**
     * Define a one-to-many relationship with the Product model.
     */
    public function courts()
    {
        return $this->hasMany(Court::class); // Adjust to fit your application's entities
    }
}

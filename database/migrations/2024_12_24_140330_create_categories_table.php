<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Add foreign key in courts table if it is related
        Schema::table('courts', function (Blueprint $table) {
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Linking category_id to categories table
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the foreign key from the courts table before dropping the categories table
        Schema::table('courts', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
        });

        // Now drop the categories table
        Schema::dropIfExists('categories');
    }
};

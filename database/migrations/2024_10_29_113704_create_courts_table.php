<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courts', function (Blueprint $table) {
            $table->id();
            $table->string('court_name');
            $table->string('location');
            $table->integer('capacity');
            $table->decimal('price_per_hour', 8, 2);
            $table->string('image')->nullable();  // Add image column
            $table->foreignId('category_id')->constrained()->onDelete('cascade');  // Add category_id as a foreign key
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courts');
    }
};

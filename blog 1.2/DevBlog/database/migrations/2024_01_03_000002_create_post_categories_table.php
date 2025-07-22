<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Sprint 2 - Create pivot table for post-category many-to-many relationship
// Allows posts to belong to multiple categories
return new class extends Migration
{
    public function up()
    {
        Schema::create('post_categories', function (Blueprint $table) {
            $table->id();
            
            // Sprint 2 - Foreign keys for many-to-many relationship
            $table->foreignId('post_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            
            $table->timestamps();
            
            // Sprint 2 - Ensure unique post-category combinations
            $table->unique(['post_id', 'category_id']);
            
            // Sprint 2 - Indexes for better query performance
            $table->index('post_id');
            $table->index('category_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('post_categories');
    }
}; 
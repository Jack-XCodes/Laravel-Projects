<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Sprint 2 - Create categories table for content organization
// Supports hierarchical categories with parent-child relationships
return new class extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            
            // Sprint 2 - Category basic fields
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            
            // Sprint 2 - Hierarchical categories support
            $table->foreignId('parent_id')->nullable()->constrained('categories')->onDelete('cascade');
            
            // Sprint 2 - Category metadata
            $table->string('color')->default('#007bff'); // For UI theming
            $table->string('icon')->nullable(); // FontAwesome icon class
            $table->integer('sort_order')->default(0);
            
            // Sprint 2 - Category status
            $table->boolean('is_active')->default(true);
            
            $table->timestamps();
            
            // Sprint 2 - Indexes
            $table->index('slug');
            $table->index(['parent_id', 'sort_order']);
            $table->index('is_active');
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
}; 
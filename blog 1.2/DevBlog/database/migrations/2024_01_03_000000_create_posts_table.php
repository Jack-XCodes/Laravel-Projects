<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Sprint 2 - Create posts table for blog post functionality
// This table stores all blog posts with user relationships and metadata
return new class extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            
            // Sprint 2 - Basic post fields
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content');
            $table->text('excerpt')->nullable();
            
            // Sprint 2 - Post metadata
            $table->string('featured_image')->nullable();
            $table->enum('status', ['draft', 'published', 'scheduled'])->default('draft');
            $table->timestamp('published_at')->nullable();
            
            // Sprint 2 - SEO fields
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            
            // Sprint 2 - User relationship
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Sprint 2 - Post analytics (for future sprints)
            $table->integer('view_count')->default(0);
            $table->integer('like_count')->default(0);
            $table->integer('comment_count')->default(0);
            
            $table->timestamps();
            
            // Sprint 2 - Indexes for better performance
            $table->index(['status', 'published_at']);
            $table->index(['user_id', 'status']);
            $table->index('slug');
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}; 
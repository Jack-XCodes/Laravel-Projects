<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Sprint 1 - Add DevBlog specific fields to users table
// This migration adds username for pretty URLs, bio for profiles, and admin flag
return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Sprint 1 - Add username for user identification and URLs
            // Initially nullable to allow for existing records
            $table->string('username')->nullable()->unique()->after('name');
            
            // Sprint 1 - Add bio field for user profiles  
            $table->text('bio')->nullable()->after('email');
            
            // Sprint 1 - Add admin flag for basic role management
            $table->boolean('is_admin')->default(false)->after('bio');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['username', 'bio', 'is_admin']);
        });
    }
}; 
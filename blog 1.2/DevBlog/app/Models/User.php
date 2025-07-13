<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// Sprint 1 - Enhanced User Model for DevBlog platform
// Adds username for URLs, bio for profiles, and admin functionality
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Sprint 1 - Mass assignable attributes for user registration and profile updates
     */
    protected $fillable = [
        'name',
        'username',    // Sprint 1 - Unique username for profile URLs
        'email',
        'password',
        'bio',         // Sprint 1 - User biography for profiles
        'is_admin',    // Sprint 1 - Admin flag for permissions
    ];

    /**
     * Sprint 1 - Hidden attributes for security
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Sprint 1 - Attribute casting for proper data types
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',  // Sprint 1 - Cast admin flag to boolean
        ];
    }

    // Sprint 1 - Helper method to get display name (name or username fallback)
    public function getDisplayNameAttribute()
    {
        return $this->name ?: $this->username;
    }

    // Sprint 1 - Generate profile URL using username
    public function getProfileUrlAttribute()
    {
        return route('profile.show', $this->username);
    }

    // Sprint 1 - Check if user has admin privileges
    public function isAdmin()
    {
        return $this->is_admin === true;
    }

    // Sprint 1 - Find user by username (case-insensitive)
    public function scopeByUsername($query, $username)
    {
        return $query->where('username', strtolower($username));
    }
}

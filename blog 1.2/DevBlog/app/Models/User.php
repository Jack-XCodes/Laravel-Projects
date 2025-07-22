<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username', // Sprint 1 - Added username field
        'email',
        'password',
        'bio', // Sprint 1 - Added bio field
        'is_admin', // Sprint 1 - Added admin flag
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean', // Sprint 1 - Cast admin flag
        ];
    }

    // Sprint 2 - Relationship: User has many Posts
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // Sprint 2 - Get published posts count
    public function getPublishedPostsCountAttribute()
    {
        return $this->posts()->published()->count();
    }

    // Sprint 2 - Get draft posts count
    public function getDraftPostsCountAttribute()
    {
        return $this->posts()->draft()->count();
    }

    // Sprint 2 - Get total posts count
    public function getTotalPostsCountAttribute()
    {
        return $this->posts()->count();
    }

    // Sprint 1 - Check if user has completed their profile
    public function hasCompletedProfile()
    {
        return !empty($this->username) && !empty($this->bio);
    }

    // Sprint 1 - Get user's display name (name or username)
    public function getDisplayNameAttribute()
    {
        return $this->name ?: $this->username;
    }

    // Sprint 1 - Get user profile URL
    public function getProfileUrlAttribute()
    {
        return route('profile.show', $this->username);
    }
}

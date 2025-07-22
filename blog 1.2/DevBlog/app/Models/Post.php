<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

// Sprint 2 - Post Model for blog posts
// Handles post creation, relationships, and business logic
class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'featured_image',
        'status',
        'published_at',
        'meta_title',
        'meta_description',
        'user_id',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    // Sprint 2 - Boot method to auto-generate slug
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = $post->generateSlug($post->title);
            }
        });
        
        static::updating(function ($post) {
            if ($post->isDirty('title') && !$post->isDirty('slug')) {
                $post->slug = $post->generateSlug($post->title);
            }
        });
    }

    // Sprint 2 - Relationship: Post belongs to User (author)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Sprint 2 - Relationship: Post belongs to many Categories
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_categories');
    }

    // Sprint 2 - Scope for published posts
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                    ->where('published_at', '<=', now());
    }

    // Sprint 2 - Scope for draft posts
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    // Sprint 2 - Scope for user's own posts
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    // Sprint 2 - Generate unique slug from title
    public function generateSlug($title)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        
        $count = 1;
        while (static::where('slug', $slug)->where('id', '!=', $this->id ?? 0)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }
        
        return $slug;
    }

    // Sprint 2 - Get post URL
    public function getUrlAttribute()
    {
        return route('posts.show', $this->slug);
    }

    // Sprint 2 - Get reading time estimate
    public function getReadingTimeAttribute()
    {
        $wordCount = str_word_count(strip_tags($this->content));
        return max(1, round($wordCount / 200)); // Assuming 200 words per minute
    }

    // Sprint 2 - Check if post is published
    public function isPublished()
    {
        return $this->status === 'published' && 
               $this->published_at && 
               $this->published_at->isPast();
    }

    // Sprint 2 - Check if post is draft
    public function isDraft()
    {
        return $this->status === 'draft';
    }

    // Sprint 2 - Get excerpt or truncated content
    public function getExcerptAttribute($value)
    {
        if ($value) {
            return $value;
        }
        
        return Str::limit(strip_tags($this->content), 150);
    }

    // Sprint 2 - Increment view count (for future analytics)
    public function incrementViews()
    {
        $this->increment('view_count');
    }
} 
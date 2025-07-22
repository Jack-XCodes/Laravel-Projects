<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

// Sprint 2 - Category Model for content organization
// Supports hierarchical categories and post relationships
class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'parent_id',
        'color',
        'icon',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Sprint 2 - Boot method to auto-generate slug
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = $category->generateSlug($category->name);
            }
        });
        
        static::updating(function ($category) {
            if ($category->isDirty('name') && !$category->isDirty('slug')) {
                $category->slug = $category->generateSlug($category->name);
            }
        });
    }

    // Sprint 2 - Relationship: Category belongs to many Posts
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_categories');
    }

    // Sprint 2 - Relationship: Parent category
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Sprint 2 - Relationship: Child categories
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Sprint 2 - Scope for active categories
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Sprint 2 - Scope for top-level categories (no parent)
    public function scopeTopLevel($query)
    {
        return $query->whereNull('parent_id');
    }

    // Sprint 2 - Scope ordered by sort_order
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    // Sprint 2 - Generate unique slug from name
    public function generateSlug($name)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        
        $count = 1;
        while (static::where('slug', $slug)->where('id', '!=', $this->id ?? 0)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }
        
        return $slug;
    }

    // Sprint 2 - Get category URL
    public function getUrlAttribute()
    {
        return route('categories.show', $this->slug);
    }

    // Sprint 2 - Get published posts count
    public function getPublishedPostsCountAttribute()
    {
        return $this->posts()->published()->count();
    }

    // Sprint 2 - Check if category has children
    public function hasChildren()
    {
        return $this->children()->count() > 0;
    }

    // Sprint 2 - Get full category path (for breadcrumbs)
    public function getFullPathAttribute()
    {
        $path = [$this->name];
        
        $parent = $this->parent;
        while ($parent) {
            $path[] = $parent->name;
            $parent = $parent->parent;
        }
        
        return implode(' > ', array_reverse($path));
    }
} 
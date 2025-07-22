<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

// Sprint 2 - Category Seeder for demo categories
// Creates sample categories for testing post organization features
class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Laravel',
                'description' => 'All things Laravel framework - tutorials, tips, and best practices',
                'color' => '#FF2D20',
                'icon' => 'fab fa-laravel',
                'sort_order' => 1,
            ],
            [
                'name' => 'PHP',
                'description' => 'PHP programming language tips, tricks, and tutorials',
                'color' => '#777BB4',
                'icon' => 'fab fa-php',
                'sort_order' => 2,
            ],
            [
                'name' => 'JavaScript',
                'description' => 'Modern JavaScript, frameworks, and web development',
                'color' => '#F7DF1E',
                'icon' => 'fab fa-js-square',
                'sort_order' => 3,
            ],
            [
                'name' => 'Vue.js',
                'description' => 'Vue.js frontend framework and ecosystem',
                'color' => '#4FC08D',
                'icon' => 'fab fa-vuejs',
                'sort_order' => 4,
            ],
            [
                'name' => 'Database',
                'description' => 'Database design, optimization, and management',
                'color' => '#336791',
                'icon' => 'fas fa-database',
                'sort_order' => 5,
            ],
            [
                'name' => 'DevOps',
                'description' => 'Deployment, server management, and CI/CD practices',
                'color' => '#FF6B35',
                'icon' => 'fas fa-server',
                'sort_order' => 6,
            ],
            [
                'name' => 'Tutorial',
                'description' => 'Step-by-step guides and learning resources',
                'color' => '#28A745',
                'icon' => 'fas fa-graduation-cap',
                'sort_order' => 7,
            ],
            [
                'name' => 'Tips & Tricks',
                'description' => 'Quick tips and productivity hacks for developers',
                'color' => '#FFC107',
                'icon' => 'fas fa-lightbulb',
                'sort_order' => 8,
            ],
        ];

        foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }

        $this->command->info('Sprint 2 - Sample categories created successfully!');
    }
} 
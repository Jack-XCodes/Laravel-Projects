<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

// Sprint 1 - Database Seeder for DevBlog sample data
// Creates test users with different profile completeness levels
class DatabaseSeeder extends Seeder
{
    /**
     * Sprint 1 - Seed the application with sample users for testing
     * 
     * This creates a variety of users to test different Sprint 1 features:
     * - Admin user for testing admin functionality
     * - Complete profiles to test profile display
     * - Incomplete profiles to test profile completion flow
     */
    public function run(): void
    {
        // Sprint 1 - Create admin user for testing administrative features
        User::create([
            'name' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@devblog.com',
            'password' => Hash::make('password'),
            'bio' => 'Administrator of the DevBlog platform. Responsible for managing users and content.',
            'is_admin' => true,
        ]);

        // Sprint 1 - Create sample regular user with complete profile
        User::create([
            'name' => 'John Doe',
            'username' => 'johndoe',
            'email' => 'john@devblog.com',
            'password' => Hash::make('password'),
            'bio' => 'Full-stack developer passionate about web technologies and open source. Love writing about PHP, JavaScript, and modern development practices.',
            'is_admin' => false,
        ]);

        // Sprint 1 - Create another sample user with complete profile
        User::create([
            'name' => 'Jane Smith',
            'username' => 'janesmith',
            'email' => 'jane@devblog.com',
            'password' => Hash::make('password'),
            'bio' => 'UX designer and frontend developer. Sharing insights about design systems, user experience, and modern CSS techniques.',
            'is_admin' => false,
        ]);

        // Sprint 1 - Create user with incomplete profile (no bio)
        // This tests the profile completion functionality
        User::create([
            'name' => 'New User',
            'username' => 'newuser',
            'email' => 'newuser@devblog.com',
            'password' => Hash::make('password'),
            'bio' => null,  // No bio to test profile completion
            'is_admin' => false,
        ]);

        // Sprint 1 - Create developer user for testing
        User::create([
            'name' => 'Alex Developer',
            'username' => 'alexdev',
            'email' => 'alex@devblog.com',
            'password' => Hash::make('password'),
            'bio' => 'Backend developer specializing in Laravel and API development. Always learning new technologies.',
            'is_admin' => false,
        ]);

        // Sprint 1 - Output success message with test account details
        // Sprint 2 - Run category seeder for content organization
        $this->call(CategorySeeder::class);
        
        // Sprint 2 - Run post seeder for demo content
        $this->call(PostSeeder::class);

        $this->command->info('Sprint 1 - Sample users created successfully!');
        $this->command->info('Test accounts for DevBlog:');
        $this->command->info('- admin@devblog.com (Admin User)');
        $this->command->info('- john@devblog.com (Complete Profile)');
        $this->command->info('- jane@devblog.com (Complete Profile)');
        $this->command->info('- newuser@devblog.com (Incomplete Profile)');
        $this->command->info('- alex@devblog.com (Developer User)');
        $this->command->info('All passwords: password');
        $this->command->info('Sprint 2 features ready for testing!');
    }
}

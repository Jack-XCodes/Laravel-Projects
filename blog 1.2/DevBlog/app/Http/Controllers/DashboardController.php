<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Sprint 1 - Dashboard Controller for user's personal homepage
// Displays welcome message, user stats, and quick actions after login
class DashboardController extends Controller
{
    // Sprint 1 - Show user dashboard with personalized content
    public function index()
    {
        $user = Auth::user();
        
        // Sprint 1 - Prepare dashboard data with user info and stats
        $dashboardData = [
            'user' => $user,
            'joinedDate' => $user->created_at->format('F j, Y'),
            'welcomeMessage' => $this->getWelcomeMessage($user),
            
            // Sprint 2 - Real post stats (IMPLEMENTED)
            'postCount' => $user->posts()->count(),
            'publishedCount' => $user->posts()->published()->count(),
            'draftCount' => $user->posts()->draft()->count(),
            
            // Sprint 4 - Future features
            'followerCount' => 0,    // Will be implemented in Sprint 4
            'likesCount' => 0,       // Will be implemented in Sprint 4
        ];
        
        return view('dashboard.index', $dashboardData);
    }

    // Sprint 1 - Generate personalized welcome message based on time of day
    private function getWelcomeMessage($user)
    {
        $timeOfDay = $this->getTimeOfDay();
        $displayName = $user->name ?: $user->username;
        
        return "Good {$timeOfDay}, {$displayName}!";
    }

    // Sprint 1 - Determine time-based greeting for better user experience
    private function getTimeOfDay()
    {
        $hour = now()->hour;
        
        if ($hour >= 5 && $hour < 12) {
            return 'morning';
        } elseif ($hour >= 12 && $hour < 17) {
            return 'afternoon';
        } else {
            return 'evening';
        }
    }
} 
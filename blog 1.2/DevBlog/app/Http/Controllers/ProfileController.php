<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

// Sprint 1 - Enhanced Profile Controller for DevBlog
// Handles public profile viewing, profile editing, and password management
class ProfileController extends Controller
{
    // Sprint 1 - Show public user profile by username
    public function show($username)
    {
        // Sprint 1 - Find user by username (case-insensitive)
        $user = User::where('username', strtolower($username))->firstOrFail();
        
        $isOwnProfile = Auth::check() && Auth::user()->id === $user->id;
        
        return view('profile.show', [
            'user' => $user,
            'isOwnProfile' => $isOwnProfile,
            'joinedDate' => $user->created_at->format('F j, Y'),
            
            // Sprint 1 - Placeholder data for future features
            'postCount' => 0,
            'followerCount' => 0,
            'followingCount' => 0,
        ]);
    }

    // Sprint 1 - Show profile edit form for authenticated user
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', ['user' => $user]);
    }

    // Sprint 1 - Update user profile with username and bio validation
    public function update(Request $request)
    {
        $user = Auth::user();
        
        // Sprint 1 - Validate profile update including unique username
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => [
                'required', 
                'string', 
                'max:255', 
                'unique:users,username,' . $user->id,
                'regex:/^[a-zA-Z0-9_-]+$/',
                'min:3'
            ],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'bio' => ['nullable', 'string', 'max:500'],
        ]);

        // Sprint 1 - Update user profile with new data
        $user->update([
            'name' => $request->name,
            'username' => strtolower($request->username),
            'email' => $request->email,
            'bio' => $request->bio,
        ]);

        return redirect()->route('profile.show', $user->username)
                        ->with('success', 'Profile updated successfully!');
    }

    // Sprint 1 - Show password change form
    public function showPasswordForm()
    {
        return view('profile.password');
    }

    // Sprint 1 - Update user password with current password verification
    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        
        // Sprint 1 - Validate password change with current password check
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Sprint 1 - Verify current password before allowing change
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'The provided password does not match your current password.'
            ]);
        }

        // Sprint 1 - Update password with hash
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('profile.show', $user->username)
                        ->with('success', 'Password updated successfully!');
    }
}

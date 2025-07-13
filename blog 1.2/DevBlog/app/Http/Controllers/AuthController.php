<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

// Sprint 1 - Custom Authentication Controller for DevBlog
// Handles registration with username field and enhanced login functionality
class AuthController extends Controller
{
    // Sprint 1 - Show registration form with username field
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Sprint 1 - Process user registration with username validation
    public function register(Request $request)
    {
        // Sprint 1 - Validate registration data including unique username
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => [
                'required', 
                'string', 
                'max:255', 
                'unique:users',
                'regex:/^[a-zA-Z0-9_-]+$/',  // Only letters, numbers, underscores, dashes
                'min:3'
            ],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Sprint 1 - Create new user with username
        $user = User::create([
            'name' => $request->name,
            'username' => strtolower($request->username),  // Store usernames in lowercase
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Sprint 1 - Log user in immediately after registration
        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Welcome to DevBlog! Your account has been created.');
    }

    // Sprint 1 - Show login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Sprint 1 - Process login with email/password
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Sprint 1 - Attempt login with session regeneration for security
        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // Sprint 1 - Handle user logout with session cleanup
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'You have been logged out successfully.');
    }
} 
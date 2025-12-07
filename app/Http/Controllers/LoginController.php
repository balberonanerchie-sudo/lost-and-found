<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Show the login/register form
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole(Auth::user());
        }

        return view('pages.loginRegister');
    }

    /**
     * Show registration form
     */
    public function showRegistrationForm()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole(Auth::user());
        }

        return view('pages.loginRegister');
    }

    /**
     * Handle login attempt
     */
    public function login(Request $request)
    {
        // If someone hits /login while already logged in, just redirect them
        if (Auth::check()) {
            return $this->redirectBasedOnRole(Auth::user());
        }

        $data = $request->validate([
            'email'      => ['required', 'email'],
            'password'   => ['required'],
            'login_type' => ['nullable', 'in:student,admin'],
        ]);

        // Find user by email
        $user = User::where('email', $data['email'])->first();

        // Check credentials
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->withInput($request->only('email'));
        }

        // Block inactive accounts with a clear message
        if ($user->status !== 'active') {
            return back()->withErrors([
                'email' => 'Your account is inactive. Please contact an administrator.',
            ])->withInput($request->only('email'));
        }

        // Log the user in (now that we know they are active)
        Auth::login($user, $request->filled('remember'));
        $request->session()->regenerate();

        $loginType = $data['login_type'] ?? 'student'; // default

        // Enforce role based on selected login tab
        if ($loginType === 'admin' && $user->role !== 'admin') {
            Auth::logout();
            return back()->withErrors([
                'email' => 'You do not have admin access.',
            ])->withInput($request->only('email'));
        }

        // "Student" login tab maps to role = user
        if ($loginType === 'student' && $user->role !== 'user') {
            Auth::logout();
            return back()->withErrors([
                'email' => 'You must log in as a student.',
            ])->withInput($request->only('email'));
        }

        return $this->redirectBasedOnRole($user);
    }

    /**
     * Handle registration
     */
    public function register(Request $request)
    {
        $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'email'      => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'   => ['required', 'string', 'min:8', 'confirmed'],
            'department' => ['nullable', 'string', 'max:255'],
        ]);

        $user = User::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'role'       => 'user',       // all self-registrations are normal users
            'status'     => 'active',     // default active
            'department' => $request->department,
        ]);

        Auth::login($user);

        return redirect()->route('home')
            ->with('success', 'Registration successful! Welcome to Lost & Found.');
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'You have been logged out.');
    }

    /**
     * Redirect user based on their role
     */
    protected function redirectBasedOnRole(User $user)
    {
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('home');
    }
}

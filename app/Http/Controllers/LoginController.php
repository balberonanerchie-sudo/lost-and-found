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
        // If already logged in, just redirect
        if (Auth::check()) {
            return $this->redirectBasedOnRole(Auth::user());
        }

        // Validate credentials + which tab was used
        $data = $request->validate([
            'email'      => ['required', 'email'],
            'password'   => ['required'],
            'login_type' => ['required', 'in:student,admin'], // Student / Admin toggle
        ]);

        // Try to authenticate with email + password
        if (!Auth::attempt(
            ['email' => $data['email'], 'password' => $data['password']],
            $request->boolean('remember')
        )) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        $user = Auth::user();

        // Optional: block clearly inactive accounts (treat NULL as active)
        if (!empty($user->status) && $user->status !== 'active') {
            Auth::logout();

            return back()->withErrors([
                'email' => 'Your account is inactive. Please contact an administrator.',
            ])->onlyInput('email');
        }

        // Enforce tab → role mapping

        // Admin tab: only users with role "admin"
        if ($data['login_type'] === 'admin' && $user->role !== 'admin') {
            Auth::logout();

            return back()->withErrors([
                'email' => 'You do not have admin access. Please use the Student login.',
            ])->onlyInput('email');
        }

        // Student tab: disallow admins here
        if ($data['login_type'] === 'student' && $user->role === 'admin') {
            Auth::logout();

            return back()->withErrors([
                'email' => 'Admins must use the Admin login tab.',
            ])->onlyInput('email');
        }

        // All good: redirect based on role
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

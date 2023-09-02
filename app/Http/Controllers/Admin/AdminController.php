<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            // Admin is already authenticated, redirect to dashboard
            return redirect()->route('admin.home');
        }

        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ], [
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'Please enter a password.',
            'password.min' => 'The password must be at least 8 characters.',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.home')->with('success', 'Admin login successful.');
        } else {
            return redirect()->back()->withInput($request->except('password'))->withErrors(['email' => 'Invalid admin credentials.']);
        }
    }

    public function logout()
    {
        // Logout the admin from the "admin" guard
        Auth::guard('admin')->logout();

        // Redirect the admin to a different page after logout (optional)
        return redirect()->route('admin.login')->with('success', 'Admin logged out.');
    }
}
<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name.required' => 'Please enter your full name.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already registered.',
            'password.required' => 'Please enter a password.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.confirmed' => 'The password confirmation does not match.',
        ]);

        // Create a new user
        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = bcrypt($validatedData['password']); // Hash the password
        $user->save();
        return "user registered successfully..";
        // return redirect()->route('home')->with('success', 'Registration successful.');
    }


    public function login_user(Request $request)
    {
        if (Auth::guard('web')->check()) {
            // return "already auth";
            // User is already authenticated, redirect to home
            return redirect()->route('user.home');
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

        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->route('user.home')->with('success', 'Login successful.');
        } else {
            return redirect()->back()->withInput($request->except('password'))->withErrors(['email' => 'Invalid login credentials.']);
        }
    }


    public function logout()
    {
        // Logout the user from the "web" guard
        Auth::guard('web')->logout();

        // Redirect the user to a different page after logout (optional)
        return redirect()->route('user.login')->with('success', 'You have been logged out.');
    }

}
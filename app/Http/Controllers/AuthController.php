<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Merchant;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role'     => 'required|in:merchant,customer',

            // optional by role
            'company_name' => 'nullable|string|max:255',
            'address'      => 'required|string',
            'contact'      => 'required|string|max:20',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        if ($request->role === 'merchant') {
            Merchant::create([
                'user_id'      => $user->id,
                'company_name' => $request->company_name,
                'address'      => $request->address,
                'contact'      => $request->contact,
            ]);
        } else {
            Customer::create([
                'user_id' => $user->id,
                'address' => $request->address,
                'contact' => $request->contact,
            ]);
        }

        Auth::login($user);

            return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
            }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return auth()->user()->role === 'merchant'
                ? redirect()->route('merchant.dashboard')
                : redirect()->route('customer.dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}

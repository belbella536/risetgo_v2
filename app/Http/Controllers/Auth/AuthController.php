<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'no_tlp' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'no_tlp' => $validated['no_tlp'],
            'password' => bcrypt($validated['password']),
        ]);

        auth()->login($user);

        return redirect()->route('dashboard');
    }

    public function login()
    {
        if (auth()->check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function loginAuth(Request $request)
    {
        $validated = $request->validate([
            'login' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        // Cari user berdasarkan email ATAU username
        $user = User::where(function($query) use ($validated) {
            $query->where('email', $validated['login'])
                ->orWhere('username', $validated['login']);
        })->first();

        // Verifikasi keberadaan user dan kecocokan password
        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return back()->withErrors(['login' => 'Kredensial yang Anda masukkan salah.']);
        }

        // Login user
        auth()->login($user);

        // Regenerasi session untuk keamanan (mencegah session fixation)
        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

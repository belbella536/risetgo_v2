<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Tambahan yang sangat penting

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();

        return match($user->role) {
            'admin'     => view('dashboard'),
            'dosen'     => view('dashboard'),
            'pimpinan'  => view('dashboard'),
            'mahasiswa' => view('dashboard'),
            default     => abort(403),
        };
    }
    
    public function profile()
    {
        return view('profile');
    }

    public function updateProfile(Request $request)
    {
        // Panggil objek User langsung dari database, bukan dari session auth
        $user = User::find(auth()->id());

        // Validasi input
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email'    => 'nullable|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Update data dasar
        $user->username = $validated['username'];
        $user->email = $validated['email'];

        // Update password hanya jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
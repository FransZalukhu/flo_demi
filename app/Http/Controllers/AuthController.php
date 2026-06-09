<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Register
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ], [
            'username.required' => 'Nama wajib diisi.',
            'username.string' => 'Nama harus berupa teks.',
            'username.max' => 'Nama tidak boleh melebihi 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.string' => 'Email harus berupa teks.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email tidak boleh melebihi 255 karakter.',
            'email.unique' => 'Email ini sudah terdaftar.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi harus memiliki minimal 8 karakter.',
        ]);

        $user = User::create([
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'mentee',
            'status'   => 'aktif',
        ]);

        Auth::login($user);

        return redirect()->route('home');
    }

    // Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->status !== 'aktif') {
                Auth::logout();
                return back()->withErrors(['email' => 'Akun Anda dinonaktifkan.']);
            }

            $request->session()->regenerate();

            if ($user->role === 'superadmin' || $user->role === 'admin') {
                return redirect()->route('superadmin.dashboard.index');
            }

            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Email atau kata sandi salah.',
        ])->onlyInput('email');
    }

    // Superadmin Login
    public function superadminLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Check if user has superadmin or admin role
            if ($user->role !== 'superadmin' && $user->role !== 'admin') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Akses ditolak. Halaman ini hanya untuk Superadmin dan Admin.',
                ])->onlyInput('email');
            }

            // Check if user status is active
            if ($user->status === 'nonaktif') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Akun Anda dinonaktifkan. Silakan hubungi Superadmin jika membutuhkan akses.',
                ])->onlyInput('email');
            }

            $request->session()->regenerate();

            return redirect()->route('superadmin.dashboard.index');
        }

        return back()->withErrors([
            'email' => 'Email atau kata sandi salah.',
        ])->onlyInput('email');
    }

    // Logout
    public function logout(Request $request)
    {
        // Get user role before logout to determine redirect
        $userRole = Auth::user()->role ?? null;
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect based on user role
        if ($userRole === 'superadmin' || $userRole === 'admin') {
            return redirect()->route('superadmin.login')->with('success', 'Anda telah berhasil keluar.');
        }

        return redirect()->route('home');
    }
}

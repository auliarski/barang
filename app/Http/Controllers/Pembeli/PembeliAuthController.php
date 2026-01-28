<?php

namespace App\Http\Controllers\Pembeli;

use App\Http\Controllers\Controller;
use App\Models\Pembeli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PembeliAuthController extends Controller
{
    // 🔹 Tampilkan halaman login
    public function showLoginForm()
    {
        return view('pembeli.auth.login');
    }

    // 🔹 Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('pembeli')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('pembeli.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // 🔹 Logout
    public function logout(Request $request)
    {
        Auth::guard('pembeli')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('pembeli.login');
    }

    // 🔹 Tampilkan halaman register
    public function showRegisterForm()
    {
        return view('pembeli.auth.register');
    }

    // 🔹 Proses register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:pembelis,email',
            'password' => 'required|min:6|confirmed',
            'alamat' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:20',
        ]);

        Pembeli::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('pembeli.login')
            ->with('success', 'Akun berhasil dibuat! Silakan login.');
    }

    // 🔹 Dashboard setelah login
    public function dashboard()
    {
        if (!Auth::guard('pembeli')->check()) {
            return redirect()->route('pembeli.login');
        }

        $pembeli = Auth::guard('pembeli')->user();
        return view('pembeli.dashboard', compact('pembeli'));
    }
}

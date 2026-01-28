<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Pembeli;

class AdminDashboardController extends Controller
{
    // ===============================
    // Halaman Dashboard Admin
    // ===============================
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.dashboard', compact('admin'));
    }

    // ===============================
    // Halaman Profile Admin
    // ===============================
    public function profile()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile', compact('admin'));
    }

    // ===============================
    // Update Data Profile Admin
    // ===============================
    public function updateProfile(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:6|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Update data dasar
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;

        // Update password jika diisi
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        // Upload foto profil jika ada
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/admins'), $filename);
            $admin->avatar = $filename;
        }

        $admin->save();

        return redirect()->route('admin.profile')->with('success', 'Profil berhasil diperbarui!');
    }

    // ===============================
    // Kelola Pengguna (Admin & Pembeli)
    // ===============================
    public function kelolaPengguna(Request $request)
    {
        $type = $request->get('type', 'admin'); // default tab: admin
        $admins = Admin::latest()->get();
        $pembelis = Pembeli::latest()->get();

        // View akan menampilkan 2 tab: Admin dan Pembeli
        return view('admin.kelola_pengguna', compact('admins', 'pembelis', 'type'));
    }

    // ===============================
    // Hapus pengguna (admin atau pembeli)
    // ===============================
    public function hapusPengguna(Request $request, $id)
    {
        $type = $request->get('type');

        if ($type === 'admin') {
            $user = Admin::findOrFail($id);
        } else {
            $user = Pembeli::findOrFail($id);
        }

        $user->delete();

        return back()->with('success', ucfirst($type) . ' berhasil dihapus!');
    }
}

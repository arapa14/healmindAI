<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController
{
    // List semua user
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    // Form create user
    public function create()
    {
        return view('admin.user.create');
    }

    // Simpan user baru
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role'     => 'required|in:user,professional,admin',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan');
    }

    // Form edit user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    // Update user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role'     => 'required|in:user,professional,admin',
        ]);

        $user->name  = $request->name;
        $user->email = $request->email;
        $user->role  = $request->role;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('user.index')->with('success', 'User berhasil diperbarui');
    }

    // Hapus user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'User berhasil dihapus');
    }

    // Switch account (login sebagai pengguna lain)
    public function switchAccount(Request $request, $id)
    {
        // Cegah switch account ke akun yang sedang aktif
        if (auth()->id() == $id) {
            return response()->json(['message' => 'Anda tidak dapat switch ke akun yang sama.'], 403);
        }

        $currentUser = Auth::user();
        // Hanya admin atau superAdmin yang diperbolehkan melakukan switch
        if ($currentUser && in_array($currentUser->role, ['admin', 'superAdmin'])) {
            // Simpan ID pengguna asli di session sebelum switch
            session(['original_user_id' => $currentUser->id]);

            // Login sebagai user target
            auth()->guard('web')->loginUsingId($id);

            // Redirect ke halaman dashboard atau halaman lainnya
            return redirect()->route('dashboard');
        }

        abort(403);
    }


    // Switch back (kembali ke akun asli)
    public function switchBack()
    {
        if (session()->has('original_user_id')) {
            $originalUserId = session('original_user_id');
            auth()->guard('web')->loginUsingId($originalUserId);
            session()->forget('original_user_id');

            // Redirect ke halaman user (ubah sesuai kebutuhan)
            return redirect()->route('user.index');
        }

        abort(403);
    }
}

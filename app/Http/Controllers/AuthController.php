<?php

namespace App\Http\Controllers;

use App\Models\Professional;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController
{
    public function index()
    {
        return view('landing');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('success', 'Login Berhasil');
        }

        return redirect()->back()->withInput()->with('error', 'login gagal');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function postRegister(Request $request)
    {
        try {

            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6|confirmed',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            Auth::login($user);

            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('success', 'Registrasi Berhasil');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Registrasi Gagal');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Logout Berhasil');
    }

    public function dashboard()
    {
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Unauthorized');
        }

        if ($user->role == 'admin') {
            return view('admin.dashboard');
        } elseif ($user->role == 'user') {
            return view('user.dashboard');
        } elseif ($user->role == 'professional') {
            return view('professional.dashboard');
        }

        return redirect()->route('login')->with('error', 'Gagal Dikenali');
    }

    public function registerProfessional()
    {
        return view('auth.professional-register');
    }

    public function postRegisterProfessional(Request $request)
    {
        try {
            $request->validate([
                'name'       => 'required|string|max:255',
                'email'      => 'required|email|unique:users',
                'password'   => 'required|min:6|confirmed',
                'license'    => 'required|string|max:255',
                'specialty'  => 'required|string|max:255',
                'experience' => 'required|numeric|min:0',
            ]);

            // Simpan user dengan role professional
            $user = User::create([
                'name'       => $request->name,
                'email'      => $request->email,
                'password'   => Hash::make($request->password),
                'role'       => 'professional',
            ]);

            // Simpan data professional
            Professional::create([
                'user_id'    => $user->id,
                'license'    => $request->license,
                'specialty'  => $request->specialty,
                'experience' => $request->experience,
            ]);

            // Auto login setelah daftar
            Auth::login($user);
            $request->session()->regenerate();

            return redirect()->route('dashboard')->with('success', 'Registrasi Professional Berhasil');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Registrasi Gagal: ' . $e->getMessage());
        }
    }
}

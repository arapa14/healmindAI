<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = Auth::user()->profile; // relasi one-to-one
        return view('profile.show', compact('profile'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        $profile = Auth::user()->profile;

        // kalau user baru daftar & belum ada profile, buat dulu
        if (!$profile) {
            $profile = Profile::create([
                'user_id' => Auth::id(),
            ]);
        }

        return view('profile.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'birthdate'        => 'nullable|date',
            'gender'           => 'nullable|in:male,female',
            'bio'              => 'nullable|string|max:255',
            'profile_picture'  => 'nullable|image|mimes:jpg,jpeg,png,gif',
        ]);

        $user = Auth::user();

        // buat atau update profile
        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            $request->only('birthdate', 'gender', 'bio')
        );

        // handle profile picture
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');

            // Update path di tabel settings
            $user->update([
                'profile_picture' => $path
            ]);
        }

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui.');
    }
}

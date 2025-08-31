<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SettingController extends Controller
{
    // Tampilkan semua setting
    public function index()
    {
        $settings = Setting::all();
        return view('admin.settings.index', compact('settings'));
    }

    // Form edit setting
    public function edit($id)
    {
        $setting = Setting::findOrFail($id);
        return view('admin.settings.edit', compact('setting'));
    }

    // Update setting
    public function update(Request $request, $id)
    {
        $setting = Setting::findOrFail($id);

        // Cek apakah setting berupa logo
        if ($setting->key === 'logo') {
            $request->validate([
                'value' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            if ($request->hasFile('value')) {
                $path = $request->file('value')->store('logos', 'public');
                $setting->value = $path;
            }
        } else {
            $request->validate([
                'value' => 'required|string|max:255'
            ]);

            $setting->value = $request->value;
        }

        $setting->save();

        return redirect()->route('settings.index')->with('success', 'Setting berhasil diperbarui');
    }
}

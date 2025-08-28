<?php

namespace App\Http\Controllers;

use App\Models\Mood_Entrie;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class MoodEntrieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $moods = Mood_Entrie::where('user_id', $user->id)
            ->orderBy('mood_date', 'desc')
            ->get();

        return view('user.mood.mood', compact('moods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'mood_score' => 'required|integer|min:1|max:10',
        ]);

        $user = Auth::user();
        $today = now()->toDateString();

        // Cek apakah user sudah input mood hari ini
        $existing = Mood_Entrie::where('user_id', $user->id)
            ->where('mood_date', $today)
            ->first();

        if ($existing) {
            $existing->update([
                'mood_score' => $request->mood_score,
            ]);
        } else {
            Mood_Entrie::create([
                'user_id' => $user->id,
                'mood_date' => $today,
                'mood_score' => $request->mood_score,
            ]);
        }

        return redirect()->back()->with('success', 'Mood berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mood_Entrie $mood_Entrie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mood_Entrie $mood_Entrie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mood_Entrie $mood_Entrie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mood_Entrie $mood_Entrie)
    {
        //
    }
}

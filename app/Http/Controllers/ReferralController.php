<?php

namespace App\Http\Controllers;

use App\Models\Professional;
use App\Models\Referral;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class ReferralController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $professionals = Professional::with('user')->get();
        // Ambil referral milik user yang sedang login
        $referrals = Referral::with(['professional.user'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('user.referral.index', compact('professionals', 'referrals'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'professional_id'  => 'required|exists:professionals,id',
            'reason'           => 'required|string|max:255',
            'appointment_date' => 'nullable|date|after:now', // opsional, harus valid
        ]);

        Referral::create([
            'user_id'         => Auth::id(),
            'professional_id' => $request->professional_id,
            'reason'          => $request->reason,
            'status'          => 'pending',
            'appointment_date' => $request->appointment_date, // bisa null
        ]);

        return redirect()->route('referral')->with('success', 'Referral berhasil dikirim!');
    }

    /**
     * Update the specified resource in storage.
     */

    public function schedule()
    {
        $referrals = Referral::with(['user'])
            ->where('professional_id', Auth::user()->professional->id) // asumsi relasi user->professional
            ->latest()
            ->get();

        return view('professional.referrals.index', compact('referrals'));
    }

    public function answer(Request $request, $id)
    {
        // dd($id);
        $referral = Referral::findOrFail($id);

        // dd($referral);

        $request->validate([
            'status' => 'required|in:accepted,rejected,completed,pending',
            'appointment_date' => 'nullable|date|after:now',
        ]);

        $referral->update([
            'status' => $request->status,
            'appointment_date' => $request->appointment_date,
        ]);

        return back()->with('success', 'Referral berhasil diperbarui.');
    }
}

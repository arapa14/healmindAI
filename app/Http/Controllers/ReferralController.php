<?php

namespace App\Http\Controllers;

use App\Models\Professional;
use App\Models\Referral;
use App\Models\User;
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
            'professional_id' => 'required|exists:professionals,id',
            'reason'          => 'required|string|max:255',
        ]);

        Referral::create([
            'user_id'        => Auth::id(),
            'professional_id' => $request->professional_id,
            'reason'         => $request->reason,
            'status'         => 'pending',
        ]);

        return redirect()->route('referral')->with('success', 'Referral berhasil dikirim!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Referral $referral)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Referral $referral)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Referral $referral)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Referral $referral)
    {
        //
    }
}

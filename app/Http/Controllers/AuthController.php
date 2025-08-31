<?php

namespace App\Http\Controllers;

use App\Models\Journal_Entrie;
use App\Models\Mood_Entrie;
use App\Models\Professional;
use App\Models\Recomendation;
use App\Models\Referral;
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
            // --- User Management ---
            $totalUsers = User::count();
            $totalAdmins = User::where('role', 'admin')->count();
            $totalProfessionals = User::where('role', 'professional')->count();
            $totalClients = User::where('role', 'user')->count();
            $activeUsers = User::where('is_active', true)->count();
            $inactiveUsers = User::where('is_active', false)->count();

            // --- Journals ---
            $totalJournals = Journal_Entrie::count();
            $publicJournals = Journal_Entrie::where('visibility', 'public')->count();
            $privateJournals = Journal_Entrie::where('visibility', 'private')->count();
            $analyzedJournals = Journal_Entrie::where('is_analyzed', true)->count();

            // --- Recommendations ---
            $totalRecomendations = Recomendation::count();
            $aiRecomendations = Recomendation::where('source', 'ai')->count();
            $profRecomendations = Recomendation::where('source', 'professional')->count();
            $sysRecomendations = Recomendation::where('source', 'system')->count();

            // --- Referrals ---
            $totalReferrals = Referral::count();
            $activeReferrals = Referral::whereIn('status', ['pending', 'accepted'])->count();
            $completedReferrals = Referral::where('status', 'completed')->count();
            $rejectedReferrals = Referral::where('status', 'rejected')->count();
            $nextAppointment = Referral::whereNotNull('appointment_date')
                ->where('appointment_date', '>=', now())
                ->orderBy('appointment_date', 'asc')
                ->value('appointment_date');

            // --- Mood Entries ---
            $totalMoodEntries = Mood_Entrie::count();
            $avgMoodGlobal = Mood_Entrie::avg('mood_score');

            // --- Settings ---
            $totalSettings = Setting::count();

            return view('admin.dashboard', [
                'totalUsers' => $totalUsers,
                'totalAdmins' => $totalAdmins,
                'totalProfessionals' => $totalProfessionals,
                'totalClients' => $totalClients,
                'activeUsers' => $activeUsers,
                'inactiveUsers' => $inactiveUsers,

                'totalJournals' => $totalJournals,
                'publicJournals' => $publicJournals,
                'privateJournals' => $privateJournals,
                'analyzedJournals' => $analyzedJournals,

                'totalRecomendations' => $totalRecomendations,
                'aiRecomendations' => $aiRecomendations,
                'profRecomendations' => $profRecomendations,
                'sysRecomendations' => $sysRecomendations,

                'totalReferrals' => $totalReferrals,
                'activeReferrals' => $activeReferrals,
                'completedReferrals' => $completedReferrals,
                'rejectedReferrals' => $rejectedReferrals,
                'nextAppointment' => $nextAppointment,

                'totalMoodEntries' => $totalMoodEntries,
                'avgMoodGlobal' => round($avgMoodGlobal, 2),

                'totalSettings' => $totalSettings,
            ]);
        } elseif ($user->role == 'user') {
            // --- Mood Analytics ---
            $avgMood = Mood_Entrie::where('user_id', $user->id)
                ->whereBetween('mood_date', [now()->startOfWeek(), now()->endOfWeek()])
                ->avg('mood_score');

            $bestMood = Mood_Entrie::where('user_id', $user->id)
                ->orderByDesc('mood_score')->first();
            $worstMood = Mood_Entrie::where('user_id', $user->id)
                ->orderBy('mood_score')->first();

            // --- Journal Analytics ---
            $totalJournals = Journal_Entrie::where('user_id', $user->id)->count();
            $publicJournals = Journal_Entrie::where('user_id', $user->id)->where('visibility', 'public')->count();
            $privateJournals = Journal_Entrie::where('user_id', $user->id)->where('visibility', 'private')->count();
            $analyzedJournals = Journal_Entrie::where('user_id', $user->id)->where('is_analyzed', true)->count();

            // --- Recommendation Insights ---
            $totalRecomendations = Recomendation::count();
            $aiRecomendations = Recomendation::where('source', 'ai')->count();
            $profRecomendations = Recomendation::where('source', 'professional')->count();
            $sysRecomendations = Recomendation::where('source', 'system')->count();

            // --- Referrals ---
            $activeReferrals = Referral::where('user_id', $user->id)
                ->whereIn('status', ['pending', 'accepted'])->count();
            $completedReferrals = Referral::where('user_id', $user->id)
                ->where('status', 'completed')->count();
            $nextAppointment = Referral::where('user_id', $user->id)
                ->whereNotNull('appointment_date')
                ->where('appointment_date', '>=', now())
                ->orderBy('appointment_date', 'asc')
                ->value('appointment_date');

            return view('user.dashboard', [
                'avgMood' => $avgMood ? round($avgMood, 2) : 'N/A',
                'bestMoodDate' => $bestMood?->mood_date ?? '-',
                'worstMoodDate' => $worstMood?->mood_date ?? '-',
                'totalJournals' => $totalJournals,
                'publicJournals' => $publicJournals,
                'privateJournals' => $privateJournals,
                'analyzedJournals' => $analyzedJournals,
                'totalRecomendations' => $totalRecomendations,
                'aiRecomendations' => $aiRecomendations,
                'profRecomendations' => $profRecomendations,
                'sysRecomendations' => $sysRecomendations,
                'activeReferrals' => $activeReferrals,
                'completedReferrals' => $completedReferrals,
                'nextAppointment' => $nextAppointment,
            ]);
        } elseif ($user->role == 'professional') {
            // --- Journal Analytics (hanya yang public agar bisa diakses professional) ---
            $totalJournals = Journal_Entrie::where('visibility', 'public')->count();
            $pendingJournals = Journal_Entrie::where('visibility', 'public')
                ->where('is_analyzed', false)->count();
            $analyzedJournals = Journal_Entrie::where('visibility', 'public')
                ->where('is_analyzed', true)->count();

            // --- Recommendation Analytics ---
            $totalRecomendations = Recomendation::count();
            $profRecomendations = Recomendation::where('source', 'professional')->count();

            // --- Referral Analytics ---
            $activeReferrals = Referral::where('professional_id', $user->id)
                ->whereIn('status', ['pending', 'accepted'])->count();
            $completedReferrals = Referral::where('professional_id', $user->id)
                ->where('status', 'completed')->count();
            $rejectedReferrals = Referral::where('professional_id', $user->id)
                ->where('status', 'rejected')->count();

            $nextAppointment = Referral::where('professional_id', $user->id)
                ->whereNotNull('appointment_date')
                ->where('appointment_date', '>=', now())
                ->orderBy('appointment_date', 'asc')
                ->value('appointment_date');

            return view('professional.dashboard', [
                'totalJournals' => $totalJournals,
                'pendingJournals' => $pendingJournals,
                'analyzedJournals' => $analyzedJournals,
                'totalRecomendations' => $totalRecomendations,
                'profRecomendations' => $profRecomendations,
                'activeReferrals' => $activeReferrals,
                'completedReferrals' => $completedReferrals,
                'rejectedReferrals' => $rejectedReferrals,
                'nextAppointment' => $nextAppointment,
            ]);
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

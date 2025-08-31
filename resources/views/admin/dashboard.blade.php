@extends('layouts.dashboard')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- User Management --}}
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-bold mb-4">User Management</h3>
            <p>Total Users: <span class="font-semibold">{{ $totalUsers }}</span></p>
            <p>Admin: {{ $totalAdmins }} | Professional: {{ $totalProfessionals }} | User: {{ $totalClients }}</p>
            <p>Aktif: {{ $activeUsers }} | Nonaktif: {{ $inactiveUsers }}</p>
        </div>

        {{-- Journals --}}
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-bold mb-4">Journals</h3>
            <p>Total jurnal: <span class="font-semibold">{{ $totalJournals }}</span></p>
            <p>Publik: {{ $publicJournals }} | Privat: {{ $privateJournals }}</p>
            <p>Sudah dianalisis: {{ $analyzedJournals }}</p>
        </div>

        {{-- Recommendations --}}
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-bold mb-4">Rekomendasi</h3>
            <p>Total rekomendasi: {{ $totalRecomendations }}</p>
            <p>AI: {{ $aiRecomendations }} | Professional: {{ $profRecomendations }} | System: {{ $sysRecomendations }}
            </p>
        </div>

        {{-- Referrals --}}
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-bold mb-4">Referral</h3>
            <p>Total referral: {{ $totalReferrals }}</p>
            <p>Aktif: {{ $activeReferrals }} | Selesai: {{ $completedReferrals }} | Ditolak: {{ $rejectedReferrals }}</p>
            <p>Appointment terdekat: {{ $nextAppointment ?? 'Tidak ada' }}</p>
        </div>

        {{-- Mood Entries --}}
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-bold mb-4">Mood Tracking</h3>
            <p>Total entri mood: {{ $totalMoodEntries }}</p>
            <p>Rata-rata skor mood global: {{ $avgMoodGlobal }}</p>
        </div>

        {{-- Settings --}}
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-bold mb-4">System Settings</h3>
            <p>Total setting: {{ $totalSettings }}</p>
        </div>

    </div>
@endsection

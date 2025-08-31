@extends('layouts.dashboard')

@section('title', 'Dashboard User')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- Mood Analytics --}}
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-bold mb-4">Mood Analytics</h3>
            <p>Rata-rata mood minggu ini: <span class="font-semibold text-blue-600">{{ $avgMood }}</span></p>
            <p>Hari dengan mood terbaik: <span class="font-semibold text-green-600">{{ $bestMoodDate }}</span></p>
            <p>Hari dengan mood terburuk: <span class="font-semibold text-red-600">{{ $worstMoodDate }}</span></p>
        </div>

        {{-- Journal Analytics --}}
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-bold mb-4">Journals</h3>
            <p>Total jurnal: <span class="font-semibold">{{ $totalJournals }}</span></p>
            <p>Publik: {{ $publicJournals }} | Privat: {{ $privateJournals }}</p>
            <p>Sudah dianalisis: {{ $analyzedJournals }}</p>
        </div>

        {{-- Recommendation Insights --}}
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-bold mb-4">Rekomendasi</h3>
            <p>Total rekomendasi: {{ $totalRecomendations }}</p>
            <p>Sumber rekomendasi:</p>
            <ul class="list-disc pl-5">
                <li>AI: {{ $aiRecomendations }}</li>
                <li>Professional: {{ $profRecomendations }}</li>
                <li>System: {{ $sysRecomendations }}</li>
            </ul>
        </div>

        {{-- Referrals --}}
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-bold mb-4">Referral</h3>
            <p>Referral aktif: {{ $activeReferrals }}</p>
            <p>Referral selesai: {{ $completedReferrals }}</p>
            <p>Jadwal appointment terdekat: {{ $nextAppointment ?? 'Tidak ada' }}</p>
        </div>

    </div>
@endsection

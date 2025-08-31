@extends('layouts.dashboard')

@section('title', 'Dashboard Professional')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- Journals --}}
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-bold mb-4">Journals Klien</h3>
            <p>Total jurnal publik: <span class="font-semibold">{{ $totalJournals }}</span></p>
            <p>Belum dianalisis: <span class="font-semibold text-red-600">{{ $pendingJournals }}</span></p>
            <p>Sudah dianalisis: <span class="font-semibold text-green-600">{{ $analyzedJournals }}</span></p>
        </div>

        {{-- Recommendations --}}
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-bold mb-4">Rekomendasi</h3>
            <p>Total rekomendasi dibuat: <span class="font-semibold">{{ $totalRecomendations }}</span></p>
            <p>Sumber professional: <span class="font-semibold">{{ $profRecomendations }}</span></p>
        </div>

        {{-- Referrals --}}
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-bold mb-4">Referral</h3>
            <p>Referral aktif: {{ $activeReferrals }}</p>
            <p>Referral selesai: {{ $completedReferrals }}</p>
            <p>Referral ditolak: {{ $rejectedReferrals }}</p>
            <p>Jadwal appointment terdekat: <span class="font-semibold">{{ $nextAppointment ?? 'Tidak ada' }}</span></p>
        </div>

    </div>
@endsection

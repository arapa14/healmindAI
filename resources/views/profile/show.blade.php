@extends('layouts.dashboard')

@section('title', 'Profil Saya')

@section('content')
    <div class="max-w-2xl mx-auto bg-white shadow-md rounded-2xl p-6 border border-dashed border-teal-300">

        {{-- Judul --}}
        <div class="flex items-center gap-2 mb-6">
            <h1 class="text-2xl font-bold text-gray-700 tracking-tight relative">
                Profil Saya
                <span class="absolute -top-2 -left-3 text-teal-400">✦</span>
                <span class="absolute -bottom-2 -right-3 text-pink-300">✦</span>
            </h1>
        </div>

        {{-- Foto Profil --}}
        <div class="flex flex-col items-center mb-6">
            <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}"
                class="w-28 h-28 rounded-full object-cover border-4 border-teal-200 shadow-md">
            <p class="mt-2 text-sm text-gray-500">Foto Profil</p>
        </div>

        {{-- Info Profil --}}
        <div class="space-y-4">
            <div class="p-4 rounded-xl border border-gray-200 bg-teal-50/40 shadow-sm">
                <p class="text-xs text-gray-500">Nama</p>
                <p class="font-semibold text-gray-800">{{ Auth::user()->name }}</p>
            </div>
            <div class="p-4 rounded-xl border border-gray-200 bg-pink-50/40 shadow-sm">
                <p class="text-xs text-gray-500">Email</p>
                <p class="font-semibold text-gray-800">{{ Auth::user()->email }}</p>
            </div>
            <div class="p-4 rounded-xl border border-gray-200 bg-yellow-50/40 shadow-sm">
                <p class="text-xs text-gray-500">Tanggal Lahir</p>
                <p class="font-semibold text-gray-800">{{ $profile->birthdate ?? 'Belum diisi' }}</p>
            </div>
            <div class="p-4 rounded-xl border border-gray-200 bg-blue-50/40 shadow-sm">
                <p class="text-xs text-gray-500">Jenis Kelamin</p>
                <p class="font-semibold text-gray-800">{{ $profile->gender ?? 'Belum diisi' }}</p>
            </div>
            <div class="p-4 rounded-xl border border-gray-200 bg-purple-50/40 shadow-sm">
                <p class="text-xs text-gray-500">Tentang Saya</p>
                <p class="font-medium text-gray-700">
                    {{ $profile->bio ?? 'Ceritakan sedikit tentang dirimu ✍️' }}
                </p>
            </div>
        </div>

        {{-- Tombol Edit --}}
        <div class="mt-6 text-center">
            <a href="{{ route('profile.edit') }}"
                class="inline-block px-6 py-2 bg-teal-500 text-white rounded-full 
              shadow-md hover:bg-teal-600 transition">
                Edit Profil
            </a>
        </div>
    </div>
@endsection

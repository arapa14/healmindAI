@extends('layouts.dashboard')

@section('title', 'Edit Profil')

@section('content')
    <div class="max-w-2xl mx-auto bg-white shadow-md rounded-2xl p-6 border border-dashed border-teal-300">

        <div class="flex items-center gap-2 mb-6">
            <h1 class="text-2xl font-bold text-gray-700 tracking-tight relative">
                Edit Profil
                <span class="absolute -top-2 -left-3 text-teal-400">✦</span>
                <span class="absolute -bottom-2 -right-3 text-pink-300">✦</span>
            </h1>
        </div>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            {{-- Foto Profil --}}
            <div class="flex flex-col items-center">
                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}"
                    class="w-28 h-28 rounded-full object-cover border-4 border-teal-200 shadow-md mb-3">

                <input type="file" name="profile_picture" accept="image/*"
                    class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 
                       file:rounded-full file:border-0 file:text-sm 
                       file:font-semibold file:bg-teal-50 file:text-teal-600 
                       hover:file:bg-teal-100">
            </div>

            {{-- Tanggal Lahir --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                <input type="date" name="birthdate" value="{{ old('birthdate', $profile->birthdate) }}"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-teal-500 focus:border-teal-500">
            </div>

            {{-- Jenis Kelamin --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                <div class="flex gap-6">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="gender" value="male"
                            {{ old('gender', $profile->gender) == 'male' ? 'checked' : '' }}
                            class="text-teal-500 focus:ring-teal-500">
                        <span>👦 Laki-laki</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="gender" value="female"
                            {{ old('gender', $profile->gender) == 'female' ? 'checked' : '' }}
                            class="text-pink-500 focus:ring-pink-400">
                        <span>👧 Perempuan</span>
                    </label>
                </div>
            </div>

            {{-- Bio --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Bio</label>
                <textarea name="bio" rows="3"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-teal-500 focus:border-teal-500">{{ old('bio', $profile->bio) }}</textarea>
            </div>

            {{-- Tombol --}}
            <div class="flex justify-end gap-3">
                <a href="{{ route('profile') }}" class="px-4 py-2 border rounded-lg">Batal</a>
                <button type="submit" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700">
                    Simpan
                </button>
            </div>
        </form>
    </div>
@endsection

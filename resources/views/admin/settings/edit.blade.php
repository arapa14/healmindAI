@extends('layouts.dashboard')

@section('title', 'Edit Setting')

@section('content')
    <div class="p-6 bg-white rounded-xl shadow max-w-lg mx-auto">
        <h1 class="text-xl font-bold mb-4">Edit Setting</h1>

        <form action="{{ route('settings.update', $setting->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="block mb-1 font-medium">Key</label>
                <input type="text" class="w-full border rounded p-2 bg-gray-100" value="{{ $setting->key }}" disabled>
            </div>

            <div class="mb-3">
                <label class="block mb-1 font-medium">Value</label>
                @if ($setting->key === 'logo')
                    <input type="file" name="value" class="w-full border rounded p-2">
                    <p class="text-sm text-gray-600 mt-1">Logo saat ini:</p>
                    <img src="{{ asset('storage/' . $setting->value) }}" alt="Logo" class="h-16 mt-2">
                @else
                    <input type="text" name="value" class="w-full border rounded p-2"
                        value="{{ old('value', $setting->value) }}" required>
                @endif
                @error('value')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label class="block mb-1 font-medium">Description</label>
                <textarea class="w-full border rounded p-2 bg-gray-100" disabled>{{ $setting->description }}</textarea>
            </div>

            <div class="flex gap-2 mt-4">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
                <a href="{{ route('settings.index') }}" class="px-4 py-2 bg-gray-400 text-white rounded">Batal</a>
            </div>
        </form>
    </div>
@endsection

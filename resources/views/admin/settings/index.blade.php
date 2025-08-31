@extends('layouts.dashboard')

@section('title', 'Kelola Setting')

@section('content')
    <div class="p-6 bg-white rounded-xl shadow">
        <h1 class="text-xl font-bold mb-4">Daftar Setting</h1>

        @if (session('success'))
            <div class="mb-4 p-2 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif

        <table class="w-full border text-sm">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border p-2">Key</th>
                    <th class="border p-2">Value</th>
                    <th class="border p-2">Description</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($settings as $setting)
                    <tr>
                        <td class="border p-2">{{ $setting->key }}</td>
                        <td class="border p-2">
                            @if ($setting->key === 'logo')
                                <img src="{{ asset('storage/' . $setting->value) }}" alt="Logo" class="h-10">
                            @else
                                {{ $setting->value }}
                            @endif
                        </td>
                        <td class="border p-2">{{ $setting->description }}</td>
                        <td class="border p-2">
                            <a href="{{ route('settings.edit', $setting->id) }}"
                                class="px-3 py-1 bg-yellow-500 text-white rounded">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

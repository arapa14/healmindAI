@extends('layouts.dashboard')

@section('title', 'chatbot AI')

@section('content')
    <div class="bg-white p-6 rounded shadow text-center">
        <h3 class="text-lg font-bold mb-4">Halaman Sedang Dalam Perkembangan</h3>
        <p class="text-gray-700 mb-4">
            Halaman ini sedang dalam pengembangan. Fitur-fitur akan segera tersedia.
        </p>
        <img src="https://cdn-icons-png.flaticon.com/512/565/565547.png" alt="Under Construction"
            class="mx-auto w-32 h-32 mb-4">
        <a href="{{ route('dashboard') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded">Kembali ke
            Dashboard</a>
    </div>
@endsection

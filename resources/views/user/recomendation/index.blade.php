@extends('layouts.dashboard')

@section('title', 'Rekomendasi')

@section('content')
    <div class="container my-4">
        <h2 class="mb-5 text-center fw-bold">🧠 Rekomendasi Kesehatan Mental</h2>

        @forelse($recomendations as $rec)
            <article class="mb-4 p-4 rounded shadow-sm bg-white border article-card">
                <h4 class="fw-bold mb-2">{{ $rec->title }}</h4>
                <p class="text-muted mb-3">Sumber: <span class="fw-semibold">{{ ucfirst($rec->source) }}</span></p>
                <p class="text-secondary">
                    {{ Str::limit($rec->content ?? 'Tidak ada ringkasan.', 200, '...') }}
                </p>
                <a href="#" class="btn btn-sm btn-outline-primary">Baca Selengkapnya</a>
            </article>
        @empty
            <div class="alert alert-info text-center">
                Belum ada rekomendasi tersedia untuk saat ini.
            </div>
        @endforelse
    </div>

    {{-- Tambahkan style agar lebih seperti artikel --}}
    <style>
        .article-card {
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .article-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection

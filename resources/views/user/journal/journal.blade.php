@extends('layouts.dashboard')

@section('title', 'Journal Tracking')

@section('content')
    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-lg font-bold mb-4">Journal Tracking</h3>

        {{-- Form Tambah Journal --}}
        <form method="POST" action="{{ route('journal.store') }}" class="mb-6">
            @csrf
            <div class="mb-2">
                <label for="title" class="block font-semibold mb-1">Judul Journal</label>
                <input type="text" name="title" id="title" required class="border rounded px-3 py-2 w-full">
            </div>

            <div class="mb-2">
                <label for="content" class="block font-semibold mb-1">Konten</label>
                <textarea name="content" id="content" rows="4" required class="border rounded px-3 py-2 w-full"></textarea>
            </div>

            <div class="mb-2">
                <label for="visibility" class="block font-semibold mb-1">Visibility</label>
                <select name="visibility" id="visibility" class="border rounded px-3 py-2">
                    <option value="public">Public</option>
                    <option value="private">Private</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Buat Journal</button>
        </form>

        {{-- Pesan Sukses --}}
        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- My Journals --}}
        <h4 class="text-md font-semibold mb-2">Jurnal Saya</h4>
        @if ($myJournals->count())
            <ul>
                @foreach ($myJournals as $journal)
                    <li class="border rounded p-3 mb-2">
                        <h5 class="font-bold">{{ $journal->title }}</h5>
                        <p class="text-gray-700">{{ $journal->content }}</p>
                        <small class="text-gray-500">Tanggal: {{ $journal->created_at->format('d M Y') }} | Visibility:
                            {{ $journal->visibility }}</small>
                        <div class="mt-2">
                            <a href="{{ route('journal.edit', $journal->id) }}" class="text-blue-600 mr-2">Edit</a>
                            <form action="{{ route('journal.destroy', $journal->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600"
                                    onclick="return confirm('Yakin ingin menghapus jurnal ini?')">Hapus</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p>Belum ada jurnal.</p>
        @endif

        {{-- List Journal Public --}}
        <h4 class="text-md font-semibold mb-2 mt-6">Jurnal Publik</h4>
        @if ($publicJournals->count())
            <ul>
                @foreach ($publicJournals as $journal)
                    <li class="border rounded p-3 mb-2">
                        <h5 class="font-bold">{{ $journal->title }}</h5>
                        <p class="text-gray-700">{{ $journal->content }}</p>
                        <small class="text-gray-500">Oleh: {{ $journal->user->name }} |
                            {{ $journal->created_at->format('d M Y') }}</small>
                    </li>
                @endforeach
            </ul>
        @else
            <p>Belum ada jurnal publik.</p>
        @endif
    </div>
@endsection

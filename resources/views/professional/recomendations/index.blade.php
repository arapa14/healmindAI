@extends('layouts.dashboard')

@section('title', 'Journal & Recommendations')

@section('content')
    <div class="grid grid-cols-2 gap-6">

        {{-- Jurnal --}}
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-bold mb-4">My Journals</h3>

            {{-- Form tambah journal --}}
            <form action="{{ route('professional.journals.store') }}" method="POST" class="mb-4">
                @csrf
                <input type="text" name="title" placeholder="Title" class="border p-2 w-full mb-2">
                <textarea name="content" placeholder="Content" class="border p-2 w-full mb-2"></textarea>
                <select name="visibility" class="border p-2 w-full mb-2">
                    <option value="private">Private</option>
                    <option value="public">Public</option>
                </select>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Tambah Journal</button>
            </form>

            {{-- List journals --}}
            <ul>
                @foreach ($myJournals as $journal)
                    <li class="mb-2 border-b pb-2">
                        <strong>{{ $journal->title }}</strong>
                        <p>{{ $journal->content }}</p>
                        <form action="{{ route('professional.journals.update', $journal->id) }}" method="POST"
                            class="mt-2">
                            @csrf @method('PUT')
                            <input type="text" name="title" value="{{ $journal->title }}"
                                class="border p-1 w-full mb-1">
                            <textarea name="content" class="border p-1 w-full mb-1">{{ $journal->content }}</textarea>
                            <select name="visibility" class="border p-1 w-full mb-1">
                                <option value="private" @selected($journal->visibility == 'private')>Private</option>
                                <option value="public" @selected($journal->visibility == 'public')>Public</option>
                            </select>
                            <button class="bg-yellow-500 text-white px-3 py-1 rounded">Update</button>
                        </form>
                        <form action="{{ route('professional.journals.destroy', $journal->id) }}" method="POST"
                            class="mt-1">
                            @csrf @method('DELETE')
                            <button class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Rekomendasi --}}
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-bold mb-4">My Recommendations</h3>

            {{-- Form tambah recomendation --}}
            <form action="{{ route('professional.recomendations.store') }}" method="POST" class="mb-4">
                @csrf
                <input type="text" name="title" placeholder="Title" class="border p-2 w-full mb-2">
                <select name="related_journal_id" class="border p-2 w-full mb-2">
                    <option value="">Tidak terkait Journal</option>
                    @foreach ($publicJournals as $journal)
                        <option value="{{ $journal->id }}">{{ $journal->title }}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Tambah Recommendation</button>
            </form>

            {{-- List recomendations --}}
            <ul>
                @foreach ($myRecomendations as $rec)
                    <li class="mb-2 border-b pb-2">
                        <strong>{{ $rec->title }}</strong>
                        <small>({{ $rec->related_journal_id ? 'Linked Journal: ' . $rec->related_journal_id : 'No Journal' }})</small>

                        <form action="{{ route('professional.recomendations.update', $rec->id) }}" method="POST"
                            class="mt-2">
                            @csrf @method('PUT')
                            <input type="text" name="title" value="{{ $rec->title }}"
                                class="border p-1 w-full mb-1">
                            <select name="related_journal_id" class="border p-1 w-full mb-1">
                                <option value="">Tidak terkait</option>
                                @foreach ($publicJournals as $journal)
                                    <option value="{{ $journal->id }}" @selected($rec->related_journal_id == $journal->id)>
                                        {{ $journal->title }}
                                    </option>
                                @endforeach
                            </select>
                            <button class="bg-yellow-500 text-white px-3 py-1 rounded">Update</button>
                        </form>

                        <form action="{{ route('professional.recomendations.destroy', $rec->id) }}" method="POST"
                            class="mt-1">
                            @csrf @method('DELETE')
                            <button class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>

    </div>

    {{-- Semua Journal Public --}}
    <div class="mt-6 bg-white p-6 rounded shadow">
        <h3 class="text-lg font-bold mb-4">All Public Journals</h3>
        <ul>
            @foreach ($publicJournals as $journal)
                <li class="mb-2"><strong>{{ $journal->title }}</strong> - {{ $journal->content }}</li>
            @endforeach
        </ul>
    </div>

    {{-- Semua Recommendation --}}
    <div class="mt-6 bg-white p-6 rounded shadow">
        <h3 class="text-lg font-bold mb-4">All Recommendations</h3>
        <ul>
            @foreach ($allRecomendations as $rec)
                <li class="mb-2"><strong>{{ $rec->title }}</strong></li>
            @endforeach
        </ul>
    </div>
@endsection

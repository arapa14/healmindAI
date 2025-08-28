@extends('layouts.dashboard')

@section('title', 'Edit Journal')

@section('content')
    <div class="bg-white p-6 rounded shadow max-w-2xl mx-auto">
        <h3 class="text-lg font-bold mb-4">Edit Journal</h3>

        {{-- Form Edit Journal --}}
        <form method="POST" action="{{ route('journal.update', $journal->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block font-semibold mb-1">Judul Journal</label>
                <input type="text" name="title" id="title" value="{{ old('title', $journal->title) }}" required
                    class="border rounded px-3 py-2 w-full">
            </div>

            <div class="mb-4">
                <label for="content" class="block font-semibold mb-1">Konten</label>
                <textarea name="content" id="content" rows="6" required class="border rounded px-3 py-2 w-full">{{ old('content', $journal->content) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="visibility" class="block font-semibold mb-1">Visibility</label>
                <select name="visibility" id="visibility" class="border rounded px-3 py-2">
                    <option value="public" {{ old('visibility', $journal->visibility) == 'public' ? 'selected' : '' }}>
                        Public</option>
                    <option value="private" {{ old('visibility', $journal->visibility) == 'private' ? 'selected' : '' }}>
                        Private</option>
                </select>
            </div>

            <div class="flex items-center gap-2">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Journal</button>
                <a href="{{ route('journal') }}" class="bg-gray-300 px-4 py-2 rounded text-gray-700">Batal</a>
            </div>
        </form>

        {{-- Tampilkan error validasi --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mt-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection

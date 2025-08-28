@extends('layouts.dashboard')

@section('title', 'Mood Tracking')

@section('content')
    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-lg font-bold mb-4">Mood Tracking</h3>

        {{-- Form Input Mood --}}
        <form method="POST" action="{{ route('mood.store') }}" class="mb-6">
            @csrf
            <label for="mood_score" class="block font-semibold mb-2">Bagaimana mood kamu hari ini? (1-10)</label>
            <input type="number" name="mood_score" id="mood_score" min="1" max="10" required
                class="border rounded px-3 py-2 w-32">

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded ml-2">Simpan</button>
        </form>

        {{-- Pesan Sukses --}}
        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- Tabel Perkembangan Mood --}}
        <h4 class="text-md font-semibold mb-2">Perkembangan Mood</h4>
        <table class="w-full border">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="p-2 border">Tanggal</th>
                    <th class="p-2 border">Mood</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($moods as $mood)
                    <tr>
                        <td class="p-2 border">{{ $mood->mood_date }}</td>
                        <td class="p-2 border">{{ $mood->mood_score }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Grafik Mood --}}
        <canvas id="moodChart" class="mt-6"></canvas>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('moodChart').getContext('2d');
        const moodChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($moods->pluck('mood_date')->reverse()->toArray()) !!},
                datasets: [{
                    label: 'Mood Score',
                    data: {!! json_encode($moods->pluck('mood_score')->reverse()->toArray()) !!},
                    borderColor: 'blue',
                    backgroundColor: 'lightblue',
                    fill: true,
                    tension: 0.3
                }]
            }
        });
    </script>
@endsection

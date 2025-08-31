{{-- resources/views/referrals/create.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'Buat Referral')

@section('content')
    <div class="max-w-lg mx-auto bg-white shadow-md rounded-2xl p-6 mt-10">
        <h2 class="text-2xl font-bold mb-4 text-center">Form Referral</h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('referral.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block font-medium mb-1">Pilih Professional</label>
                <select name="professional_id" class="w-full border rounded p-2" required>
                    <option value="">-- Pilih Professional --</option>
                    @foreach ($professionals as $pro)
                        <option value="{{ $pro->id }}">
                            {{ $pro->user->name }}
                            ({{ $pro->specialty }}, {{ $pro->experience }})
                        </option>
                    @endforeach
                </select>

                @error('professional_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-medium mb-1">Alasan Rujukan</label>
                <textarea name="reason" rows="4" class="w-full border rounded p-2">{{ old('reason') }}</textarea>
                @error('reason')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-medium mb-1">Usulan Tanggal Pertemuan (opsional)</label>
                <input type="datetime-local" name="appointment_date" value="{{ old('appointment_date') }}"
                    class="w-full border rounded p-2">

                @error('appointment_date')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                Kirim Referral
            </button>
        </form>
    </div>
    <div class="max-w-3xl mx-auto mt-10">
        <h3 class="text-xl font-bold mb-4">Referral Saya</h3>

        @if ($referrals->count())
            <div class="space-y-4">
                @foreach ($referrals as $ref)
                    <div class="border rounded-lg p-4 shadow-sm bg-gray-50">
                        <h4 class="font-semibold text-lg">
                            {{ $ref->professional->user->name }}
                            <span class="text-sm text-gray-500">({{ $ref->professional->specialty }})</span>
                        </h4>
                        <p class="text-gray-700 mt-1">{{ $ref->reason }}</p>
                        <span
                            class="inline-block mt-2 px-3 py-1 text-sm rounded-full
                        @if ($ref->status === 'pending') bg-yellow-100 text-yellow-700
                        @elseif($ref->status === 'accepted') bg-green-100 text-green-700
                        @elseif($ref->status === 'rejected') bg-red-100 text-red-700
                        @else bg-blue-100 text-blue-700 @endif">
                            Status: {{ ucfirst($ref->status) }}
                        </span>
                        @if ($ref->appointment_date)
                            <div class="text-sm text-gray-600 mt-1">
                                Usulan Pertemuan: {{ \Carbon\Carbon::parse($ref->appointment_date)->format('d M Y H:i') }}
                            </div>
                        @endif

                        <div class="text-sm text-gray-500 mt-1">
                            Dibuat: {{ $ref->created_at->format('d M Y H:i') }}
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">Belum ada referral yang kamu buat.</p>
        @endif
    </div>

@endsection

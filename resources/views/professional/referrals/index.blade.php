@extends('layouts.dashboard')

@section('title', 'Rujukan')

@section('content')
    <div class="bg-white p-6 rounded shadow mb-6">
        <h3 class="text-lg font-bold mb-4">Halo, {{ Auth::user()->name }}!</h3>
        <p>Anda bisa mengelola referral klien dan mengatur jadwal pertemuan di sini.</p>
    </div>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white p-6 rounded shadow">
        <h4 class="font-semibold text-lg mb-4">Daftar Referral</h4>

        @if ($referrals->count())
            <div class="space-y-4">
                @foreach ($referrals as $ref)
                    <div class="border rounded p-4 bg-gray-50">
                        <h5 class="font-bold">{{ $ref->user->name }}</h5>
                        <p class="text-sm text-gray-600 mb-2">Alasan: {{ $ref->reason }}</p>

                        <form action="{{ route('professional.referrals.answer', $ref->id) }}" method="POST"
                            class="space-y-3">
                            @csrf
                            @method('PUT')
                            <div>
                                <label class="block text-sm font-medium">Status</label>
                                <select name="status" class="w-full border rounded p-2">
                                    <option value="pending" {{ $ref->status == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="accepted" {{ $ref->status == 'accepted' ? 'selected' : '' }}>Accepted
                                    </option>
                                    <option value="rejected" {{ $ref->status == 'rejected' ? 'selected' : '' }}>Rejected
                                    </option>
                                    <option value="completed" {{ $ref->status == 'completed' ? 'selected' : '' }}>Completed
                                    </option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium">Tanggal Pertemuan</label>
                                <input type="datetime-local" name="appointment_date"
                                    value="{{ $ref->appointment_date ? \Carbon\Carbon::parse($ref->appointment_date)->format('Y-m-d\TH:i') : '' }}"
                                    class="w-full border rounded p-2">
                            </div>

                            <button type="submit"
                                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                                Update
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">Belum ada referral untuk Anda.</p>
        @endif
    </div>
@endsection

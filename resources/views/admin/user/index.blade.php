@extends('layouts.dashboard')

@section('title', 'Kelola User')

@section('content')
    <div class="p-6 bg-white rounded-xl shadow">
        <div class="flex  mb-4">
            <h1 class="text-xl font-bold">Daftar User</h1>
            <a href="{{ route('user.create') }}" class="ml-5 px-4 py-2 bg-blue-600 text-white rounded-lg">Tambah User</a>
        </div>

        @if (session('success'))
            <div class="mb-4 p-2 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif

        <table class="w-full border text-sm">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border p-2">ID</th>
                    <th class="border p-2">Nama</th>
                    <th class="border p-2">Email</th>
                    <th class="border p-2">Role</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="border p-2">{{ $user->id }}</td>
                        <td class="border p-2">{{ $user->name }}</td>
                        <td class="border p-2">{{ $user->email }}</td>
                        <td class="border p-2">{{ $user->role }}</td>
                        <td class="border p-2 flex gap-2">
                            <a href="{{ route('user.edit', $user->id) }}"
                                class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</a>
                            <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                onsubmit="return confirm('Yakin hapus user ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded">Hapus</button>
                            </form>
                            {{-- Tombol switch akun --}}
                            @if (auth()->user()->id !== $user->id) {{-- jangan switch ke diri sendiri --}}
                                <form action="{{ route('user.switch', $user->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-2 py-1 bg-blue-600 text-white rounded">Switch</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

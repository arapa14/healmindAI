@extends('layouts.dashboard')

@section('title', 'Edit User')

@section('content')
    <div class="p-6 bg-white rounded-xl shadow max-w-lg mx-auto">
        <h1 class="text-xl font-bold mb-4">Edit User</h1>

        <form action="{{ route('user.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="block mb-1 font-medium">Nama</label>
                <input type="text" name="name" class="w-full border rounded p-2" value="{{ old('name', $user->name) }}"
                    required>
                @error('name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label class="block mb-1 font-medium">Email</label>
                <input type="email" name="email" class="w-full border rounded p-2"
                    value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label class="block mb-1 font-medium">Password (kosongkan jika tidak diubah)</label>
                <input type="password" name="password" class="w-full border rounded p-2">
                @error('password')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label class="block mb-1 font-medium">Role</label>
                <select name="role" class="w-full border rounded p-2" required>
                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                    <option value="professional" {{ $user->role === 'professional' ? 'selected' : '' }}>Professional
                    </option>
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('role')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-2 mt-4">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
                <a href="{{ route('user.index') }}" class="px-4 py-2 bg-gray-400 text-white rounded">Batal</a>
            </div>
        </form>
    </div>
@endsection

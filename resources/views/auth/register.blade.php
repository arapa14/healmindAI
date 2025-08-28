<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - {{ $appName ?? 'HealMind AI' }}</title>
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-r from-blue-50 to-teal-50">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">
        {{-- Logo & App Name --}}
        <div class="text-center mb-8">
            <img src="{{ asset( 'storage/' . $appLogo ?? 'default-logo.png') }}" alt="Logo"
                class="w-16 h-16 mx-auto rounded-full object-cover mb-4">
            <h1 class="text-2xl font-bold text-teal-700">{{ $appName ?? 'HealMind AI' }}</h1>
            <p class="text-gray-500 text-sm mt-1">Buat akun baru Anda</p>
        </div>

        {{-- Form --}}
        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            {{-- Name --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                    class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                    class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" required
                    class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi
                    Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                    class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
            </div>

            {{-- Submit --}}
            <div>
                <button type="submit"
                    class="w-full px-4 py-2 bg-gradient-to-r from-teal-400 to-blue-500 text-white font-semibold rounded-lg shadow-md hover:scale-[1.02] transition">
                    Daftar
                </button>
            </div>
        </form>

        {{-- Footer --}}
        <p class="text-center text-sm text-gray-500 mt-6">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-teal-600 font-medium hover:underline">Login</a>
        </p>
    </div>
</body>

</html>

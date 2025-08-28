<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - {{ $appName ?? 'HealMind AI' }}</title>
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-r from-blue-50 to-teal-50">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">
        {{-- Logo & App Name --}}
        <div class="text-center mb-8">
            <img src="{{ asset( 'storage/' . $appLogo ?? 'default-logo.png') }}" alt="Logo"
                class="w-16 h-16 mx-auto rounded-full object-cover mb-4">
            <h1 class="text-2xl font-bold text-teal-700">{{ $appName ?? 'HealMind AI' }}</h1>
            <p class="text-gray-500 text-sm mt-1">Silakan masuk ke akun Anda</p>
        </div>

        {{-- Form --}}
        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
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

            {{-- Remember Me --}}
            <div class="flex items-center justify-between">
                <label class="flex items-center gap-2 text-sm text-gray-600">
                    <input type="checkbox" name="remember"
                        class="h-4 w-4 text-teal-600 focus:ring-teal-500 border-gray-300 rounded">
                    Ingat saya
                </label>
                <a href="javascript:void(0)" class="text-sm text-teal-600 hover:underline">Lupa
                    password?</a>
            </div>

            {{-- Submit --}}
            <div>
                <button type="submit"
                    class="w-full px-4 py-2 bg-gradient-to-r from-teal-400 to-blue-500 text-white font-semibold rounded-lg shadow-md hover:scale-[1.02] transition">
                    Masuk
                </button>
            </div>
        </form>

        {{-- Footer --}}
        <p class="text-center text-sm text-gray-500 mt-6">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-teal-600 font-medium hover:underline">Daftar</a>
        </p>
    </div>
</body>

</html>

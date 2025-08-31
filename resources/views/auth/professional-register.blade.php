<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Professional - HealMind AI</title>
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-r from-blue-50 to-teal-50">
    <div class="w-full max-w-lg bg-white rounded-2xl shadow-xl p-8">
        <h1 class="text-2xl font-bold text-center text-teal-700 mb-6">Daftar Akun Professional</h1>

        <form method="POST" action="{{ route('register.professional.post') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div>
                <label class="block text-sm font-medium">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div>
                <label class="block text-sm font-medium">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div>
                <label class="block text-sm font-medium">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div>
                <label class="block text-sm font-medium">Nomor Lisensi</label>
                <input type="text" name="license" value="{{ old('license') }}" required
                    class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div>
                <label class="block text-sm font-medium">Spesialisasi</label>
                <input type="text" name="specialty" value="{{ old('specialty') }}" required
                    class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div>
                <label class="block text-sm font-medium">Pengalaman (tahun)</label>
                <input type="number" name="experience" value="{{ old('experience') }}" required
                    class="w-full px-4 py-2 border rounded-lg">
            </div>

            <button type="submit"
                class="w-full px-4 py-2 bg-gradient-to-r from-teal-400 to-blue-500 text-white font-semibold rounded-lg shadow-md">
                Daftar sebagai Professional
            </button>
        </form>

        <p class="text-center text-sm text-gray-500 mt-6">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-teal-600 font-medium hover:underline">Masuk</a>
        </p>
    </div>
</body>

</html>

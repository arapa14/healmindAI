<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ \DB::table('settings')->where('key', 'name')->value('value') ?? 'HealMind AI' }}</title>
    @vite('resources/css/app.css')
</head>

<body class="antialiased bg-gray-50">

    {{-- Header --}}
    <header class="bg-white shadow-md fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            {{-- Logo & Name --}}
            <div class="flex items-center gap-3">
                <img src="{{ asset(\DB::table('settings')->where('key', 'logo')->value('value')) }}" alt="Logo"
                    class="h-10 w-10 rounded-full object-cover">
                <span class="font-bold text-xl text-teal-700">
                    {{ \DB::table('settings')->where('key', 'name')->value('value') }}
                </span>
            </div>
            {{-- Login Button --}}
            <div>
                <a href="{{ route('login') }}"
                    class="px-5 py-2 bg-gradient-to-r from-teal-400 to-blue-500 text-white rounded-lg shadow-md hover:scale-105 transition">
                    Login
                </a>
            </div>
        </div>
    </header>

    <main class="pt-24">
        {{-- Hero Section --}}
        <section class="bg-gradient-to-r from-blue-50 to-teal-50 py-24 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-800 leading-tight">
                Selamat Datang di <span class="text-teal-600">HealMind AI</span>
            </h1>
            <p class="mt-6 max-w-2xl mx-auto text-gray-600 text-lg">
                Teman curhat virtual berbasis AI untuk mendukung kesehatan mental Anda.
                Aman, empatik, dan mudah diakses kapan saja.
            </p>
            <div class="mt-8">
                <a href="{{ route('login') }}"
                    class="px-8 py-3 bg-teal-600 text-white text-lg rounded-full shadow-lg hover:bg-teal-700 transition">
                    Mulai Sekarang
                </a>
            </div>
        </section>

        {{-- Features --}}
        <section class="max-w-7xl mx-auto px-6 py-20 grid md:grid-cols-3 gap-10">
            <div class="p-6 bg-white rounded-2xl shadow-lg hover:shadow-xl transition">
                <h3 class="text-xl font-bold text-teal-700 mb-3">Mood Tracking</h3>
                <p class="text-gray-600">Catat suasana hati Anda setiap hari dengan visual yang mudah dipahami.</p>
            </div>
            <div class="p-6 bg-white rounded-2xl shadow-lg hover:shadow-xl transition">
                <h3 class="text-xl font-bold text-teal-700 mb-3">Chatbot Konseling AI</h3>
                <p class="text-gray-600">Curhat dengan AI yang empatik dan selalu siap mendengarkan Anda.</p>
            </div>
            <div class="p-6 bg-white rounded-2xl shadow-lg hover:shadow-xl transition">
                <h3 class="text-xl font-bold text-teal-700 mb-3">Jurnal Refleksi</h3>
                <p class="text-gray-600">Tulis cerita dan perasaan Anda, biarkan sistem membantu mengenali pola emosi.
                </p>
            </div>
        </section>

        {{-- Call to Action --}}
        <section class="bg-gradient-to-r from-teal-500 to-blue-600 py-20 text-center text-white">
            <h2 class="text-3xl font-bold">Jaga Kesehatan Mental Anda Mulai Hari Ini</h2>
            <p class="mt-4 text-lg max-w-2xl mx-auto">
                Dengan HealMind AI, Anda tidak sendirian. Kami hadir sebagai teman curhat virtual yang siap menemani
                perjalanan emosional Anda.
            </p>
            <div class="mt-6">
                <a href="{{ route('login') }}"
                    class="px-8 py-3 bg-white text-teal-700 font-semibold rounded-full shadow-lg hover:scale-105 transition">
                    Masuk Sekarang
                </a>
            </div>
        </section>
    </main>

    <footer class="bg-gray-100 py-6 text-center text-gray-500 text-sm">
        &copy; {{ date('Y') }} {{ \DB::table('settings')->where('key', 'name')->value('value') ?? 'HealMind AI' }}.
        All rights reserved.
    </footer>

</body>

</html>

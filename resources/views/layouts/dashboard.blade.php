<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $appName ?? 'HealMind AI' }} - @yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/' . $appLogo) }}">
    @vite('resources/css/app.css')
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="h-screen flex flex-col bg-gray-100 font-sans">

    {{-- Header --}}
    <x-header :title="View::getSections()['title'] ?? ''" />

    <div class="flex flex-1 overflow-hidden">
        {{-- Sidebar (Desktop) --}}
        <aside class="hidden md:flex md:flex-col md:w-64 bg-white shadow-sm">
            <x-sidebar />
        </aside>

        {{-- Sidebar (Mobile Drawer) --}}
        <div id="mobile-sidebar" class="fixed inset-0 z-40 hidden" aria-hidden="true">
            {{-- Background Overlay --}}
            <div class="absolute inset-0 bg-black/40" onclick="toggleSidebar(false)"></div>

            {{-- Drawer Content --}}
            <div class="relative w-64 h-full bg-white shadow-xl transform -translate-x-full transition-transform duration-300"
                id="drawer-content">
                <x-sidebar />
            </div>
        </div>

        {{-- Main Content --}}
        <main class="flex-1 overflow-y-auto p-6">
            @yield('content')
        </main>
    </div>

    <script>
        lucide.createIcons();

        function toggleSidebar(show) {
            const sidebar = document.getElementById('mobile-sidebar');
            const drawer = document.getElementById('drawer-content');

            if (show) {
                sidebar.classList.remove('hidden');
                setTimeout(() => drawer.classList.remove('-translate-x-full'), 10);
            } else {
                drawer.classList.add('-translate-x-full');
                setTimeout(() => sidebar.classList.add('hidden'), 300);
            }
        }
    </script>
</body>

</html>

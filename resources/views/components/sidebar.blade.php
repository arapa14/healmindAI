{{-- Sidebar --}}
<aside class="w-64 bg-white  flex flex-col">
    {{-- Brand (Mobile Only) --}}
    <div class="md:hidden flex items-center gap-2 px-4 py-4 border-b border-gray-200">
        <img src="{{ asset($appLogo ?? 'default-logo.png') }}" alt="Logo"
            class="h-9 w-9 rounded-full object-cover border border-gray-200 shadow-sm">
        <span class="text-lg font-bold text-teal-600 tracking-wide">
            {{ $appName ?? 'HealMind AI' }}
        </span>
    </div>
    {{-- Navigation --}}
    <nav class="flex-1 px-4 py-6 space-y-1 text-gray-700 text-sm font-medium">
        {{-- Admin Menu --}}
        @if (Auth::user()->role === 'admin')
            <a href="{{ route('dashboard') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-lg 
                           {{ request()->routeIs('dashboard') ? 'bg-teal-50 text-teal-700 font-semibold border-l-4 border-teal-500' : 'hover:bg-gray-50 hover:text-teal-600' }}">
                <i data-lucide="layout-dashboard" class="w-5 h-5"></i> Dashboard
            </a>
            <a href="javascript:void(0)"
                class="flex items-center gap-3 px-3 py-2 rounded-lg 
                           hover:bg-gray-50 hover:text-teal-600">
                <i data-lucide="book-open" class="w-5 h-5"></i> Jurnal
            </a>
            <a href="javascript:void(0)"
                class="flex items-center gap-3 px-3 py-2 rounded-lg 
                           hover:bg-gray-50 hover:text-teal-600">
                <i data-lucide="share-2" class="w-5 h-5"></i> Rujukan
            </a>
            <a href="javascript:void(0)"
                class="flex items-center gap-3 px-3 py-2 rounded-lg 
                           hover:bg-gray-50 hover:text-teal-600">
                <i data-lucide="users" class="w-5 h-5"></i> Kelola User
            </a>
            <a href="javascript:void(0)"
                class="flex items-center gap-3 px-3 py-2 rounded-lg 
                           hover:bg-gray-50 hover:text-teal-600">
                <i data-lucide="settings" class="w-5 h-5"></i> Pengaturan
            </a>
        @endif

        {{-- Professional Menu --}}
        @if (Auth::user()->role === 'professional')
            <a href="{{ route('dashboard') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-lg 
                           {{ request()->routeIs('dashboard') ? 'bg-teal-50 text-teal-700 font-semibold border-l-4 border-teal-500' : 'hover:bg-gray-50 hover:text-teal-600' }}">
                <i data-lucide="layout-dashboard" class="w-5 h-5"></i> Dashboard
            </a>
            <a href="javascript:void(0)"
                class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-50 hover:text-teal-600">
                <i data-lucide="book-open" class="w-5 h-5"></i> Jurnal
            </a>
            <a href="javascript:void(0)"
                class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-50 hover:text-teal-600">
                <i data-lucide="file-text" class="w-5 h-5"></i> Request
            </a>
        @endif

        {{-- User Menu --}}
        @if (Auth::user()->role === 'user')
            <a href="{{ route('dashboard') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-lg 
                           {{ request()->routeIs('dashboard') ? 'bg-teal-50 text-teal-700 font-semibold border-l-4 border-teal-500' : 'hover:bg-gray-50 hover:text-teal-600' }}">
                <i data-lucide="layout-dashboard" class="w-5 h-5"></i> Dashboard
            </a>
            <a href="javascript:void(0)"
                class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-50 hover:text-teal-600">
                <i data-lucide="smile" class="w-5 h-5"></i> Mood Tracker
            </a>
            <a href="javascript:void(0)"
                class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-50 hover:text-teal-600">
                <i data-lucide="book-open" class="w-5 h-5"></i> Jurnal
            </a>
            <a href="javascript:void(0)"
                class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-50 hover:text-teal-600">
                <i data-lucide="message-circle" class="w-5 h-5"></i> Chatbot AI
            </a>
            <a href="javascript:void(0)"
                class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-50 hover:text-teal-600">
                <i data-lucide="sparkles" class="w-5 h-5"></i> Rekomendasi
            </a>
            <a href="javascript:void(0)"
                class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-50 hover:text-teal-600">
                <i data-lucide="share-2" class="w-5 h-5"></i> Rujukan
            </a>
        @endif
    </nav>
</aside>

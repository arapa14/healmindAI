<header
    class="bg-white/80 backdrop-blur-lg border-b border-gray-200 shadow-sm px-6 py-3 flex items-center justify-between">

    {{-- Brand + Page Title --}}
    <div class="flex items-center gap-4">
        {{-- Hamburger Menu (Mobile Only) --}}
        <button class="md:hidden p-2 rounded-lg hover:bg-gray-100" onclick="toggleSidebar(true)">
            <i data-lucide="menu" class="w-6 h-6 text-gray-600"></i>
        </button>

        {{-- Logo + App Name (Desktop Only) --}}
        <div class="hidden md:flex items-center gap-2">
            <img src="{{ asset($appLogo ?? 'default-logo.png') }}" alt="Logo"
                class="h-9 w-9 rounded-full object-cover border border-gray-200 shadow-sm">
            <span class="text-lg font-bold text-teal-600 tracking-wide">
                {{ $appName ?? 'HealMind AI' }}
            </span>
        </div>

        {{-- Divider --}}
        <span class="hidden md:block h-5 w-px bg-gray-300"></span>

        {{-- Page Title --}}
        <div class="flex items-center gap-2 text-gray-700">
            <i data-lucide="layout-dashboard" class="w-5 h-5 text-teal-600"></i>
            <h2 class="text-base md:text-lg font-semibold tracking-tight">@yield('title')</h2>
        </div>
    </div>

    {{-- User Profile Dropdown --}}
    <div class="relative group">
        <button class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-50 transition focus:outline-none">
            <div class="text-right hidden md:block leading-tight">
                <p class="text-sm font-medium text-gray-800">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-500 capitalize">{{ Auth::user()->role }}</p>
            </div>
            <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}"
                class="w-9 h-9 rounded-full object-cover border border-gray-200 shadow-sm group-hover:scale-105 transition">
            <i data-lucide="chevron-down" class="w-4 h-4 text-gray-500"></i>
        </button>

        {{-- Dropdown --}}
        <div
            class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg border border-gray-100 
                   opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 
                   transform transition-all duration-200 origin-top-right">
            <div class="px-4 py-3 border-b border-gray-100">
                <p class="text-sm font-medium text-gray-800">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-500 capitalize">{{ Auth::user()->role }}</p>
            </div>
            <a href="{{ route('profile')}}"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-teal-50 hover:text-teal-600 transition">
                Profil Saya
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition">
                    Logout
                </button>
            </form>
        </div>
    </div>
</header>

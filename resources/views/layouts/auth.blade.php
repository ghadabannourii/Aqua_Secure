@extends('layouts.app')

@section('content')
<div class="min-h-screen relative overflow-hidden">
    <!-- Rain Effect -->
    <x-rain-effect :count="72" />
    
    <!-- Wave Background -->
    <x-wave-background />
    
    <!-- Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-b from-blue-950/40 via-transparent to-slate-950/70 pointer-events-none"></div>

    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 px-6 py-4 flex items-center justify-between">
        <a href="{{ route('landing') }}" class="flex items-center gap-3 group">
            <span class="w-10 h-10 rounded-xl bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center shadow-lg shadow-cyan-500/30 group-hover:scale-105 transition-transform">
                <i data-lucide="droplet" class="w-6 h-6 text-white"></i>
            </span>
            <span class="font-display text-xl font-bold text-white">AquaSecure</span>
        </a>
        <button onclick="toggleTheme()" class="glass p-2.5 rounded-xl text-cyan-200 hover:text-white transition-colors" aria-label="Changer de thème">
            <svg class="w-5 h-5 sun-icon hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            <svg class="w-5 h-5 moon-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
            </svg>
        </button>
    </nav>

    <!-- Main Content -->
    <main class="relative z-10 min-h-screen flex items-center justify-center px-4 py-28">
        @yield('auth-content')
    </main>
</div>

@push('scripts')
<script>
    // Update theme icons
    function updateThemeIcons() {
        const theme = document.documentElement.getAttribute('data-theme');
        const sunIcon = document.querySelector('.sun-icon');
        const moonIcon = document.querySelector('.moon-icon');
        
        if (theme === 'light') {
            sunIcon?.classList.remove('hidden');
            moonIcon?.classList.add('hidden');
        } else {
            sunIcon?.classList.add('hidden');
            moonIcon?.classList.remove('hidden');
        }
    }
    
    updateThemeIcons();
    
    // Override toggleTheme to update icons
    const originalToggleTheme = window.toggleTheme;
    window.toggleTheme = function() {
        originalToggleTheme();
        updateThemeIcons();
    };
</script>
@endpush
@endsection

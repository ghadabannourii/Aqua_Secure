@extends('layouts.app')

@section('content')
<div class="min-h-screen relative">
    <!-- Top Navigation -->
    <nav class="sticky top-0 z-50 glass-strong px-4 sm:px-6 py-3 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <a href="{{ route('landing') }}" class="glass p-2 rounded-lg text-cyan-200 hover:text-white transition-colors" aria-label="Retour à l'accueil">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center">
                    <i data-lucide="droplet" class="w-5 h-5 text-white"></i>
                </div>
                <span class="font-display font-bold text-white hidden sm:block">AquaSecure</span>
                <x-badge color="#3b82f6" class="hidden sm:inline-flex">Espace Gestionnaire</x-badge>
            </div>
        </div>
        <div class="flex items-center gap-2">
            <button onclick="toggleTheme()" class="glass p-2 rounded-lg text-cyan-200 hover:text-white transition-colors" aria-label="Changer de thème">
                <svg class="w-5 h-5 sun-icon hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                <svg class="w-5 h-5 moon-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                </svg>
            </button>
            
            @auth
            <button onclick="toggleProfileModal()" class="hidden sm:flex items-center gap-2 glass px-3 py-2 rounded-lg text-white/80 hover:text-white transition-colors">
                <span class="w-6 h-6 rounded-full bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center text-[10px] font-bold">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 2)) }}
                </span>
                <span class="text-xs font-semibold max-w-[120px] truncate">{{ auth()->user()->name ?? 'Admin' }}</span>
            </button>
            
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="glass p-2 rounded-lg text-cyan-200/70 hover:text-red-300 transition-colors" aria-label="Se déconnecter">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                </button>
            </form>
            @endauth
        </div>
    </nav>

    <!-- Tab Bar -->
    @hasSection('tabs')
    <div class="sticky top-[57px] z-40 glass px-4 py-2 flex gap-2 overflow-x-auto">
        @yield('tabs')
    </div>
    @endif

    <!-- Content -->
    <div class="px-4 sm:px-6 py-6 max-w-7xl mx-auto pb-8">
        @yield('manager-content')
    </div>
</div>

@push('scripts')
<script>
    // Update theme icons
    function updateThemeIcons() {
        const theme = document.documentElement.getAttribute('data-theme');
        document.querySelectorAll('.sun-icon').forEach(el => {
            theme === 'light' ? el.classList.remove('hidden') : el.classList.add('hidden');
        });
        document.querySelectorAll('.moon-icon').forEach(el => {
            theme === 'light' ? el.classList.add('hidden') : el.classList.remove('hidden');
        });
    }
    
    updateThemeIcons();
    
    const originalToggleTheme = window.toggleTheme;
    window.toggleTheme = function() {
        originalToggleTheme();
        updateThemeIcons();
    };

    // Profile modal toggle (placeholder)
    function toggleProfileModal() {
        showToast('Modal profil à implémenter', 'info');
    }
</script>
@endpush
@endsection

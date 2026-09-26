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
        <div class="flex items-center gap-3">
            <!-- Notifications -->
            <x-notification-center />
            
            <!-- User Menu -->
            <x-user-menu />
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

@extends('layouts.app')

@section('content')
<div class="min-h-screen flex" id="admin-shell">

    {{-- ═══════════════════════════════════════════
         SIDEBAR
    ═══════════════════════════════════════════ --}}
    <aside id="admin-sidebar"
           class="fixed inset-y-0 left-0 z-40 flex flex-col w-64 glass-strong border-r border-cyan-500/10
                  transition-transform duration-300 lg:translate-x-0 -translate-x-full"
           aria-label="Sidebar administration">

        {{-- Brand --}}
        <div class="flex items-center gap-3 px-5 py-4 border-b border-white/5 shrink-0">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center shrink-0">
                <i data-lucide="droplet" class="w-5 h-5 text-white"></i>
            </div>
            <div class="flex-1 min-w-0">
                <p class="font-display font-bold text-white text-sm leading-tight">AquaSecure</p>
                <p class="text-[10px] text-cyan-300/70 font-medium uppercase tracking-wider">Control Center</p>
            </div>
            {{-- Close (mobile) --}}
            <button onclick="closeSidebar()"
                    class="lg:hidden text-cyan-400 hover:text-white transition-colors"
                    aria-label="Fermer menu">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-1" aria-label="Navigation admin">

            <x-admin-nav-item route="admin.dashboard" icon="layout-dashboard" label="Tableau de bord" />

            <p class="px-3 pt-4 pb-1 text-[10px] font-semibold uppercase tracking-widest text-cyan-100/30">Gestion</p>
            <x-admin-nav-item route="admin.users.index" icon="users"     label="Utilisateurs" />
            <x-admin-nav-item route="admin.roles"       icon="shield"    label="Rôles & permissions" />
            <x-admin-nav-item route="manager.map"       icon="map-pin"   label="Carte réseau" />
            <x-admin-nav-item route="admin.logs"        icon="file-text" label="Historique" />

            <p class="px-3 pt-4 pb-1 text-[10px] font-semibold uppercase tracking-widest text-cyan-100/30">Compte</p>
            <x-admin-nav-item route="profile.show"        icon="user-circle" label="Mon profil" />
            <x-admin-nav-item route="settings.index"      icon="settings"    label="Paramètres" />
            <x-admin-nav-item route="notifications.index" icon="bell"        label="Notifications" />
        </nav>

        {{-- Footer: user card --}}
        <div class="px-3 py-3 border-t border-white/5 shrink-0">
            <a href="{{ route('profile.show') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-white/5 transition-colors group">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-cyan-500/30 to-blue-600/30 border border-cyan-400/20
                             flex items-center justify-center text-xs font-bold text-cyan-300 shrink-0">
                    AK
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-white text-xs font-semibold truncate">Amina Kacem</p>
                    <p class="text-cyan-100/40 text-[10px] truncate">Administrateur</p>
                </div>
                <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-cyan-100/30 group-hover:text-cyan-400 transition-colors shrink-0"></i>
            </a>
        </div>
    </aside>

    {{-- Sidebar overlay (mobile) --}}
    <div id="sidebar-overlay"
         class="fixed inset-0 z-30 bg-black/50 backdrop-blur-sm hidden lg:hidden"
         onclick="closeSidebar()"></div>

    {{-- ═══════════════════════════════════════════
         MAIN COLUMN
    ═══════════════════════════════════════════ --}}
    <div class="flex-1 flex flex-col min-w-0 lg:ml-64">

        {{-- ── TOPBAR ── --}}
        <header class="sticky top-0 z-30 glass-strong border-b border-white/5 px-4 sm:px-6 py-3
                        flex items-center gap-3">

            {{-- Mobile hamburger --}}
            <button onclick="openSidebar()"
                    class="lg:hidden glass p-2 rounded-lg text-cyan-300 hover:text-white transition-colors"
                    aria-label="Ouvrir le menu">
                <i data-lucide="menu" class="w-5 h-5"></i>
            </button>

            {{-- Page title slot --}}
            <div class="flex-1 min-w-0">
                <h1 class="text-white font-display font-bold text-base sm:text-lg leading-tight truncate">
                    @yield('page-title', 'Administration')
                </h1>
                <p class="text-cyan-100/50 text-xs truncate hidden sm:block">
                    @yield('page-subtitle', 'Vue globale de la plateforme AquaSecure')
                </p>
            </div>

            {{-- Theme toggle --}}
            <button onclick="toggleTheme()"
                    class="glass p-2 rounded-lg text-cyan-300 hover:text-white transition-colors"
                    aria-label="Changer le thème">
                <i data-lucide="sun"  class="w-4 h-4 sun-icon  hidden"></i>
                <i data-lucide="moon" class="w-4 h-4 moon-icon"></i>
            </button>

            {{-- Notifications --}}
            <x-notification-center />

            {{-- Admin user menu --}}
            <x-user-menu />
        </header>

        {{-- ── PAGE CONTENT ── --}}
        <main class="flex-1 overflow-x-hidden p-4 sm:p-6 pb-10">
            @yield('admin-content')
        </main>
    </div>
</div>

@push('scripts')
<script>
/* ── Sidebar toggle ── */
function openSidebar() {
    document.getElementById('admin-sidebar').classList.remove('-translate-x-full');
    document.getElementById('sidebar-overlay').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}
function closeSidebar() {
    document.getElementById('admin-sidebar').classList.add('-translate-x-full');
    document.getElementById('sidebar-overlay').classList.add('hidden');
    document.body.style.overflow = '';
}

/* ── Theme icons ── */
function updateThemeIcons() {
    const isLight = document.documentElement.getAttribute('data-theme') === 'light';
    document.querySelectorAll('.sun-icon').forEach(el =>
        isLight ? el.classList.remove('hidden') : el.classList.add('hidden'));
    document.querySelectorAll('.moon-icon').forEach(el =>
        isLight ? el.classList.add('hidden') : el.classList.remove('hidden'));
}
updateThemeIcons();
const _origToggle = window.toggleTheme;
window.toggleTheme = function() { _origToggle?.(); updateThemeIcons(); };
</script>
@endpush
@endsection

@extends('layouts.manager')

@section('title', 'Tableau de bord Technicien')

@php
    use App\Data\PlaceholderData;
    $zones = PlaceholderData::zones();
    $stats = PlaceholderData::stats();
    $user = session('user', ['name' => 'Technicien', 'role' => 'technician']);
@endphp

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-3">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-teal-500/20 to-cyan-600/20 border border-teal-400/25 flex items-center justify-center">
                    <i data-lucide="hard-hat" class="w-7 h-7 text-teal-300"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-display font-bold text-white">Espace Technicien</h1>
                    <p class="text-cyan-100/60 text-sm mt-1">{{ $user['name'] }} - Interventions terrain</p>
                </div>
            </div>
            <x-ripple-button size="md" onclick="showToast('Rapport genere', 'success')">
                <i data-lucide="file-text" class="w-4 h-4"></i>
                Nouveau rapport
            </x-ripple-button>
        </div>
        <p class="text-cyan-100/70 max-w-3xl">
            Gestion de vos interventions, assignations et rapport quotidien.
        </p>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="glass p-5 rounded-2xl hover-lift">
            <div class="flex items-start justify-between mb-3">
                <div class="w-12 h-12 rounded-xl bg-orange-500/10 flex items-center justify-center">
                    <i data-lucide="clipboard-list" class="w-6 h-6 text-orange-400"></i>
                </div>
                <span class="text-xs font-semibold text-teal-400">+2</span>
            </div>
            <div class="text-2xl font-display font-bold text-white mb-1">5</div>
            <div class="text-xs text-cyan-100/60">Interventions assignées</div>
        </div>
        
        <div class="glass p-5 rounded-2xl hover-lift">
            <div class="flex items-start justify-between mb-3">
                <div class="w-12 h-12 rounded-xl bg-teal-500/10 flex items-center justify-center">
                    <i data-lucide="check-circle" class="w-6 h-6 text-teal-400"></i>
                </div>
                <span class="text-xs font-semibold text-teal-400">+5</span>
            </div>
            <div class="text-2xl font-display font-bold text-white mb-1">23</div>
            <div class="text-xs text-cyan-100/60">Interventions complétées</div>
        </div>
        
        <div class="glass p-5 rounded-2xl hover-lift">
            <div class="flex items-start justify-between mb-3">
                <div class="w-12 h-12 rounded-xl bg-cyan-500/10 flex items-center justify-center">
                    <i data-lucide="clock" class="w-6 h-6 text-cyan-400"></i>
                </div>
                <span class="text-xs font-semibold text-teal-400">-15min</span>
            </div>
            <div class="text-2xl font-display font-bold text-white mb-1">2.1h</div>
            <div class="text-xs text-cyan-100/60">Temps moyen</div>
        </div>
        
        <div class="glass p-5 rounded-2xl hover-lift">
            <div class="flex items-start justify-between mb-3">
                <div class="w-12 h-12 rounded-xl bg-blue-500/10 flex items-center justify-center">
                    <i data-lucide="map-pin" class="w-6 h-6 text-blue-400"></i>
                </div>
            </div>
            <div class="text-2xl font-display font-bold text-white mb-1">Tunis Nord</div>
            <div class="text-xs text-cyan-100/60">Zone actuelle</div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="grid lg:grid-cols-3 gap-6">
        <!-- Interventions Column -->
        <div class="lg:col-span-2 space-y-6">
            <div class="glass-strong p-6 rounded-2xl">
                <h3 class="text-xl font-display font-bold text-white mb-4 flex items-center gap-2">
                    <i data-lucide="clipboard-list" class="w-5 h-5 text-orange-400"></i>
                    Mes interventions du jour
                </h3>
                <div class="space-y-3">
                    <!-- Intervention 1 -->
                    <div class="glass p-5 rounded-xl hover-lift">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="text-sm font-mono font-semibold text-cyan-300">#INT-089</span>
                                    <x-badge color="#ef4444">Urgent</x-badge>
                                    <x-badge color="#f97316">En cours</x-badge>
                                </div>
                                <h4 class="text-white font-semibold mb-1">Réparation fuite</h4>
                                <p class="text-cyan-100/60 text-sm">
                                    <i data-lucide="map-pin" class="w-3.5 h-3.5 inline"></i>
                                    Tunis Nord - Rue Habib Bourguiba
                                </p>
                                <p class="text-cyan-100/50 text-xs mt-1">
                                    <i data-lucide="clock" class="w-3.5 h-3.5 inline"></i>
                                    09:00
                                </p>
                            </div>
                            <div class="flex gap-2">
                                <button class="glass p-2 rounded-lg text-cyan-300 hover:text-white transition-colors">
                                    <i data-lucide="play" class="w-4 h-4"></i>
                                </button>
                                <button class="glass p-2 rounded-lg text-cyan-300 hover:text-white transition-colors">
                                    <i data-lucide="info" class="w-4 h-4"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Intervention 2 -->
                    <div class="glass p-5 rounded-xl hover-lift">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="text-sm font-mono font-semibold text-cyan-300">#INT-091</span>
                                    <x-badge color="#06b6d4">Normal</x-badge>
                                    <x-badge color="#06b6d4">Assignée</x-badge>
                                </div>
                                <h4 class="text-white font-semibold mb-1">Inspection capteurs</h4>
                                <p class="text-cyan-100/60 text-sm">
                                    <i data-lucide="map-pin" class="w-3.5 h-3.5 inline"></i>
                                    Ariana - Avenue de la République
                                </p>
                                <p class="text-cyan-100/50 text-xs mt-1">
                                    <i data-lucide="clock" class="w-3.5 h-3.5 inline"></i>
                                    11:30
                                </p>
                            </div>
                            <div class="flex gap-2">
                                <button class="glass p-2 rounded-lg text-cyan-300 hover:text-white transition-colors">
                                    <i data-lucide="play" class="w-4 h-4"></i>
                                </button>
                                <button class="glass p-2 rounded-lg text-cyan-300 hover:text-white transition-colors">
                                    <i data-lucide="info" class="w-4 h-4"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Intervention 3 -->
                    <div class="glass p-5 rounded-xl hover-lift">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="text-sm font-mono font-semibold text-cyan-300">#INT-092</span>
                                    <x-badge color="#3b82f6">Faible</x-badge>
                                    <x-badge color="#3b82f6">Planifiée</x-badge>
                                </div>
                                <h4 class="text-white font-semibold mb-1">Maintenance préventive</h4>
                                <p class="text-cyan-100/60 text-sm">
                                    <i data-lucide="map-pin" class="w-3.5 h-3.5 inline"></i>
                                    Tunis Sud - Boulevard du 7 Novembre
                                </p>
                                <p class="text-cyan-100/50 text-xs mt-1">
                                    <i data-lucide="clock" class="w-3.5 h-3.5 inline"></i>
                                    14:00
                                </p>
                            </div>
                            <div class="flex gap-2">
                                <button class="glass p-2 rounded-lg text-cyan-300 hover:text-white transition-colors">
                                    <i data-lucide="play" class="w-4 h-4"></i>
                                </button>
                                <button class="glass p-2 rounded-lg text-cyan-300 hover:text-white transition-colors">
                                    <i data-lucide="info" class="w-4 h-4"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Historique -->
            <div class="glass-strong p-6 rounded-2xl">
                <h3 class="text-lg font-display font-bold text-white mb-4 flex items-center gap-2">
                    <i data-lucide="history" class="w-5 h-5 text-teal-400"></i>
                    Interventions complétées cette semaine
                </h3>
                <div class="space-y-2">
                    <div class="glass p-4 rounded-lg flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-teal-500/10 flex items-center justify-center">
                                <i data-lucide="check" class="w-4 h-4 text-teal-400"></i>
                            </div>
                            <div>
                                <h5 class="text-white text-sm font-semibold">Réparation vanne</h5>
                                <p class="text-cyan-100/50 text-xs">Sfax Centre - Hier 14:30</p>
                            </div>
                        </div>
                        <span class="text-xs text-cyan-100/60">1h 45min</span>
                    </div>

                    <div class="glass p-4 rounded-lg flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-teal-500/10 flex items-center justify-center">
                                <i data-lucide="check" class="w-4 h-4 text-teal-400"></i>
                            </div>
                            <div>
                                <h5 class="text-white text-sm font-semibold">Inspection qualité eau</h5>
                                <p class="text-cyan-100/50 text-xs">Sousse Nord - 23 sept 10:15</p>
                            </div>
                        </div>
                        <span class="text-xs text-cyan-100/60">2h 10min</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Équipement -->
            <div class="glass-strong p-6 rounded-2xl">
                <h3 class="text-lg font-display font-bold text-white mb-4 flex items-center gap-2">
                    <i data-lucide="wrench" class="w-5 h-5 text-blue-400"></i>
                    Mon équipement
                </h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between py-2 border-b border-white/5">
                        <span class="text-sm text-cyan-100/80">Kit réparation</span>
                        <x-badge color="#14b8a6">OK</x-badge>
                    </div>
                    <div class="flex items-center justify-between py-2 border-b border-white/5">
                        <span class="text-sm text-cyan-100/80">Détecteur fuite</span>
                        <x-badge color="#14b8a6">OK</x-badge>
                    </div>
                    <div class="flex items-center justify-between py-2 border-b border-white/5">
                        <span class="text-sm text-cyan-100/80">Multimètre</span>
                        <x-badge color="#14b8a6">OK</x-badge>
                    </div>
                    <div class="flex items-center justify-between py-2 border-b border-white/5">
                        <span class="text-sm text-cyan-100/80">Vanne 3/4"</span>
                        <x-badge color="#f97316">Stock faible</x-badge>
                    </div>
                </div>
            </div>

            <!-- Zones -->
            <div class="glass-strong p-6 rounded-2xl">
                <h3 class="text-lg font-display font-bold text-white mb-4 flex items-center gap-2">
                    <i data-lucide="map" class="w-5 h-5 text-cyan-400"></i>
                    Mes zones
                </h3>
                <div class="space-y-2">
                    <div class="glass p-3 rounded-lg flex items-center gap-2">
                        <i data-lucide="map-pin" class="w-4 h-4 text-cyan-400"></i>
                        <span class="text-sm text-white">Tunis Nord</span>
                    </div>
                    <div class="glass p-3 rounded-lg flex items-center gap-2">
                        <i data-lucide="map-pin" class="w-4 h-4 text-cyan-400"></i>
                        <span class="text-sm text-white">Ariana</span>
                    </div>
                    <div class="glass p-3 rounded-lg flex items-center gap-2">
                        <i data-lucide="map-pin" class="w-4 h-4 text-cyan-400"></i>
                        <span class="text-sm text-white">Tunis Sud</span>
                    </div>
                </div>
            </div>

            <!-- Contact urgence -->
            <div class="glass-strong p-6 rounded-2xl">
                <h3 class="text-lg font-display font-bold text-white mb-4 flex items-center gap-2">
                    <i data-lucide="phone" class="w-5 h-5 text-red-400"></i>
                    Contact urgence
                </h3>
                <x-ripple-button size="md" class="w-full" onclick="showToast('Appel dispatching', 'info')">
                    <i data-lucide="phone-call" class="w-4 h-4"></i>
                    Appeler le dispatching
                </x-ripple-button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
</script>
@endpush
@endsection

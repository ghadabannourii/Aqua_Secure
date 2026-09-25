@extends('layouts.manager')

@section('title', 'Tableau de bord Gestionnaire')

@php
    use App\Data\PlaceholderData;
    $zones = PlaceholderData::zones();
    $stats = PlaceholderData::stats();
    $user = session('user', ['name' => 'Gestionnaire', 'role' => 'manager']);
@endphp

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-3">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-cyan-500/20 to-blue-600/20 border border-cyan-400/25 flex items-center justify-center">
                    <i data-lucide="droplet" class="w-7 h-7 text-cyan-300"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-display font-bold text-white">Centre de gestion</h1>
                    <p class="text-cyan-100/60 text-sm mt-1">{{ ucfirst($user['role']) }} • {{ $user['name'] }}</p>
                </div>
            </div>
            <x-ripple-button size="md" onclick="showToast('Export des données en cours...', 'info')">
                <i data-lucide="download" class="w-4 h-4"></i>
                Exporter
            </x-ripple-button>
        </div>
        <p class="text-cyan-100/70 max-w-3xl">
            Vue d'ensemble du réseau national, gestion des interventions et supervision des équipes terrain.
        </p>
    </div>

    <!-- Key Metrics -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        @foreach([
            ['icon' => 'droplet', 'value' => $stats['totalZones'], 'label' => 'Zones surveillées', 'trend' => '+2', 'color' => 'cyan'],
            ['icon' => 'alert-circle', 'value' => $stats['activeIncidents'], 'label' => 'Incidents actifs', 'trend' => '-5', 'color' => 'orange'],
            ['icon' => 'users', 'value' => '47', 'label' => 'Techniciens actifs', 'trend' => '+3', 'color' => 'teal'],
            ['icon' => 'activity', 'value' => '94%', 'label' => 'Taux disponibilité', 'trend' => '+1%', 'color' => 'blue'],
        ] as $metric)
        <div class="glass p-5 rounded-2xl hover-lift">
            <div class="flex items-start justify-between mb-3">
                <div class="w-12 h-12 rounded-xl bg-{{ $metric['color'] }}-500/10 flex items-center justify-center">
                    <i data-lucide="{{ $metric['icon'] }}" class="w-6 h-6 text-{{ $metric['color'] }}-400"></i>
                </div>
                <span class="text-xs font-semibold {{ strpos($metric['trend'], '+') === 0 ? 'text-teal-400' : 'text-red-400' }}">
                    {{ $metric['trend'] }}
                </span>
            </div>
            <div class="text-2xl font-display font-bold text-white mb-1">{{ $metric['value'] }}</div>
            <div class="text-xs text-cyan-100/60">{{ $metric['label'] }}</div>
        </div>
        @endforeach
    </div>

    <!-- Main Content Tabs -->
    <div class="glass-strong rounded-2xl overflow-hidden">
        <!-- Tab Navigation -->
        <div class="border-b border-white/5">
            <nav class="flex overflow-x-auto">
                @foreach([
                    ['id' => 'overview', 'icon' => 'layout-grid', 'label' => 'Vue d\'ensemble'],
                    ['id' => 'map', 'icon' => 'map', 'label' => 'Carte réseau'],
                    ['id' => 'reports', 'icon' => 'file-text', 'label' => 'Rapports'],
                    ['id' => 'projects', 'icon' => 'briefcase', 'label' => 'Projets'],
                    ['id' => 'stats', 'icon' => 'bar-chart', 'label' => 'Statistiques'],
                ] as $index => $tab)
                <button 
                    onclick="switchTab('{{ $tab['id'] }}')" 
                    class="tab-btn flex items-center gap-2 px-6 py-4 text-sm font-semibold border-b-2 transition-all whitespace-nowrap {{ $index === 0 ? 'border-cyan-400 text-white' : 'border-transparent text-cyan-100/50 hover:text-cyan-100/80' }}"
                    data-tab="{{ $tab['id'] }}"
                >
                    <i data-lucide="{{ $tab['icon'] }}" class="w-4 h-4"></i>
                    <span>{{ $tab['label'] }}</span>
                </button>
                @endforeach
            </nav>
        </div>

        <!-- Tab Content -->
        <div class="p-6">
            <!-- Overview Tab -->
            <div id="tab-overview" class="tab-content">
                <div class="grid lg:grid-cols-2 gap-6">
                    <!-- Recent Incidents -->
                    <div>
                        <h3 class="text-lg font-display font-bold text-white mb-4 flex items-center gap-2">
                            <i data-lucide="alert-triangle" class="w-5 h-5 text-orange-400"></i>
                            Incidents récents
                        </h3>
                        <div class="space-y-3">
                            @foreach([
                                ['id' => '#INC-2026-089', 'type' => 'Fuite majeure', 'zone' => 'Tunis Nord', 'priority' => 'Élevée', 'time' => '15 min', 'priorityColor' => 'red'],
                                ['id' => '#INC-2026-088', 'type' => 'Qualité dégradée', 'zone' => 'Sfax Centre', 'priority' => 'Moyenne', 'time' => '1h 20min', 'priorityColor' => 'orange'],
                                ['id' => '#INC-2026-087', 'type' => 'Pression basse', 'zone' => 'Sousse Nord', 'priority' => 'Faible', 'time' => '2h', 'priorityColor' => 'cyan'],
                            ] as $incident)
                            <div class="glass p-4 rounded-xl hover-lift">
                                <div class="flex items-start justify-between mb-2">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-1">
                                            <span class="text-sm font-mono font-semibold text-cyan-300">{{ $incident['id'] }}</span>
                                            <x-badge color="#{{ $incident['priorityColor'] === 'red' ? 'ef4444' : ($incident['priorityColor'] === 'orange' ? 'f97316' : '06b6d4') }}">
                                                {{ $incident['priority'] }}
                                            </x-badge>
                                        </div>
                                        <h4 class="text-white font-semibold text-sm">{{ $incident['type'] }}</h4>
                                        <p class="text-cyan-100/60 text-xs mt-1">{{ $incident['zone'] }} • Il y a {{ $incident['time'] }}</p>
                                    </div>
                                    <button class="text-cyan-300 hover:text-cyan-200 transition-colors">
                                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Active Teams -->
                    <div>
                        <h3 class="text-lg font-display font-bold text-white mb-4 flex items-center gap-2">
                            <i data-lucide="users" class="w-5 h-5 text-teal-400"></i>
                            Équipes sur le terrain
                        </h3>
                        <div class="space-y-3">
                            @foreach([
                                ['name' => 'Équipe Alpha', 'tech' => 'Amira Ben Ali', 'zone' => 'Tunis Nord', 'status' => 'En intervention', 'statusColor' => 'orange'],
                                ['name' => 'Équipe Beta', 'tech' => 'Mohamed Touati', 'zone' => 'Ariana', 'status' => 'En route', 'statusColor' => 'cyan'],
                                ['name' => 'Équipe Gamma', 'tech' => 'Salma Khelifi', 'zone' => 'Sfax Centre', 'status' => 'Disponible', 'statusColor' => 'teal'],
                            ] as $team)
                            <div class="glass p-4 rounded-xl hover-lift">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-cyan-500/20 to-blue-600/20 flex items-center justify-center">
                                            <i data-lucide="hard-hat" class="w-5 h-5 text-cyan-300"></i>
                                        </div>
                                        <div>
                                            <h4 class="text-white font-semibold text-sm">{{ $team['name'] }}</h4>
                                            <p class="text-cyan-100/60 text-xs">{{ $team['tech'] }} • {{ $team['zone'] }}</p>
                                        </div>
                                    </div>
                                    <x-badge color="#{{ $team['statusColor'] === 'orange' ? 'f97316' : ($team['statusColor'] === 'cyan' ? '06b6d4' : '14b8a6') }}">
                                        {{ $team['status'] }}
                                    </x-badge>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Zone Status Grid -->
                <div class="mt-8">
                    <h3 class="text-lg font-display font-bold text-white mb-4 flex items-center gap-2">
                        <i data-lucide="grid" class="w-5 h-5 text-cyan-400"></i>
                        État des zones
                    </h3>
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
                        @foreach($zones as $zone)
                        <div class="glass p-4 rounded-xl hover-lift cursor-pointer" style="border-color: {{ $zone['color'] }}40">
                            <div class="flex items-center justify-between mb-2">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background-color: {{ $zone['color'] }}20">
                                    <i data-lucide="droplet" class="w-4 h-4" style="color: {{ $zone['color'] }}"></i>
                                </div>
                                <span class="text-xl">{{ $zone['emoji'] }}</span>
                            </div>
                            <h4 class="text-white font-semibold text-sm mb-1">{{ $zone['name'] }}</h4>
                            <div class="flex items-center gap-2">
                                <div class="flex-1 h-1.5 bg-slate-950/50 rounded-full overflow-hidden">
                                    <div class="h-full rounded-full" style="width: {{ $zone['quality'] }}%; background-color: {{ $zone['color'] }}"></div>
                                </div>
                                <span class="text-xs font-semibold" style="color: {{ $zone['color'] }}">{{ $zone['quality'] }}%</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Map Tab -->
            <div id="tab-map" class="tab-content hidden">
                <h3 class="text-xl font-display font-bold text-white mb-4">Carte interactive du réseau</h3>
                <div class="glass p-8 rounded-xl text-center">
                    <i data-lucide="map-pin" class="w-16 h-16 text-cyan-400 mx-auto mb-4"></i>
                    <p class="text-cyan-100/60">Carte interactive du réseau national (à venir)</p>
                    <p class="text-cyan-100/40 text-sm mt-2">Cette fonctionnalité sera disponible avec l'intégration backend</p>
                </div>
            </div>

            <!-- Reports Tab -->
            <div id="tab-reports" class="tab-content hidden">
                <h3 class="text-xl font-display font-bold text-white mb-4">Rapports et analyses</h3>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach([
                        ['icon' => 'file-bar-chart', 'title' => 'Rapport mensuel', 'desc' => 'Septembre 2026', 'color' => 'cyan'],
                        ['icon' => 'trending-up', 'title' => 'Analyse tendances', 'desc' => 'Derniers 90 jours', 'color' => 'teal'],
                        ['icon' => 'clock', 'title' => 'Temps intervention', 'desc' => 'Performance équipes', 'color' => 'blue'],
                        ['icon' => 'droplet', 'title' => 'Qualité de l\'eau', 'desc' => 'Tests laboratoire', 'color' => 'cyan'],
                        ['icon' => 'alert-circle', 'title' => 'Incidents', 'desc' => 'Analyse par type', 'color' => 'orange'],
                        ['icon' => 'users', 'title' => 'Satisfaction', 'desc' => 'Enquêtes citoyens', 'color' => 'teal'],
                    ] as $report)
                    <button class="glass p-5 rounded-xl hover-lift text-left transition-all hover:border-{{ $report['color'] }}-400/40">
                        <div class="w-12 h-12 rounded-xl bg-{{ $report['color'] }}-500/10 flex items-center justify-center mb-3">
                            <i data-lucide="{{ $report['icon'] }}" class="w-6 h-6 text-{{ $report['color'] }}-400"></i>
                        </div>
                        <h4 class="text-white font-semibold mb-1">{{ $report['title'] }}</h4>
                        <p class="text-cyan-100/60 text-sm">{{ $report['desc'] }}</p>
                    </button>
                    @endforeach
                </div>
            </div>

            <!-- Projects Tab -->
            <div id="tab-projects" class="tab-content hidden">
                <h3 class="text-xl font-display font-bold text-white mb-4">Projets en cours</h3>
                <div class="space-y-4">
                    @foreach([
                        ['name' => 'Extension réseau Tunis Nord', 'progress' => 67, 'deadline' => '15 nov 2026', 'team' => '8 personnes', 'status' => 'En cours'],
                        ['name' => 'Modernisation capteurs Sfax', 'progress' => 34, 'deadline' => '30 déc 2026', 'team' => '5 personnes', 'status' => 'En cours'],
                        ['name' => 'Audit qualité Sousse', 'progress' => 89, 'deadline' => '05 oct 2026', 'team' => '3 personnes', 'status' => 'Finalisation'],
                    ] as $project)
                    <div class="glass p-5 rounded-xl hover-lift">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h4 class="text-white font-semibold mb-2">{{ $project['name'] }}</h4>
                                <div class="flex items-center gap-4 text-xs text-cyan-100/60">
                                    <span class="flex items-center gap-1">
                                        <i data-lucide="calendar" class="w-3.5 h-3.5"></i>
                                        {{ $project['deadline'] }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <i data-lucide="users" class="w-3.5 h-3.5"></i>
                                        {{ $project['team'] }}
                                    </span>
                                </div>
                            </div>
                            <x-badge color="#06b6d4">{{ $project['status'] }}</x-badge>
                        </div>
                        <div class="space-y-2">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-cyan-100/70">Progression</span>
                                <span class="text-white font-semibold">{{ $project['progress'] }}%</span>
                            </div>
                            <div class="h-2 bg-slate-950/50 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-cyan-500 to-blue-600 rounded-full transition-all" style="width: {{ $project['progress'] }}%"></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Stats Tab -->
            <div id="tab-stats" class="tab-content hidden">
                <h3 class="text-xl font-display font-bold text-white mb-4">Statistiques détaillées</h3>
                <div class="glass p-8 rounded-xl text-center">
                    <i data-lucide="bar-chart-2" class="w-16 h-16 text-cyan-400 mx-auto mb-4"></i>
                    <p class="text-cyan-100/60">Graphiques et statistiques avancées</p>
                    <p class="text-cyan-100/40 text-sm mt-2">Les composants Chart.js seront intégrés dans la prochaine phase</p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function switchTab(tabId) {
        // Hide all tabs
        document.querySelectorAll('.tab-content').forEach(tab => {
            tab.classList.add('hidden');
        });
        
        // Remove active state from all buttons
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('border-cyan-400', 'text-white');
            btn.classList.add('border-transparent', 'text-cyan-100/50');
        });
        
        // Show selected tab
        document.getElementById('tab-' + tabId).classList.remove('hidden');
        
        // Add active state to clicked button
        const activeBtn = document.querySelector('[data-tab="' + tabId + '"]');
        activeBtn.classList.add('border-cyan-400', 'text-white');
        activeBtn.classList.remove('border-transparent', 'text-cyan-100/50');
        
        // Reinitialize Lucide icons for newly shown content
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    }
</script>
@endpush
@endsection

@extends('layouts.frontoffice')

@section('title', 'Tableau de bord')

@php
    use App\Data\PlaceholderData;
    $zones = PlaceholderData::zones();
    $user = session('user', ['name' => 'Utilisateur', 'email' => 'user@example.com']);
@endphp

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Welcome Header -->
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-cyan-500/20 to-blue-600/20 border border-cyan-400/25 flex items-center justify-center">
                <i data-lucide="droplet" class="w-7 h-7 text-cyan-300"></i>
            </div>
            <div>
                <h1 class="text-3xl font-display font-bold text-white">Bienvenue, {{ explode(' ', $user['name'])[0] }} 👋</h1>
                <p class="text-cyan-100/60 text-sm mt-1">{{ $user['email'] }}</p>
            </div>
        </div>
        <p class="text-cyan-100/70 max-w-3xl">
            Gérez vos déclarations, suivez l'état du réseau et restez informé des interventions dans votre zone.
        </p>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        @foreach([
            ['icon' => 'alert-circle', 'value' => '3', 'label' => 'Déclarations actives', 'color' => 'orange'],
            ['icon' => 'check-circle', 'value' => '12', 'label' => 'Problèmes résolus', 'color' => 'teal'],
            ['icon' => 'clock', 'value' => '48h', 'label' => 'Temps moyen réponse', 'color' => 'cyan'],
            ['icon' => 'bell', 'value' => '5', 'label' => 'Notifications non lues', 'color' => 'blue'],
        ] as $stat)
        <div class="glass p-5 rounded-2xl hover-lift">
            <div class="flex items-start justify-between mb-3">
                <div class="w-12 h-12 rounded-xl bg-{{ $stat['color'] }}-500/10 flex items-center justify-center">
                    <i data-lucide="{{ $stat['icon'] }}" class="w-6 h-6 text-{{ $stat['color'] }}-400"></i>
                </div>
            </div>
            <div class="text-2xl font-display font-bold text-white mb-1">{{ $stat['value'] }}</div>
            <div class="text-xs text-cyan-100/60">{{ $stat['label'] }}</div>
        </div>
        @endforeach
    </div>

    <!-- Main Content Tabs -->
    <div class="glass-strong rounded-2xl overflow-hidden">
        <!-- Tab Navigation -->
        <div class="border-b border-white/5">
            <nav class="flex overflow-x-auto">
                @foreach([
                    ['id' => 'report', 'icon' => 'alert-triangle', 'label' => 'Déclarer un problème'],
                    ['id' => 'track', 'icon' => 'list-checks', 'label' => 'Mes déclarations'],
                    ['id' => 'notify', 'icon' => 'bell', 'label' => 'Notifications'],
                    ['id' => 'finance', 'icon' => 'credit-card', 'label' => 'Mes factures'],
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
            <!-- Report Problem Tab -->
            <div id="tab-report" class="tab-content">
                <div class="max-w-2xl">
                    <h3 class="text-xl font-display font-bold text-white mb-4">Signaler un nouveau problème</h3>
                    <p class="text-cyan-100/60 mb-6">Aidez-nous à maintenir la qualité du service en signalant tout problème constaté sur le réseau.</p>
                    
                    <form class="space-y-5">
                        <div>
                            <label class="text-xs font-semibold text-cyan-100/70 mb-2 block">Type de problème</label>
                            <select class="w-full bg-slate-950/35 border border-cyan-400/15 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-cyan-400/50">
                                <option>Fuite d'eau</option>
                                <option>Qualité de l'eau</option>
                                <option>Pression insuffisante</option>
                                <option>Coupure d'eau</option>
                                <option>Autre</option>
                            </select>
                        </div>

                        <div>
                            <label class="text-xs font-semibold text-cyan-100/70 mb-2 block">Zone concernée</label>
                            <select class="w-full bg-slate-950/35 border border-cyan-400/15 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-cyan-400/50">
                                @foreach($zones as $zone)
                                <option value="{{ $zone['id'] }}">{{ $zone['name'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="text-xs font-semibold text-cyan-100/70 mb-2 block">Description</label>
                            <textarea rows="4" placeholder="Décrivez le problème en détail..." class="w-full bg-slate-950/35 border border-cyan-400/15 rounded-xl px-4 py-3 text-sm text-white placeholder:text-cyan-100/30 focus:outline-none focus:border-cyan-400/50 resize-none"></textarea>
                        </div>

                        <div>
                            <label class="text-xs font-semibold text-cyan-100/70 mb-2 block">Urgence</label>
                            <div class="grid grid-cols-3 gap-3">
                                @foreach([
                                    ['value' => 'low', 'label' => 'Faible', 'color' => 'teal'],
                                    ['value' => 'medium', 'label' => 'Moyenne', 'color' => 'orange'],
                                    ['value' => 'high', 'label' => 'Élevée', 'color' => 'red'],
                                ] as $priority)
                                <label class="glass p-3 rounded-xl cursor-pointer hover:border-{{ $priority['color'] }}-400/40 transition-all">
                                    <input type="radio" name="priority" value="{{ $priority['value'] }}" class="sr-only peer">
                                    <div class="text-center peer-checked:text-{{ $priority['color'] }}-400 text-cyan-100/50">
                                        <div class="text-sm font-semibold">{{ $priority['label'] }}</div>
                                    </div>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <x-ripple-button type="button" size="lg" onclick="showToast('Déclaration envoyée avec succès', 'success')">
                            <i data-lucide="send" class="w-4 h-4"></i>
                            Envoyer la déclaration
                        </x-ripple-button>
                    </form>
                </div>
            </div>

            <!-- Track Declarations Tab -->
            <div id="tab-track" class="tab-content hidden">
                <h3 class="text-xl font-display font-bold text-white mb-4">Mes déclarations</h3>
                <div class="space-y-3">
                    @foreach([
                        ['id' => '#2024-001', 'type' => 'Fuite d\'eau', 'zone' => 'Tunis Nord', 'status' => 'En cours', 'date' => '23 sept 2026', 'statusColor' => 'orange'],
                        ['id' => '#2024-002', 'type' => 'Qualité eau', 'zone' => 'Sfax Centre', 'status' => 'Résolu', 'date' => '20 sept 2026', 'statusColor' => 'teal'],
                        ['id' => '#2024-003', 'type' => 'Pression faible', 'zone' => 'Tunis Nord', 'status' => 'Assigné', 'date' => '18 sept 2026', 'statusColor' => 'cyan'],
                    ] as $declaration)
                    <div class="glass p-5 rounded-xl hover-lift">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="text-sm font-mono font-semibold text-cyan-300">{{ $declaration['id'] }}</span>
                                    <x-badge color="#{{ $declaration['statusColor'] === 'orange' ? 'f97316' : ($declaration['statusColor'] === 'teal' ? '14b8a6' : '06b6d4') }}">
                                        {{ $declaration['status'] }}
                                    </x-badge>
                                </div>
                                <h4 class="text-white font-semibold mb-1">{{ $declaration['type'] }}</h4>
                                <p class="text-cyan-100/60 text-sm">Zone : {{ $declaration['zone'] }} • {{ $declaration['date'] }}</p>
                            </div>
                            <button class="text-cyan-300 hover:text-cyan-200 transition-colors">
                                <i data-lucide="chevron-right" class="w-5 h-5"></i>
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Notifications Tab -->
            <div id="tab-notify" class="tab-content hidden">
                <h3 class="text-xl font-display font-bold text-white mb-4">Notifications récentes</h3>
                <div class="space-y-3">
                    @foreach([
                        ['icon' => 'check-circle', 'color' => 'teal', 'title' => 'Problème résolu', 'message' => 'Votre déclaration #2024-002 a été résolue', 'time' => 'Il y a 2h'],
                        ['icon' => 'alert-triangle', 'color' => 'orange', 'title' => 'Coupure planifiée', 'message' => 'Intervention prévue demain 8h-12h dans votre zone', 'time' => 'Il y a 5h'],
                        ['icon' => 'droplet', 'color' => 'cyan', 'title' => 'Qualité excellente', 'message' => 'Les derniers tests montrent une qualité optimale', 'time' => 'Hier'],
                    ] as $notification)
                    <div class="glass p-5 rounded-xl hover-lift">
                        <div class="flex gap-4">
                            <div class="w-12 h-12 rounded-xl bg-{{ $notification['color'] }}-500/10 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="{{ $notification['icon'] }}" class="w-6 h-6 text-{{ $notification['color'] }}-400"></i>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-white font-semibold mb-1">{{ $notification['title'] }}</h4>
                                <p class="text-cyan-100/60 text-sm mb-2">{{ $notification['message'] }}</p>
                                <p class="text-cyan-100/40 text-xs">{{ $notification['time'] }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Finance Tab -->
            <div id="tab-finance" class="tab-content hidden">
                <h3 class="text-xl font-display font-bold text-white mb-4">Factures et paiements</h3>
                <div class="space-y-3">
                    @foreach([
                        ['period' => 'Septembre 2026', 'amount' => '45.50 TND', 'status' => 'Payée', 'date' => '01 sept 2026', 'statusColor' => 'teal'],
                        ['period' => 'Août 2026', 'amount' => '42.30 TND', 'status' => 'Payée', 'date' => '01 août 2026', 'statusColor' => 'teal'],
                        ['period' => 'Juillet 2026', 'amount' => '48.90 TND', 'status' => 'Payée', 'date' => '01 juil 2026', 'statusColor' => 'teal'],
                    ] as $invoice)
                    <div class="glass p-5 rounded-xl hover-lift">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-cyan-500/10 flex items-center justify-center">
                                    <i data-lucide="file-text" class="w-6 h-6 text-cyan-400"></i>
                                </div>
                                <div>
                                    <h4 class="text-white font-semibold">{{ $invoice['period'] }}</h4>
                                    <p class="text-cyan-100/60 text-sm">{{ $invoice['date'] }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <div class="text-right">
                                    <div class="text-white font-bold">{{ $invoice['amount'] }}</div>
                                    <x-badge color="#14b8a6">{{ $invoice['status'] }}</x-badge>
                                </div>
                                <button class="text-cyan-300 hover:text-cyan-200 transition-colors">
                                    <i data-lucide="download" class="w-5 h-5"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
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

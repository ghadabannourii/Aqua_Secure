@extends('layouts.manager')

@section('title', 'Tableau de bord Administrateur')

@php
    use App\Data\PlaceholderData;
    $zones = PlaceholderData::zones();
    $stats = PlaceholderData::stats();
    $user = session('user', ['name' => 'Administrateur', 'role' => 'admin']);
@endphp

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-3">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-purple-500/20 to-pink-600/20 border border-purple-400/25 flex items-center justify-center">
                    <i data-lucide="shield-check" class="w-7 h-7 text-purple-300"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-display font-bold text-white">Administration Système</h1>
                    <p class="text-cyan-100/60 text-sm mt-1">{{ $user['name'] }} • Accès complet</p>
                </div>
            </div>
            <x-ripple-button size="md" onclick="showToast('Configuration système ouverte', 'info')">
                <i data-lucide="settings" class="w-4 h-4"></i>
                Configuration
            </x-ripple-button>
        </div>
        <p class="text-cyan-100/70 max-w-3xl">
            Administration complète du système, gestion des utilisateurs, paramètres et sécurité.
        </p>
    </div>

    <!-- System Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        @foreach([
            ['icon' => 'users', 'value' => $stats['totalUsers'], 'label' => 'Utilisateurs actifs', 'trend' => '+12', 'color' => 'cyan'],
            ['icon' => 'server', 'value' => $stats['systemUptime'], 'label' => 'Uptime système', 'trend' => '', 'color' => 'teal'],
            ['icon' => 'database', 'value' => '2.4 GB', 'label' => 'Stockage utilisé', 'trend' => '+0.2GB', 'color' => 'blue'],
            ['icon' => 'shield-alert', 'value' => '0', 'label' => 'Alertes sécurité', 'trend' => '0', 'color' => 'purple'],
        ] as $metric)
        <div class="glass p-5 rounded-2xl hover-lift">
            <div class="flex items-start justify-between mb-3">
                <div class="w-12 h-12 rounded-xl bg-{{ $metric['color'] }}-500/10 flex items-center justify-center">
                    <i data-lucide="{{ $metric['icon'] }}" class="w-6 h-6 text-{{ $metric['color'] }}-400"></i>
                </div>
                @if($metric['trend'])
                <span class="text-xs font-semibold {{ $metric['trend'] === '0' ? 'text-teal-400' : (strpos($metric['trend'], '+') === 0 ? 'text-cyan-400' : 'text-red-400') }}">
                    {{ $metric['trend'] }}
                </span>
                @endif
            </div>
            <div class="text-2xl font-display font-bold text-white mb-1">{{ $metric['value'] }}</div>
            <div class="text-xs text-cyan-100/60">{{ $metric['label'] }}</div>
        </div>
        @endforeach
    </div>

    <!-- Main Tabs -->
    <div class="glass-strong rounded-2xl overflow-hidden">
        <!-- Tab Navigation -->
        <div class="border-b border-white/5">
            <nav class="flex overflow-x-auto">
                @foreach([
                    ['id' => 'users', 'icon' => 'users', 'label' => 'Utilisateurs'],
                    ['id' => 'roles', 'icon' => 'shield', 'label' => 'Rôles & Permissions'],
                    ['id' => 'system', 'icon' => 'server', 'label' => 'Système'],
                    ['id' => 'logs', 'icon' => 'file-text', 'label' => 'Logs'],
                    ['id' => 'security', 'icon' => 'lock', 'label' => 'Sécurité'],
                ] as $index => $tab)
                <button 
                    onclick="switchTab('{{ $tab['id'] }}')" 
                    class="tab-btn flex items-center gap-2 px-6 py-4 text-sm font-semibold border-b-2 transition-all whitespace-nowrap {{ $index === 0 ? 'border-purple-400 text-white' : 'border-transparent text-cyan-100/50 hover:text-cyan-100/80' }}"
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
            <!-- Users Tab -->
            <div id="tab-users" class="tab-content">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-display font-bold text-white">Gestion des utilisateurs</h3>
                    <x-ripple-button size="sm" onclick="showToast('Formulaire création utilisateur', 'info')">
                        <i data-lucide="user-plus" class="w-4 h-4"></i>
                        Nouvel utilisateur
                    </x-ripple-button>
                </div>
                <div class="space-y-3">
                    @foreach([
                        ['name' => 'Yassine Hamdi', 'email' => 'citoyen@aquasecure.tn', 'role' => 'Citoyen', 'status' => 'Actif', 'lastLogin' => 'Il y a 2h'],
                        ['name' => 'Amira Ben Ali', 'email' => 'amira@aquasecure.tn', 'role' => 'Technicien', 'status' => 'Actif', 'lastLogin' => 'Il y a 5min'],
                        ['name' => 'Ines Mansouri', 'email' => 'gestionnaire@aquasecure.tn', 'role' => 'Gestionnaire', 'status' => 'Actif', 'lastLogin' => 'Il y a 1h'],
                        ['name' => 'Amina Kacem', 'email' => 'admin@aquasecure.tn', 'role' => 'Admin', 'status' => 'Actif', 'lastLogin' => 'Connecté'],
                    ] as $user)
                    <div class="glass p-5 rounded-xl hover-lift">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-cyan-500/20 to-blue-600/20 flex items-center justify-center">
                                    <i data-lucide="user" class="w-6 h-6 text-cyan-300"></i>
                                </div>
                                <div>
                                    <h4 class="text-white font-semibold">{{ $user['name'] }}</h4>
                                    <p class="text-cyan-100/60 text-sm">{{ $user['email'] }}</p>
                                    <p class="text-cyan-100/40 text-xs mt-1">{{ $user['lastLogin'] }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <x-badge color="#06b6d4">{{ $user['role'] }}</x-badge>
                                <x-badge color="#14b8a6">{{ $user['status'] }}</x-badge>
                                <button class="glass p-2 rounded-lg text-cyan-300 hover:text-white">
                                    <i data-lucide="more-vertical" class="w-4 h-4"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Roles Tab -->
            <div id="tab-roles" class="tab-content hidden">
                <h3 class="text-xl font-display font-bold text-white mb-4">Rôles et Permissions</h3>
                <div class="grid sm:grid-cols-2 gap-4">
                    @foreach([
                        ['role' => 'Admin', 'users' => 2, 'color' => 'purple', 'permissions' => ['Tout', 'Gestion système', 'Utilisateurs', 'Sécurité']],
                        ['role' => 'Gestionnaire', 'users' => 8, 'color' => 'blue', 'permissions' => ['Réseau', 'Projets', 'Rapports', 'Équipes']],
                        ['role' => 'Technicien', 'users' => 47, 'color' => 'teal', 'permissions' => ['Interventions', 'Équipement', 'Rapports']],
                        ['role' => 'Citoyen', 'users' => 1190, 'color' => 'cyan', 'permissions' => ['Signalements', 'Suivi', 'Factures']],
                    ] as $role)
                    <div class="glass p-5 rounded-xl hover-lift">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-12 h-12 rounded-xl bg-{{ $role['color'] }}-500/10 flex items-center justify-center">
                                <i data-lucide="shield" class="w-6 h-6 text-{{ $role['color'] }}-400"></i>
                            </div>
                            <div>
                                <h4 class="text-white font-semibold">{{ $role['role'] }}</h4>
                                <p class="text-cyan-100/60 text-sm">{{ $role['users'] }} utilisateurs</p>
                            </div>
                        </div>
                        <div class="space-y-1">
                            @foreach($role['permissions'] as $perm)
                            <div class="flex items-center gap-2 text-sm text-cyan-100/70">
                                <i data-lucide="check" class="w-3.5 h-3.5 text-teal-400"></i>
                                <span>{{ $perm }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- System Tab -->
            <div id="tab-system" class="tab-content hidden">
                <h3 class="text-xl font-display font-bold text-white mb-4">État du système</h3>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach([
                        ['label' => 'Base de données', 'value' => 'MySQL 8.0', 'status' => 'OK', 'color' => 'teal'],
                        ['label' => 'Serveur web', 'value' => 'Apache 2.4', 'status' => 'OK', 'color' => 'teal'],
                        ['label' => 'PHP Version', 'value' => '8.2.12', 'status' => 'OK', 'color' => 'teal'],
                        ['label' => 'Laravel', 'value' => '12.69.2', 'status' => 'OK', 'color' => 'teal'],
                        ['label' => 'Cache', 'value' => 'Redis', 'status' => 'OK', 'color' => 'teal'],
                        ['label' => 'Queue', 'value' => '0 jobs', 'status' => 'OK', 'color' => 'teal'],
                    ] as $sys)
                    <div class="glass p-4 rounded-xl">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm text-cyan-100/70">{{ $sys['label'] }}</span>
                            <x-badge color="#{{ $sys['color'] === 'teal' ? '14b8a6' : 'ef4444' }}">
                                {{ $sys['status'] }}
                            </x-badge>
                        </div>
                        <div class="text-white font-semibold">{{ $sys['value'] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Logs Tab -->
            <div id="tab-logs" class="tab-content hidden">
                <h3 class="text-xl font-display font-bold text-white mb-4">Logs système récents</h3>
                <div class="space-y-2">
                    @foreach([
                        ['type' => 'info', 'message' => 'Utilisateur admin@aquasecure.tn connecté', 'time' => 'Il y a 5min'],
                        ['type' => 'success', 'message' => 'Backup base de données complété', 'time' => 'Il y a 1h'],
                        ['type' => 'warning', 'message' => 'Espace disque > 80%', 'time' => 'Il y a 3h'],
                        ['type' => 'info', 'message' => 'Mise à jour capteur zone Tunis Nord', 'time' => 'Il y a 5h'],
                    ] as $log)
                    <div class="glass p-4 rounded-lg flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full {{ $log['type'] === 'success' ? 'bg-teal-400' : ($log['type'] === 'warning' ? 'bg-orange-400' : 'bg-cyan-400') }}"></div>
                        <div class="flex-1">
                            <p class="text-white text-sm">{{ $log['message'] }}</p>
                            <p class="text-cyan-100/50 text-xs mt-1">{{ $log['time'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Security Tab -->
            <div id="tab-security" class="tab-content hidden">
                <h3 class="text-xl font-display font-bold text-white mb-4">Sécurité et audit</h3>
                <div class="space-y-4">
                    <div class="glass p-5 rounded-xl">
                        <h4 class="text-white font-semibold mb-3 flex items-center gap-2">
                            <i data-lucide="shield-check" class="w-5 h-5 text-teal-400"></i>
                            État de sécurité : Excellent
                        </h4>
                        <div class="grid sm:grid-cols-2 gap-3">
                            @foreach([
                                ['label' => 'Pare-feu', 'status' => 'Actif'],
                                ['label' => 'SSL/TLS', 'status' => 'Actif'],
                                ['label' => 'Authentification 2FA', 'status' => 'Disponible'],
                                ['label' => 'Dernière tentative intrusion', 'status' => 'Aucune'],
                            ] as $sec)
                            <div class="flex items-center justify-between py-2 border-b border-white/5">
                                <span class="text-sm text-cyan-100/70">{{ $sec['label'] }}</span>
                                <span class="text-sm text-teal-400 font-semibold">{{ $sec['status'] }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
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
            btn.classList.remove('border-purple-400', 'text-white');
            btn.classList.add('border-transparent', 'text-cyan-100/50');
        });
        
        // Show selected tab
        document.getElementById('tab-' + tabId).classList.remove('hidden');
        
        // Add active state to clicked button
        const activeBtn = document.querySelector('[data-tab="' + tabId + '"]');
        activeBtn.classList.add('border-purple-400', 'text-white');
        activeBtn.classList.remove('border-transparent', 'text-cyan-100/50');
        
        // Reinitialize Lucide icons for newly shown content
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    }
</script>
@endpush
@endsection

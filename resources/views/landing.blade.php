@extends('layouts.public')

@php
    use App\Data\PlaceholderData;
    $zones = PlaceholderData::zones();
    $zoneStats = PlaceholderData::zoneStats();
    $zoneColors = PlaceholderData::zoneColors();
    $zoneLabels = PlaceholderData::zoneLabels();
    $kpis = PlaceholderData::landingKPIs();
@endphp

@section('public-content')
<!-- Top Nav -->
<nav class="fixed top-0 left-0 right-0 z-50 px-6 py-4 flex items-center justify-between">
    <div class="flex items-center gap-3">
   <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center shadow-lg shadow-cyan-500/30">
   <i data-lucide="droplet" class="w-6 h-6 text-white"></i>
     </div>
<span class="font-display text-xl font-bold text-white">
    AquaSecure
</span>
</div>

    <div class="flex items-center gap-3">
        <button onclick="toggleTheme()" class="glass p-2.5 rounded-xl text-cyan-200 hover:text-white transition-colors">
            <svg class="w-5 h-5 sun-icon hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            <svg class="w-5 h-5 moon-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
            </svg>
        </button>
    </div>
</nav>

<!-- Hero Section -->
<section class="relative min-h-screen flex items-center justify-center px-6 pt-20">
    <x-rain-effect :count="50" />
    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-slate-950/60 pointer-events-none"></div>
    <x-wave-background />

    <div class="relative z-10 max-w-5xl mx-auto text-center">
        <div class="animate-fade-in-up inline-flex items-center gap-2 glass px-4 py-2 rounded-full mb-8">
            <span class="w-2 h-2 rounded-full bg-teal-400 pulse-glow"></span>
            <span class="text-sm text-cyan-100/80">Surveillance en temps réel · Grand Tunis</span>
        </div>

        <h1 class="animate-fade-in-up text-5xl md:text-7xl font-display font-bold text-white mb-6 leading-tight" style="animation-delay: 0.1s">
            L'eau de votre ville,
            <br />
            <span class="text-gradient">sous surveillance intelligente</span>
        </h1>

        <p class="animate-fade-in-up text-lg md:text-xl text-cyan-100/70 mb-10 max-w-2xl mx-auto" style="animation-delay: 0.2s">
            AquaSecure connecte citoyens et gestionnaires pour protéger les infrastructures
            d'eau potable. Surveillez, signalez et financez le réseau ensemble.
        </p>

        <div class="animate-fade-in-up flex flex-col sm:flex-row gap-4 justify-center" style="animation-delay: 0.3s">
            <x-ripple-button size="lg" onclick="window.location.href='{{ route('auth.login') }}'" class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                Signaler un incident
            </x-ripple-button>
            <x-ripple-button size="lg" variant="secondary" onclick="window.location.href='{{ route('auth.login') }}'" class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
                Se connecter
            </x-ripple-button>
        </div>

        <!-- Stats strip -->
        <div class="animate-fade-in-up grid grid-cols-3 gap-4 mt-16 max-w-2xl mx-auto" style="animation-delay: 0.4s">
            @foreach($kpis as $stat)
            <div class="glass px-4 py-5 rounded-2xl">
                <div class="flex items-center justify-center text-cyan-400 mb-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        @if($stat['icon'] === 'activity')
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        @elseif($stat['icon'] === 'droplet')
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                        @else
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        @endif
                    </svg>
                </div>
                <div class="text-2xl font-bold text-white">{{ $stat['value'] }}</div>
                <div class="text-xs text-cyan-200/60 mt-1">{{ $stat['label'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Concept Section -->
<section class="relative px-6 py-24 max-w-6xl mx-auto">
    <div class="text-center mb-16">
        <h2 class="text-3xl md:text-5xl font-display font-bold text-white mb-4">
            Trois piliers, <span class="text-gradient">une mission</span>
        </h2>
        <p class="text-cyan-100/60 max-w-2xl mx-auto">
            Une plateforme qui réunit la technologie, la communauté et la transparence financière
        </p>
    </div>

    <div class="grid md:grid-cols-3 gap-6">
        @php
            $concepts = [
                ['icon' => 'activity', 'title' => 'Surveiller', 'desc' => 'Capteurs IoT et monitoring en temps réel sur tout le réseau de distribution', 'color' => 'from-cyan-500 to-blue-600'],
                ['icon' => 'bell', 'title' => 'Signaler', 'desc' => 'Les citoyens signalent incidents et coupures, les équipes interviennent rapidement', 'color' => 'from-teal-500 to-cyan-600'],
                ['icon' => 'wallet', 'title' => 'Financer', 'desc' => 'Suivez l\'avancement budgétaire des projets de rénovation en toute transparence', 'color' => 'from-blue-500 to-indigo-600'],
            ];
        @endphp
        @foreach($concepts as $index => $concept)
        <div class="glass p-8 rounded-2xl hover-lift animate-fade-in-up" style="animation-delay: {{ $index * 0.15 }}s">
            <div class="w-16 h-16 rounded-2xl bg-gradient-to-br {{ $concept['color'] }} flex items-center justify-center text-white mb-6 shadow-lg">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    @if($concept['icon'] === 'activity')
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    @elseif($concept['icon'] === 'bell')
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    @else
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                    @endif
                </svg>
            </div>
            <h3 class="text-xl font-display font-bold text-white mb-3">{{ $concept['title'] }}</h3>
            <p class="text-cyan-100/60 text-sm leading-relaxed">{{ $concept['desc'] }}</p>
        </div>
        @endforeach
    </div>
</section>

<!-- Interactive Map Section -->
<section class="relative px-6 py-24 max-w-6xl mx-auto">
    <div class="text-center mb-12">
        <h2 class="text-3xl md:text-5xl font-display font-bold text-white mb-4">
            État du réseau <span class="text-gradient">en direct</span>
        </h2>
        <p class="text-cyan-100/60">Cliquez sur une zone pour voir le détail</p>
    </div>

    <div class="grid lg:grid-cols-3 gap-6">
        <!-- Map -->
        <div class="lg:col-span-2 glass p-6 rounded-2xl relative">
            <div class="relative w-full aspect-[4/3] rounded-xl overflow-hidden bg-gradient-to-br from-slate-900/80 to-blue-950/80">
                <!-- Grid lines for map feel -->
                <svg class="absolute inset-0 w-full h-full opacity-20" viewBox="0 0 100 75">
                    @for($i = 0; $i < 10; $i++)
                    <line x1="0" y1="{{ $i * 7.5 }}" x2="100" y2="{{ $i * 7.5 }}" stroke="#06b6d4" stroke-width="0.2" />
                    @endfor
                    @for($i = 0; $i < 14; $i++)
                    <line x1="{{ $i * 7.14 }}" y1="0" x2="{{ $i * 7.14 }}" y2="75" stroke="#06b6d4" stroke-width="0.2" />
                    @endfor
                    <!-- Water body representation -->
                    <ellipse cx="65" cy="35" rx="15" ry="8" fill="#0c4a6e" opacity="0.3" />
                    <path d="M0 50 Q 20 45, 40 50 T 80 48 T 100 52" fill="none" stroke="#06b6d4" stroke-width="0.3" opacity="0.4" />
                </svg>

                <!-- Zone markers -->
                @foreach($zones as $zone)
                <button
                    onclick="selectZone('{{ $zone['id'] }}')"
                    onmouseenter="hoverZone('{{ $zone['id'] }}')"
                    onmouseleave="unhoverZone()"
                    class="absolute -translate-x-1/2 -translate-y-1/2 group zone-marker"
                    style="left: {{ $zone['x'] }}%; top: {{ $zone['y'] }}%"
                    data-zone-id="{{ $zone['id'] }}"
                    data-zone-name="{{ $zone['name'] }}"
                >
                    <span class="absolute inset-0 rounded-full zone-pulse-ring" style="background: {{ $zoneColors[$zone['status']] }}; width: 24px; height: 24px; left: -12px; top: -12px;"></span>
                    <span class="relative block rounded-full border-2 transition-all duration-300 group-hover:scale-150" style="width: 14px; height: 14px; background: {{ $zoneColors[$zone['status']] }}; border-color: {{ $zoneColors[$zone['status']] }}88; box-shadow: 0 0 12px {{ $zoneColors[$zone['status']] }};"></span>
                    <span class="zone-tooltip absolute top-5 left-1/2 -translate-x-1/2 whitespace-nowrap glass-strong px-3 py-1 rounded-lg text-xs text-white pointer-events-none opacity-0">{{ $zone['name'] }}</span>
                </button>
                @endforeach

                <!-- Legend -->
                <div class="absolute bottom-4 left-4 glass px-4 py-3 rounded-xl flex gap-4">
                    @foreach(['normal', 'alert', 'critical'] as $status)
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full" style="background: {{ $zoneColors[$status] }}"></span>
                        <span class="text-xs text-white/70">{{ $zoneLabels[$status] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Zone detail / summary -->
        <div class="glass p-6 rounded-2xl">
            <div id="zone-detail" class="hidden">
                <!-- Will be populated by JavaScript -->
            </div>
            <div id="zone-summary">
                <h3 class="text-lg font-display font-bold text-white mb-4">Vue d'ensemble</h3>
                <div class="space-y-3">
                    @foreach([
                        ['label' => 'Zones normales', 'value' => $zoneStats['normal'], 'color' => '#2dd4bf'],
                        ['label' => 'Zones en alerte', 'value' => $zoneStats['alert'], 'color' => '#fbbf24'],
                        ['label' => 'Zones critiques', 'value' => $zoneStats['critical'], 'color' => '#ef4444'],
                    ] as $stat)
                    <div class="flex items-center justify-between p-3 rounded-xl" style="background: {{ $stat['color'] }}10">
                        <span class="flex items-center gap-2 text-sm text-white/80">
                            <span class="w-3 h-3 rounded-full" style="background: {{ $stat['color'] }}"></span>
                            {{ $stat['label'] }}
                        </span>
                        <span class="text-lg font-bold" style="color: {{ $stat['color'] }}">{{ $stat['value'] }}</span>
                    </div>
                    @endforeach
                </div>
                <p class="text-xs text-cyan-200/40 mt-4 text-center">Sélectionnez une zone sur la carte</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="relative px-6 py-24 max-w-4xl mx-auto text-center">
    <div class="glass-strong p-12 rounded-3xl">
        <div class="w-20 h-20 mx-auto rounded-3xl bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center mb-6 shadow-xl shadow-cyan-500/30">
            <i data-lucide="droplet" class="w-10 h-10 text-white"></i>
        </div>
        <h2 class="text-3xl md:text-4xl font-display font-bold text-white mb-4">
            Rejoignez la communauté AquaSecure
        </h2>
        <p class="text-cyan-100/60 mb-8 max-w-xl mx-auto">
            Que vous soyez citoyen concerné ou gestionnaire de réseau, votre rôle est essentiel
            pour garantir une eau potable sûre et durable.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <x-ripple-button size="lg" onclick="window.location.href='{{ route('auth.login') }}'" class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                Espace Citoyen
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </x-ripple-button>
            <x-ripple-button size="lg" variant="secondary" onclick="window.location.href='{{ route('auth.login') }}'" class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
                Espace Gestionnaire
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </x-ripple-button>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="relative px-6 py-12 border-t border-white/5">
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center shadow-lg shadow-cyan-500/30">
                <i data-lucide="droplet" class="w-6 h-6 text-white"></i>
            </div>
            <span class="font-display text-xl font-bold text-white">AquaSecure</span>
        </div>
        <p class="text-sm text-cyan-200/40">Surveillance intelligente des infrastructures d'eau potable · Grand Tunis</p>
    </div>
</footer>

@push('scripts')
<script>
    // Zone data from PHP
    const zones = @json($zones);
    const zoneColors = @json($zoneColors);
    const zoneLabels = @json($zoneLabels);
    
    let selectedZoneId = null;
    
    function selectZone(zoneId) {
        selectedZoneId = zoneId;
        const zone = zones.find(z => z.id === zoneId);
        if (!zone) return;
        
        document.getElementById('zone-summary').classList.add('hidden');
        const detailEl = document.getElementById('zone-detail');
        detailEl.classList.remove('hidden');
        detailEl.classList.add('animate-scale-in');
        
        detailEl.innerHTML = `
            <div class="flex items-center gap-3 mb-4">
                <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <h3 class="text-xl font-display font-bold text-white">${zone.name}</h3>
            </div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold mb-4"
                style="background: ${zoneColors[zone.status]}1a; color: ${zoneColors[zone.status]}; border: 1px solid ${zoneColors[zone.status]}66">
                ${zoneLabels[zone.status]}
            </div>
            <div class="space-y-4">
                ${[
                    { label: 'Capteurs actifs', value: zone.sensors, icon: 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z' },
                    { label: 'Consommation', value: zone.consumption.toLocaleString() + ' m³/j', icon: 'M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12' },
                    { label: 'Qualité eau', value: zone.quality + '%', icon: 'M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z' },
                    { label: 'Pression', value: zone.pressure + ' bar', icon: 'M13 10V3L4 14h7v7l9-11h-7z' }
                ].map(m => `
                    <div class="flex items-center justify-between py-2 border-b border-white/5">
                        <span class="flex items-center gap-2 text-sm text-cyan-100/60">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="${m.icon}"></path>
                            </svg>
                            ${m.label}
                        </span>
                        <span class="text-sm font-semibold text-white">${m.value}</span>
                    </div>
                `).join('')}
            </div>
            <button onclick="clearZoneSelection()" class="mt-4 w-full py-2 px-4 rounded-xl bg-white/5 hover:bg-white/10 text-cyan-100/60 hover:text-white text-sm transition-colors">
                Retour à la vue d'ensemble
            </button>
        `;
        
        // Update marker styles
        document.querySelectorAll('.zone-marker').forEach(m => {
            m.style.opacity = m.dataset.zoneId === zoneId ? '1' : '0.5';
        });
    }
    
    function clearZoneSelection() {
        selectedZoneId = null;
        document.getElementById('zone-detail').classList.add('hidden');
        document.getElementById('zone-summary').classList.remove('hidden');
        document.querySelectorAll('.zone-marker').forEach(m => m.style.opacity = '1');
    }
    
    function hoverZone(zoneId) {
        if (selectedZoneId) return;
        const marker = document.querySelector(`[data-zone-id="${zoneId}"]`);
        const tooltip = marker?.querySelector('.zone-tooltip');
        if (tooltip) tooltip.style.opacity = '1';
    }
    
    function unhoverZone() {
        document.querySelectorAll('.zone-tooltip').forEach(t => t.style.opacity = '0');
    }
    
    // Theme toggle
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
</script>
@endpush
@endsection

@extends('layouts.auth')

@section('auth-content')
<div class="w-full max-w-5xl grid lg:grid-cols-[1.05fr_0.95fr] gap-8 items-stretch">
    <!-- Left Section - Info (Desktop only) -->
    <section class="hidden lg:flex flex-col justify-between glass p-9 animate-fade-in-up">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-cyan-400/10 border border-cyan-400/25 text-cyan-200 text-xs font-semibold mb-8">
                <span class="w-2 h-2 rounded-full bg-teal-400 pulse-glow"></span>
                Plateforme nationale de surveillance
            </div>
            <h1 class="text-4xl xl:text-5xl font-display font-bold text-white leading-tight mb-6">
                Chaque goutte compte.
                <span class="block text-gradient">Chaque intervention aussi.</span>
            </h1>
            <p class="text-cyan-100/65 leading-relaxed max-w-lg">
                AquaSecure relie les citoyens, techniciens et gestionnaires autour d'un réseau d'eau potable plus sûr, plus transparent et plus résilient.
            </p>
        </div>

        <div class="grid grid-cols-3 gap-3 mt-12">
            @foreach([
                ['value' => '14', 'label' => 'zones suivies'],
                ['value' => '24/7', 'label' => 'surveillance'],
                ['value' => '100%', 'label' => 'transparent'],
            ] as $stat)
            <div class="glass-strong p-4 rounded-2xl">
                <div class="text-xl font-display font-bold text-white">{{ $stat['value'] }}</div>
                <div class="text-[11px] text-cyan-100/50 mt-1">{{ $stat['label'] }}</div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Right Section - Register Form -->
    <section class="glass-strong p-6 sm:p-8 animate-fade-in-up" style="animation-delay: 0.12s">
        <div class="flex items-center justify-between mb-7">
            <div>
                <p class="text-xs font-semibold tracking-wider text-cyan-300 uppercase">Accès sécurisé</p>
                <h2 class="text-2xl font-display font-bold text-white mt-1">Créer votre compte</h2>
            </div>
            <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-cyan-500/20 to-blue-600/20 border border-cyan-400/25 flex items-center justify-center">
                <svg class="w-5 h-5 text-cyan-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
            </div>
        </div>

        <!-- Mode Toggle Tabs -->
        <div class="grid grid-cols-3 gap-1 p-1 rounded-xl bg-slate-950/30 border border-white/5 mb-7">
            <a href="{{ route('auth.login') }}" class="flex items-center justify-center gap-1.5 rounded-lg px-2 py-2 text-[11px] sm:text-xs font-semibold transition-all text-cyan-100/45 hover:text-cyan-100/80">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                </svg>
                <span class="hidden sm:inline">Connexion</span>
            </a>
            <a href="{{ route('auth.register') }}" class="flex items-center justify-center gap-1.5 rounded-lg px-2 py-2 text-[11px] sm:text-xs font-semibold transition-all bg-gradient-to-r from-cyan-500 to-blue-600 text-white shadow-lg shadow-cyan-500/20">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
                <span class="hidden sm:inline">Inscription</span>
            </a>
            <a href="{{ route('auth.forgot-password') }}" class="flex items-center justify-center gap-1.5 rounded-lg px-2 py-2 text-[11px] sm:text-xs font-semibold transition-all text-cyan-100/45 hover:text-cyan-100/80">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
                <span class="hidden sm:inline">Mot de passe</span>
            </a>
        </div>

        <!-- Register Form -->
        <form method="POST" action="{{ route('register.post') }}" class="space-y-4">
            @csrf
            
            <div>
                <label class="text-xs font-semibold text-cyan-100/70 mb-2 block">Nom complet</label>
                <input type="text" name="name" required placeholder="Ex. Yassine Hamdi" class="w-full bg-slate-950/35 border border-cyan-400/15 rounded-xl px-4 py-3 text-sm text-white placeholder:text-cyan-100/30 focus:outline-none focus:border-cyan-400/50 transition-colors" />
            </div>

            <div>
                <label class="text-xs font-semibold text-cyan-100/70 mb-2 block">Adresse email</label>
                <input type="email" name="email" required placeholder="vous@exemple.tn" class="w-full bg-slate-950/35 border border-cyan-400/15 rounded-xl px-4 py-3 text-sm text-white placeholder:text-cyan-100/30 focus:outline-none focus:border-cyan-400/50 transition-colors" />
            </div>

            <div>
                <label class="text-xs font-semibold text-cyan-100/70 mb-2 block">Mot de passe</label>
                <input type="password" name="password" required minlength="6" placeholder="••••••••" class="w-full bg-slate-950/35 border border-cyan-400/15 rounded-xl px-4 py-3 text-sm text-white placeholder:text-cyan-100/30 focus:outline-none focus:border-cyan-400/50 transition-colors" />
            </div>

            <div>
                <label class="text-xs font-semibold text-cyan-100/70 mb-2 block">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" required minlength="6" placeholder="••••••••" class="w-full bg-slate-950/35 border border-cyan-400/15 rounded-xl px-4 py-3 text-sm text-white placeholder:text-cyan-100/30 focus:outline-none focus:border-cyan-400/50 transition-colors" />
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="text-xs font-semibold text-cyan-100/70 mb-2 block">Profil</label>
                    <select name="role" class="w-full bg-slate-950/35 border border-cyan-400/15 rounded-xl px-3 py-3 text-sm text-white focus:outline-none focus:border-cyan-400/50">
                        <option value="citizen">Citoyen</option>
                        <option value="technician">Technicien</option>
                        <option value="manager">Gestionnaire</option>
                    </select>
                </div>
                <div>
                    <label class="text-xs font-semibold text-cyan-100/70 mb-2 block">Quartier</label>
                    <select name="zone" class="w-full bg-slate-950/35 border border-cyan-400/15 rounded-xl px-3 py-3 text-sm text-white focus:outline-none focus:border-cyan-400/50">
                        @foreach(App\Data\PlaceholderData::zones() as $zone)
                        <option>{{ $zone['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <x-ripple-button type="submit" size="lg" class="w-full flex items-center justify-center gap-2">
                Créer mon compte
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </x-ripple-button>
        </form>

        <p class="text-xs text-cyan-100/40 mt-4 text-center">
            En vous inscrivant, vous acceptez nos conditions d'utilisation
        </p>
    </section>
</div>
@endsection

<?php $__env->startSection('title', 'Administration — AquaSecure'); ?>
<?php $__env->startSection('page-title', 'Administration'); ?>
<?php $__env->startSection('page-subtitle', 'Vue globale de la plateforme AquaSecure'); ?>

<?php
    use App\Data\PlaceholderData;

    $reclamations = PlaceholderData::adminAllReclamations();
    $accounts     = PlaceholderData::adminAllAccounts();
    $mapZones     = PlaceholderData::mapZones();
    $technicians  = PlaceholderData::adminTechnicians();
    $managers     = PlaceholderData::adminManagers();
    $funcAct      = PlaceholderData::adminFunctionalActivity();

    // KPI counters calculés depuis les données
    $totalAccounts    = count($accounts);
    $activeAccounts   = count(array_filter($accounts, fn($a) => $a['status'] === 'active'));
    $blockedAccounts  = count(array_filter($accounts, fn($a) => $a['status'] === 'blocked'));
    $citizens         = count(array_filter($accounts, fn($a) => $a['role'] === 'citizen'));
    $techniciansCount = count(array_filter($accounts, fn($a) => $a['role'] === 'technician'));
    $managersCount    = count(array_filter($accounts, fn($a) => $a['role'] === 'manager'));

    $totalRec    = count($reclamations);
    $pendingRec  = count(array_filter($reclamations, fn($r) => $r['status'] === 'pending'));
    $progressRec = count(array_filter($reclamations, fn($r) => $r['status'] === 'in_progress'));
    $resolvedRec = count(array_filter($reclamations, fn($r) => $r['status'] === 'resolved'));

    // Style helpers
    $priorityStyle = [
        'critical' => ['bg'=>'bg-red-500/15',   'text'=>'text-red-300',   'dot'=>'bg-red-400',   'label'=>'Critique'],
        'medium'   => ['bg'=>'bg-amber-500/15', 'text'=>'text-amber-300', 'dot'=>'bg-amber-400', 'label'=>'Moyenne'],
        'low'      => ['bg'=>'bg-blue-500/15',  'text'=>'text-blue-300',  'dot'=>'bg-blue-400',  'label'=>'Faible'],
    ];
    $statusStyle = [
        'pending'     => ['bg'=>'bg-red-500/15',   'text'=>'text-red-300',   'label'=>'Non traité', 'dot'=>'bg-red-400'],
        'in_progress' => ['bg'=>'bg-amber-500/15', 'text'=>'text-amber-300', 'label'=>'En cours',   'dot'=>'bg-amber-400'],
        'resolved'    => ['bg'=>'bg-teal-500/15',  'text'=>'text-teal-300',  'label'=>'Résolu',     'dot'=>'bg-teal-400'],
    ];
    $roleStyle = [
        'admin'      => ['bg'=>'bg-violet-500/15', 'text'=>'text-violet-300', 'label'=>'Admin',          'avatar'=>'from-violet-500/30 to-violet-700/30', 'border'=>'border-violet-400/20'],
        'manager'    => ['bg'=>'bg-blue-500/15',   'text'=>'text-blue-300',   'label'=>'Gestionnaire',   'avatar'=>'from-blue-500/30 to-blue-700/30',   'border'=>'border-blue-400/20'],
        'technician' => ['bg'=>'bg-cyan-500/15',   'text'=>'text-cyan-300',   'label'=>'Technicien',     'avatar'=>'from-cyan-500/30 to-cyan-700/30',   'border'=>'border-cyan-400/20'],
        'citizen'    => ['bg'=>'bg-teal-500/15',   'text'=>'text-teal-300',   'label'=>'Citoyen',        'avatar'=>'from-teal-500/30 to-teal-700/30',   'border'=>'border-teal-400/20'],
    ];
?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
      integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<style>
/* ── Animations ── */
@keyframes barSlide { from { width: 0 } }
.bar-grow { animation: barSlide .9s cubic-bezier(.22,1,.36,1) both; }
@keyframes donutSpin { from { stroke-dashoffset: 300 } }
.donut-seg { animation: donutSpin .9s cubic-bezier(.22,1,.36,1) both; }
@keyframes fadeUp { from { opacity:0; transform:translateY(12px) } to { opacity:1; transform:translateY(0) } }
.fade-up { animation: fadeUp .5s ease both; }

/* ── Map ── */
#admin-map { height: 420px; }
.leaflet-tile-pane { filter: brightness(.68) saturate(.6) hue-rotate(185deg); }
.leaflet-control-zoom a {
    background: rgba(6,21,37,.92) !important;
    border-color: rgba(5,191,219,.25) !important;
    color: #7ce8f7 !important;
}
.leaflet-control-attribution { display:none !important; }
.leaflet-popup-content-wrapper {
    background: rgba(6,21,37,.97) !important;
    border: 1px solid rgba(5,191,219,.3) !important;
    border-radius: 14px !important;
    color: #f0fdff !important;
    padding: 0 !important;
    box-shadow: 0 16px 48px rgba(0,0,0,.5) !important;
    backdrop-filter: blur(20px);
}
.leaflet-popup-tip { background: rgba(6,21,37,.97) !important; }
.leaflet-popup-content { margin:0 !important; padding:0 !important; min-width:220px; }
.leaflet-popup-close-button { color: rgba(156,200,216,.6) !important; font-size:18px !important; padding:8px 10px !important; }
.leaflet-popup-close-button:hover { color: #fff !important; }

/* ── Tab active ── */
.tab-active {
    background: rgba(5,191,219,.12);
    color: #5ee5f7;
    border-color: rgba(94,221,247,.35);
}
.tab-inactive {
    color: rgba(156,200,216,.5);
    border-color: transparent;
}
.tab-inactive:hover { color: rgba(156,200,216,.8); background: rgba(255,255,255,.03); }

/* ── Table row hover ── */
.trow:hover { background: rgba(255,255,255,.025); }

/* ── Status action button ── */
.btn-block  { color: #fca5a5; border-color: rgba(239,68,68,.3); }
.btn-block:hover  { background: rgba(239,68,68,.12); color:#f87171; }
.btn-unblock { color: #6ee7b7; border-color: rgba(52,211,153,.3); }
.btn-unblock:hover { background: rgba(52,211,153,.12); color:#34d399; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('admin-content'); ?>
<div class="space-y-6 max-w-7xl mx-auto">


<div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-6 gap-4">
    <?php $__currentLoopData = [
        ['icon'=>'users',          'val'=>$totalAccounts,    'label'=>'Comptes total',    'sub'=>$activeAccounts.' actifs',            'ring'=>'ring-cyan-400/20',   'ib'=>'bg-cyan-500/10',   'ic'=>'text-cyan-400',   'vc'=>'text-white'],
        ['icon'=>'user-check',     'val'=>$citizens,         'label'=>'Citoyens',         'sub'=>'+14 ce mois',                        'ring'=>'ring-teal-400/20',   'ib'=>'bg-teal-500/10',   'ic'=>'text-teal-400',   'vc'=>'text-teal-300'],
        ['icon'=>'wrench',         'val'=>$techniciansCount, 'label'=>'Techniciens',      'sub'=>count(array_filter($technicians, fn($t)=>$t['status']==='on_mission')).' en mission', 'ring'=>'ring-blue-400/20','ib'=>'bg-blue-500/10','ic'=>'text-blue-400','vc'=>'text-white'],
        ['icon'=>'briefcase',      'val'=>$managersCount,    'label'=>'Gestionnaires',    'sub'=>'actifs sur le réseau',               'ring'=>'ring-violet-400/20', 'ib'=>'bg-violet-500/10', 'ic'=>'text-violet-400', 'vc'=>'text-white'],
        ['icon'=>'alert-triangle', 'val'=>$totalRec,         'label'=>'Réclamations',     'sub'=>$pendingRec.' non traitées',          'ring'=>'ring-red-400/20',    'ib'=>'bg-red-500/10',    'ic'=>'text-red-400',    'vc'=>'text-red-300'],
        ['icon'=>'check-circle',   'val'=>$resolvedRec,      'label'=>'Résolues',         'sub'=>round($resolvedRec/$totalRec*100).'% taux résolution', 'ring'=>'ring-emerald-400/20','ib'=>'bg-emerald-500/10','ic'=>'text-emerald-400','vc'=>'text-emerald-300'],
    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $kpi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="glass rounded-2xl p-4 ring-1 <?php echo e($kpi['ring']); ?> relative overflow-hidden hover-lift fade-up group"
         style="animation-delay:<?php echo e($i * 0.06); ?>s">
        <div class="w-10 h-10 rounded-xl <?php echo e($kpi['ib']); ?> flex items-center justify-center mb-3">
            <i data-lucide="<?php echo e($kpi['icon']); ?>" class="w-5 h-5 <?php echo e($kpi['ic']); ?>"></i>
        </div>
        <p class="text-2xl font-display font-bold <?php echo e($kpi['vc']); ?> leading-tight"><?php echo e($kpi['val']); ?></p>
        <p class="text-[11px] text-cyan-100/55 font-medium mt-0.5"><?php echo e($kpi['label']); ?></p>
        <p class="text-[10px] text-cyan-100/30 mt-0.5"><?php echo e($kpi['sub']); ?></p>
        <div class="absolute bottom-0 left-0 right-0 h-0.5 opacity-0 group-hover:opacity-100 transition-opacity"
             style="background:linear-gradient(90deg,transparent,<?php echo e(['#05bfdb','#2dd4bf','#38bdf8','#818cf8','#ef4444','#34d399'][$i]); ?>80,transparent)"></div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>


<div class="glass rounded-2xl overflow-hidden fade-up" style="animation-delay:.1s">
    <div class="px-6 py-4 border-b border-white/5 flex flex-wrap items-center justify-between gap-3">
        <div>
            <h2 class="text-white font-display font-bold text-base">Carte des réclamations & zones</h2>
            <p class="text-cyan-100/50 text-xs mt-0.5"><?php echo e(count($mapZones)); ?> zones surveillées · <?php echo e($totalRec); ?> réclamations</p>
        </div>
        <div class="flex items-center gap-2 flex-wrap">
            
            <?php $__currentLoopData = [
                ['c'=>'bg-red-400 animate-pulse', 't'=>'text-red-300',   'l'=>'Non traité',  'n'=>$pendingRec],
                ['c'=>'bg-amber-400',             't'=>'text-amber-300', 'l'=>'En cours',    'n'=>$progressRec],
                ['c'=>'bg-teal-400',              't'=>'text-teal-300',  'l'=>'Résolu',      'n'=>$resolvedRec],
            ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-white/5 border border-white/10">
                <span class="w-2 h-2 rounded-full <?php echo e($leg['c']); ?>"></span>
                <span class="text-xs font-semibold <?php echo e($leg['t']); ?>"><?php echo e($leg['n']); ?> <?php echo e($leg['l']); ?></span>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
            <div class="hidden sm:flex items-center gap-1 px-2 py-1 rounded-lg bg-white/5 text-[10px] text-cyan-100/40">
                <span class="w-3 h-0.5 rounded bg-teal-400/60 inline-block"></span> Zone normale
                <span class="w-3 h-0.5 rounded bg-amber-400/60 inline-block ml-2"></span> Zone alerte
            </div>
            <a href="<?php echo e(route('manager.map')); ?>"
               class="glass px-3 py-1.5 rounded-lg text-xs text-cyan-300 hover:text-white font-semibold
                      flex items-center gap-1.5 transition-all hover:border-cyan-400/40">
                <i data-lucide="maximize-2" class="w-3.5 h-3.5"></i>
                <span class="hidden sm:inline">Plein écran</span>
            </a>
        </div>
    </div>
    <div id="admin-map"></div>
</div>


<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 fade-up" style="animation-delay:.15s">
    <?php $__currentLoopData = [
        ['icon'=>'alert-triangle','color'=>'red',  'count'=>$pendingRec,  'label'=>'Non traitées',   'sub'=>'Aucun technicien assigné',   'filter'=>'pending',     'ring'=>'ring-red-500/25'],
        ['icon'=>'loader',        'color'=>'amber','count'=>$progressRec, 'label'=>'En cours',        'sub'=>'Interventions actives',      'filter'=>'in_progress', 'ring'=>'ring-amber-500/25'],
        ['icon'=>'check-circle',  'color'=>'teal', 'count'=>$resolvedRec, 'label'=>'Résolues',        'sub'=>'Problèmes clôturés',         'filter'=>'resolved',    'ring'=>'ring-teal-500/25'],
    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
        $cs = [
            'red'  =>['ib'=>'bg-red-500/15',  'ic'=>'text-red-400',  'nc'=>'text-red-300',  'btn'=>'bg-red-500/10 text-red-300 border-red-500/25 hover:bg-red-500/20'],
            'amber'=>['ib'=>'bg-amber-500/15','ic'=>'text-amber-400','nc'=>'text-amber-300','btn'=>'bg-amber-500/10 text-amber-300 border-amber-500/25 hover:bg-amber-500/20'],
            'teal' =>['ib'=>'bg-teal-500/15', 'ic'=>'text-teal-400', 'nc'=>'text-teal-300', 'btn'=>'bg-teal-500/10 text-teal-300 border-teal-500/25 hover:bg-teal-500/20'],
        ][$col['color']];
    ?>
    <button onclick="filterRec('<?php echo e($col['filter']); ?>')"
            class="glass rounded-2xl p-6 ring-1 <?php echo e($col['ring']); ?> flex flex-col items-center text-center
                   hover-lift transition-all w-full group">
        <div class="w-14 h-14 rounded-2xl <?php echo e($cs['ib']); ?> flex items-center justify-center mb-3">
            <i data-lucide="<?php echo e($col['icon']); ?>" class="w-7 h-7 <?php echo e($cs['ic']); ?>

                <?php echo e($col['color']==='red' ? 'animate-pulse' : ''); ?>"></i>
        </div>
        <p class="text-4xl font-display font-bold <?php echo e($cs['nc']); ?> mb-1"><?php echo e($col['count']); ?></p>
        <p class="text-white text-sm font-semibold mb-0.5"><?php echo e($col['label']); ?></p>
        <p class="text-cyan-100/40 text-xs mb-4"><?php echo e($col['sub']); ?></p>
        <span class="px-4 py-1.5 rounded-xl border text-xs font-semibold <?php echo e($cs['btn']); ?> transition-colors">
            Filtrer →
        </span>
    </button>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>


<div class="grid lg:grid-cols-5 gap-6 fade-up" style="animation-delay:.2s">

    
    <div class="glass rounded-2xl overflow-hidden lg:col-span-3">
        <div class="px-5 py-4 border-b border-white/5 flex flex-wrap items-center gap-3 justify-between">
            <div>
                <h2 class="text-white font-display font-bold">Toutes les réclamations</h2>
                <p class="text-cyan-100/50 text-xs mt-0.5">Signalements des citoyens</p>
            </div>
            <div class="flex gap-1.5" id="rec-filters">
                <button onclick="filterRec('all')"         data-f="all"         class="rec-tab tab-active  px-2.5 py-1 rounded-lg text-[11px] font-semibold border transition-all">Tous</button>
                <button onclick="filterRec('pending')"     data-f="pending"     class="rec-tab tab-inactive px-2.5 py-1 rounded-lg text-[11px] font-semibold border transition-all">Non traités</button>
                <button onclick="filterRec('in_progress')" data-f="in_progress" class="rec-tab tab-inactive px-2.5 py-1 rounded-lg text-[11px] font-semibold border transition-all">En cours</button>
                <button onclick="filterRec('resolved')"    data-f="resolved"    class="rec-tab tab-inactive px-2.5 py-1 rounded-lg text-[11px] font-semibold border transition-all">Résolus</button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-white/5 text-left">
                        <th class="px-4 py-2.5 text-[11px] font-semibold text-cyan-100/40">ID · Type</th>
                        <th class="px-3 py-2.5 text-[11px] font-semibold text-cyan-100/40 hidden md:table-cell">Zone</th>
                        <th class="px-3 py-2.5 text-[11px] font-semibold text-cyan-100/40 hidden sm:table-cell">Citoyen</th>
                        <th class="px-3 py-2.5 text-[11px] font-semibold text-cyan-100/40 text-center">Priorité</th>
                        <th class="px-3 py-2.5 text-[11px] font-semibold text-cyan-100/40 text-center">Statut</th>
                        <th class="px-3 py-2.5 text-[11px] font-semibold text-cyan-100/40 text-right hidden lg:table-cell">Date</th>
                    </tr>
                </thead>
                <tbody id="rec-tbody" class="divide-y divide-white/[.04]">
                    <?php $__currentLoopData = $reclamations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $ps = $priorityStyle[$rec['priority']];
                        $ss = $statusStyle[$rec['status']];
                    ?>
                    <tr class="trow transition-colors rec-row cursor-pointer"
                        data-status="<?php echo e($rec['status']); ?>"
                        onclick="openRecModal(<?php echo e($loop->index); ?>)">
                        <td class="px-4 py-3">
                            <span class="text-[10px] font-mono font-bold text-cyan-400"><?php echo e($rec['id']); ?></span>
                            <p class="text-white text-xs font-semibold mt-0.5 max-w-[140px] truncate"><?php echo e($rec['type']); ?></p>
                        </td>
                        <td class="px-3 py-3 hidden md:table-cell">
                            <span class="text-xs text-cyan-100/60"><?php echo e($rec['zone']); ?></span>
                        </td>
                        <td class="px-3 py-3 hidden sm:table-cell">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-teal-500/20 border border-teal-400/20 flex items-center
                                             justify-center text-[9px] font-bold text-teal-300 shrink-0">
                                    <?php echo e($rec['citizen_init']); ?>

                                </div>
                                <span class="text-xs text-cyan-100/60 truncate max-w-[80px]"><?php echo e($rec['citizen']); ?></span>
                            </div>
                        </td>
                        <td class="px-3 py-3 text-center">
                            <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded-full text-[10px] font-bold
                                         <?php echo e($ps['bg']); ?> <?php echo e($ps['text']); ?>">
                                <span class="w-1.5 h-1.5 rounded-full <?php echo e($ps['dot']); ?>

                                    <?php echo e($rec['priority']==='critical' ? 'animate-pulse' : ''); ?>"></span>
                                <?php echo e($ps['label']); ?>

                            </span>
                        </td>
                        <td class="px-3 py-3 text-center">
                            <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded-full text-[10px] font-bold
                                         <?php echo e($ss['bg']); ?> <?php echo e($ss['text']); ?>">
                                <span class="w-1.5 h-1.5 rounded-full <?php echo e($ss['dot']); ?>"></span>
                                <?php echo e($ss['label']); ?>

                            </span>
                        </td>
                        <td class="px-3 py-3 text-right hidden lg:table-cell">
                            <span class="text-[10px] text-cyan-100/30"><?php echo e($rec['created_at']); ?></span>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <div id="rec-empty" class="hidden py-10 text-center">
            <i data-lucide="check-circle" class="w-10 h-10 text-teal-400/40 mx-auto mb-2"></i>
            <p class="text-cyan-100/40 text-sm">Aucune réclamation dans cette catégorie</p>
        </div>
        <div class="px-5 py-3 border-t border-white/5 flex items-center justify-between">
            <span class="text-[11px] text-cyan-100/35" id="rec-count"><?php echo e($totalRec); ?> réclamations</span>
            <a href="<?php echo e(route('admin.logs')); ?>"
               class="text-xs text-cyan-400 hover:text-cyan-300 font-semibold transition-colors">
                Historique complet →
            </a>
        </div>
    </div>

    
    <div class="glass rounded-2xl overflow-hidden lg:col-span-2">
        <div class="px-5 py-4 border-b border-white/5">
            <h2 class="text-white font-display font-bold text-sm">Activité en temps réel</h2>
            <p class="text-cyan-100/50 text-xs mt-0.5">Flux AquaSecure</p>
        </div>
        <div class="relative">
            <div class="absolute left-9 top-2 bottom-2 w-px bg-gradient-to-b from-cyan-500/20 to-transparent pointer-events-none"></div>
            <div class="divide-y divide-white/[.04]">
                <?php $__currentLoopData = array_slice($funcAct, 0, 7); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $actBg = match($act['color']) {
                        'teal'  => 'bg-teal-500/15',
                        'amber' => 'bg-amber-500/15',
                        'blue'  => 'bg-blue-500/15',
                        default => 'bg-cyan-500/15',
                    };
                    $actTx = match($act['color']) {
                        'teal'  => 'text-teal-400',
                        'amber' => 'text-amber-400',
                        'blue'  => 'text-blue-400',
                        default => 'text-cyan-400',
                    };
                    $roleActBg = ['citizen'=>'bg-teal-500/15','manager'=>'bg-blue-500/15','technician'=>'bg-cyan-500/15','admin'=>'bg-violet-500/15'][$act['role']] ?? 'bg-white/5';
                    $roleActTx = ['citizen'=>'text-teal-300', 'manager'=>'text-blue-300', 'technician'=>'text-cyan-300', 'admin'=>'text-violet-300'][$act['role']] ?? 'text-white';
                    $roleLabel = ['citizen'=>'Citoyen','manager'=>'Gestionnaire','technician'=>'Technicien','admin'=>'Admin'][$act['role']] ?? $act['role'];
                ?>
                <div class="flex items-start gap-2.5 px-4 py-2.5 hover:bg-white/[.02] transition-colors">
                    <div class="w-7 h-7 rounded-lg <?php echo e($actBg); ?> flex items-center justify-center shrink-0 mt-0.5 relative z-10">
                        <i data-lucide="<?php echo e($act['icon']); ?>" class="w-3 h-3 <?php echo e($actTx); ?>"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-1.5 flex-wrap">
                            <span class="text-white text-xs font-semibold truncate"><?php echo e($act['actor']); ?></span>
                            <span class="px-1.5 py-0.5 rounded text-[9px] font-bold <?php echo e($roleActBg); ?> <?php echo e($roleActTx); ?>">
                                <?php echo e($roleLabel); ?>

                            </span>
                        </div>
                        <p class="text-cyan-100/50 text-[11px] mt-0.5 leading-tight"><?php echo e($act['event']); ?></p>
                    </div>
                    <span class="text-[10px] text-cyan-100/30 shrink-0 mt-0.5 whitespace-nowrap"><?php echo e($act['time']); ?></span>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>


<div class="glass rounded-2xl overflow-hidden fade-up" style="animation-delay:.25s">
    <div class="px-6 py-4 border-b border-white/5 flex flex-wrap items-center gap-3 justify-between">
        <div>
            <h2 class="text-white font-display font-bold">Gestion des comptes</h2>
            <p class="text-cyan-100/50 text-xs mt-0.5">
                <?php echo e($totalAccounts); ?> comptes ·
                <span class="text-teal-400"><?php echo e($activeAccounts); ?> actifs</span> ·
                <span class="text-red-400"><?php echo e($blockedAccounts); ?> bloqués</span>
            </p>
        </div>
        <div class="flex items-center gap-2">
            
            <div class="flex gap-1" id="acc-filters">
                <?php $__currentLoopData = ['all'=>'Tous', 'citizen'=>'Citoyens', 'technician'=>'Techniciens', 'manager'=>'Gestionnaires']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fval => $flbl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <button onclick="filterAccounts('<?php echo e($fval); ?>')" data-af="<?php echo e($fval); ?>"
                        class="acc-tab px-2.5 py-1 rounded-lg text-[11px] font-semibold border transition-all
                               <?php echo e($fval==='all' ? 'tab-active' : 'tab-inactive'); ?>">
                    <?php echo e($flbl); ?>

                </button>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <button onclick="showToast('Formulaire nouvel utilisateur', 'info')"
                    class="glass px-3 py-1.5 rounded-xl text-xs text-cyan-300 hover:text-white font-semibold
                           flex items-center gap-1.5 transition-all hover:border-cyan-400/40">
                <i data-lucide="user-plus" class="w-3.5 h-3.5"></i>
                <span class="hidden sm:inline">Nouveau compte</span>
            </button>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-white/5 text-left">
                    <th class="px-5 py-2.5 text-[11px] font-semibold text-cyan-100/40">Utilisateur</th>
                    <th class="px-3 py-2.5 text-[11px] font-semibold text-cyan-100/40 text-center">Rôle</th>
                    <th class="px-3 py-2.5 text-[11px] font-semibold text-cyan-100/40 hidden md:table-cell">Zone</th>
                    <th class="px-3 py-2.5 text-[11px] font-semibold text-cyan-100/40 text-center">Statut</th>
                    <th class="px-3 py-2.5 text-[11px] font-semibold text-cyan-100/40 text-center hidden sm:table-cell">Réclamations</th>
                    <th class="px-3 py-2.5 text-[11px] font-semibold text-cyan-100/40 hidden lg:table-cell">Dernière connexion</th>
                    <th class="px-3 py-2.5 text-[11px] font-semibold text-cyan-100/40 text-right">Actions</th>
                </tr>
            </thead>
            <tbody id="acc-tbody" class="divide-y divide-white/[.04]">
                <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $acc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $rs = $roleStyle[$acc['role']]; ?>
                <tr class="trow transition-colors acc-row" data-role="<?php echo e($acc['role']); ?>" data-id="<?php echo e($acc['id']); ?>">
                    
                    <td class="px-5 py-3">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-gradient-to-br <?php echo e($rs['avatar']); ?> border <?php echo e($rs['border']); ?>

                                         flex items-center justify-center text-xs font-bold <?php echo e($rs['text']); ?> shrink-0">
                                <?php echo e($acc['initials']); ?>

                            </div>
                            <div class="min-w-0">
                                <p class="text-white text-xs font-semibold truncate"><?php echo e($acc['name']); ?></p>
                                <p class="text-cyan-100/40 text-[10px] truncate"><?php echo e($acc['email']); ?></p>
                            </div>
                        </div>
                    </td>
                    
                    <td class="px-3 py-3 text-center">
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold <?php echo e($rs['bg']); ?> <?php echo e($rs['text']); ?>">
                            <?php echo e($rs['label']); ?>

                        </span>
                    </td>
                    
                    <td class="px-3 py-3 hidden md:table-cell">
                        <span class="text-xs text-cyan-100/55 truncate max-w-[100px] block"><?php echo e($acc['zone']); ?></span>
                    </td>
                    
                    <td class="px-3 py-3 text-center">
                        <span id="status-badge-<?php echo e($acc['id']); ?>"
                              class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold
                                     <?php echo e($acc['status']==='active'
                                        ? 'bg-teal-500/15 text-teal-300'
                                        : 'bg-red-500/15 text-red-300'); ?>">
                            <span class="w-1.5 h-1.5 rounded-full
                                <?php echo e($acc['status']==='active' ? 'bg-teal-400' : 'bg-red-400'); ?>"></span>
                            <?php echo e($acc['status']==='active' ? 'Actif' : 'Bloqué'); ?>

                        </span>
                    </td>
                    
                    <td class="px-3 py-3 text-center hidden sm:table-cell">
                        <?php if($acc['reports'] > 0): ?>
                        <span class="inline-flex items-center justify-center w-6 h-6 rounded-full
                                     bg-amber-500/15 text-amber-300 text-[11px] font-bold">
                            <?php echo e($acc['reports']); ?>

                        </span>
                        <?php else: ?>
                        <span class="text-cyan-100/25 text-xs">—</span>
                        <?php endif; ?>
                    </td>
                    
                    <td class="px-3 py-3 hidden lg:table-cell">
                        <span class="text-[11px] text-cyan-100/40 whitespace-nowrap"><?php echo e($acc['last_seen']); ?></span>
                    </td>
                    
                    <td class="px-3 py-3">
                        <div class="flex items-center justify-end gap-1.5">
                            
                            <a href="<?php echo e(route('admin.users.index')); ?>"
                               class="glass p-1.5 rounded-lg text-cyan-400/60 hover:text-cyan-300 transition-colors"
                               title="Voir le profil">
                                <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                            </a>
                            
                            <button onclick="showToast('Modifier <?php echo e($acc['name']); ?>', 'info')"
                                    class="glass p-1.5 rounded-lg text-blue-400/60 hover:text-blue-300 transition-colors"
                                    title="Modifier">
                                <i data-lucide="pencil" class="w-3.5 h-3.5"></i>
                            </button>
                            
                            <?php if($acc['role'] !== 'admin'): ?>
                            <button id="action-btn-<?php echo e($acc['id']); ?>"
                                    onclick="toggleBlock(<?php echo e($acc['id']); ?>, '<?php echo e($acc['status']); ?>', '<?php echo e(addslashes($acc['name'])); ?>')"
                                    class="glass p-1.5 rounded-lg border transition-all
                                           <?php echo e($acc['status']==='active'
                                              ? 'btn-block'
                                              : 'btn-unblock'); ?>"
                                    title="<?php echo e($acc['status']==='active' ? 'Bloquer' : 'Débloquer'); ?>">
                                <i data-lucide="<?php echo e($acc['status']==='active' ? 'ban' : 'unlock'); ?>"
                                   class="w-3.5 h-3.5"></i>
                            </button>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <div id="acc-empty" class="hidden py-10 text-center">
        <i data-lucide="users" class="w-10 h-10 text-cyan-400/30 mx-auto mb-2"></i>
        <p class="text-cyan-100/40 text-sm">Aucun compte dans cette catégorie</p>
    </div>

    <div class="px-5 py-3 border-t border-white/5 flex items-center justify-between">
        <span class="text-[11px] text-cyan-100/35" id="acc-count"><?php echo e($totalAccounts); ?> comptes</span>
        <a href="<?php echo e(route('admin.users.index')); ?>"
           class="text-xs text-cyan-400 hover:text-cyan-300 font-semibold transition-colors">
            Gestion complète →
        </a>
    </div>
</div>


<div class="grid lg:grid-cols-2 gap-6 fade-up" style="animation-delay:.3s">

    
    <div class="glass rounded-2xl p-6">
        <div class="flex items-center justify-between mb-5">
            <div>
                <h2 class="text-white font-display font-bold">Répartition des comptes</h2>
                <p class="text-cyan-100/50 text-xs mt-0.5"><?php echo e($totalAccounts); ?> comptes enregistrés</p>
            </div>
        </div>
        <?php
            $distData = [
                ['label'=>'Citoyens',    'count'=>$citizens,         'color'=>'#2dd4bf'],
                ['label'=>'Techniciens', 'count'=>$techniciansCount, 'color'=>'#38bdf8'],
                ['label'=>'Gestionnaires','count'=>$managersCount,   'color'=>'#818cf8'],
                ['label'=>'Admins',      'count'=> count(array_filter($accounts,fn($a)=>$a['role']==='admin')), 'color'=>'#f472b6'],
            ];
            $dTotal = array_sum(array_column($distData,'count'));
            $dCirc  = 2 * M_PI * 50;
            $dOff   = 0;
        ?>
        <div class="flex items-center gap-6">
            <svg width="130" height="130" viewBox="0 0 130 130" class="shrink-0">
                <?php $__currentLoopData = $distData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $dDash = ($dr['count']/$dTotal)*$dCirc; ?>
                <circle cx="65" cy="65" r="50" fill="none" stroke="<?php echo e($dr['color']); ?>"
                        stroke-width="16"
                        stroke-dasharray="<?php echo e($dDash); ?> <?php echo e($dCirc - $dDash); ?>"
                        stroke-dashoffset="<?php echo e(-$dOff); ?>"
                        transform="rotate(-90 65 65)" class="donut-seg"
                        style="animation-delay:<?php echo e($loop->index * 0.1); ?>s"/>
                <?php $dOff += $dDash; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <text x="65" y="60" text-anchor="middle" font-size="20" font-weight="700"
                      fill="#f0fdff" font-family="Space Grotesk"><?php echo e($dTotal); ?></text>
                <text x="65" y="74" text-anchor="middle" font-size="9"
                      fill="rgba(156,200,216,.5)" font-family="Plus Jakarta Sans">comptes</text>
            </svg>
            <div class="flex-1 space-y-3">
                <?php $__currentLoopData = $distData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full" style="background:<?php echo e($dr['color']); ?>"></span>
                            <span class="text-xs text-cyan-100/65"><?php echo e($dr['label']); ?></span>
                        </div>
                        <span class="text-xs font-bold text-white"><?php echo e(number_format($dr['count'],0,',',' ')); ?></span>
                    </div>
                    <div class="h-1.5 bg-slate-950/60 rounded-full overflow-hidden">
                        <div class="h-full rounded-full bar-grow"
                             style="width:<?php echo e($dTotal > 0 ? max(2, round($dr['count']/$dTotal*100)) : 0); ?>%;
                                    background:<?php echo e($dr['color']); ?>;
                                    animation-delay:<?php echo e($loop->index * 0.12); ?>s"></div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
                <div class="pt-3 border-t border-white/5 flex items-center justify-between text-xs">
                    <span class="flex items-center gap-1.5 text-red-300">
                        <span class="w-2 h-2 rounded-full bg-red-400 animate-pulse"></span>
                        Comptes bloqués
                    </span>
                    <span class="font-bold text-red-300"><?php echo e($blockedAccounts); ?></span>
                </div>
            </div>
        </div>
    </div>

    
    <div class="glass rounded-2xl overflow-hidden">
        <div class="px-6 py-4 border-b border-white/5">
            <h2 class="text-white font-display font-bold">Techniciens sur le terrain</h2>
            <p class="text-cyan-100/50 text-xs mt-0.5">
                <?php echo e(count(array_filter($technicians,fn($t)=>$t['status']==='on_mission'))); ?> en mission ·
                <?php echo e(count(array_filter($technicians,fn($t)=>$t['status']==='available'))); ?> disponibles
            </p>
        </div>
        <div class="divide-y divide-white/[.04]">
            <?php $__currentLoopData = $technicians; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tech): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $ts = [
                    'on_mission' => ['dot'=>'bg-amber-400 animate-pulse','text'=>'text-amber-300','label'=>'En mission','interv_bg'=>'bg-amber-500/15'],
                    'available'  => ['dot'=>'bg-teal-400',               'text'=>'text-teal-300', 'label'=>'Disponible', 'interv_bg'=>'bg-teal-500/15'],
                    'off_duty'   => ['dot'=>'bg-slate-500',              'text'=>'text-slate-400','label'=>'Hors service','interv_bg'=>'bg-slate-500/15'],
                ][$tech['status']];
            ?>
            <div class="flex items-center gap-3 px-5 py-3 hover:bg-white/[.02] transition-colors">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-cyan-500/20 to-cyan-700/20
                             border border-cyan-400/15 flex items-center justify-center
                             text-xs font-bold text-cyan-300 shrink-0">
                    <?php echo e($tech['initials']); ?>

                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-white text-sm font-semibold truncate"><?php echo e($tech['name']); ?></p>
                    <p class="text-cyan-100/40 text-xs truncate"><?php echo e($tech['zone']); ?></p>
                </div>
                <div class="flex items-center gap-2 shrink-0">
                    <?php if($tech['interventions'] > 0): ?>
                    <span class="w-6 h-6 rounded-full <?php echo e($ts['interv_bg']); ?> <?php echo e($ts['text']); ?>

                                  text-[11px] font-bold flex items-center justify-center">
                        <?php echo e($tech['interventions']); ?>

                    </span>
                    <?php endif; ?>
                    <div class="flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full <?php echo e($ts['dot']); ?>"></span>
                        <span class="text-xs <?php echo e($ts['text']); ?> font-medium hidden sm:inline"><?php echo e($ts['label']); ?></span>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>

</div>


<div id="rec-modal" class="hidden fixed inset-0 z-[200] flex items-end sm:items-center justify-center p-4 bg-black/65 backdrop-blur-sm"
     onclick="if(event.target===this) closeRecModal()">
    <div class="glass-strong rounded-2xl w-full max-w-lg overflow-hidden animate-scale-in" onclick="event.stopPropagation()">
        <div class="flex items-center justify-between px-6 py-4 border-b border-white/5">
            <h3 class="text-white font-display font-bold" id="modal-title">Détail réclamation</h3>
            <button onclick="closeRecModal()" class="text-cyan-100/50 hover:text-white transition-colors">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <div id="modal-body" class="p-6 space-y-4 overflow-y-auto max-h-[70vh]">
            
        </div>
        <div class="px-6 py-4 border-t border-white/5 flex justify-end gap-2">
            <button onclick="closeRecModal()"
                    class="glass px-4 py-2 rounded-xl text-sm text-cyan-100/60 hover:text-white font-semibold transition-colors">
                Fermer
            </button>
            <button onclick="showToast('Réclamation assignée à un technicien', 'success'); closeRecModal()"
                    class="bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500
                           text-white text-sm font-semibold px-4 py-2 rounded-xl transition-all">
                Assigner technicien
            </button>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV/XN/WLI=" crossorigin=""></script>

<script>
/* ─── Data ───────────────────────────────────────────────── */
const MAP_ZONES    = <?php echo json_encode($mapZones, 15, 512) ?>;
const RECLAMATIONS = <?php echo json_encode($reclamations, 15, 512) ?>;

/* ─── Leaflet Map ────────────────────────────────────────── */
(function initMap() {
    const map = L.map('admin-map', {
        center: [34.0, 9.4], zoom: 6,
        zoomControl: false, attributionControl: false,
        scrollWheelZoom: false,
    });
    L.control.zoom({ position: 'topright' }).addTo(map);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 18 }).addTo(map);

    /* ── Zone polylines / background markers ── */
    const zoneColors = { normal:'#2dd4bf', alert:'#fbbf24', critical:'#ef4444' };
    MAP_ZONES.forEach(z => {
        const c = zoneColors[z.status] ?? '#2dd4bf';
        const size = 24, half = 12;
        const svg = `<svg xmlns="http://www.w3.org/2000/svg" width="${size}" height="${size}" viewBox="0 0 ${size} ${size}">
            <circle cx="${half}" cy="${half}" r="${half-2}" fill="${c}" fill-opacity="0.12" stroke="${c}" stroke-width="1.5" stroke-dasharray="3,2"/>
        </svg>`;
        L.marker([z.lat, z.lng], {
            icon: L.divIcon({ html: svg, iconSize:[size,size], iconAnchor:[half,half], className:'' }),
            zIndexOffset: -100,
        }).addTo(map).bindTooltip(
            `<b style="color:#f0fdff;font-size:11px">${z.emoji} ${z.name}</b><br>
             <span style="color:${c};font-size:10px">Qualité: ${z.quality}%</span>`,
            { className:'', sticky: true }
        );
    });

    /* ── Réclamation markers ── */
    // Couleur selon statut : pending=rouge, in_progress=orange, resolved=vert
    const recColors = { pending:'#ef4444', in_progress:'#f97316', resolved:'#2dd4bf' };
    const recIcons  = { pending:'⚠', in_progress:'🔧', resolved:'✓' };

    RECLAMATIONS.forEach((r, idx) => {
        const c    = recColors[r.status] ?? '#9ca3af';
        const icon = recIcons[r.status] ?? '•';
        const pulse = r.status !== 'resolved';
        const size  = r.status === 'pending' ? 38 : 32, half = size / 2;

        const svg = `<svg xmlns="http://www.w3.org/2000/svg" width="${size}" height="${size}" viewBox="0 0 ${size} ${size}">
            ${pulse ? `<circle cx="${half}" cy="${half}" r="${half}" fill="${c}" opacity="0.18">
                <animate attributeName="r" from="${half}" to="${size}" dur="2s" repeatCount="indefinite"/>
                <animate attributeName="opacity" from="0.25" to="0" dur="2s" repeatCount="indefinite"/>
            </circle>` : ''}
            <circle cx="${half}" cy="${half}" r="${half-3}" fill="${c}" fill-opacity="0.25" stroke="${c}" stroke-width="2"/>
            <circle cx="${half}" cy="${half}" r="${half-9}" fill="${c}" fill-opacity="0.9"/>
            <text x="${half}" y="${half+4}" text-anchor="middle" font-size="10" fill="white">${icon}</text>
        </svg>`;

        L.marker([r.lat, r.lng], {
            icon: L.divIcon({ html: svg, iconSize:[size,size], iconAnchor:[half,half], className:'' }),
            zIndexOffset: 100,
        }).addTo(map).bindPopup(buildRecPopup(r), { maxWidth: 260 });
    });
})();

function buildRecPopup(r) {
    const statusColor = { pending:'#ef4444', in_progress:'#f97316', resolved:'#2dd4bf' };
    const statusLabel = { pending:'Non traité', in_progress:'En cours', resolved:'Résolu' };
    const priColor    = { critical:'#ef4444', medium:'#fbbf24', low:'#38bdf8' };
    const priLabel    = { critical:'Critique',  medium:'Moyenne', low:'Faible' };
    const sc = statusColor[r.status] ?? '#9ca3af';
    const sl = statusLabel[r.status] ?? r.status;
    const pc = priColor[r.priority] ?? '#38bdf8';
    const pl = priLabel[r.priority] ?? r.priority;

    return `<div style="padding:14px;font-family:'Plus Jakarta Sans',sans-serif">
        <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;gap:8px">
            <div>
                <p style="margin:0;color:rgba(156,200,216,.6);font-size:10px;font-family:monospace">${r.id}</p>
                <h3 style="margin:2px 0 0;color:#f0fdff;font-size:13px;font-weight:700">${r.type}</h3>
            </div>
            <span style="padding:3px 8px;border-radius:20px;font-size:10px;font-weight:700;
                         background:${sc}20;border:1px solid ${sc}50;color:${sc};white-space:nowrap">${sl}</span>
        </div>
        <p style="margin:0 0 8px;color:rgba(156,200,216,.6);font-size:11px;line-height:1.4">${r.description}</p>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:6px;margin-bottom:10px">
            <div style="background:rgba(255,255,255,.04);border-radius:7px;padding:6px 8px">
                <p style="margin:0 0 2px;color:rgba(156,200,216,.5);font-size:9px">Zone</p>
                <p style="margin:0;color:#f0fdff;font-size:11px;font-weight:600">${r.zone}</p>
            </div>
            <div style="background:rgba(255,255,255,.04);border-radius:7px;padding:6px 8px">
                <p style="margin:0 0 2px;color:rgba(156,200,216,.5);font-size:9px">Priorité</p>
                <p style="margin:0;color:${pc};font-size:11px;font-weight:600">${pl}</p>
            </div>
            <div style="background:rgba(255,255,255,.04);border-radius:7px;padding:6px 8px">
                <p style="margin:0 0 2px;color:rgba(156,200,216,.5);font-size:9px">Citoyen</p>
                <p style="margin:0;color:#f0fdff;font-size:11px;font-weight:600">${r.citizen}</p>
            </div>
            <div style="background:rgba(255,255,255,.04);border-radius:7px;padding:6px 8px">
                <p style="margin:0 0 2px;color:rgba(156,200,216,.5);font-size:9px">Technicien</p>
                <p style="margin:0;color:${r.technician?'#5ee5f7':'rgba(156,200,216,.4)'};font-size:11px;font-weight:600">${r.technician ?? 'Non assigné'}</p>
            </div>
        </div>
        <p style="margin:0;color:rgba(156,200,216,.4);font-size:10px">
            Signalé le ${r.created_at} · Mis à jour ${r.updated_at}
        </p>
    </div>`;
}

/* ─── Filter réclamations ────────────────────────────────── */
function filterRec(filter) {
    // Update tabs
    document.querySelectorAll('.rec-tab').forEach(b => {
        b.classList.toggle('tab-active',   b.dataset.f === filter);
        b.classList.toggle('tab-inactive', b.dataset.f !== filter);
    });

    let visible = 0;
    document.querySelectorAll('.rec-row').forEach(row => {
        const show = filter === 'all' || row.dataset.status === filter;
        row.style.display = show ? '' : 'none';
        if (show) visible++;
    });

    document.getElementById('rec-empty').classList.toggle('hidden', visible > 0);
    document.getElementById('rec-count').textContent = visible + ' réclamation' + (visible>1?'s':'');
}

/* ─── Filter comptes ────────────────────────────────────── */
function filterAccounts(filter) {
    document.querySelectorAll('.acc-tab').forEach(b => {
        b.classList.toggle('tab-active',   b.dataset.af === filter);
        b.classList.toggle('tab-inactive', b.dataset.af !== filter);
    });

    let visible = 0;
    document.querySelectorAll('.acc-row').forEach(row => {
        const show = filter === 'all' || row.dataset.role === filter;
        row.style.display = show ? '' : 'none';
        if (show) visible++;
    });

    document.getElementById('acc-empty').classList.toggle('hidden', visible > 0);
    document.getElementById('acc-count').textContent = visible + ' compte' + (visible>1?'s':'');
}

/* ─── Bloquer / Débloquer compte ─────────────────────────── */
function toggleBlock(id, currentStatus, name) {
    const isBlocking = currentStatus === 'active';
    const action     = isBlocking ? 'bloquer' : 'débloquer';
    const confirm    = window.confirm(`Voulez-vous ${action} le compte de ${name} ?`);
    if (!confirm) return;

    // Mise à jour visuelle (frontend uniquement)
    const badge  = document.getElementById('status-badge-' + id);
    const btn    = document.getElementById('action-btn-' + id);

    if (isBlocking) {
        // → bloquer
        badge.className = 'inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-red-500/15 text-red-300';
        badge.innerHTML = '<span class="w-1.5 h-1.5 rounded-full bg-red-400"></span>Bloqué';
        btn.className   = btn.className.replace('btn-block', 'btn-unblock');
        btn.title       = 'Débloquer';
        btn.innerHTML   = '<i data-lucide="unlock" style="width:14px;height:14px"></i>';
        btn.setAttribute('onclick', `toggleBlock(${id}, 'blocked', '${name.replace(/'/g,"\\'")}') `);
        showToast(`Compte de ${name} bloqué`, 'error');
    } else {
        // → débloquer
        badge.className = 'inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-teal-500/15 text-teal-300';
        badge.innerHTML = '<span class="w-1.5 h-1.5 rounded-full bg-teal-400"></span>Actif';
        btn.className   = btn.className.replace('btn-unblock', 'btn-block');
        btn.title       = 'Bloquer';
        btn.innerHTML   = '<i data-lucide="ban" style="width:14px;height:14px"></i>';
        btn.setAttribute('onclick', `toggleBlock(${id}, 'active', '${name.replace(/'/g,"\\'")}') `);
        showToast(`Compte de ${name} débloqué`, 'success');
    }

    if (typeof lucide !== 'undefined') lucide.createIcons();
}

/* ─── Modal réclamation ──────────────────────────────────── */
function openRecModal(idx) {
    const r = RECLAMATIONS[idx];
    if (!r) return;

    const statusColor = { pending:'#ef4444', in_progress:'#f97316', resolved:'#2dd4bf' };
    const statusLabel = { pending:'Non traité', in_progress:'En cours', resolved:'Résolu' };
    const priColor    = { critical:'#ef4444', medium:'#fbbf24', low:'#38bdf8' };
    const priLabel    = { critical:'Critique', medium:'Moyenne', low:'Faible' };

    document.getElementById('modal-title').textContent = r.id + ' — ' + r.type;
    document.getElementById('modal-body').innerHTML = `
        <div style="background:rgba(255,255,255,.03);border-radius:12px;padding:12px 14px;margin-bottom:4px">
            <p style="color:rgba(156,200,216,.6);font-size:11px;margin:0 0 4px">Description</p>
            <p style="color:#f0fdff;font-size:13px;margin:0;line-height:1.5">${r.description}</p>
        </div>
        <div class="grid grid-cols-2 gap-3">
            ${infoBox('Zone',      r.zone,         '#38bdf8')}
            ${infoBox('Adresse',   r.address,      'rgba(156,200,216,.7)')}
            ${infoBox('Citoyen',   r.citizen,      '#2dd4bf')}
            ${infoBox('Priorité',  priLabel[r.priority] ?? r.priority, priColor[r.priority] ?? '#9ca3af')}
            ${infoBox('Statut',    statusLabel[r.status] ?? r.status,  statusColor[r.status] ?? '#9ca3af')}
            ${infoBox('Technicien',r.technician ?? 'Non assigné',      r.technician ? '#5ee5f7' : 'rgba(156,200,216,.4)')}
            ${infoBox('Gestionnaire',r.manager ?? 'Non assigné',       r.manager ? '#818cf8' : 'rgba(156,200,216,.4)')}
            ${infoBox('Créé le',   r.created_at,   'rgba(156,200,216,.6)')}
        </div>`;

    document.getElementById('rec-modal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    if (typeof lucide !== 'undefined') lucide.createIcons();
}

function infoBox(label, value, color) {
    return `<div style="background:rgba(255,255,255,.03);border-radius:10px;padding:10px 12px">
        <p style="color:rgba(156,200,216,.5);font-size:10px;margin:0 0 3px">${label}</p>
        <p style="color:${color};font-size:12px;font-weight:600;margin:0">${value}</p>
    </div>`;
}

function closeRecModal() {
    document.getElementById('rec-modal').classList.add('hidden');
    document.body.style.overflow = '';
}
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeRecModal(); });

/* ─── Init Lucide ────────────────────────────────────────── */
document.addEventListener('DOMContentLoaded', () => {
    if (typeof lucide !== 'undefined') lucide.createIcons();
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ghada\Desktop\5ème\projet_Laravel\aquasecure\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>
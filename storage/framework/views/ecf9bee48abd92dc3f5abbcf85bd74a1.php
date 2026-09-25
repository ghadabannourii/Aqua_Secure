<?php $__env->startSection('title', 'Tableau de bord Gestionnaire'); ?>

<?php
    use App\Data\PlaceholderData;
    $zones = PlaceholderData::zones();
    $stats = PlaceholderData::stats();
    $user = session('user', ['name' => 'Gestionnaire', 'role' => 'manager']);
?>

<?php $__env->startSection('content'); ?>
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
                    <p class="text-cyan-100/60 text-sm mt-1"><?php echo e(ucfirst($user['role'])); ?> • <?php echo e($user['name']); ?></p>
                </div>
            </div>
            <?php if (isset($component)) { $__componentOriginal31327652ba86dff3ae51860919901558 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal31327652ba86dff3ae51860919901558 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ripple-button','data' => ['size' => 'md','onclick' => 'showToast(\'Export des données en cours...\', \'info\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ripple-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => 'md','onclick' => 'showToast(\'Export des données en cours...\', \'info\')']); ?>
                <i data-lucide="download" class="w-4 h-4"></i>
                Exporter
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal31327652ba86dff3ae51860919901558)): ?>
<?php $attributes = $__attributesOriginal31327652ba86dff3ae51860919901558; ?>
<?php unset($__attributesOriginal31327652ba86dff3ae51860919901558); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal31327652ba86dff3ae51860919901558)): ?>
<?php $component = $__componentOriginal31327652ba86dff3ae51860919901558; ?>
<?php unset($__componentOriginal31327652ba86dff3ae51860919901558); ?>
<?php endif; ?>
        </div>
        <p class="text-cyan-100/70 max-w-3xl">
            Vue d'ensemble du réseau national, gestion des interventions et supervision des équipes terrain.
        </p>
    </div>

    <!-- Key Metrics -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <?php $__currentLoopData = [
            ['icon' => 'droplet', 'value' => $stats['totalZones'], 'label' => 'Zones surveillées', 'trend' => '+2', 'color' => 'cyan'],
            ['icon' => 'alert-circle', 'value' => $stats['activeIncidents'], 'label' => 'Incidents actifs', 'trend' => '-5', 'color' => 'orange'],
            ['icon' => 'users', 'value' => '47', 'label' => 'Techniciens actifs', 'trend' => '+3', 'color' => 'teal'],
            ['icon' => 'activity', 'value' => '94%', 'label' => 'Taux disponibilité', 'trend' => '+1%', 'color' => 'blue'],
        ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $metric): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="glass p-5 rounded-2xl hover-lift">
            <div class="flex items-start justify-between mb-3">
                <div class="w-12 h-12 rounded-xl bg-<?php echo e($metric['color']); ?>-500/10 flex items-center justify-center">
                    <i data-lucide="<?php echo e($metric['icon']); ?>" class="w-6 h-6 text-<?php echo e($metric['color']); ?>-400"></i>
                </div>
                <span class="text-xs font-semibold <?php echo e(strpos($metric['trend'], '+') === 0 ? 'text-teal-400' : 'text-red-400'); ?>">
                    <?php echo e($metric['trend']); ?>

                </span>
            </div>
            <div class="text-2xl font-display font-bold text-white mb-1"><?php echo e($metric['value']); ?></div>
            <div class="text-xs text-cyan-100/60"><?php echo e($metric['label']); ?></div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- Main Content Tabs -->
    <div class="glass-strong rounded-2xl overflow-hidden">
        <!-- Tab Navigation -->
        <div class="border-b border-white/5">
            <nav class="flex overflow-x-auto">
                <?php $__currentLoopData = [
                    ['id' => 'overview', 'icon' => 'layout-grid', 'label' => 'Vue d\'ensemble'],
                    ['id' => 'map', 'icon' => 'map', 'label' => 'Carte réseau'],
                    ['id' => 'reports', 'icon' => 'file-text', 'label' => 'Rapports'],
                    ['id' => 'projects', 'icon' => 'briefcase', 'label' => 'Projets'],
                    ['id' => 'stats', 'icon' => 'bar-chart', 'label' => 'Statistiques'],
                ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <button 
                    onclick="switchTab('<?php echo e($tab['id']); ?>')" 
                    class="tab-btn flex items-center gap-2 px-6 py-4 text-sm font-semibold border-b-2 transition-all whitespace-nowrap <?php echo e($index === 0 ? 'border-cyan-400 text-white' : 'border-transparent text-cyan-100/50 hover:text-cyan-100/80'); ?>"
                    data-tab="<?php echo e($tab['id']); ?>"
                >
                    <i data-lucide="<?php echo e($tab['icon']); ?>" class="w-4 h-4"></i>
                    <span><?php echo e($tab['label']); ?></span>
                </button>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                            <?php $__currentLoopData = [
                                ['id' => '#INC-2026-089', 'type' => 'Fuite majeure', 'zone' => 'Tunis Nord', 'priority' => 'Élevée', 'time' => '15 min', 'priorityColor' => 'red'],
                                ['id' => '#INC-2026-088', 'type' => 'Qualité dégradée', 'zone' => 'Sfax Centre', 'priority' => 'Moyenne', 'time' => '1h 20min', 'priorityColor' => 'orange'],
                                ['id' => '#INC-2026-087', 'type' => 'Pression basse', 'zone' => 'Sousse Nord', 'priority' => 'Faible', 'time' => '2h', 'priorityColor' => 'cyan'],
                            ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $incident): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="glass p-4 rounded-xl hover-lift">
                                <div class="flex items-start justify-between mb-2">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-1">
                                            <span class="text-sm font-mono font-semibold text-cyan-300"><?php echo e($incident['id']); ?></span>
                                            <?php if (isset($component)) { $__componentOriginal2ddbc40e602c342e508ac696e52f8719 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ddbc40e602c342e508ac696e52f8719 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge','data' => ['color' => '#'.e($incident['priorityColor'] === 'red' ? 'ef4444' : ($incident['priorityColor'] === 'orange' ? 'f97316' : '06b6d4')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => '#'.e($incident['priorityColor'] === 'red' ? 'ef4444' : ($incident['priorityColor'] === 'orange' ? 'f97316' : '06b6d4')).'']); ?>
                                                <?php echo e($incident['priority']); ?>

                                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $attributes = $__attributesOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $component = $__componentOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__componentOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
                                        </div>
                                        <h4 class="text-white font-semibold text-sm"><?php echo e($incident['type']); ?></h4>
                                        <p class="text-cyan-100/60 text-xs mt-1"><?php echo e($incident['zone']); ?> • Il y a <?php echo e($incident['time']); ?></p>
                                    </div>
                                    <button class="text-cyan-300 hover:text-cyan-200 transition-colors">
                                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>

                    <!-- Active Teams -->
                    <div>
                        <h3 class="text-lg font-display font-bold text-white mb-4 flex items-center gap-2">
                            <i data-lucide="users" class="w-5 h-5 text-teal-400"></i>
                            Équipes sur le terrain
                        </h3>
                        <div class="space-y-3">
                            <?php $__currentLoopData = [
                                ['name' => 'Équipe Alpha', 'tech' => 'Amira Ben Ali', 'zone' => 'Tunis Nord', 'status' => 'En intervention', 'statusColor' => 'orange'],
                                ['name' => 'Équipe Beta', 'tech' => 'Mohamed Touati', 'zone' => 'Ariana', 'status' => 'En route', 'statusColor' => 'cyan'],
                                ['name' => 'Équipe Gamma', 'tech' => 'Salma Khelifi', 'zone' => 'Sfax Centre', 'status' => 'Disponible', 'statusColor' => 'teal'],
                            ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="glass p-4 rounded-xl hover-lift">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-cyan-500/20 to-blue-600/20 flex items-center justify-center">
                                            <i data-lucide="hard-hat" class="w-5 h-5 text-cyan-300"></i>
                                        </div>
                                        <div>
                                            <h4 class="text-white font-semibold text-sm"><?php echo e($team['name']); ?></h4>
                                            <p class="text-cyan-100/60 text-xs"><?php echo e($team['tech']); ?> • <?php echo e($team['zone']); ?></p>
                                        </div>
                                    </div>
                                    <?php if (isset($component)) { $__componentOriginal2ddbc40e602c342e508ac696e52f8719 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ddbc40e602c342e508ac696e52f8719 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge','data' => ['color' => '#'.e($team['statusColor'] === 'orange' ? 'f97316' : ($team['statusColor'] === 'cyan' ? '06b6d4' : '14b8a6')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => '#'.e($team['statusColor'] === 'orange' ? 'f97316' : ($team['statusColor'] === 'cyan' ? '06b6d4' : '14b8a6')).'']); ?>
                                        <?php echo e($team['status']); ?>

                                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $attributes = $__attributesOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $component = $__componentOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__componentOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                        <?php $__currentLoopData = $zones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="glass p-4 rounded-xl hover-lift cursor-pointer" style="border-color: <?php echo e($zone['color']); ?>40">
                            <div class="flex items-center justify-between mb-2">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background-color: <?php echo e($zone['color']); ?>20">
                                    <i data-lucide="droplet" class="w-4 h-4" style="color: <?php echo e($zone['color']); ?>"></i>
                                </div>
                                <span class="text-xl"><?php echo e($zone['emoji']); ?></span>
                            </div>
                            <h4 class="text-white font-semibold text-sm mb-1"><?php echo e($zone['name']); ?></h4>
                            <div class="flex items-center gap-2">
                                <div class="flex-1 h-1.5 bg-slate-950/50 rounded-full overflow-hidden">
                                    <div class="h-full rounded-full" style="width: <?php echo e($zone['quality']); ?>%; background-color: <?php echo e($zone['color']); ?>"></div>
                                </div>
                                <span class="text-xs font-semibold" style="color: <?php echo e($zone['color']); ?>"><?php echo e($zone['quality']); ?>%</span>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                    <?php $__currentLoopData = [
                        ['icon' => 'file-bar-chart', 'title' => 'Rapport mensuel', 'desc' => 'Septembre 2026', 'color' => 'cyan'],
                        ['icon' => 'trending-up', 'title' => 'Analyse tendances', 'desc' => 'Derniers 90 jours', 'color' => 'teal'],
                        ['icon' => 'clock', 'title' => 'Temps intervention', 'desc' => 'Performance équipes', 'color' => 'blue'],
                        ['icon' => 'droplet', 'title' => 'Qualité de l\'eau', 'desc' => 'Tests laboratoire', 'color' => 'cyan'],
                        ['icon' => 'alert-circle', 'title' => 'Incidents', 'desc' => 'Analyse par type', 'color' => 'orange'],
                        ['icon' => 'users', 'title' => 'Satisfaction', 'desc' => 'Enquêtes citoyens', 'color' => 'teal'],
                    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <button class="glass p-5 rounded-xl hover-lift text-left transition-all hover:border-<?php echo e($report['color']); ?>-400/40">
                        <div class="w-12 h-12 rounded-xl bg-<?php echo e($report['color']); ?>-500/10 flex items-center justify-center mb-3">
                            <i data-lucide="<?php echo e($report['icon']); ?>" class="w-6 h-6 text-<?php echo e($report['color']); ?>-400"></i>
                        </div>
                        <h4 class="text-white font-semibold mb-1"><?php echo e($report['title']); ?></h4>
                        <p class="text-cyan-100/60 text-sm"><?php echo e($report['desc']); ?></p>
                    </button>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <!-- Projects Tab -->
            <div id="tab-projects" class="tab-content hidden">
                <h3 class="text-xl font-display font-bold text-white mb-4">Projets en cours</h3>
                <div class="space-y-4">
                    <?php $__currentLoopData = [
                        ['name' => 'Extension réseau Tunis Nord', 'progress' => 67, 'deadline' => '15 nov 2026', 'team' => '8 personnes', 'status' => 'En cours'],
                        ['name' => 'Modernisation capteurs Sfax', 'progress' => 34, 'deadline' => '30 déc 2026', 'team' => '5 personnes', 'status' => 'En cours'],
                        ['name' => 'Audit qualité Sousse', 'progress' => 89, 'deadline' => '05 oct 2026', 'team' => '3 personnes', 'status' => 'Finalisation'],
                    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="glass p-5 rounded-xl hover-lift">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h4 class="text-white font-semibold mb-2"><?php echo e($project['name']); ?></h4>
                                <div class="flex items-center gap-4 text-xs text-cyan-100/60">
                                    <span class="flex items-center gap-1">
                                        <i data-lucide="calendar" class="w-3.5 h-3.5"></i>
                                        <?php echo e($project['deadline']); ?>

                                    </span>
                                    <span class="flex items-center gap-1">
                                        <i data-lucide="users" class="w-3.5 h-3.5"></i>
                                        <?php echo e($project['team']); ?>

                                    </span>
                                </div>
                            </div>
                            <?php if (isset($component)) { $__componentOriginal2ddbc40e602c342e508ac696e52f8719 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ddbc40e602c342e508ac696e52f8719 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge','data' => ['color' => '#06b6d4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => '#06b6d4']); ?><?php echo e($project['status']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $attributes = $__attributesOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $component = $__componentOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__componentOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
                        </div>
                        <div class="space-y-2">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-cyan-100/70">Progression</span>
                                <span class="text-white font-semibold"><?php echo e($project['progress']); ?>%</span>
                            </div>
                            <div class="h-2 bg-slate-950/50 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-cyan-500 to-blue-600 rounded-full transition-all" style="width: <?php echo e($project['progress']); ?>%"></div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

<?php $__env->startPush('scripts'); ?>
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
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.manager', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ghada\Desktop\5ème\projet_Laravel\aquasecure\resources\views/manager/dashboard.blade.php ENDPATH**/ ?>
<?php $__env->startSection('title', 'Tableau de bord Administrateur'); ?>

<?php
    use App\Data\PlaceholderData;
    $zones = PlaceholderData::zones();
    $stats = PlaceholderData::stats();
    $user = session('user', ['name' => 'Administrateur', 'role' => 'admin']);
?>

<?php $__env->startSection('content'); ?>
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
                    <p class="text-cyan-100/60 text-sm mt-1"><?php echo e($user['name']); ?> • Accès complet</p>
                </div>
            </div>
            <?php if (isset($component)) { $__componentOriginal31327652ba86dff3ae51860919901558 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal31327652ba86dff3ae51860919901558 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ripple-button','data' => ['size' => 'md','onclick' => 'showToast(\'Configuration système ouverte\', \'info\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ripple-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => 'md','onclick' => 'showToast(\'Configuration système ouverte\', \'info\')']); ?>
                <i data-lucide="settings" class="w-4 h-4"></i>
                Configuration
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
            Administration complète du système, gestion des utilisateurs, paramètres et sécurité.
        </p>
    </div>

    <!-- System Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <?php $__currentLoopData = [
            ['icon' => 'users', 'value' => $stats['totalUsers'], 'label' => 'Utilisateurs actifs', 'trend' => '+12', 'color' => 'cyan'],
            ['icon' => 'server', 'value' => $stats['systemUptime'], 'label' => 'Uptime système', 'trend' => '', 'color' => 'teal'],
            ['icon' => 'database', 'value' => '2.4 GB', 'label' => 'Stockage utilisé', 'trend' => '+0.2GB', 'color' => 'blue'],
            ['icon' => 'shield-alert', 'value' => '0', 'label' => 'Alertes sécurité', 'trend' => '0', 'color' => 'purple'],
        ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $metric): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="glass p-5 rounded-2xl hover-lift">
            <div class="flex items-start justify-between mb-3">
                <div class="w-12 h-12 rounded-xl bg-<?php echo e($metric['color']); ?>-500/10 flex items-center justify-center">
                    <i data-lucide="<?php echo e($metric['icon']); ?>" class="w-6 h-6 text-<?php echo e($metric['color']); ?>-400"></i>
                </div>
                <?php if($metric['trend']): ?>
                <span class="text-xs font-semibold <?php echo e($metric['trend'] === '0' ? 'text-teal-400' : (strpos($metric['trend'], '+') === 0 ? 'text-cyan-400' : 'text-red-400')); ?>">
                    <?php echo e($metric['trend']); ?>

                </span>
                <?php endif; ?>
            </div>
            <div class="text-2xl font-display font-bold text-white mb-1"><?php echo e($metric['value']); ?></div>
            <div class="text-xs text-cyan-100/60"><?php echo e($metric['label']); ?></div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- Main Tabs -->
    <div class="glass-strong rounded-2xl overflow-hidden">
        <!-- Tab Navigation -->
        <div class="border-b border-white/5">
            <nav class="flex overflow-x-auto">
                <?php $__currentLoopData = [
                    ['id' => 'users', 'icon' => 'users', 'label' => 'Utilisateurs'],
                    ['id' => 'roles', 'icon' => 'shield', 'label' => 'Rôles & Permissions'],
                    ['id' => 'system', 'icon' => 'server', 'label' => 'Système'],
                    ['id' => 'logs', 'icon' => 'file-text', 'label' => 'Logs'],
                    ['id' => 'security', 'icon' => 'lock', 'label' => 'Sécurité'],
                ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <button 
                    onclick="switchTab('<?php echo e($tab['id']); ?>')" 
                    class="tab-btn flex items-center gap-2 px-6 py-4 text-sm font-semibold border-b-2 transition-all whitespace-nowrap <?php echo e($index === 0 ? 'border-purple-400 text-white' : 'border-transparent text-cyan-100/50 hover:text-cyan-100/80'); ?>"
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
            <!-- Users Tab -->
            <div id="tab-users" class="tab-content">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-display font-bold text-white">Gestion des utilisateurs</h3>
                    <?php if (isset($component)) { $__componentOriginal31327652ba86dff3ae51860919901558 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal31327652ba86dff3ae51860919901558 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ripple-button','data' => ['size' => 'sm','onclick' => 'showToast(\'Formulaire création utilisateur\', \'info\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ripple-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => 'sm','onclick' => 'showToast(\'Formulaire création utilisateur\', \'info\')']); ?>
                        <i data-lucide="user-plus" class="w-4 h-4"></i>
                        Nouvel utilisateur
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
                <div class="space-y-3">
                    <?php $__currentLoopData = [
                        ['name' => 'Yassine Hamdi', 'email' => 'citoyen@aquasecure.tn', 'role' => 'Citoyen', 'status' => 'Actif', 'lastLogin' => 'Il y a 2h'],
                        ['name' => 'Amira Ben Ali', 'email' => 'amira@aquasecure.tn', 'role' => 'Technicien', 'status' => 'Actif', 'lastLogin' => 'Il y a 5min'],
                        ['name' => 'Ines Mansouri', 'email' => 'gestionnaire@aquasecure.tn', 'role' => 'Gestionnaire', 'status' => 'Actif', 'lastLogin' => 'Il y a 1h'],
                        ['name' => 'Amina Kacem', 'email' => 'admin@aquasecure.tn', 'role' => 'Admin', 'status' => 'Actif', 'lastLogin' => 'Connecté'],
                    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="glass p-5 rounded-xl hover-lift">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-cyan-500/20 to-blue-600/20 flex items-center justify-center">
                                    <i data-lucide="user" class="w-6 h-6 text-cyan-300"></i>
                                </div>
                                <div>
                                    <h4 class="text-white font-semibold"><?php echo e($user['name']); ?></h4>
                                    <p class="text-cyan-100/60 text-sm"><?php echo e($user['email']); ?></p>
                                    <p class="text-cyan-100/40 text-xs mt-1"><?php echo e($user['lastLogin']); ?></p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <?php if (isset($component)) { $__componentOriginal2ddbc40e602c342e508ac696e52f8719 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ddbc40e602c342e508ac696e52f8719 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge','data' => ['color' => '#06b6d4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => '#06b6d4']); ?><?php echo e($user['role']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $attributes = $__attributesOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $component = $__componentOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__componentOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
                                <?php if (isset($component)) { $__componentOriginal2ddbc40e602c342e508ac696e52f8719 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ddbc40e602c342e508ac696e52f8719 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge','data' => ['color' => '#14b8a6']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => '#14b8a6']); ?><?php echo e($user['status']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $attributes = $__attributesOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $component = $__componentOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__componentOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
                                <button class="glass p-2 rounded-lg text-cyan-300 hover:text-white">
                                    <i data-lucide="more-vertical" class="w-4 h-4"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <!-- Roles Tab -->
            <div id="tab-roles" class="tab-content hidden">
                <h3 class="text-xl font-display font-bold text-white mb-4">Rôles et Permissions</h3>
                <div class="grid sm:grid-cols-2 gap-4">
                    <?php $__currentLoopData = [
                        ['role' => 'Admin', 'users' => 2, 'color' => 'purple', 'permissions' => ['Tout', 'Gestion système', 'Utilisateurs', 'Sécurité']],
                        ['role' => 'Gestionnaire', 'users' => 8, 'color' => 'blue', 'permissions' => ['Réseau', 'Projets', 'Rapports', 'Équipes']],
                        ['role' => 'Technicien', 'users' => 47, 'color' => 'teal', 'permissions' => ['Interventions', 'Équipement', 'Rapports']],
                        ['role' => 'Citoyen', 'users' => 1190, 'color' => 'cyan', 'permissions' => ['Signalements', 'Suivi', 'Factures']],
                    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="glass p-5 rounded-xl hover-lift">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-12 h-12 rounded-xl bg-<?php echo e($role['color']); ?>-500/10 flex items-center justify-center">
                                <i data-lucide="shield" class="w-6 h-6 text-<?php echo e($role['color']); ?>-400"></i>
                            </div>
                            <div>
                                <h4 class="text-white font-semibold"><?php echo e($role['role']); ?></h4>
                                <p class="text-cyan-100/60 text-sm"><?php echo e($role['users']); ?> utilisateurs</p>
                            </div>
                        </div>
                        <div class="space-y-1">
                            <?php $__currentLoopData = $role['permissions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $perm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex items-center gap-2 text-sm text-cyan-100/70">
                                <i data-lucide="check" class="w-3.5 h-3.5 text-teal-400"></i>
                                <span><?php echo e($perm); ?></span>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <!-- System Tab -->
            <div id="tab-system" class="tab-content hidden">
                <h3 class="text-xl font-display font-bold text-white mb-4">État du système</h3>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <?php $__currentLoopData = [
                        ['label' => 'Base de données', 'value' => 'MySQL 8.0', 'status' => 'OK', 'color' => 'teal'],
                        ['label' => 'Serveur web', 'value' => 'Apache 2.4', 'status' => 'OK', 'color' => 'teal'],
                        ['label' => 'PHP Version', 'value' => '8.2.12', 'status' => 'OK', 'color' => 'teal'],
                        ['label' => 'Laravel', 'value' => '12.69.2', 'status' => 'OK', 'color' => 'teal'],
                        ['label' => 'Cache', 'value' => 'Redis', 'status' => 'OK', 'color' => 'teal'],
                        ['label' => 'Queue', 'value' => '0 jobs', 'status' => 'OK', 'color' => 'teal'],
                    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sys): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="glass p-4 rounded-xl">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm text-cyan-100/70"><?php echo e($sys['label']); ?></span>
                            <?php if (isset($component)) { $__componentOriginal2ddbc40e602c342e508ac696e52f8719 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ddbc40e602c342e508ac696e52f8719 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge','data' => ['color' => '#'.e($sys['color'] === 'teal' ? '14b8a6' : 'ef4444').'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => '#'.e($sys['color'] === 'teal' ? '14b8a6' : 'ef4444').'']); ?>
                                <?php echo e($sys['status']); ?>

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
                        <div class="text-white font-semibold"><?php echo e($sys['value']); ?></div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <!-- Logs Tab -->
            <div id="tab-logs" class="tab-content hidden">
                <h3 class="text-xl font-display font-bold text-white mb-4">Logs système récents</h3>
                <div class="space-y-2">
                    <?php $__currentLoopData = [
                        ['type' => 'info', 'message' => 'Utilisateur admin@aquasecure.tn connecté', 'time' => 'Il y a 5min'],
                        ['type' => 'success', 'message' => 'Backup base de données complété', 'time' => 'Il y a 1h'],
                        ['type' => 'warning', 'message' => 'Espace disque > 80%', 'time' => 'Il y a 3h'],
                        ['type' => 'info', 'message' => 'Mise à jour capteur zone Tunis Nord', 'time' => 'Il y a 5h'],
                    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="glass p-4 rounded-lg flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full <?php echo e($log['type'] === 'success' ? 'bg-teal-400' : ($log['type'] === 'warning' ? 'bg-orange-400' : 'bg-cyan-400')); ?>"></div>
                        <div class="flex-1">
                            <p class="text-white text-sm"><?php echo e($log['message']); ?></p>
                            <p class="text-cyan-100/50 text-xs mt-1"><?php echo e($log['time']); ?></p>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                            <?php $__currentLoopData = [
                                ['label' => 'Pare-feu', 'status' => 'Actif'],
                                ['label' => 'SSL/TLS', 'status' => 'Actif'],
                                ['label' => 'Authentification 2FA', 'status' => 'Disponible'],
                                ['label' => 'Dernière tentative intrusion', 'status' => 'Aucune'],
                            ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex items-center justify-between py-2 border-b border-white/5">
                                <span class="text-sm text-cyan-100/70"><?php echo e($sec['label']); ?></span>
                                <span class="text-sm text-teal-400 font-semibold"><?php echo e($sec['status']); ?></span>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
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
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.manager', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ghada\Desktop\5ème\projet_Laravel\aquasecure\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>
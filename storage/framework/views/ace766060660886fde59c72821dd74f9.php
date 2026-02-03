<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title'); ?> | MTs Nurul Falaah Soreang</title>

    <!-- Favicon Admin -->
    <?php
        $logo = \App\Models\Logo::first();
        $faviconUrl = $logo && $logo->path 
            ? (str_starts_with($logo->path, 'images/') ? asset($logo->path) : asset('storage/' . $logo->path)) 
            : asset('favicon.ico');
    ?>
    <link rel="icon" type="image/x-icon" href="<?php echo e($faviconUrl); ?>">

    <?php if(request()->routeIs('admin.konten.berita.index') || request()->routeIs('admin.konten.artikel.index') || request()->routeIs('admin.konten.prestasi-siswa.index')): ?>
        <?php
            $adminViewKey = null;
            if (request()->routeIs('admin.konten.berita.index')) {
                $adminViewKey = 'admin_view_type:news';
            } elseif (request()->routeIs('admin.konten.artikel.index')) {
                $adminViewKey = 'admin_view_type:article';
            } elseif (request()->routeIs('admin.konten.prestasi-siswa.index')) {
                $adminViewKey = 'admin_view_type:achievements';
            }
        ?>
        <script>
            document.documentElement.dataset.adminViewType = window.localStorage.getItem(<?php echo json_encode($adminViewKey, 15, 512) ?>) || window.localStorage.getItem('admin_view_type') || 'table';
        </script>
        <style>
            :root[data-admin-view-type="grid"] [data-admin-view-panel="table"] {
                display: none !important;
            }

            :root[data-admin-view-type="table"] [data-admin-view-panel="grid"] {
                display: none !important;
            }
        </style>
    <?php endif; ?>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/admin.css', 'resources/js/admin.js']); ?>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body class="font-sans bg-gray-100 text-slate-900">
    <div class="flex">
        <?php echo $__env->make('admin.components.layout.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <div class="flex-1 flex flex-col lg:ml-64">
            <?php echo $__env->make('admin.components.layout.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <main class="flex-1 px-4 sm:px-6 py-4 relative">


                <?php echo $__env->yieldContent('content'); ?>
            </main>
        </div>
    </div>
    
    <?php if (isset($component)) { $__componentOriginal1de95d362ec2bca0f2cd4e5b97092bf1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1de95d362ec2bca0f2cd4e5b97092bf1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.ui.preview-image','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.preview-image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1de95d362ec2bca0f2cd4e5b97092bf1)): ?>
<?php $attributes = $__attributesOriginal1de95d362ec2bca0f2cd4e5b97092bf1; ?>
<?php unset($__attributesOriginal1de95d362ec2bca0f2cd4e5b97092bf1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1de95d362ec2bca0f2cd4e5b97092bf1)): ?>
<?php $component = $__componentOriginal1de95d362ec2bca0f2cd4e5b97092bf1; ?>
<?php unset($__componentOriginal1de95d362ec2bca0f2cd4e5b97092bf1); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginalcd888331444a0bf6c83f0e84274b0759 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcd888331444a0bf6c83f0e84274b0759 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.ui.unsaved-changes','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.unsaved-changes'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcd888331444a0bf6c83f0e84274b0759)): ?>
<?php $attributes = $__attributesOriginalcd888331444a0bf6c83f0e84274b0759; ?>
<?php unset($__attributesOriginalcd888331444a0bf6c83f0e84274b0759); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcd888331444a0bf6c83f0e84274b0759)): ?>
<?php $component = $__componentOriginalcd888331444a0bf6c83f0e84274b0759; ?>
<?php unset($__componentOriginalcd888331444a0bf6c83f0e84274b0759); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginal4076532fdc26f9803b1828ee91b0af64 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4076532fdc26f9803b1828ee91b0af64 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.ui.notifications','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.notifications'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4076532fdc26f9803b1828ee91b0af64)): ?>
<?php $attributes = $__attributesOriginal4076532fdc26f9803b1828ee91b0af64; ?>
<?php unset($__attributesOriginal4076532fdc26f9803b1828ee91b0af64); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4076532fdc26f9803b1828ee91b0af64)): ?>
<?php $component = $__componentOriginal4076532fdc26f9803b1828ee91b0af64; ?>
<?php unset($__componentOriginal4076532fdc26f9803b1828ee91b0af64); ?>
<?php endif; ?>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html>
<?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/admin/layouts/admin.blade.php ENDPATH**/ ?>
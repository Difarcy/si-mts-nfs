<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Login'); ?> | MTs Nurul Falaah Soreang</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/website.css', 'resources/js/auth.js']); ?>
</head>

<body class="bg-gray-100 h-screen flex items-center justify-center font-sans p-4">

    <div class="bg-white p-6 sm:p-8 rounded-lg shadow-lg w-full max-w-sm">
        <?php echo $__env->yieldContent('content'); ?>
    </div>

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

</body>

</html>
<?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/admin/layouts/login.blade.php ENDPATH**/ ?>
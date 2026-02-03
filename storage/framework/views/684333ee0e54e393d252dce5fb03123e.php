<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title'); ?> | MTs Nurul Falaah Soreang</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Roboto+Slab:wght@100..900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="<?php echo e($websiteLogo); ?>">

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/website.css', 'resources/js/website.js']); ?>
</head>

<body class="bg-gray-50 font-sans antialiased text-gray-800 flex flex-col min-h-screen">

    <!-- Topbar (Static - stays at top) -->
    <?php echo $__env->make('website.components.layout.topbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Header (Sticky - follows scroll) -->
    <div id="main-header-container" class="w-full sticky top-0 z-100 transition-shadow duration-300">
        <?php echo $__env->make('website.components.layout.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

    <!-- Hero Section (Full Width) -->
    <?php echo $__env->yieldContent('hero'); ?>

    <!-- Main Container -->
    <div class="flex-grow container mx-auto px-4 pb-4 sm:pb-6">
        <div class="flex flex-col lg:flex-row gap-8 <?php echo e($reverseLayout ?? false ? 'lg:flex-row-reverse' : ''); ?>">

            <!-- Left Content (70%) -->
            <main class="w-full lg:w-[70%]">
                <?php echo $__env->yieldContent('content'); ?>
            </main>

            <!-- Right Sidebar (30%) -->
            <aside class="w-full lg:w-[30%] space-y-6">
                <?php echo $__env->yieldContent('sidebar'); ?>
            </aside>

        </div>
    </div>

    <!-- Footer -->
    <?php echo $__env->make('website.components.layout.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php if (isset($component)) { $__componentOriginal05c4324961d9546cb56dd9129d7535e4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal05c4324961d9546cb56dd9129d7535e4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'website.components.ui.preview-image','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('website.components.ui.preview-image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal05c4324961d9546cb56dd9129d7535e4)): ?>
<?php $attributes = $__attributesOriginal05c4324961d9546cb56dd9129d7535e4; ?>
<?php unset($__attributesOriginal05c4324961d9546cb56dd9129d7535e4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal05c4324961d9546cb56dd9129d7535e4)): ?>
<?php $component = $__componentOriginal05c4324961d9546cb56dd9129d7535e4; ?>
<?php unset($__componentOriginal05c4324961d9546cb56dd9129d7535e4); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginal88d7657fe4c48488c5296a8dd7681753 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal88d7657fe4c48488c5296a8dd7681753 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'website.components.ui.notifications','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('website.components.ui.notifications'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal88d7657fe4c48488c5296a8dd7681753)): ?>
<?php $attributes = $__attributesOriginal88d7657fe4c48488c5296a8dd7681753; ?>
<?php unset($__attributesOriginal88d7657fe4c48488c5296a8dd7681753); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal88d7657fe4c48488c5296a8dd7681753)): ?>
<?php $component = $__componentOriginal88d7657fe4c48488c5296a8dd7681753; ?>
<?php unset($__componentOriginal88d7657fe4c48488c5296a8dd7681753); ?>
<?php endif; ?>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html>
<?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/website/layouts/main.blade.php ENDPATH**/ ?>
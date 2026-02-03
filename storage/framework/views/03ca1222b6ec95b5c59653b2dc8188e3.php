<?php $__env->startSection('title', 'Kepala Madrasah'); ?>

<?php $__env->startSection('content'); ?>
    <div class="pt-4 sm:pt-6 space-y-6">
        
        <?php if (isset($component)) { $__componentOriginale44b0f5ba441cef716df532631fccc38 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale44b0f5ba441cef716df532631fccc38 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'website.components.layout.breadcrumb','data' => ['items' => [['label' => 'PROFIL'], ['label' => 'KEPALA MADRASAH']]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('website.components.layout.breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([['label' => 'PROFIL'], ['label' => 'KEPALA MADRASAH']])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale44b0f5ba441cef716df532631fccc38)): ?>
<?php $attributes = $__attributesOriginale44b0f5ba441cef716df532631fccc38; ?>
<?php unset($__attributesOriginale44b0f5ba441cef716df532631fccc38); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale44b0f5ba441cef716df532631fccc38)): ?>
<?php $component = $__componentOriginale44b0f5ba441cef716df532631fccc38; ?>
<?php unset($__componentOriginale44b0f5ba441cef716df532631fccc38); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal6a101a87b680dc09f4f04cda5e74cfd1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6a101a87b680dc09f4f04cda5e74cfd1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'website.components.layout.page-title','data' => ['title' => 'Kepala Madrasah']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('website.components.layout.page-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Kepala Madrasah']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6a101a87b680dc09f4f04cda5e74cfd1)): ?>
<?php $attributes = $__attributesOriginal6a101a87b680dc09f4f04cda5e74cfd1; ?>
<?php unset($__attributesOriginal6a101a87b680dc09f4f04cda5e74cfd1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6a101a87b680dc09f4f04cda5e74cfd1)): ?>
<?php $component = $__componentOriginal6a101a87b680dc09f4f04cda5e74cfd1; ?>
<?php unset($__componentOriginal6a101a87b680dc09f4f04cda5e74cfd1); ?>
<?php endif; ?>

        <div class="flex flex-col lg:flex-row gap-4 lg:gap-8">

            <!-- Left Side (30% on desktop) -->
            <div class="w-full lg:w-[30%] flex-shrink-0">
                <div class="relative">
                    <?php if($kepalaMadrasah?->foto): ?>
                        <div class="w-full aspect-[3/4] bg-gray-200 overflow-hidden relative">
                            <img src="<?php echo e(asset('storage/' . $kepalaMadrasah->foto)); ?>" alt="Kepala Madrasah"
                                class="w-full h-full object-cover">
                        </div>
                    <?php else: ?>
                        <div class="w-full aspect-[3/4] bg-gray-200 flex flex-col items-center justify-center relative">
                            <span class="text-[10px] sm:text-xs font-semibold text-slate-900 tracking-wider uppercase">Belum ada
                                foto</span>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Name & Position -->
                <div class="mt-4 text-center">
                    <h2 class="text-[13px] sm:text-base text-black font-bold text-center font-roboto-slab leading-tight">
                        <?php echo e($kepalaMadrasah?->nama ?? 'Kepala Madrasah'); ?>

                    </h2>
                    <p class="text-[10px] sm:text-xs text-slate-900 mt-1 text-center font-roboto-slab">
                        - Kepala Madrasah -
                    </p>
                </div>
            </div>

            <!-- Right Side (70% on desktop) -->
            <div class="flex-grow space-y-8">
                <div class="mb-6">
                    <h3
                        class="text-[13px] sm:text-[18px] font-bold text-black font-roboto-slab leading-tight inline-block border-b border-green-600 pb-1">
                        Sambutan Kepala Madrasah
                    </h3>
                </div>

                <div class="prose prose-lg max-w-none text-black leading-relaxed text-justify font-inter">
                    <?php if($kepalaMadrasah?->sambutan): ?>
                        <?php echo $kepalaMadrasah->sambutan; ?>

                    <?php else: ?>
                        <div class="min-h-[400px] flex flex-col items-center justify-center text-center w-full">
                            <p class="text-xs sm:text-base font-semibold text-slate-900 tracking-wider">
                                Belum Ada Sambutan Kepala Madrasah
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.layouts.full', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/website/pages/profile/greeting/index.blade.php ENDPATH**/ ?>
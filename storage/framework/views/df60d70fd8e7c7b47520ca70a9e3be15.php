<?php $__env->startSection('title', 'Struktur Organisasi'); ?>

<?php $__env->startSection('content'); ?>
    <div class="pt-4 sm:pt-6 space-y-6">
        <?php if (isset($component)) { $__componentOriginale44b0f5ba441cef716df532631fccc38 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale44b0f5ba441cef716df532631fccc38 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'website.components.layout.breadcrumb','data' => ['items' => [['label' => 'PROFIL'], ['label' => 'STRUKTUR ORGANISASI']]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('website.components.layout.breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([['label' => 'PROFIL'], ['label' => 'STRUKTUR ORGANISASI']])]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'website.components.layout.page-title','data' => ['title' => 'Struktur Organisasi']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('website.components.layout.page-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Struktur Organisasi']); ?>
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

        <div>
            <h2 class="text-xs sm:text-[18px] font-bold text-black mb-8 text-center font-roboto-slab">
                Bagan Struktur Organisasi
            </h2>

            <?php if($strukturOrganisasi?->struktur): ?>
                <?php if (isset($component)) { $__componentOriginal62440f04410f38f849d947bfc26bfdcf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal62440f04410f38f849d947bfc26bfdcf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'website.components.ui.image-preview','data' => ['src' => asset('storage/' . $strukturOrganisasi->struktur),'alt' => 'Struktur Organisasi']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('website.components.ui.image-preview'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['src' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(asset('storage/' . $strukturOrganisasi->struktur)),'alt' => 'Struktur Organisasi']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal62440f04410f38f849d947bfc26bfdcf)): ?>
<?php $attributes = $__attributesOriginal62440f04410f38f849d947bfc26bfdcf; ?>
<?php unset($__attributesOriginal62440f04410f38f849d947bfc26bfdcf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal62440f04410f38f849d947bfc26bfdcf)): ?>
<?php $component = $__componentOriginal62440f04410f38f849d947bfc26bfdcf; ?>
<?php unset($__componentOriginal62440f04410f38f849d947bfc26bfdcf); ?>
<?php endif; ?>
            <?php else: ?>
                <div class="flex flex-col items-center justify-center min-h-[400px] text-center w-full">
                    <p class="text-[11px] sm:text-base font-semibold text-slate-900 tracking-wider">
                        Belum Ada Struktur Organisasi
                    </p>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('sidebar'); ?>
    
    <div class="space-y-10 pt-4 sm:pt-6 lg:pt-[52px]">
        <?php echo $__env->make('website.components.content.headmaster-greeting', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->make('website.components.content.category-widget', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/website/pages/profile/organization/index.blade.php ENDPATH**/ ?>
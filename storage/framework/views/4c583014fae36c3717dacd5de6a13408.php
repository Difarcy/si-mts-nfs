<?php $__env->startSection('title', 'Banner Promosi'); ?>

<?php $__env->startSection('content'); ?>
    <div class="flex flex-col gap-3 pb-4">
        
        <?php if (isset($component)) { $__componentOriginalfe7ff6290c4dd6e9c44a868826f51472 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfe7ff6290c4dd6e9c44a868826f51472 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.ui.page-header','data' => ['title' => 'Banner Promosi','subtitle' => 'Kelola banner promosi untuk informasi spesial']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Banner Promosi','subtitle' => 'Kelola banner promosi untuk informasi spesial']); ?>
             <?php $__env->slot('actions', null, []); ?> 
                <?php if (isset($component)) { $__componentOriginala0276693788c189e10dfd0bfb3860e87 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala0276693788c189e10dfd0bfb3860e87 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.form.button','data' => ['type' => 'submit','variant' => 'primary','form' => 'promotion-banner-form','class' => 'cursor-not-allowed opacity-50']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.form.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','variant' => 'primary','form' => 'promotion-banner-form','class' => 'cursor-not-allowed opacity-50']); ?>
                     <?php $__env->slot('icon', null, []); ?> 
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                     <?php $__env->endSlot(); ?>
                    Simpan
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala0276693788c189e10dfd0bfb3860e87)): ?>
<?php $attributes = $__attributesOriginala0276693788c189e10dfd0bfb3860e87; ?>
<?php unset($__attributesOriginala0276693788c189e10dfd0bfb3860e87); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala0276693788c189e10dfd0bfb3860e87)): ?>
<?php $component = $__componentOriginala0276693788c189e10dfd0bfb3860e87; ?>
<?php unset($__componentOriginala0276693788c189e10dfd0bfb3860e87); ?>
<?php endif; ?>
             <?php $__env->endSlot(); ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfe7ff6290c4dd6e9c44a868826f51472)): ?>
<?php $attributes = $__attributesOriginalfe7ff6290c4dd6e9c44a868826f51472; ?>
<?php unset($__attributesOriginalfe7ff6290c4dd6e9c44a868826f51472); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfe7ff6290c4dd6e9c44a868826f51472)): ?>
<?php $component = $__componentOriginalfe7ff6290c4dd6e9c44a868826f51472; ?>
<?php unset($__componentOriginalfe7ff6290c4dd6e9c44a868826f51472); ?>
<?php endif; ?>

        
        <?php if (isset($component)) { $__componentOriginalfdb23fa6017278bcd751b09e9d04fdc0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfdb23fa6017278bcd751b09e9d04fdc0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.ui.card','data' => ['bodyClass' => 'p-4 sm:p-6']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['bodyClass' => 'p-4 sm:p-6']); ?>
            <form id="promotion-banner-form" method="POST" action="<?php echo e(route('admin.pengaturan.promotion-banner.update')); ?>" class="space-y-6"
                enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <div class="space-y-2">
                    <label class="block text-[12px] sm:text-sm text-black">
                        Upload Gambar Banner Promosi
                    </label>

                    <div class="text-xs text-slate-500 mb-2">
                        Tampilkan informasi PPDB, event sekolah, atau pengumuman penting dalam bentuk banner promosi.
                        Ukuran rekomendasi 1920×600 px, maksimal 10MB.
                    </div>

                    <?php
                        $bannerPromosiPath = isset($bannerPromosi) && $bannerPromosi && $bannerPromosi->path ? $bannerPromosi->path : '';
                        $bannerPromosiUrl = $bannerPromosiPath ? asset('storage/' . $bannerPromosiPath) : '';
                    ?>

                    <?php if (isset($component)) { $__componentOriginaldc7fa6334b1909b429708920f13a8b57 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldc7fa6334b1909b429708920f13a8b57 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.form.upload-image','data' => ['label' => '','name' => 'banner_promosi','height' => 'aspect-21/9 sm:aspect-1920/600','helperText' => 'Ukuran rekomendasi 1920×600 px. Maksimal file 10MB.','existing' => $bannerPromosiUrl,'existingValue' => $bannerPromosiPath,'objectFit' => 'object-cover']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.form.upload-image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => '','name' => 'banner_promosi','height' => 'aspect-21/9 sm:aspect-1920/600','helperText' => 'Ukuran rekomendasi 1920×600 px. Maksimal file 10MB.','existing' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($bannerPromosiUrl),'existingValue' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($bannerPromosiPath),'objectFit' => 'object-cover']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldc7fa6334b1909b429708920f13a8b57)): ?>
<?php $attributes = $__attributesOriginaldc7fa6334b1909b429708920f13a8b57; ?>
<?php unset($__attributesOriginaldc7fa6334b1909b429708920f13a8b57); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldc7fa6334b1909b429708920f13a8b57)): ?>
<?php $component = $__componentOriginaldc7fa6334b1909b429708920f13a8b57; ?>
<?php unset($__componentOriginaldc7fa6334b1909b429708920f13a8b57); ?>
<?php endif; ?>
                </div>
            </form>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfdb23fa6017278bcd751b09e9d04fdc0)): ?>
<?php $attributes = $__attributesOriginalfdb23fa6017278bcd751b09e9d04fdc0; ?>
<?php unset($__attributesOriginalfdb23fa6017278bcd751b09e9d04fdc0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfdb23fa6017278bcd751b09e9d04fdc0)): ?>
<?php $component = $__componentOriginalfdb23fa6017278bcd751b09e9d04fdc0; ?>
<?php unset($__componentOriginalfdb23fa6017278bcd751b09e9d04fdc0); ?>
<?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/admin/pages/settings/promotion-banner.blade.php ENDPATH**/ ?>
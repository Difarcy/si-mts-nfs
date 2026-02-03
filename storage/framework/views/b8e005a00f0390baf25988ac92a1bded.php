<?php $__env->startSection('title', 'Struktur Organisasi'); ?>

<?php $__env->startSection('content'); ?>
    <div class="flex flex-col gap-3 max-w-6xl mx-auto pb-4">
        <?php if (isset($component)) { $__componentOriginalfe7ff6290c4dd6e9c44a868826f51472 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfe7ff6290c4dd6e9c44a868826f51472 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.ui.page-header','data' => ['title' => 'Struktur Organisasi','subtitle' => 'Pengelolaan konten halaman Struktur Organisasi']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Struktur Organisasi','subtitle' => 'Pengelolaan konten halaman Struktur Organisasi']); ?>
             <?php $__env->slot('actions', null, []); ?> 
                <?php if (isset($component)) { $__componentOriginala0276693788c189e10dfd0bfb3860e87 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala0276693788c189e10dfd0bfb3860e87 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.form.button','data' => ['type' => 'submit','variant' => 'primary','form' => 'profile-organization-form']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.form.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','variant' => 'primary','form' => 'profile-organization-form']); ?>
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
            <form id="profile-organization-form" action="<?php echo e(route('admin.profil.organization.update')); ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
                <?php echo csrf_field(); ?>
                <?php if (isset($component)) { $__componentOriginaldc7fa6334b1909b429708920f13a8b57 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldc7fa6334b1909b429708920f13a8b57 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.form.upload-image','data' => ['name' => 'struktur_organisasi','label' => 'Struktur Organisasi','helperText' => 'PNG, JPG up to 10MB','existing' => $organization?->struktur ? asset('storage/' . $organization->struktur) : null,'existingValue' => $organization?->struktur,'containerStyle' => 'height: 700px;','objectFit' => 'object-contain']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.form.upload-image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'struktur_organisasi','label' => 'Struktur Organisasi','helperText' => 'PNG, JPG up to 10MB','existing' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($organization?->struktur ? asset('storage/' . $organization->struktur) : null),'existingValue' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($organization?->struktur),'containerStyle' => 'height: 700px;','objectFit' => 'object-contain']); ?>
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

<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/admin/pages/profile/organization.blade.php ENDPATH**/ ?>
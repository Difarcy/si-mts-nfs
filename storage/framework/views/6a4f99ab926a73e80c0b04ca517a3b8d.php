<?php if (isset($component)) { $__componentOriginald1d93fc7a3741dd0b5d24cd52a9ebe8a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald1d93fc7a3741dd0b5d24cd52a9ebe8a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.ui.pagination','data' => ['items' => $berita]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.pagination'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($berita)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald1d93fc7a3741dd0b5d24cd52a9ebe8a)): ?>
<?php $attributes = $__attributesOriginald1d93fc7a3741dd0b5d24cd52a9ebe8a; ?>
<?php unset($__attributesOriginald1d93fc7a3741dd0b5d24cd52a9ebe8a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald1d93fc7a3741dd0b5d24cd52a9ebe8a)): ?>
<?php $component = $__componentOriginald1d93fc7a3741dd0b5d24cd52a9ebe8a; ?>
<?php unset($__componentOriginald1d93fc7a3741dd0b5d24cd52a9ebe8a); ?>
<?php endif; ?>

<?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/admin/partials/content/news/pagination.blade.php ENDPATH**/ ?>
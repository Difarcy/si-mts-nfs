<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'label' => null,
    'name' => '',
    'placeholder' => '',
    'rows' => 5,
    'required' => false,
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'label' => null,
    'name' => '',
    'placeholder' => '',
    'rows' => 5,
    'required' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="space-y-0.5">
    <?php if($label): ?>
        <label for="<?php echo e($name); ?>" class="block text-[12px] sm:text-sm text-black">
            <?php echo e($label); ?>

            <?php if($required): ?>
                <span class="text-red-600" data-required-indicator="true">*</span>
            <?php endif; ?>
        </label>
    <?php endif; ?>
    <textarea 
        id="<?php echo e($name); ?>" 
        name="<?php echo e($name); ?>"
        rows="<?php echo e($rows); ?>"
        placeholder="<?php echo e($placeholder); ?>"
        <?php echo e($required ? 'required' : ''); ?>

        <?php echo e($attributes->merge(['class' => 'w-full px-3 py-2 sm:px-4 sm:py-3 border border-black rounded-lg focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400 focus:outline-none text-[12px] sm:text-sm transition-all resize-none cursor-text'])); ?>

    ><?php echo e($slot); ?></textarea>
</div>
<?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/admin/components/form/textarea.blade.php ENDPATH**/ ?>
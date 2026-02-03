<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'label' => null,
    'name' => null,
    'id' => null,
    'wrapperClass' => '',
    'placeholder' => '',
    'required' => false,
    'rows' => 4,
    'value' => '',
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
    'name' => null,
    'id' => null,
    'wrapperClass' => '',
    'placeholder' => '',
    'required' => false,
    'rows' => 4,
    'value' => '',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $textareaId = $id ?: $name;
?>

<div class="<?php echo e($wrapperClass); ?>">
    <?php if($label): ?>
        <label for="<?php echo e($textareaId); ?>" class="block text-gray-700 text-xs sm:text-sm mb-1 sm:mb-2 font-medium">
            <?php echo e($label); ?>

        </label>
    <?php endif; ?>
    <textarea 
        id="<?php echo e($textareaId); ?>"
        name="<?php echo e($name); ?>"
        rows="<?php echo e($rows); ?>"
        placeholder="<?php echo e($placeholder); ?>"
        <?php echo e($required ? 'required' : ''); ?>

        <?php echo e($attributes->merge(['class' => 'w-full px-4 py-1.5 sm:py-2 bg-gray-50 border border-black rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 focus:outline-none transition-all placeholder:text-gray-400 placeholder:font-normal text-gray-700 text-xs sm:text-sm resize-none'])); ?>

    ><?php echo e(old($name, $value)); ?></textarea>
</div>
<?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/website/components/form/textarea.blade.php ENDPATH**/ ?>
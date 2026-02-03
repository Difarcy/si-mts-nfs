<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'label' => null,
    'name' => '',
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

            <?php if($required && $name !== 'status'): ?>
                <span class="text-red-600" data-required-indicator="true">*</span>
            <?php endif; ?>
        </label>
    <?php endif; ?>
    <div class="relative">
        <select 
            id="<?php echo e($name); ?>" 
            name="<?php echo e($name); ?>"
            <?php echo e($required ? 'required' : ''); ?>

            <?php echo e($attributes->merge(['class' => 'w-full px-3 py-1 sm:px-4 sm:py-1.5 border border-black rounded-lg focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400 focus:outline-none text-[12px] sm:text-sm transition-all appearance-none bg-white'])); ?>

        >
            <?php echo e($slot); ?>

        </select>
        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/admin/components/form/select-input.blade.php ENDPATH**/ ?>
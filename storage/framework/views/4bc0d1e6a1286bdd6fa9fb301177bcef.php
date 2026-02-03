<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title' => null,
    'tag' => 'h2',
    'margin' => 'mb-6'
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
    'title' => null,
    'tag' => 'h2',
    'margin' => 'mb-6'
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="flex items-center gap-3 <?php echo e($margin); ?>">
    <span class="w-px h-6 sm:h-8 bg-green-700"></span>
    <<?php echo e($tag); ?> <?php echo e($attributes->merge(['class' => 'text-sm sm:text-xl font-bold text-black tracking-tight leading-none font-roboto-slab'])); ?>>
        <?php echo e($title ?? $slot); ?>

    </<?php echo e($tag); ?>>
</div>
<?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/website/components/layout/page-title.blade.php ENDPATH**/ ?>
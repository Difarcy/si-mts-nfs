<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'variant' => 'default',
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
    'variant' => 'default',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<?php
    $baseClasses = 'px-2.5 py-0.5 rounded-full text-[11px] font-bold inline-flex items-center justify-center';

    $variants = [
        'default' => 'bg-slate-100 text-slate-700',

        // Status Variants
        'publish' => 'bg-green-100 text-green-700',
        'draft' => 'bg-slate-200 text-slate-600',
        'nonaktif' => 'bg-red-100 text-red-700',

        // Content & Utility Variants
        'highlight' => 'bg-yellow-100 text-yellow-700',
        'berita' => 'bg-blue-100 text-blue-700',
        'artikel' => 'bg-purple-100 text-purple-700',

        // Extra Variants (Requested)
        'pengumuman' => 'bg-orange-100 text-orange-700',
        'agenda' => 'bg-indigo-100 text-indigo-700',
        'prestasi' => 'bg-teal-100 text-teal-700',

        // Rank Variants
        'juara 1' => 'bg-yellow-100 text-yellow-700 border border-yellow-200',
        'juara 2' => 'bg-gray-100 text-gray-600 border border-gray-200',
        'juara 3' => 'bg-orange-100 text-orange-700 border border-orange-200',
    ];

    $classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['default']);
?>

<span <?php echo e($attributes->merge(['class' => $classes])); ?>>
    <?php echo e($slot); ?>

</span>
<?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/admin/components/ui/badge.blade.php ENDPATH**/ ?>
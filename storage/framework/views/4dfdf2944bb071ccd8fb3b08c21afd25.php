<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'label',
    'value',
    'icon' => null,
    'color' => 'blue',
    'footer' => null,
    'href' => null
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
    'label',
    'value',
    'icon' => null,
    'color' => 'blue',
    'footer' => null,
    'href' => null
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<?php
    $colorClasses = [
        'blue' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-600', 'border' => 'hover:border-blue-600'],
        'green' => ['bg' => 'bg-green-100', 'text' => 'text-green-600', 'border' => 'hover:border-green-600'],
        'purple' => ['bg' => 'bg-purple-100', 'text' => 'text-purple-600', 'border' => 'hover:border-purple-600'],
        'pink' => ['bg' => 'bg-pink-100', 'text' => 'text-pink-600', 'border' => 'hover:border-pink-600'],
        'yellow' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-600', 'border' => 'hover:border-yellow-600'],
        'red' => ['bg' => 'bg-red-100', 'text' => 'text-red-600', 'border' => 'hover:border-red-600'],
    ];

    $style = $colorClasses[$color] ?? $colorClasses['blue'];
?>

<?php if($href): ?>
    <a href="<?php echo e($href); ?>"
        class="bg-white border border-gray-200 <?php echo e($style['border']); ?> hover:shadow-md transition-all p-3 sm:p-4 rounded-xl shadow-sm block cursor-pointer">
    <?php else: ?>
        <div class="bg-white border border-gray-200 <?php echo e($style['border']); ?> transition-all p-3 sm:p-4 rounded-xl shadow-sm">
<?php endif; ?>

<div class="flex items-center justify-between">
    <div>
        <p class="text-xs sm:text-sm font-semibold text-black"><?php echo e($label); ?></p>
        <p class="text-xl sm:text-3xl font-bold text-black mt-1 sm:mt-2"><?php echo e($value); ?></p>
    </div>
    <?php if($icon): ?>
        <div class="p-2 sm:p-3 <?php echo e($style['bg']); ?> rounded-xl <?php echo e($style['text']); ?>">
            <?php echo e($icon); ?>

        </div>
    <?php endif; ?>
</div>
<?php if($footer): ?>
    <div class="mt-3 sm:mt-4 flex items-center gap-3 text-xs sm:text-sm text-black">
        <?php echo e($footer); ?>

    </div>
<?php endif; ?>

<?php if($href): ?>
    </a>
<?php else: ?>
    </div>
<?php endif; ?>
<?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/admin/components/ui/stats-card.blade.php ENDPATH**/ ?>
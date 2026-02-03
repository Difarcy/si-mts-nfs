<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'variant' => 'primary',
    'href' => null,
    'type' => 'button',
    'icon' => null,
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
    'variant' => 'primary',
    'href' => null,
    'type' => 'button',
    'icon' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    // Base classes common to all buttons
    $baseClasses = 'inline-flex items-center justify-center p-1.5 sm:px-4 sm:py-1.5 text-[11px] sm:text-sm font-semibold transition-colors rounded shadow-sm cursor-pointer';

    // Map variants to specific Tailwind color classes
    $variants = [
        'primary' => 'bg-green-700 hover:bg-green-800 text-white',
        'add'     => 'bg-green-700 hover:bg-green-800 text-white',
        'gray'    => 'bg-slate-600 hover:bg-slate-700 text-white',
        'back'    => 'bg-slate-600 hover:bg-slate-700 text-white',
        'danger'  => 'bg-red-600 hover:bg-red-700 text-white',
        'delete'  => 'bg-red-600 hover:bg-red-700 text-white',
        'cancel'  => 'bg-red-600 hover:bg-red-700 text-white',
        'warning' => 'bg-yellow-500 hover:bg-yellow-600 text-white',
        'edit'    => 'bg-yellow-500 hover:bg-yellow-600 text-white',
        'secondary' => 'bg-slate-600 hover:bg-slate-700 text-white',
        'info'      => 'bg-blue-600 hover:bg-blue-700 text-white',
    ];

    $classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['primary']);
?>

<?php if($href): ?>
    
    <a href="<?php echo e($href); ?>" <?php echo e($attributes->merge(['class' => $classes])); ?>>
        <?php if($icon): ?>
            <div class="<?php echo e($slot->isEmpty() ? '' : 'sm:mr-1.5'); ?>">
                <?php echo e($icon); ?>

            </div>
        <?php endif; ?>
        <?php if(!$slot->isEmpty()): ?>
            <span class="<?php echo e($icon ? 'hidden sm:inline' : ''); ?>">
                <?php echo e($slot); ?>

            </span>
        <?php endif; ?>
    </a>
<?php else: ?>
    
    <button type="<?php echo e($type); ?>" <?php echo e($attributes->merge(['class' => $classes])); ?>>
        <?php if($icon): ?>
            <div class="<?php echo e($slot->isEmpty() ? '' : 'sm:mr-1.5'); ?>">
                <?php echo e($icon); ?>

            </div>
        <?php endif; ?>
        <?php if(!$slot->isEmpty()): ?>
            <span class="<?php echo e($icon ? 'hidden sm:inline' : ''); ?>">
                <?php echo e($slot); ?>

            </span>
        <?php endif; ?>
    </button>
<?php endif; ?>
<?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/admin/components/form/button.blade.php ENDPATH**/ ?>
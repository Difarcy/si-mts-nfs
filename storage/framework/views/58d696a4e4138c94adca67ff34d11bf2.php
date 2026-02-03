<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'activeView' => 'view' // Nama variabel Alpine.js yang digunakan
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
    'activeView' => 'view' // Nama variabel Alpine.js yang digunakan
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div <?php echo e($attributes->merge(['class' => 'flex items-center bg-white p-0.5 rounded-lg border border-black gap-0.5 h-[34px] sm:h-[34px]'])); ?>>
    
    <button type="button" @click="<?php echo e($activeView); ?> = 'table'"
        :class="<?php echo e($activeView); ?> === 'table' 
            ? 'bg-green-600 text-white shadow-sm' 
            : 'text-gray-400 hover:bg-gray-50 hover:text-green-700'"
        class="h-full px-2 sm:px-2.5 rounded-md transition-all duration-200 flex items-center justify-center group cursor-pointer"
        title="Tampilan Tabel">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
            <rect x="3" y="4" width="18" height="16" rx="2" />
            <line x1="3" y1="10" x2="21" y2="10" />
            <line x1="3" y1="15" x2="21" y2="15" />
            <line x1="10" y1="4" x2="10" y2="20" />
        </svg>
    </button>

    
    <button type="button" @click="<?php echo e($activeView); ?> = 'grid'"
        :class="<?php echo e($activeView); ?> === 'grid' 
            ? 'bg-blue-600 text-white shadow-sm' 
            : 'text-gray-400 hover:bg-gray-100 hover:text-blue-700'"
        class="h-full px-2 sm:px-2.5 rounded-md transition-all duration-200 flex items-center justify-center group cursor-pointer"
        title="Tampilan Grid">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
            <rect x="3" y="3" width="7" height="7" rx="1" />
            <rect x="14" y="3" width="7" height="7" rx="1" />
            <rect x="14" y="14" width="7" height="7" rx="1" />
            <rect x="3" y="14" width="7" height="7" rx="1" />
        </svg>
    </button>
</div>
<?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/admin/components/ui/view-switcher.blade.php ENDPATH**/ ?>
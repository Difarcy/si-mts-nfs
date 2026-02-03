<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'src' => '',
    'alt' => 'Preview',
    'wrapperClass' => '',
    'imgClass' => 'w-full h-auto object-contain',
    'showHint' => true,
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
    'src' => '',
    'alt' => 'Preview',
    'wrapperClass' => '',
    'imgClass' => 'w-full h-auto object-contain',
    'showHint' => true,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php if(is_string($src) && $src !== ''): ?>
    <div
        class="relative w-full overflow-hidden rounded-xl border border-gray-100 shadow-sm transition-all duration-300 hover:shadow-md cursor-pointer group <?php echo e($wrapperClass); ?>"
        data-image-preview-trigger data-image-preview-src="<?php echo e($src); ?>">
        <img src="<?php echo e($src); ?>" alt="<?php echo e($alt); ?>" class="<?php echo e($imgClass); ?>">
        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors flex items-center justify-center">
            <span
                class="bg-white/90 p-2 rounded-full opacity-0 group-hover:opacity-100 transition-opacity transform translate-y-2 group-hover:translate-y-0 duration-300">
                <svg class="h-4 w-4 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 7v6m-3-3h6" />
                </svg>
            </span>
        </div>
    </div>

    <?php if($showHint): ?>
        <div class="mt-6 p-4 bg-gray-50 rounded-lg flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-700 shrink-0" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="text-xs sm:text-sm text-slate-900">
                Klik gambar untuk memperbesar tampilan.
            </p>
        </div>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/website/components/ui/image-preview.blade.php ENDPATH**/ ?>
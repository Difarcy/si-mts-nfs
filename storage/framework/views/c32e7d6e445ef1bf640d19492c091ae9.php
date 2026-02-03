<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'placeholder' => 'Cari...',
    'name' => 'search',
    'value' => '',
    'autoSubmit' => false,
    'autoSubmitDelay' => 900,
    'autoSubmitMinLength' => 2,
    'autoFocus' => false,
    'autocomplete' => null,
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
    'placeholder' => 'Cari...',
    'name' => 'search',
    'value' => '',
    'autoSubmit' => false,
    'autoSubmitDelay' => 900,
    'autoSubmitMinLength' => 2,
    'autoFocus' => false,
    'autocomplete' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div <?php echo e($attributes->merge(['class' => 'relative w-full sm:w-[450px] sm:min-w-[450px] sm:flex-none sm:shrink-0'])); ?>>
    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
    </span>
    <input type="text" 
        name="<?php echo e($name); ?>" 
        value="<?php echo e($value); ?>"
        placeholder="<?php echo e($placeholder); ?>"
        <?php if(!is_null($autocomplete)): ?> autocomplete="<?php echo e($autocomplete); ?>" <?php endif; ?>
        <?php echo e($autoFocus ? 'autofocus' : ''); ?>

        <?php if($autoSubmit): ?>
            oncompositionstart="this.__as_comp = 1;"
            oncompositionend="this.__as_comp = 0;"
            oninput="if(this.__as_comp) return; if(!this.form) return; var el=this; var v=String(el.value||'').trim(); if(v!=='' && v.length < <?php echo e((int) $autoSubmitMinLength); ?>) return; clearTimeout(el.__as_t); el.__as_t = setTimeout(function(){ if(!el.form) return; try { el.form.requestSubmit ? el.form.requestSubmit() : el.form.submit(); } catch(e) { el.form.submit(); } }, <?php echo e((int) $autoSubmitDelay); ?>);"
            onkeydown="if(event.key === 'Enter'){ event.preventDefault(); if(!this.form) return; var el=this; clearTimeout(el.__as_t); try { el.form.requestSubmit ? el.form.requestSubmit() : el.form.submit(); } catch(e) { el.form.submit(); } }"
        <?php endif; ?>
        class="w-full pl-9 pr-3 py-1.5 sm:pl-10 sm:pr-4 sm:py-1.5 border border-black rounded-lg focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400 focus:outline-none text-[12px] sm:text-sm bg-white transition-all text-slate-900 placeholder:font-normal placeholder:text-gray-400"
    >
</div>
<?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/admin/components/form/input-search.blade.php ENDPATH**/ ?>
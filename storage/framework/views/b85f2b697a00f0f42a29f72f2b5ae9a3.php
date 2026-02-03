<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'label' => null,
    'name' => 'tags',
    'placeholder' => 'Tambah tag...',
    'required' => false,
    'tags' => [],
    'maxTags' => 10
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
    'name' => 'tags',
    'placeholder' => 'Tambah tag...',
    'required' => false,
    'tags' => [],
    'maxTags' => 10
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="space-y-0.5" 
     x-data="{ 
        tags: <?php echo \Illuminate\Support\Js::from($tags)->toHtml() ?>, 
        newTag: '',
        placeholderText: <?php echo \Illuminate\Support\Js::from($placeholder)->toHtml() ?>,
        maxTags: <?php echo \Illuminate\Support\Js::from($maxTags)->toHtml() ?>,
        syncHidden() {
            this.$nextTick(() => {
                if (!this.$refs.hiddenInput) return;
                this.$refs.hiddenInput.dispatchEvent(new Event('input', { bubbles: true }));
                this.$refs.hiddenInput.dispatchEvent(new Event('change', { bubbles: true }));
            });
        },
        init() {
            this.$watch('tags', () => this.syncHidden());
            this.syncHidden();
        },
        addTag() {
            if (this.tags.length >= this.maxTags) {
                this.newTag = '';
                return;
            }
            // Ganti spasi dengan strip, trim, dan lowercase
            let tag = this.newTag.trim().toLowerCase().replace(/\s+/g, '-');
            
            if (tag !== '' && !this.tags.includes(tag)) {
                this.tags.push(tag);
            }
            this.newTag = '';
            this.syncHidden();
        },
        handleInput() {
             // Mencegah spasi saat mengetik secara real-time
             this.newTag = this.newTag.replace(/\s/g, '-');
        },
        removeTag(index) {
            this.tags.splice(index, 1);
            this.syncHidden();
        },
        removeLastTag() {
            if (this.newTag !== '') return;
            if (this.tags.length === 0) return;
            this.tags.pop();
            this.syncHidden();
        }
     }">
    
    <?php if($label): ?>
        <label class="block text-[12px] sm:text-sm text-black">
            <?php echo e($label); ?>

            <?php if($required): ?>
                <span class="text-red-600">*</span>
            <?php endif; ?>
        </label>
    <?php endif; ?>

    
    <input type="hidden" name="<?php echo e($name); ?>" x-ref="hiddenInput" :value="tags.join(',')">

    <div <?php echo e($attributes->merge(['class' => 'w-full min-h-[100px] sm:min-h-[200px] px-2 py-1.5 sm:py-2 border border-black rounded-lg bg-white focus-within:border-yellow-400 focus-within:ring-2 focus-within:ring-yellow-400 transition-all flex flex-wrap gap-1.5 sm:gap-2 items-start content-start cursor-text'])); ?>

         @click="$refs.tagInput.focus()">
        
        <template x-for="(tag, index) in tags" :key="index">
            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-slate-100 text-slate-800 text-xs font-medium rounded-md border border-slate-200">
                <span x-text="tag"></span>
                <button type="button" @click.stop="removeTag(index)" class="text-slate-400 hover:text-red-600 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </span>
        </template>

        
        <input 
            type="text" 
            x-ref="tagInput"
            x-model="newTag"
            @input="handleInput()"
            @keydown.enter.prevent="addTag()"
            @keydown.,.prevent="addTag()"
            @keydown.space.prevent="addTag()"
            @keydown.backspace="removeLastTag()"
            @keydown.delete="removeLastTag()"
            @blur="addTag()"
            :disabled="tags.length >= maxTags"
            x-bind:placeholder="tags.length >= maxTags ? `Maksimal ${maxTags} tag` : (tags.length ? '' : placeholderText)"
            class="flex-1 min-w-[120px] outline-none border-none focus:ring-0 text-sm p-0 bg-transparent placeholder:text-gray-400"
        >
    </div>
    <p class="text-[10px] sm:text-xs text-black/60">Maksimal <?php echo e($maxTags); ?> tag.</p>

</div>
<?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/admin/components/form/tags-input.blade.php ENDPATH**/ ?>
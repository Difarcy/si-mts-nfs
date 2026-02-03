@props([
    'label' => null,
    'name' => 'tags',
    'placeholder' => 'Tambah tag...',
    'required' => false,
    'tags' => [],
    'maxTags' => 10
])

<div class="space-y-0.5" 
     x-data="{ 
        tags: @js($tags), 
        newTag: '',
        placeholderText: @js($placeholder),
        maxTags: @js($maxTags),
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
    
    @if($label)
        <label class="block text-[12px] sm:text-sm text-black">
            {{ $label }}
            @if($required)
                <span class="text-red-600">*</span>
            @endif
        </label>
    @endif

    {{-- Hidden Input for form submission --}}
    <input type="hidden" name="{{ $name }}" x-ref="hiddenInput" :value="tags.join(',')">

    <div {{ $attributes->merge(['class' => 'w-full min-h-[100px] sm:min-h-[200px] px-2 py-1.5 sm:py-2 border border-black rounded-lg bg-white focus-within:border-yellow-400 focus-within:ring-2 focus-within:ring-yellow-400 transition-all flex flex-wrap gap-1.5 sm:gap-2 items-start content-start cursor-text']) }}
         @click="$refs.tagInput.focus()">
        {{-- Tag Chips --}}
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

        {{-- Actual Input --}}
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
    <p class="text-[10px] sm:text-xs text-black/60">Maksimal {{ $maxTags }} tag.</p>

</div>

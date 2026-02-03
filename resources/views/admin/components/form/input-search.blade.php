@props([
    'placeholder' => 'Cari...',
    'name' => 'search',
    'value' => '',
    'autoSubmit' => false,
    'autoSubmitDelay' => 900,
    'autoSubmitMinLength' => 2,
    'autoFocus' => false,
    'autocomplete' => null,
])

<div {{ $attributes->merge(['class' => 'relative w-full sm:w-[450px] sm:min-w-[450px] sm:flex-none sm:shrink-0']) }}>
    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
    </span>
    <input type="text" 
        name="{{ $name }}" 
        value="{{ $value }}"
        placeholder="{{ $placeholder }}"
        @if(!is_null($autocomplete)) autocomplete="{{ $autocomplete }}" @endif
        {{ $autoFocus ? 'autofocus' : '' }}
        @if($autoSubmit)
            oncompositionstart="this.__as_comp = 1;"
            oncompositionend="this.__as_comp = 0;"
            oninput="if(this.__as_comp) return; if(!this.form) return; var el=this; var v=String(el.value||'').trim(); if(v!=='' && v.length < {{ (int) $autoSubmitMinLength }}) return; clearTimeout(el.__as_t); el.__as_t = setTimeout(function(){ if(!el.form) return; try { el.form.requestSubmit ? el.form.requestSubmit() : el.form.submit(); } catch(e) { el.form.submit(); } }, {{ (int) $autoSubmitDelay }});"
            onkeydown="if(event.key === 'Enter'){ event.preventDefault(); if(!this.form) return; var el=this; clearTimeout(el.__as_t); try { el.form.requestSubmit ? el.form.requestSubmit() : el.form.submit(); } catch(e) { el.form.submit(); } }"
        @endif
        class="w-full pl-9 pr-3 py-1.5 sm:pl-10 sm:pr-4 sm:py-1.5 border border-black rounded-lg focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400 focus:outline-none text-[12px] sm:text-sm bg-white transition-all text-slate-900 placeholder:font-normal placeholder:text-gray-400"
    >
</div>

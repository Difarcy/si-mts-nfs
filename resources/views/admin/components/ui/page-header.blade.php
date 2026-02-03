@props([
    'title' => '',
    'subtitle' => ''
])

<div {{ $attributes->merge(['class' => 'flex items-center justify-between gap-2 sm:gap-4']) }}>
    <div>
        <h1 class="text-sm sm:text-xl font-bold text-slate-900">{{ $title }}</h1>
        @if($subtitle)
            <p class="text-[10px] sm:text-sm text-black mt-0.5">{{ $subtitle }}</p>
        @endif
    </div>
    @if(isset($actions))
        <div class="flex items-center gap-1.5 sm:gap-3">
            <x-admin.form.button variant="gray" type="button" hidden data-admin-reset-button="true">Reset</x-admin.form.button>
            {{ $actions }}
        </div>
    @endif
</div>

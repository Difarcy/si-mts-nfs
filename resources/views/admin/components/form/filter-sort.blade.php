@props([
    'name' => '',
    'id' => '',
])

<select 
    @if($name) name="{{ $name }}" @endif
    @if($id) id="{{ $id }}" @endif
    autocomplete="off"
    {{ $attributes->merge(['class' => 'border border-black rounded-lg px-3 py-1.5 sm:px-3 sm:py-1.5 text-[12px] sm:text-sm focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400 focus:outline-none bg-white transition-all text-slate-900 min-w-[100px] cursor-pointer']) }}
>
    {{ $slot }}
</select>

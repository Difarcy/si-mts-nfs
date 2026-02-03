@props([
    'label' => null,
    'name' => '',
    'required' => false,
])

<div class="space-y-0.5">
    @if($label)
        <label for="{{ $name }}" class="block text-[12px] sm:text-sm text-black">
            {{ $label }}
            @if($required && $name !== 'status')
                <span class="text-red-600" data-required-indicator="true">*</span>
            @endif
        </label>
    @endif
    <div class="relative">
        <select 
            id="{{ $name }}" 
            name="{{ $name }}"
            {{ $required ? 'required' : '' }}
            {{ $attributes->merge(['class' => 'w-full px-3 py-1 sm:px-4 sm:py-1.5 border border-black rounded-lg focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400 focus:outline-none text-[12px] sm:text-sm transition-all appearance-none bg-white']) }}
        >
            {{ $slot }}
        </select>
        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </div>
    </div>
</div>

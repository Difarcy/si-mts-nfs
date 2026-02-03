@props([
    'label' => 'Upload Gambar',
    'name' => 'image',
    'required' => false,
    'enforceRequired' => true,
    'existingValue' => null,
    'helperText' => 'PNG, JPG up to 10MB',
    'multiple' => false,
    'maxFiles' => 0,
    'height' => 'h-[250px] sm:h-[400px]',
    'containerStyle' => null,
    'existing' => null,
    'objectFit' => 'object-cover'
])

@php
    $existingSingle = !$multiple && is_string($existing) && $existing !== '';
    $existingMultiple = $multiple && is_array($existing) && count($existing) > 0;
@endphp

<div class="space-y-1">
    @if($label)
        <label class="block text-[12px] sm:text-sm text-black">
            {{ $label }}
            @if($required)
                <span class="text-red-600" data-required-indicator="true">*</span>
            @endif
        </label>
    @endif

    <div class="relative w-full group/upload" 
         data-component="upload-image" 
         data-multiple="{{ $multiple ? 'true' : 'false' }}"
         data-max-files="{{ $maxFiles }}">
        
        {{-- Hidden Input for Order --}}
        @if($multiple)
            <input type="hidden" name="{{ $name }}_order" class="upload-order-input" value="">
        @endif

        <label for="{{ $name }}" class="relative flex flex-col w-full {{ $height }} border-2 border-dashed border-black rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 hover:border-yellow-400 focus-within:border-yellow-400 transition-colors overflow-y-auto" @if($containerStyle) style="{{ $containerStyle }}" @endif>
            
            {{-- Default / Empty State --}}
            <div class="flex flex-col items-center justify-center flex-grow pt-5 pb-6 upload-placeholder {{ ($existingSingle || $existingMultiple) ? 'hidden' : '' }}">
                <svg class="w-10 h-10 sm:w-16 sm:h-16 mb-2 sm:mb-4 text-gray-400 group-hover/upload:text-gray-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <div class="text-center space-y-1">
                    <p class="text-xs sm:text-sm text-gray-700">Klik atau seret gambar</p>
                    <p class="text-[10px] sm:text-xs text-gray-500">{{ $helperText }}</p>
                </div>
            </div>

            {{-- Single Preview Container --}}
            @if(!$multiple)
                <div class="{{ $existingSingle ? '' : 'hidden' }} absolute inset-0 w-full h-full p-2 sm:p-3 upload-preview-container">
                    <div class="relative w-full h-full rounded-md overflow-hidden border border-black/5">
                        <img src="{{ $existingSingle ? $existing : '' }}" loading="lazy" decoding="async" class="w-full h-full {{ $objectFit }} upload-preview-image">
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover/upload:opacity-100 transition-opacity flex items-center justify-center">
                            <p class="text-white text-[10px] sm:text-xs font-bold px-3 py-1.5 border border-white rounded-full">Ganti Gambar</p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Multiple Grid Container --}}
            @if($multiple)
                <div class="{{ $existingMultiple ? '' : 'hidden' }} w-full grid grid-cols-1 sm:grid-cols-2 gap-4 p-4 upload-grid-container content-start">
                    @if($existingMultiple)
                        @foreach($existing as $path)
                            @if(is_string($path) && $path !== '')
                                <div class="relative group/item aspect-video rounded-lg overflow-hidden border border-gray-200 bg-white" data-existing-item="true" data-sortable-item="true" draggable="true">
                                    <input type="hidden" name="{{ $name }}_existing[]" value="{{ $path }}">
                                    <img src="{{ str_starts_with($path, 'http') ? $path : asset('storage/' . $path) }}" loading="lazy" decoding="async" class="w-full h-full object-cover">
                                    <button type="button" class="absolute top-1 right-1 w-5 h-5 bg-red-600 text-white rounded-full flex items-center justify-center p-0 shadow-md hover:bg-red-700 transition-colors z-20 remove-item-btn" data-existing="true">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                    <div class="absolute inset-0 bg-black/20 opacity-0 group-hover/item:opacity-100 transition-opacity pointer-events-none"></div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            @endif

            <input id="{{ $name }}" 
                   name="{{ $multiple ? $name.'[]' : $name }}" 
                   type="file" 
                   class="hidden upload-input" 
                   data-required="{{ ($required && $enforceRequired) ? 'true' : 'false' }}"
                   accept="image/*" 
                   {{ ($required && $enforceRequired) ? 'required' : '' }}
                   {{ $multiple ? 'multiple' : '' }} />
        </label>

        @if(!$multiple && $existingSingle)
            <input type="hidden" name="{{ $name }}_existing" value="{{ is_string($existingValue) ? $existingValue : $existing }}">
            <input type="hidden" name="{{ $name }}_remove" value="0">
        @endif

        {{-- Global Remove Button (Only for Single) --}}
        @if(!$multiple)
            <button type="button" class="{{ $existingSingle ? '' : 'hidden' }} absolute top-5 right-5 sm:top-6 sm:right-6 w-6 h-6 bg-red-600 text-white rounded-full flex items-center justify-center p-0 shadow-lg hover:bg-red-700 transition-colors z-10 upload-remove-btn" title="Hapus Gambar">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        @else
            {{-- Floating Add Button for Multiple Mode --}}
            <button type="button" class="{{ $existingMultiple ? '' : 'hidden' }} absolute top-3 left-3 w-8 h-8 bg-green-600 text-white rounded-md flex items-center justify-center shadow-lg hover:bg-green-700 transition-all hover:scale-105 active:scale-95 z-[30] upload-add-floating-btn" title="Tambah Gambar">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
            </button>
        @endif
    </div>
</div>

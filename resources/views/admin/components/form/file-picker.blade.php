@props([
    'label' => 'Lampiran',
    'name' => 'attachment',
    'required' => false,
    'placeholder' => 'Pilih file...',
    'accept' => '.pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx',
    'existingUrl' => null,
    'existingName' => null,
])
@php
    $displayValue = $existingName ? $existingName : '';
@endphp
<div class="space-y-1" data-component="file-picker">
    @if($label)
        <label class="block text-[12px] sm:text-sm text-black">
            {{ $label }}


                       @if($required)
                        <span class="text-red-600" data-required-indicator="true">*</span>
                    @endif


           </label>
    @endif
                   

   

                
                <div class="flex w-full group relative">
        <button type="button" class="px-3 py-1 sm:px-4 sm:py-1.5 border border-black border-r-0 rounded-l-lg bg-green-700 hover:bg-green-800 text-white text-[12px] sm:text-sm font-semibold transition-colors focus:outline-none ring-0 outline-none cursor-pointer" data-file-picker-button>
            Pilih File
        </button>

        <input type="text" class="flex-1 px-3 py-1 sm:px-4 sm:py-1.5 border border-black rounded-r-lg text-[12px] sm:text-sm text-black bg-white focus:outline-none ring-0 outline-none transition-all cursor-pointer pr-8" value="{{ $displayValue }}" placeholder="{{ $placeholder }}" readonly data-file-picker-display />
        
        <button type="button" class="absolute right-0 top-1/2 -translate-y-1/2 h-full px-2 text-gray-400 hover:text-red-600 {{ $displayValue ? '' : 'hidden' }} transition-colors z-10" data-file-picker-clear style="margin-right: 1px;">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>
    <input type="file" name="{{ $name }}" class="hidden" accept="{{ $accept }}" data-file-picker-input {{ $required ? 'required' : '' }} />

    @if($existingUrl)
        @php
            $ext = strtolower(pathinfo($existingUrl, PATHINFO_EXTENSION));
            $isPdf = $ext === 'pdf';
            $isOffice = in_array($ext, ['doc','docx','xls','xlsx','ppt','pptx']);
            $isProduction = app()->environment('production');
            
            $finalUrl = $existingUrl;
            
            if ($isProduction && ($isOffice || $isPdf)) {
                 $finalUrl = 'https://docs.google.com/viewer?url=' . urlencode($existingUrl) . '&embedded=true';
            } elseif ($isPdf) {
                 // Gunakan Internal PDF Viewer (PDF.js) via Route kita
                 // Pastikan route 'admin.pdf-preview' sudah ada
                 $finalUrl = route('admin.pdf-preview', ['url' => $existingUrl]);
            }

            $previewLabel = ($isPdf || $isOffice) ? 'Lihat Preview' : 'Lihat Lampiran';
        @endphp
        <div class="pt-1 flex flex-wrap items-center gap-2">
            <a href="{{ $finalUrl }}" target="_blank" rel="noopener"
                class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 text-blue-700 hover:bg-blue-100 hover:text-blue-800 rounded-md text-[11px] sm:text-xs font-semibold transition-colors border border-blue-200"
                title="{{ $previewLabel }}">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                {{ $previewLabel }}
            </a>
        </div>
    @endif
</div>

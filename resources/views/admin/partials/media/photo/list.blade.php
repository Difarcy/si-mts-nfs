@if($photos->count() > 0)
    <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 p-4" id="photo-grid">
        @foreach($photos as $photo)
            <div class="relative aspect-video group rounded-lg overflow-hidden border border-gray-200 bg-gray-50 cursor-move"
                data-photo-item data-id="{{ $photo->id }}" draggable="true">
                <img src="{{ asset('storage/' . $photo->gambar) }}" alt="Foto Kegiatan"
                    class="w-full h-full object-cover pointer-events-none">

                {{-- Handle Indicator (Visible on hover) --}}
                <div
                    class="absolute inset-0 bg-black/10 opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none flex items-center justify-center">
                    <svg class="w-8 h-8 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9h8M8 15h8"></path>
                    </svg>
                </div>

                {{-- Date Overlay --}}
                <div
                    class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                    <div class="absolute bottom-3 left-3 flex flex-col">
                        <span class="text-[10px] text-white/90 font-medium">
                            {{ $photo->tanggal_publikasi->format('d M Y') }}
                        </span>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div
                    class="absolute top-2 right-2 flex gap-2 translate-y-[-10px] opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                    <button type="button"
                        class="p-2 bg-white/90 text-slate-900 rounded-full shadow-lg hover:bg-white transition-colors"
                        data-image-preview-trigger data-image-preview-src="{{ asset('storage/' . $photo->gambar) }}"
                        draggable="false">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 7v6m-3-3h6" />
                        </svg>
                    </button>
                    <button type="button"
                        class="p-2 bg-red-600 text-white rounded-full shadow-lg hover:bg-red-700 transition-colors"
                        data-photo-delete data-photo-id="{{ $photo->id }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="flex-1 flex flex-col items-center justify-center text-center gap-6 px-4">
        {{-- Icon --}}
        <svg class="w-24 h-24 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
            </path>
        </svg>

        {{-- Description text --}}
        <p class="text-sm text-black max-w-xs">Mulai abadikan momen berharga sekolah Anda dengan mengupload
            foto pertama.</p>

        {{-- Button --}}
        <x-admin.form.button variant="add" type="button" class="sm:px-8 border border-black"
            x-on:click="$dispatch('open-modal', { name: 'upload-photo' })">
            <x-slot:icon>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
            </x-slot:icon>
            Tambah Foto Pertama
        </x-admin.form.button>
    </div>
@endif

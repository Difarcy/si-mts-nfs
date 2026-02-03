@foreach($photos as $photo)
    <div class="aspect-video rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow cursor-pointer group relative animate-on-scroll"
        data-image-preview-trigger data-image-preview-src="{{ asset('storage/' . $photo->gambar) }}">
        <img src="{{ asset('storage/' . $photo->gambar) }}" alt="Foto Kegiatan"
            class="w-full h-full object-cover">
        <div
            class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors flex items-center justify-center">
            <span
                class="bg-white/90 p-2 rounded-full opacity-0 group-hover:opacity-100 transition-opacity transform translate-y-2 group-hover:translate-y-0 duration-300">
                <svg class="h-4 w-4 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 7v6m-3-3h6" />
                </svg>
            </span>
        </div>
    </div>
@endforeach

<div id="gallery-meta-{{ $photos->currentPage() }}" data-has-more="{{ $photos->hasMorePages() ? 'true' : 'false' }}" class="hidden gallery-meta"></div>
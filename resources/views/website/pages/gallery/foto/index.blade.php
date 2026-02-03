@extends('website.layouts.full')

@section('title', 'Foto')

@section('content')
    <div class="space-y-6 pt-4 sm:pt-6">
        <!-- Breadcrumb -->
        <x-website.components.layout.breadcrumb :items="[['label' => 'GALERI'], ['label' => 'FOTO']]" />

        <!-- Header Section -->
        <div class="flex items-center justify-between gap-4 mb-6">
            <x-website.components.layout.page-title title="Foto" margin="mb-0" />
            {{-- Pagination Toolbar Removed for Load More --}}
        </div>

        <div class="w-full @if($photos->count() > 0) min-h-[600px] lg:min-h-[800px] @endif">
            @if($photos->count() > 0)
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4" id="photo-grid">
                    @include('website.pages.gallery.foto.partial-list')
                </div>

                @if($photos->hasMorePages())
                    <div class="py-8 text-center" id="load-more-container">
                        <button type="button" id="btn-load-more" 
                            data-next-page="{{ $photos->currentPage() + 1 }}"
                            class="px-6 py-2.5 bg-white border border-gray-200 rounded-full text-sm font-medium text-gray-700 hover:bg-gray-50 hover:border-gray-300 transition-all shadow-sm cursor-pointer">
                            Muat Lebih Banyak
                        </button>
                    </div>
                @endif
            @else
                <div class="h-full flex items-center justify-center">
                    <div class="col-span-full flex items-center justify-center py-20 text-center">
                        <p class="text-xs sm:text-base font-semibold text-slate-900 tracking-wider">Belum Ada Foto Kegiatan</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btnLoadMore = document.getElementById('btn-load-more');
        const container = document.getElementById('load-more-container');
        const grid = document.getElementById('photo-grid');
        
        if (btnLoadMore) {
            btnLoadMore.addEventListener('click', function() {
                const nextPage = this.getAttribute('data-next-page');
                const originalText = this.textContent;
                
                this.disabled = true;
                this.textContent = 'Memuat...';
                
                const url = new URL(window.location.href);
                url.searchParams.set('page', nextPage);
                
                fetch(url.toString(), {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'text/html, application/xhtml+xml'
                    }
                })
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.text();
                })
                .then(html => {
                    if (!html.trim()) {
                        container.style.display = 'none';
                        return;
                    }
                    
                    // Check for meta data in the response
                    const temp = document.createElement('div');
                    temp.innerHTML = html;
                    // Try to find the meta div in the partial response
                    // Since html might contain multiple elements (divs), we search in temp
                    // Note: if html is just text nodes, this works too.
                    
                    // We look for any element with class 'gallery-meta' inside the appended html
                    // But since we already appended it (or are about to), we can just check the string or the temp DOM
                    
                    let serverHasMore = false;
                    const metaDiv = temp.querySelector('.gallery-meta');
                    if (metaDiv) {
                         serverHasMore = metaDiv.getAttribute('data-has-more') === 'true';
                    }

                    if (html.includes('<html') || html.includes('<!DOCTYPE')) {
                         const fullPageTemp = document.createElement('div');
                         fullPageTemp.innerHTML = html;
                         const partialContent = fullPageTemp.querySelector('#photo-grid')?.innerHTML;
                         if (partialContent) {
                             grid.insertAdjacentHTML('beforeend', partialContent);
                             // Need to check hasMore in full page response too if possible
                             // But usually full page response is not what we want here.
                         }
                    } else {
                        // It is a partial view as expected
                        grid.insertAdjacentHTML('beforeend', html);
                    }
                    
                    // Update button state
                    if (!serverHasMore) {
                        container.style.display = 'none';
                    } else {
                        const newNextPage = parseInt(nextPage) + 1;
                        btnLoadMore.setAttribute('data-next-page', newNextPage);
                        btnLoadMore.disabled = false;
                        btnLoadMore.textContent = originalText;
                    }
                })
                .catch(error => {
                    console.error('Error loading photos:', error);
                    btnLoadMore.disabled = false;
                    btnLoadMore.textContent = 'Gagal memuat. Coba lagi.';
                });
            });
        }
    });
</script>
@endpush

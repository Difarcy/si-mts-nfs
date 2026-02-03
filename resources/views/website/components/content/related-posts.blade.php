@if(isset($relatedPosts) && $relatedPosts->isNotEmpty())
    <div class="pt-6 border-t border-gray-100">
        <h3 class="text-base sm:text-lg font-bold text-black mb-4 font-roboto-slab">Baca Juga:</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($relatedPosts as $item)
                @php
                    $isNews = $item->post_type === 'news';
                    $route = $isNews ? 'web.news.detail' : 'web.article.detail';
                    $btnText = $isNews ? 'BACA BERITA' : 'BACA ARTIKEL';
                    $img = $item->thumbnail ? asset('storage/' . $item->thumbnail) : asset('img/banner1.jpg');
                    $dObj = $item->tanggal_publikasi ?? $item->created_at ?? now();
                    $d = \Carbon\Carbon::parse($dObj)->translatedFormat('d F Y');
                @endphp
                <a href="{{ route($route, $item->id) }}"
                    class="group overflow-hidden border border-gray-100 bg-white hover:shadow-lg transition-all duration-300 rounded-lg flex flex-col h-full">
                    <div class="aspect-video bg-gray-50 overflow-hidden relative">
                        <img src="{{ $img }}" alt="{{ $item->judul ?? 'Post' }}"
                            class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500"
                            loading="lazy">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                        <div class="absolute top-2 left-2">
                            <x-website.components.ui.badge :variant="$isNews ? 'news' : 'article'" class="!px-1.5 !py-0.5 text-[8px] tracking-normal" style="text-transform: none !important;">
                                {{ $isNews ? 'Berita' : 'Artikel' }}
                            </x-website.components.ui.badge>
                        </div>
                    </div>
                    <div class="p-4 flex flex-col flex-1">
                        <h4
                            class="text-[13px] sm:text-sm font-bold text-black line-clamp-2 group-hover:text-green-700 transition-colors font-roboto-slab leading-snug mb-2">
                            {{ $item->judul ?? 'Belum ada' }}
                        </h4>
                        <p class="text-[11px] text-slate-900 line-clamp-2 mb-4 font-lato leading-relaxed">
                            {{ \Illuminate\Support\Str::limit(strip_tags($item->deskripsi), 100) }}
                        </p>
                        <div class="mt-auto pt-3 border-t border-gray-50 flex items-center justify-between">
                            <p class="text-[10px] text-slate-900 font-lato">
                                {{ $d }}
                            </p>
                            <span
                                class="text-[10px] font-bold text-green-700 font-lato group-hover:underline">{{ $btnText }}</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endif
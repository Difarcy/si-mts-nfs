@php
    // Ambil banner dari parameter yang dikirim controller
    $dbBanners = isset($banners) && $banners->count() > 0 ? $banners : collect();

    // Siapkan array gambar untuk slider
    $slideImages = [];

    // Jika ada banner dari DB, gunakan; jika tidak, gunakan default background
    if ($dbBanners->count() > 0) {
        $slideImages = $dbBanners->filter(function ($banner) {
            return $banner->is_active && $banner->path;
        })->sortBy('urutan')->values()->map(function ($banner) {
            $bannerUpdatedAt = time(); // No timestamps in DB, use current time or handle cache busting differently if needed
            $imagePath = 'storage/' . $banner->path;
            $imageUrl = asset('storage/' . $banner->path);

            return [
                'image' => $imageUrl,
                'image_path' => $imagePath,
                'image_version' => $bannerUpdatedAt,
            ];
        })->toArray();
    }
@endphp

@if(empty($slideImages))
    <!-- Jika tidak ada banner, gunakan default background -->
    <div class="absolute inset-0 z-10">
        <img src="{{ asset('images/background/default-backgrounds.png') }}@if(file_exists(public_path('images/background/default-backgrounds.png')))?v={{ filemtime(public_path('images/background/default-backgrounds.png')) }}@endif"
            alt="Banner Default" class="w-full h-full object-cover" loading="lazy" decoding="async">
        <div class="absolute inset-0 bg-linear-to-b from-black/20 to-black/65">
        </div>
    </div>
@else
    <!-- Hanya gambar yang di-slide -->
    @foreach ($slideImages as $index => $slideImage)
        @php
            $imagePath = $slideImage['image_path'] ?? '';
            $imageExists = $imagePath && file_exists(public_path($imagePath));
            if (isset($slideImage['image_version']) && $imageExists) {
                $imageSrc = asset($imagePath) . '?v=' . $slideImage['image_version'];
            } elseif ($imageExists) {
                $imageVersion = filemtime(public_path($imagePath));
                $imageSrc = asset($imagePath) . ($imageVersion ? '?v=' . $imageVersion : '');
            } else {
                $imageSrc = asset('images/background/default-backgrounds.png');
            }
        @endphp
        <div class="absolute inset-0 transition-transform duration-1000 ease-in-out transform bg-slate-900 {{ $index === 0 ? 'z-10' : 'z-0' }}"
            data-banner-slide data-slide-index="{{ $index }}" style="transform: translateX({{ $index === 0 ? '0' : '100' }}%);">
            <img src="{{ $imageSrc }}" alt="Banner {{ $index + 1 }}"
                class="w-full h-full object-cover bg-slate-800 js-img-fallback"
                data-fallback-src="{{ asset('images/background/default-backgrounds.png') }}">
            <div class="absolute inset-0 bg-linear-to-b from-black/20 to-black/65">
            </div>
        </div>
    @endforeach

    <!-- Indicators -->
    <div class="flex absolute bottom-8 left-1/2 -translate-x-1/2 items-center gap-3 z-40 px-4 py-2 pointer-events-auto opacity-0 invisible transition-all duration-300 ease-out group-hover:opacity-100 group-hover:visible"
        data-banner-indicators>
        @foreach ($slideImages as $index => $slideImage)
            <button type="button"
                class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full cursor-pointer transition-all duration-300 ease-in-out shrink-0 {{ $index === 0 ? 'bg-white' : 'bg-white/50 hover:bg-white/80' }}"
                data-banner-dot data-slide-target="{{ $index }}" aria-label="Pilih slide {{ $index + 1 }}"></button>
        @endforeach
    </div>
@endif

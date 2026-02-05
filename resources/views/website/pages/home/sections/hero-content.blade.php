@php
    // Use default logo
    $logoPath = 'images/logo/logo.png';
    $logoVersion = file_exists(public_path($logoPath)) ? filemtime(public_path($logoPath)) : null;

    // Get Data from Hero Model (passed from controller)
    $tagline = $hero->tagline ?? 'Tagline belum tersedia';
    $title = $hero->judul ?? 'Judul banner belum tersedia';
    $description = $hero->deskripsi ?? 'Deskripsi banner belum tersedia';
    $buttonText = $hero->button_text ?? 'Teks tombol';
    $buttonLink = $hero->button_url ?? null;

    // Display Options
    $showLogo = $hero->show_logo ?? true;
    $showTagline = $hero->show_tagline ?? true;
    $showTitle = $hero->show_judul ?? true;
    $showDescription = $hero->show_deskripsi ?? true;
    $showButton = $hero->show_button ?? true;
@endphp

<!-- Konten Hero (Logo, Teks, Tombol) -->
<div class="absolute inset-0 flex items-end pb-8 md:pb-16 z-20 pointer-events-none">
    <div class="px-6 max-w-3xl sm:pl-10 lg:pl-20 pointer-events-auto">
        <div class="flex flex-col items-start gap-2 sm:gap-4">
            @if($showLogo)
                <div>
                    <img src="{{ $websiteLogo }}" alt="Logo {{ 'MTs Nurul Falaah' }}"
                        class="h-14 w-14 sm:h-32 sm:w-32 md:h-36 md:w-36 lg:h-40 lg:w-40 object-contain drop-shadow-[1px_1px_2px_rgba(0,0,0,0.4)] md:drop-shadow-[2px_2px_4px_rgba(0,0,0,0.5)]">
                </div>
            @endif

            <div class="flex flex-col items-start gap-1 sm:gap-2">
                @if($showTagline && !empty($tagline))
                    <p class="text-[10px] sm:text-base font-bold text-white drop-shadow-md leading-tight">
                        {{ $tagline }}
                    </p>
                @endif

                @if($showTitle && !empty($title))
                    <h1 class="text-base sm:text-3xl md:text-4xl font-bold text-white drop-shadow-lg leading-tight">
                        {{ $title }}
                    </h1>
                @endif

                @if($showDescription && !empty($description))
                    <p class="text-[10px] sm:text-base lg:text-lg text-white font-bold drop-shadow-md leading-relaxed max-w-xl text-left line-clamp-3 md:line-clamp-5 break-words">
                        {{ $description }}
                    </p>
                @endif
            </div>

            @if($showButton)
                @php
                    $btnClass = "inline-block bg-green-700 hover:bg-green-800 text-white font-bold py-1.5 px-4 sm:py-2.5 sm:px-6 rounded-md transition-all duration-300 flex items-center gap-2 text-[10px] sm:text-base shadow-lg hover:shadow-xl hover:-translate-y-0.5 transform";
                @endphp
                @if($buttonLink)
                    <a href="{{ $buttonLink }}" class="{{ $btnClass }}">
                        {{ $buttonText }}
                    </a>
                @else
                    <button type="button" class="{{ $btnClass }}">
                        {{ $buttonText }}
                    </button>
                @endif
            @endif
        </div>
    </div>
</div>
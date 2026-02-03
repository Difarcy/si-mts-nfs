<div id="topbar-container"
    class="bg-green-900 text-white h-7 flex items-center text-[10px] sm:text-sm transition-all duration-300 overflow-hidden font-lato">
    <div class="container mx-auto px-4 flex justify-between items-center">
        <!-- Sisi Kiri: Login & Kontak -->
        <div class="flex items-center space-x-2 sm:space-x-4">
            @auth
                <a href="{{ route('admin.dashboard') }}"
                    class="hover:text-yellow-400 transition-colors font-medium">{{ Auth::user()->nama }}</a>
            @else
                <a href="/auth" class="hover:text-yellow-400 transition-colors font-medium">Login</a>
            @endauth
            <span class="border-l border-white/30 h-4"></span>

            <!-- Phone: Hidden on Mobile, Show on Desktop -->
            <span class="hidden md:flex items-center space-x-2">
                @php
                    $phoneLabel = $kontak?->telepon ?: null;
                    $phoneHref = $phoneLabel ? preg_replace('/[^0-9+]/', '', (string) $phoneLabel) : null;
                @endphp
                @if($phoneLabel)
                    <a href="tel:{{ $phoneHref }}" class="hover:text-yellow-400 transition-colors font-medium">
                        {{ $phoneLabel }}
                    </a>
                @else
                    <span>Belum ada</span>
                @endif
            </span>
            <span class="hidden md:inline border-l border-white/30 h-4"></span>

            <!-- Email: Show on Mobile & Desktop -->
            <span class="flex items-center space-x-2">
                @if(!empty($kontak?->email))
                    <a href="mailto:{{ $kontak->email }}" class="hover:text-yellow-400 transition-colors font-medium">
                        {{ $kontak->email }}
                    </a>
                @else
                    <span>Belum ada</span>
                @endif
            </span>
        </div>

        <!-- Sisi Kanan: Ikon Media Sosial -->
        <div class="flex items-center space-x-3 sm:space-x-5">
            <!-- Facebook (Hover: Blue) -->
            @if(!empty($socialLinks['facebook']))
                <a href="{{ $socialLinks['facebook'] }}" target="_blank" rel="noopener noreferrer" class="text-white transition-colors duration-300 hover:text-[#1877F2]" aria-label="Facebook">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
                    </svg>
                </a>
            @else
                <span class="text-white transition-colors duration-300 cursor-default" aria-label="Facebook">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
                    </svg>
                </span>
            @endif

            <!-- Instagram (Hover: Pink) -->
            @if(!empty($socialLinks['instagram']))
                <a href="{{ $socialLinks['instagram'] }}" target="_blank" rel="noopener noreferrer" class="text-white transition-colors duration-300 hover:text-[#E1306C]" aria-label="Instagram">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M7.5 2h9A5.5 5.5 0 0 1 22 7.5v9A5.5 5.5 0 0 1 16.5 22h-9A5.5 5.5 0 0 1 2 16.5v-9A5.5 5.5 0 0 1 7.5 2zM7.5 4A3.5 3.5 0 0 0 4 7.5v9A3.5 3.5 0 0 0 7.5 20h9A3.5 3.5 0 0 0 20 16.5v-9A3.5 3.5 0 0 0 16.5 4h-9z" />
                        <path d="M12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10zm0 2a3 3 0 1 0 0 6 3 3 0 0 0 0-6z" />
                        <path d="M17 6.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                    </svg>
                </a>
            @else
                <span class="text-white transition-colors duration-300 cursor-default" aria-label="Instagram">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M7.5 2h9A5.5 5.5 0 0 1 22 7.5v9A5.5 5.5 0 0 1 16.5 22h-9A5.5 5.5 0 0 1 2 16.5v-9A5.5 5.5 0 0 1 7.5 2zM7.5 4A3.5 3.5 0 0 0 4 7.5v9A3.5 3.5 0 0 0 7.5 20h9A3.5 3.5 0 0 0 20 16.5v-9A3.5 3.5 0 0 0 16.5 4h-9z" />
                        <path d="M12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10zm0 2a3 3 0 1 0 0 6 3 3 0 0 0 0-6z" />
                        <path d="M17 6.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                    </svg>
                </span>
            @endif

            <!-- X (Hover: Black) -->
            @if(!empty($socialLinks['x']))
                <a href="{{ $socialLinks['x'] }}" target="_blank" rel="noopener noreferrer" class="text-white transition-colors duration-300 hover:text-black" aria-label="X">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                    </svg>
                </a>
            @else
                <span class="text-white transition-colors duration-300 cursor-default" aria-label="X">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                    </svg>
                </span>
            @endif

            <!-- YouTube (Hover: Red) -->
            @if(!empty($socialLinks['youtube']))
                <a href="{{ $socialLinks['youtube'] }}" target="_blank" rel="noopener noreferrer" class="text-white transition-colors duration-300 hover:text-[#FF0000]" aria-label="YouTube">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z" />
                    </svg>
                </a>
            @else
                <span class="text-white transition-colors duration-300 cursor-default" aria-label="YouTube">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z" />
                    </svg>
                </span>
            @endif

            <!-- TikTok (Hover: Black) -->
            @if(!empty($socialLinks['tiktok']))
                <a href="{{ $socialLinks['tiktok'] }}" target="_blank" rel="noopener noreferrer" class="text-white transition-colors duration-300 hover:text-black" aria-label="TikTok">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 1 0-1 13.6 6.84 6.84 0 0 0 6.9-6.9V8a7.09 7.09 0 0 0 4.39 1.47v-3.44a3.53 3.53 0 0 1-1.06-.34z" />
                    </svg>
                </a>
            @else
                <span class="text-white transition-colors duration-300 cursor-default" aria-label="TikTok">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 1 0-1 13.6 6.84 6.84 0 0 0 6.9-6.9V8a7.09 7.09 0 0 0 4.39 1.47v-3.44a3.53 3.53 0 0 1-1.06-.34z" />
                    </svg>
                </span>
            @endif
        </div>
    </div>
</div>

<div class="flex items-center h-full relative w-full justify-end">
    {{-- ==========================================
    DESKTOP NAVIGATION (Visible on md and up)
    ========================================== --}}
    <div id="navbar-links"
        class="hidden md:flex items-center space-x-4 h-full transition-all duration-300 ease-in-out origin-right font-roboto-slab">
        <!-- Beranda -->
        <a href="/"
            class="px-1 py-1 text-base font-bold text-white border-b-2 border-transparent hover:border-white transition-all">
            Beranda
        </a>

        <!-- Dropdown Profil -->
        <div class="relative group">
            <button
                class="flex items-center px-1 py-1 text-base font-bold text-white border-b-2 border-transparent hover:border-white group-hover:border-white transition-all focus:outline-none h-full">
                Profil
                <svg class="w-5 h-5 ml-1 transition-transform duration-200 group-hover:rotate-180" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div
                class="absolute left-0 top-full w-[190px] bg-white shadow-xl rounded-lg invisible opacity-0 translate-y-2 group-hover:visible group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 ease-in-out z-50 border-t-2 border-green-600 overflow-hidden">
                <a href="/about"
                    class="block px-4 py-2 text-base font-bold text-black hover:text-green-600 transition-colors">Tentang
                    Sekolah</a>
                <a href="/vision"
                    class="block px-4 py-2 text-base font-bold text-black hover:text-green-600 transition-colors">Visi,
                    Misi, Tujuan</a>
                <a href="/greeting"
                    class="block px-4 py-2 text-base font-bold text-black hover:text-green-600 transition-colors">Kepala
                    Madrasah</a>
                <a href="/organization"
                    class="block px-4 py-2 text-base font-bold text-black hover:text-green-600 transition-colors">Struktur
                    Organisasi</a>
                <a href="/achievement"
                    class="block px-4 py-2 text-base font-bold text-black hover:text-green-600 transition-colors">Prestasi
                    Siswa</a>
            </div>
        </div>

        <!-- Dropdown Informasi -->
        <div class="relative group">
            <button
                class="flex items-center px-1 py-1 text-base font-bold text-white border-b-2 border-transparent hover:border-white group-hover:border-white transition-all focus:outline-none h-full">
                Informasi
                <svg class="w-5 h-5 ml-1 transition-transform duration-200 group-hover:rotate-180" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div
                class="absolute left-0 top-full w-[190px] bg-white shadow-xl rounded-lg invisible opacity-0 translate-y-2 group-hover:visible group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 ease-in-out z-50 border-t-2 border-green-600 overflow-hidden">
                <a href="/news"
                    class="block px-4 py-2 text-base font-bold text-black hover:text-green-600 transition-colors">Berita</a>
                <a href="/article"
                    class="block px-4 py-2 text-base font-bold text-black hover:text-green-600 transition-colors">Artikel</a>
                <a href="/announcement"
                    class="block px-4 py-2 text-base font-bold text-black hover:text-green-600 transition-colors">Pengumuman</a>
                <a href="/agenda"
                    class="block px-4 py-2 text-base font-bold text-black hover:text-green-600 transition-colors">Agenda</a>
            </div>
        </div>

        <!-- SPMB -->
        <a href="{{ route('web.spmb') }}"
            class="px-1 py-1 text-base font-bold text-white border-b-2 border-transparent hover:border-white transition-all">
            SPMB/PPDB
        </a>

        <!-- Dropdown Portal -->
        <div class="relative group">
            <button
                class="flex items-center px-1 py-1 text-base font-bold text-white border-b-2 border-transparent hover:border-white group-hover:border-white transition-all focus:outline-none h-full">
                Portal
                <svg class="w-5 h-5 ml-1 transition-transform duration-200 group-hover:rotate-180" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div
                class="absolute left-0 top-full w-[190px] bg-white shadow-xl rounded-lg invisible opacity-0 translate-y-2 group-hover:visible group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 ease-in-out z-50 border-t-2 border-green-600 overflow-hidden">
                <a href="https://rdm.hdmadrasah.id/login/auth" target="_blank" rel="noopener noreferrer"
                    class="block px-4 py-2 text-base font-bold text-black hover:text-green-600 transition-colors">RDM</a>
                <a href="https://emisgtk.kemenag.go.id/" target="_blank" rel="noopener noreferrer"
                    class="block px-4 py-2 text-base font-bold text-black hover:text-green-600 transition-colors">EMIS
                    GTK</a>
            </div>
        </div>

        <!-- Dropdown Galeri -->
        <div class="relative group">
            <button
                class="flex items-center px-1 py-1 text-base font-bold text-white border-b-2 border-transparent hover:border-white group-hover:border-white transition-all focus:outline-none h-full">
                Galeri
                <svg class="w-5 h-5 ml-1 transition-transform duration-200 group-hover:rotate-180" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div
                class="absolute left-0 top-full w-[190px] bg-white shadow-xl rounded-lg invisible opacity-0 translate-y-2 group-hover:visible group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 ease-in-out z-50 border-t-2 border-green-600 overflow-hidden">
                <a href="{{ route('web.foto') }}"
                    class="block px-4 py-2 text-base font-bold text-black hover:text-green-600 transition-colors">Foto</a>
                <a href="{{ route('web.video') }}"
                    class="block px-4 py-2 text-base font-bold text-black hover:text-green-600 transition-colors">Video</a>
            </div>
        </div>

        <!-- Kontak -->
        <a href="/contact"
            class="px-1 py-1 text-base font-bold text-white border-b-2 border-transparent hover:border-white transition-all">
            Kontak
        </a>
    </div>

    <!-- Desktop Search Toggle -->
    <div class="hidden md:flex items-center ml-4 z-30 w-10 justify-center">
        <button type="button" id="search-toggle-btn"
            class="text-white hover:text-yellow-400 transition-colors focus:outline-none transform duration-200 p-2 rounded-full cursor-pointer relative z-50">
            <svg id="search-icon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 block" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <svg id="close-icon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hidden" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Desktop Search Form Overlay -->
    <div id="search-container" class="hidden absolute inset-y-0 left-0 right-10 flex items-center z-20">
        <form action="{{ route('web.search') }}" method="GET" class="w-full">
            <input type="text" id="search-input" name="q" placeholder="Cari informasi..." autofocus autocomplete="off"
                class="w-full bg-green-700 text-white placeholder-green-100 rounded-lg py-2 px-4 focus:ring-2 focus:ring-yellow-400 focus:outline-none text-base transition-all shadow-inner">
        </form>
    </div>

    {{-- ==========================================
    MOBILE NAVIGATION Toggle (Visible only on mobile)
    ========================================== --}}
    <div class="flex md:hidden items-center">
        <button type="button" id="mobile-menu-toggle"
            class="text-white hover:text-yellow-400 transition-colors p-2 focus:outline-none">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path id="hamburger-icon" class="block" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"></path>
                <path id="hamburger-close" class="hidden" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    {{-- ==========================================
    MOBILE MENU DRAWER
    ========================================== --}}
    @include('website.components.layout.sidebar-mobile')
</div>

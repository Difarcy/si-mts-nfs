{{-- Mobile Sidebar Menu --}}
<div id="mobile-sidebar" class="fixed inset-0 z-[100] md:hidden hidden">
    {{-- Overlay (Fully Transparent) --}}
    <div id="sidebar-overlay" class="absolute inset-0 bg-transparent transition-opacity"></div>

    {{-- Sidebar Content (Right Side) --}}
    <div id="sidebar-content"
        class="absolute top-0 right-0 h-full w-64 bg-white shadow-2xl transform translate-x-full transition-transform duration-300 ease-in-out flex flex-col overflow-hidden">

        {{-- Header Sidebar --}}
        <div class="flex items-center justify-between p-3 border-b border-gray-100 bg-green-600 text-white">
            <span class="font-bold text-xs uppercase">MENU WEBSITE</span>
            <button id="close-sidebar" class="hover:text-yellow-400 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>

        {{-- Content Area --}}
        <div class="flex-grow overflow-y-auto overflow-x-hidden pt-2 px-2 space-y-2"
            style="-ms-overflow-style: none; scrollbar-width: none;">
            {{-- Search Bar --}}
            <div class="px-1">
                <form action="{{ route('web.search') }}" method="GET" class="relative">
                    <input type="text" name="q" placeholder="Cari informasi..."
                        class="w-full bg-gray-100 text-gray-800 placeholder-gray-400 rounded-lg py-2 pl-3 pr-10 focus:ring-2 focus:ring-yellow-400 focus:outline-none text-xs transition-all border-none">
                    <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </form>
            </div>

            {{-- Navigation Links --}}
            <nav class="space-y-2 font-bold text-xs text-gray-700 font-roboto-slab">
                {{-- Beranda --}}
                <a href="{{ route('web.home') }}"
                    class="block px-3 py-2 hover:bg-green-600 hover:text-white rounded-lg transition-all">
                    Beranda
                </a>

                {{-- Profil Accordion --}}
                <div>
                    <button type="button"
                        class="sidebar-dropdown-toggle w-full flex items-center justify-between px-3 py-2 hover:bg-green-600 hover:text-white rounded-lg transition-all">
                        <span>Profil</span>
                        <svg class="sidebar-dropdown-icon w-3.5 h-3.5 transition-transform duration-200" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div class="sidebar-dropdown-menu hidden space-y-2 text-gray-700 mt-2">
                        <a href="{{ route('web.about') }}"
                            class="block px-3 py-2 hover:bg-green-600 hover:text-white rounded-lg transition-colors">Tentang
                            Sekolah</a>
                        <a href="{{ route('web.vision') }}"
                            class="block px-3 py-2 hover:bg-green-600 hover:text-white rounded-lg transition-colors">Visi,
                            Misi, Tujuan</a>
                        <a href="{{ route('web.greeting') }}"
                            class="block px-3 py-2 hover:bg-green-600 hover:text-white rounded-lg transition-colors">Kepala
                            Madrasah</a>
                        <a href="{{ route('web.organization') }}"
                            class="block px-3 py-2 hover:bg-green-600 hover:text-white rounded-lg transition-colors">Struktur
                            Organisasi</a>
                        <a href="{{ route('web.achievement') }}"
                            class="block px-3 py-2 hover:bg-green-600 hover:text-white rounded-lg transition-colors">Prestasi
                            Siswa</a>
                    </div>
                </div>

                {{-- Informasi Accordion --}}
                <div>
                    <button type="button"
                        class="sidebar-dropdown-toggle w-full flex items-center justify-between px-3 py-2 hover:bg-green-600 hover:text-white rounded-lg transition-all">
                        <span>Informasi</span>
                        <svg class="sidebar-dropdown-icon w-3.5 h-3.5 transition-transform duration-200" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div class="sidebar-dropdown-menu hidden space-y-2 text-gray-700 mt-2">
                        <a href="{{ route('web.news') }}"
                            class="block px-3 py-2 hover:bg-green-600 hover:text-white rounded-lg transition-colors">Berita</a>
                        <a href="{{ route('web.article') }}"
                            class="block px-3 py-2 hover:bg-green-600 hover:text-white rounded-lg transition-colors">Artikel</a>
                        <a href="{{ route('web.announcement') }}"
                            class="block px-3 py-2 hover:bg-green-600 hover:text-white rounded-lg transition-colors">Pengumuman</a>
                        <a href="{{ route('web.agenda') }}"
                            class="block px-3 py-2 hover:bg-green-600 hover:text-white rounded-lg transition-colors">Agenda</a>
                    </div>
                </div>

                {{-- SPMB --}}
                <a href="{{ route('web.spmb') }}"
                    class="block px-3 py-2 hover:bg-green-600 hover:text-white rounded-lg transition-all">
                    SPMB/PPDB
                </a>

                {{-- Portal Accordion --}}
                <div>
                    <button type="button"
                        class="sidebar-dropdown-toggle w-full flex items-center justify-between px-3 py-2 hover:bg-green-600 hover:text-white rounded-lg transition-all">
                        <span>Portal</span>
                        <svg class="sidebar-dropdown-icon w-3.5 h-3.5 transition-transform duration-200" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div class="sidebar-dropdown-menu hidden space-y-2 text-gray-700 mt-2">
                        <a href="https://rdm.hdmadrasah.id/login/auth" target="_blank"
                            class="block px-3 py-2 hover:bg-green-600 hover:text-white rounded-lg transition-colors">RDM</a>
                        <a href="https://emisgtk.kemenag.go.id/" target="_blank"
                            class="block px-3 py-2 hover:bg-green-600 hover:text-white rounded-lg transition-colors">EMIS
                            GTK</a>
                    </div>
                </div>

                {{-- Galeri Accordion --}}
                <div>
                    <button type="button"
                        class="sidebar-dropdown-toggle w-full flex items-center justify-between px-3 py-2 hover:bg-green-600 hover:text-white rounded-lg transition-all">
                        <span>Galeri</span>
                        <svg class="sidebar-dropdown-icon w-3.5 h-3.5 transition-transform duration-200" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div class="sidebar-dropdown-menu hidden space-y-2 text-gray-700 mt-2">
                        <a href="{{ route('web.foto') }}"
                            class="block px-3 py-2 hover:bg-green-600 hover:text-white rounded-lg transition-colors">Foto</a>
                        <a href="{{ route('web.video') }}"
                            class="block px-3 py-2 hover:bg-green-600 hover:text-white rounded-lg transition-colors">Video</a>
                    </div>
                </div>

                {{-- Kontak --}}
                <a href="{{ route('web.contact') }}"
                    class="block px-3 py-2 hover:bg-green-600 hover:text-white rounded-lg transition-all">
                    Kontak
                </a>
            </nav>
        </div>
    </div>
</div>

<style>
    /* Hide scrollbar for Chrome, Safari and Opera */
    #sidebar-content div::-webkit-scrollbar {
        display: none;
    }
</style>

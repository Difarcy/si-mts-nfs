<header class="sticky top-0 z-40 bg-white border-b border-gray-200 px-3 sm:px-6 h-18 overflow-hidden">
    <div class="h-full flex flex-nowrap items-center justify-between gap-2">
        <div class="flex items-center gap-2 min-w-0">
            {{-- ========================================
            HAMBURGER MENU (HANYA TAMPIL DI MOBILE)
            Icon 3 garis untuk buka sidebar
            ======================================== --}}
            <button type="button" id="sidebar-toggle-btn"
                class="inline-flex items-center justify-center p-2 text-slate-900 hover:text-yellow-400 shrink-0 lg:hidden focus:outline-none transition-colors"
                aria-label="Buka menu sidebar" aria-controls="admin-sidebar" aria-expanded="false">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>
            {{-- ======================================== --}}

            {{-- TITLE HALAMAN (Dashboard, dll) --}}
            <div class="min-w-0 flex-1 sm:flex-initial">
                <p class="text-sm sm:text-lg font-bold tracking-tight text-slate-900 truncate">
                    @php
                        $groupTitle = null;
                        if (request()->routeIs('admin.profil.*')) {
                            $groupTitle = 'Profil';
                        } elseif (request()->routeIs('admin.konten.*')) {
                            $groupTitle = 'Konten';
                        } elseif (request()->routeIs('admin.media.*')) {
                            $groupTitle = 'Media';
                        } elseif (request()->routeIs('admin.interaksi.*')) {
                            $groupTitle = 'Interaksi';
                        } elseif (request()->routeIs('admin.pengaturan.*')) {
                            $groupTitle = 'Pengaturan';
                        }
                    @endphp
                    @if ($groupTitle)
                        {{ $groupTitle }}
                    @else
                        @yield('title', 'Admin')
                    @endif
                </p>
            </div>
        </div>

        @include('admin.components.layout.navbar')
    </div>
</header>


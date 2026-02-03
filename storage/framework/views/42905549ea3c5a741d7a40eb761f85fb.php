<?php
    $currentRoute = request()->route() ? request()->route()->getName() : '';
?>

<aside id="admin-sidebar"
    class="fixed left-0 top-0 z-50 h-screen w-72 bg-white border-r border-gray-100 overflow-hidden transform -translate-x-full transition-transform duration-300 ease-in-out flex flex-col lg:translate-x-0 lg:w-64 lg:shadow-none shadow-2xl">

    
    <div
        class="h-18 px-6 border-b border-gray-100 flex items-center justify-center lg:justify-center shrink-0 relative bg-white text-black">
        <span class="text-xs lg:text-lg font-bold tracking-wider text-center uppercase lg:normal-case">
            <?php echo e(auth()->user()->nama ?? 'Admin Panel'); ?>

        </span>
        <button id="close-sidebar-btn"
            class="lg:hidden absolute right-4 text-gray-400 hover:text-yellow-400 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    
    <div id="admin-sidebar-menu-container"
        class="flex-1 overflow-y-auto [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
        <nav class="pt-1 pb-6 space-y-1 select-none font-roboto-slab">

            
            <a href="<?php echo e(route('admin.dashboard')); ?>"
                class="flex items-center gap-3 px-6 py-2 w-full transition-all duration-300 font-bold <?php echo e(request()->is('admin/dashboard*') ? 'text-green-600' : 'text-black hover:text-green-600'); ?>">
                <svg class="w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                    </path>
                </svg>
                <span class="text-xs lg:text-base">Dashboard</span>
            </a>

            
            <a href="<?php echo e(url('/')); ?>" target="_blank"
                class="flex items-center gap-3 px-6 py-2 w-full transition-all duration-300 font-bold text-black hover:text-green-600">
                <svg class="w-5 h-5 transition-colors duration-300" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                </svg>
                <span class="text-xs lg:text-base">Lihat Situs</span>
            </a>

            <?php
                $isProfilActive = request()->is('admin/profil*');
            ?>
            <div>
                <button type="button" data-collapse-toggle="dropdown-profil" aria-expanded="<?php echo e($isProfilActive ? 'true' : 'false'); ?>"
                    class="flex items-center justify-between px-6 py-2 w-full transition-all duration-300 font-bold <?php echo e($isProfilActive ? 'text-green-600' : 'text-black hover:text-green-600'); ?> group">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span class="text-xs lg:text-base font-bold">Profil</span>
                    </div>
                    <svg data-accordion-icon
                        class="w-4 h-4 transition-transform duration-200 <?php echo e($isProfilActive ? 'rotate-180' : ''); ?>" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="dropdown-profil" class="<?php echo e($isProfilActive ? '' : 'hidden'); ?> bg-gray-50/80 pt-1 space-y-1">
                    <a href="<?php echo e(route('admin.profil.about')); ?>"
                        class="block pl-14 pr-6 py-2 text-xs lg:text-base font-bold <?php echo e(request()->routeIs('admin.profil.about') ? 'text-green-600' : 'text-black hover:text-green-600'); ?> transition-colors">Tentang Sekolah</a>
                    <a href="<?php echo e(route('admin.profil.vision')); ?>"
                        class="block pl-14 pr-6 py-2 text-xs lg:text-base font-bold <?php echo e(request()->routeIs('admin.profil.vision') ? 'text-green-600' : 'text-black hover:text-green-600'); ?> transition-colors">Visi, Misi, Tujuan</a>
                    <a href="<?php echo e(route('admin.profil.greeting')); ?>"
                        class="block pl-14 pr-6 py-2 text-xs lg:text-base font-bold <?php echo e(request()->routeIs('admin.profil.greeting') ? 'text-green-600' : 'text-black hover:text-green-600'); ?> transition-colors">Kepala Madrasah</a>
                    <a href="<?php echo e(route('admin.profil.organization')); ?>"
                        class="block pl-14 pr-6 py-2 text-xs lg:text-base font-bold <?php echo e(request()->routeIs('admin.profil.organization') ? 'text-green-600' : 'text-black hover:text-green-600'); ?> transition-colors">Struktur Organisasi</a>
                </div>
            </div>

            
            <?php
                $isKontenActive = request()->is('admin/konten*');
            ?>
            <div>
                <button type="button" data-collapse-toggle="dropdown-konten"
                    aria-expanded="<?php echo e($isKontenActive ? 'true' : 'false'); ?>"
                    class="flex items-center justify-between px-6 py-2 w-full transition-all duration-300 font-bold <?php echo e($isKontenActive ? 'text-green-600' : 'text-black hover:text-green-600'); ?> group">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 transition-colors duration-300" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                            </path>
                        </svg>
                        <span class="text-xs lg:text-base font-bold">Konten</span>
                    </div>
                    <svg data-accordion-icon
                        class="w-4 h-4 transition-transform duration-200 <?php echo e($isKontenActive ? 'rotate-180' : ''); ?>"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="dropdown-konten" class="<?php echo e($isKontenActive ? '' : 'hidden'); ?> bg-gray-50/80 pt-1 space-y-1">
                    <a href="<?php echo e(route('admin.konten.berita.index')); ?>"
                        class="block pl-14 pr-6 py-2 text-xs lg:text-base font-bold <?php echo e(request()->is('admin/konten/berita*') ? 'text-green-600' : 'text-black hover:text-green-600'); ?> transition-colors">Berita</a>
                    <a href="<?php echo e(route('admin.konten.artikel.index')); ?>"
                        class="block pl-14 pr-6 py-2 text-xs lg:text-base font-bold <?php echo e(request()->is('admin/konten/artikel*') ? 'text-green-600' : 'text-black hover:text-green-600'); ?> transition-colors">Artikel</a>
                    <a href="<?php echo e(route('admin.konten.pengumuman.index')); ?>"
                        class="block pl-14 pr-6 py-2 text-xs lg:text-base font-bold <?php echo e(request()->is('admin/konten/pengumuman*') ? 'text-green-600' : 'text-black hover:text-green-600'); ?> transition-colors">Pengumuman</a>
                    <a href="<?php echo e(route('admin.konten.agenda.index')); ?>"
                        class="block pl-14 pr-6 py-2 text-xs lg:text-base font-bold <?php echo e(request()->is('admin/konten/agenda*') ? 'text-green-600' : 'text-black hover:text-green-600'); ?> transition-colors">Agenda</a>
                    <a href="<?php echo e(route('admin.konten.prestasi-siswa.index')); ?>"
                        class="block pl-14 pr-6 py-2 text-xs lg:text-base font-bold <?php echo e(request()->is('admin/konten/prestasi-siswa*') ? 'text-green-600' : 'text-black hover:text-green-600'); ?> transition-colors">Prestasi
                        Siswa</a>
                </div>
            </div>

            
            <?php
                $isMediaActive = request()->is('admin/media*');
            ?>
            <div>
                <button type="button" data-collapse-toggle="dropdown-media"
                    aria-expanded="<?php echo e($isMediaActive ? 'true' : 'false'); ?>"
                    class="flex items-center justify-between px-6 py-2 w-full transition-all duration-300 font-bold <?php echo e($isMediaActive ? 'text-green-600' : 'text-black hover:text-green-600'); ?> group">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 transition-colors duration-300" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        <span class="text-xs lg:text-base font-bold">Media</span>
                    </div>
                    <svg data-accordion-icon
                        class="w-4 h-4 transition-transform duration-200 <?php echo e($isMediaActive ? 'rotate-180' : ''); ?>"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="dropdown-media" class="<?php echo e($isMediaActive ? '' : 'hidden'); ?> bg-gray-50/80 pt-1 space-y-1">
                    <a href="<?php echo e(route('admin.media.foto.index')); ?>"
                        class="block pl-14 pr-6 py-2 text-xs lg:text-base font-bold <?php echo e(request()->is('admin/media/foto*') ? 'text-green-600' : 'text-black hover:text-green-600'); ?> transition-colors">Foto</a>
                    <a href="<?php echo e(route('admin.media.video.index')); ?>"
                        class="block pl-14 pr-6 py-2 text-xs lg:text-base font-bold <?php echo e(request()->is('admin/media/video*') ? 'text-green-600' : 'text-black hover:text-green-600'); ?> transition-colors">Video</a>
                </div>
            </div>

            
            <?php
                $isInteraksiActive = request()->is('admin/interaksi*');
            ?>
            <div>
                <button type="button" data-collapse-toggle="dropdown-interaksi"
                    aria-expanded="<?php echo e($isInteraksiActive ? 'true' : 'false'); ?>"
                    class="flex items-center justify-between px-6 py-2 w-full transition-all duration-300 font-bold <?php echo e($isInteraksiActive ? 'text-green-600' : 'text-black hover:text-green-600'); ?> group">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 transition-colors duration-300" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                            </path>
                        </svg>
                        <span class="text-xs lg:text-base font-bold">Interaksi</span>
                    </div>
                    <svg data-accordion-icon
                        class="w-4 h-4 transition-transform duration-200 <?php echo e($isInteraksiActive ? 'rotate-180' : ''); ?>"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="dropdown-interaksi"
                    class="<?php echo e($isInteraksiActive ? '' : 'hidden'); ?> bg-gray-50/80 pt-1 space-y-1">
                    <?php
                        $unreadMessagesCount = \App\Models\Pesan::where('status', 'unread')->count();
                        $unreadCommentsCount = \App\Models\Komentar::where('is_read', false)
                            ->where('author_type', '!=', 'admin')
                            ->count();
                    ?>
                    <a href="<?php echo e(route('admin.interaksi.pesan-masuk.index')); ?>"
                        class="relative flex items-center justify-between pl-14 pr-6 py-2 text-xs lg:text-base font-bold <?php echo e(request()->is('admin/interaksi/pesan-masuk*') ? 'text-green-600' : 'text-black hover:text-green-600'); ?> transition-colors">
                        <span>Pesan Masuk</span>
                        <span id="sidebar-unread-badge" data-count="<?php echo e($unreadMessagesCount); ?>"
                            class="flex items-center justify-center min-w-[20px] h-5 px-1 text-[10px] font-bold text-white bg-red-600 rounded-full <?php echo e($unreadMessagesCount > 0 ? '' : 'hidden'); ?>">
                            <?php echo e($unreadMessagesCount > 99 ? '99+' : $unreadMessagesCount); ?>

                        </span>
                    </a>
                    <a href="<?php echo e(route('admin.interaksi.komentar.index')); ?>"
                        class="relative flex items-center justify-between pl-14 pr-6 py-2 text-xs lg:text-base font-bold <?php echo e(request()->is('admin/interaksi/komentar*') ? 'text-green-600' : 'text-black hover:text-green-600'); ?> transition-colors">
                        <span>Komentar</span>
                        <span id="sidebar-unread-comments-badge" data-count="<?php echo e($unreadCommentsCount); ?>"
                            class="flex items-center justify-center min-w-[20px] h-5 px-1 text-[10px] font-bold text-white bg-red-600 rounded-full <?php echo e($unreadCommentsCount > 0 ? '' : 'hidden'); ?>">
                            <?php echo e($unreadCommentsCount > 99 ? '99+' : $unreadCommentsCount); ?>

                        </span>
                    </a>
                </div>
            </div>

            <a href="<?php echo e(route('admin.spmb.index')); ?>"
                class="flex items-center gap-3 px-6 py-2 w-full transition-all duration-300 font-bold <?php echo e(request()->is('admin/spmb*') ? 'text-green-600' : 'text-black hover:text-green-600'); ?>">
                <svg class="w-5 h-5 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 10l9-4 9 4-9 4-9-4zm0 0v8l9 4 9-4v-8"></path>
                </svg>
                <span class="text-xs lg:text-base">SPMB/PPDB</span>
            </a>

            
            <?php
                $isPengaturanActive = request()->is('admin/pengaturan*');
            ?>
            <div>
                <button type="button" data-collapse-toggle="dropdown-pengaturan"
                    aria-expanded="<?php echo e($isPengaturanActive ? 'true' : 'false'); ?>"
                    class="flex items-center justify-between px-6 py-2 w-full transition-all duration-300 font-bold <?php echo e($isPengaturanActive ? 'text-green-600' : 'text-black hover:text-green-600'); ?> group">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 transition-colors duration-300" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="text-xs lg:text-base font-bold">Pengaturan</span>
                    </div>
                    <svg data-accordion-icon
                        class="w-4 h-4 transition-transform duration-200 <?php echo e($isPengaturanActive ? 'rotate-180' : ''); ?>"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="dropdown-pengaturan"
                    class="<?php echo e($isPengaturanActive ? '' : 'hidden'); ?> bg-gray-50/80 pt-1 space-y-1">
                    <a href="<?php echo e(route('admin.pengaturan.logo')); ?>"
                        class="block pl-14 pr-6 py-2 text-xs lg:text-base font-bold <?php echo e(request()->routeIs('admin.pengaturan.logo') ? 'text-green-600' : 'text-black hover:text-green-600'); ?> transition-colors">Logo</a>
                    <a href="<?php echo e(route('admin.pengaturan.banner.index')); ?>"
                        class="block pl-14 pr-6 py-2 text-xs lg:text-base font-bold <?php echo e(request()->routeIs('admin.pengaturan.banner*') ? 'text-green-600' : 'text-black hover:text-green-600'); ?> transition-colors">Banner</a>
                    <a href="<?php echo e(route('admin.pengaturan.hero')); ?>"
                        class="block pl-14 pr-6 py-2 text-xs lg:text-base font-bold <?php echo e(request()->routeIs('admin.pengaturan.hero') ? 'text-green-600' : 'text-black hover:text-green-600'); ?> transition-colors">Hero</a>
                    <a href="<?php echo e(route('admin.pengaturan.promotion-banner')); ?>"
                        class="block pl-14 pr-6 py-2 text-xs lg:text-base font-bold <?php echo e(request()->routeIs('admin.pengaturan.promotion-banner') ? 'text-green-600' : 'text-black hover:text-green-600'); ?> transition-colors">Banner
                        Promosi</a>
                    <a href="<?php echo e(route('admin.pengaturan.kontak')); ?>"
                        class="block pl-14 pr-6 py-2 text-xs lg:text-base font-bold <?php echo e(request()->routeIs('admin.pengaturan.kontak') ? 'text-green-600' : 'text-black hover:text-green-600'); ?> transition-colors">Kontak</a>
                    <a href="<?php echo e(route('admin.pengaturan.social-media')); ?>"
                        class="block pl-14 pr-6 py-2 text-xs lg:text-base font-bold <?php echo e(request()->routeIs('admin.pengaturan.social-media') ? 'text-green-600' : 'text-black hover:text-green-600'); ?> transition-colors">Social
                        Media</a>
                </div>
            </div>


        </nav>
    </div>

</aside>

<!-- Sidebar Overlay -->
<div id="sidebar-overlay" class="hidden fixed inset-0 bg-transparent z-40 lg:hidden transition-all duration-300"></div>
<?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/admin/components/layout/sidebar.blade.php ENDPATH**/ ?>
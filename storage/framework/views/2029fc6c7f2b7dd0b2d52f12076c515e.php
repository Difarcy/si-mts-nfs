<!-- Footer -->
<footer class="bg-green-700 text-white mt-auto">
    <div class="container mx-auto px-3 sm:px-4 lg:px-6 xl:px-8 max-w-7xl pt-8 sm:pt-12 pb-2">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Logo dan Nama Sekolah -->
            <?php
                $logoPath = 'images/logo/logo.png';
                $logoVersion = file_exists(public_path($logoPath)) ? filemtime(public_path($logoPath)) : null;
                $namaSekolah = 'MTs Nurul Falaah Soreang';
            ?>
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <a href="/" class="flex items-center gap-3 hover:opacity-90 transition-opacity">
                        <img src="<?php echo e($websiteLogo); ?>"
                            alt="Logo <?php echo e($namaSekolah); ?>" class="h-10 w-10 sm:h-12 sm:w-12 object-contain shrink-0">
                        <div class="flex flex-col justify-center">
                            <span class="text-base sm:text-lg font-bold leading-tight font-sans">
                                <?php echo e($namaSekolah); ?>

                            </span>
                        </div>
                    </a>
                </div>
                <p class="text-xs sm:text-sm md:text-base text-gray-200 leading-relaxed mb-4 whitespace-pre-line max-w-xs break-words"><?php echo e(trim($kontak?->deskripsi ?: 'Belum ada')); ?></p>
                <div class="flex items-center gap-4">
                    <?php if(!empty($socialLinks['facebook'])): ?>
                        <a href="<?php echo e($socialLinks['facebook']); ?>" target="_blank" rel="noopener noreferrer" class="text-white transition-colors duration-300 hover:text-[#1877F2] transform hover:scale-110" aria-label="Facebook">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                    <?php else: ?>
                        <span class="text-white transition-colors duration-300 cursor-default" aria-label="Facebook">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </span>
                    <?php endif; ?>

                    <?php if(!empty($socialLinks['instagram'])): ?>
                        <a href="<?php echo e($socialLinks['instagram']); ?>" target="_blank" rel="noopener noreferrer" class="text-white transition-colors duration-300 hover:text-[#E1306C] transform hover:scale-110" aria-label="Instagram">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M7.5 2h9A5.5 5.5 0 0 1 22 7.5v9A5.5 5.5 0 0 1 16.5 22h-9A5.5 5.5 0 0 1 2 16.5v-9A5.5 5.5 0 0 1 7.5 2zM7.5 4A3.5 3.5 0 0 0 4 7.5v9A3.5 3.5 0 0 0 7.5 20h9A3.5 3.5 0 0 0 20 16.5v-9A3.5 3.5 0 0 0 16.5 4h-9z" />
                                <path d="M12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10zm0 2a3 3 0 1 0 0 6 3 3 0 0 0 0-6z" />
                                <path d="M17 6.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                            </svg>
                        </a>
                    <?php else: ?>
                        <span class="text-white transition-colors duration-300 cursor-default" aria-label="Instagram">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M7.5 2h9A5.5 5.5 0 0 1 22 7.5v9A5.5 5.5 0 0 1 16.5 22h-9A5.5 5.5 0 0 1 2 16.5v-9A5.5 5.5 0 0 1 7.5 2zM7.5 4A3.5 3.5 0 0 0 4 7.5v9A3.5 3.5 0 0 0 7.5 20h9A3.5 3.5 0 0 0 20 16.5v-9A3.5 3.5 0 0 0 16.5 4h-9z" />
                                <path d="M12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10zm0 2a3 3 0 1 0 0 6 3 3 0 0 0 0-6z" />
                                <path d="M17 6.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                            </svg>
                        </span>
                    <?php endif; ?>

                    <?php if(!empty($socialLinks['x'])): ?>
                        <a href="<?php echo e($socialLinks['x']); ?>" target="_blank" rel="noopener noreferrer" class="text-white transition-colors duration-300 hover:text-black transform hover:scale-110" aria-label="X (Twitter)">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                            </svg>
                        </a>
                    <?php else: ?>
                        <span class="text-white transition-colors duration-300 cursor-default" aria-label="X (Twitter)">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                            </svg>
                        </span>
                    <?php endif; ?>

                    <?php if(!empty($socialLinks['youtube'])): ?>
                        <a href="<?php echo e($socialLinks['youtube']); ?>" target="_blank" rel="noopener noreferrer" class="text-white transition-colors duration-300 hover:text-[#FF0000] transform hover:scale-110" aria-label="YouTube">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                            </svg>
                        </a>
                    <?php else: ?>
                        <span class="text-white transition-colors duration-300 cursor-default" aria-label="YouTube">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                            </svg>
                        </span>
                    <?php endif; ?>

                    <?php if(!empty($socialLinks['tiktok'])): ?>
                        <a href="<?php echo e($socialLinks['tiktok']); ?>" target="_blank" rel="noopener noreferrer" class="text-white transition-colors duration-300 hover:text-black transform hover:scale-110" aria-label="TikTok">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z" />
                            </svg>
                        </a>
                    <?php else: ?>
                        <span class="text-white transition-colors duration-300 cursor-default" aria-label="TikTok">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z" />
                            </svg>
                        </span>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Menu Cepat -->
            <div>
                <h3 class="text-sm sm:text-xl font-bold mb-4">Menu Cepat</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="<?php echo e(route('web.home')); ?>"
                            class="inline-block text-xs sm:text-sm md:text-base text-gray-200 hover:text-white transition-all duration-200 pb-1 hover:border-b-2 hover:border-white border-b-2 border-transparent">
                            Beranda
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('web.about')); ?>"
                            class="inline-block text-xs sm:text-sm md:text-base text-gray-200 hover:text-white transition-all duration-200 pb-1 hover:border-b-2 hover:border-white border-b-2 border-transparent">
                            Tentang Sekolah
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('web.news')); ?>"
                            class="inline-block text-xs sm:text-sm md:text-base text-gray-200 hover:text-white transition-all duration-200 pb-1 hover:border-b-2 hover:border-white border-b-2 border-transparent">
                            Berita Terbaru
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('web.announcement')); ?>"
                            class="inline-block text-xs sm:text-sm md:text-base text-gray-200 hover:text-white transition-all duration-200 pb-1 hover:border-b-2 hover:border-white border-b-2 border-transparent">
                            Pengumuman
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('web.contact')); ?>"
                            class="inline-block text-xs sm:text-sm md:text-base text-gray-200 hover:text-white transition-all duration-200 pb-1 hover:border-b-2 hover:border-white border-b-2 border-transparent">
                            Hubungi Kami
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Layanan Publik -->
            <div>
                <h3 class="text-sm sm:text-xl font-bold mb-4">Layanan Publik</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="/news"
                            class="inline-block text-xs sm:text-sm md:text-base text-gray-200 hover:text-white transition-all duration-200 pb-1 hover:border-b-2 hover:border-white border-b-2 border-transparent">
                            Berita
                        </a>
                    </li>
                    <li>
                        <a href="/article"
                            class="inline-block text-xs sm:text-sm md:text-base text-gray-200 hover:text-white transition-all duration-200 pb-1 hover:border-b-2 hover:border-white border-b-2 border-transparent">
                            Artikel
                        </a>
                    </li>
                    <li>
                        <a href="/announcement"
                            class="inline-block text-xs sm:text-sm md:text-base text-gray-200 hover:text-white transition-all duration-200 pb-1 hover:border-b-2 hover:border-white border-b-2 border-transparent">
                            Pengumuman
                        </a>
                    </li>
                    <li>
                        <a href="/agenda"
                            class="inline-block text-xs sm:text-sm md:text-base text-gray-200 hover:text-white transition-all duration-200 pb-1 hover:border-b-2 hover:border-white border-b-2 border-transparent">
                            Agenda
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('web.spmb')); ?>"
                            class="inline-block text-xs sm:text-sm md:text-base text-gray-200 hover:text-white transition-all duration-200 pb-1 hover:border-b-2 hover:border-white border-b-2 border-transparent">
                            SPMB/PPDB
                        </a>
                    </li>
                    <li>
                        <a href="/contact"
                            class="inline-block text-xs sm:text-sm md:text-base text-gray-200 hover:text-white transition-all duration-200 pb-1 hover:border-b-2 hover:border-white border-b-2 border-transparent">
                            Kontak
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Kontak -->
            <div>
                <h3 class="text-sm sm:text-xl font-bold mb-4">Kontak</h3>

                <!-- Footer Search -->
                <div id="footer-search-container" class="relative mb-4">
                    <form action="<?php echo e(route('web.search')); ?>" method="GET" class="relative">
                        <input type="text" id="footer-search-input" name="q" placeholder="Cari ..."
                            class="w-full px-3 py-1.5 text-xs sm:text-sm text-gray-900 bg-white border border-gray-300 focus:outline-none focus:border-green-500 rounded-none placeholder-gray-500"
                            autocomplete="off">
                    </form>
                </div>

                <ul class="space-y-3">
                    <li class="flex items-start gap-2">
                        <div class="h-6 w-5 sm:w-6 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 scale-75" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M20.52 3.48A11.9 11.9 0 0 0 12.04 0C5.43 0 0 5.43 0 12.04c0 2.12.55 4.2 1.6 6.03L0 24l6.13-1.6a11.95 11.95 0 0 0 5.91 1.5h.01C18.67 23.9 24 18.57 24 11.96c0-3.2-1.24-6.2-3.48-8.48zM12.05 21.7h-.01a9.9 9.9 0 0 1-5.05-1.38l-.36-.21-3.64.95.97-3.55-.23-.37A9.9 9.9 0 1 1 12.05 21.7zm5.76-7.38c-.31-.15-1.82-.9-2.1-1-.28-.1-.48-.15-.68.15-.2.3-.78 1-.95 1.2-.17.2-.35.22-.66.07-.31-.15-1.3-.48-2.48-1.53-.92-.82-1.54-1.83-1.72-2.14-.18-.31-.02-.48.13-.63.14-.14.31-.35.46-.53.15-.18.2-.31.31-.51.1-.2.05-.38-.03-.53-.08-.15-.68-1.64-.93-2.25-.24-.58-.49-.5-.68-.51h-.58c-.2 0-.53.08-.8.38-.27.3-1.06 1.03-1.06 2.5 0 1.47 1.09 2.9 1.24 3.1.15.2 2.14 3.27 5.18 4.58.72.31 1.28.5 1.72.64.72.23 1.38.2 1.9.12.58-.09 1.82-.74 2.08-1.46.26-.72.26-1.34.18-1.46-.08-.12-.28-.2-.58-.35z"/>
                            </svg>
                        </div>
                        <?php if($kontak?->whatsapp): ?>
                            <?php
                                $waNumber = preg_replace('/[^0-9]/', '', $kontak->whatsapp);
                                if (str_starts_with($waNumber, '0')) {
                                    $waNumber = '62' . substr($waNumber, 1);
                                }
                            ?>
                            <a href="https://wa.me/<?php echo e($waNumber); ?>" target="_blank" rel="noopener noreferrer" class="inline-block text-xs sm:text-sm md:text-base text-gray-200 hover:text-white transition-colors leading-relaxed">
                                <?php echo e($kontak->whatsapp); ?>

                            </a>
                        <?php else: ?>
                            <span class="inline-block text-xs sm:text-sm md:text-base text-gray-200 leading-relaxed">Belum ada</span>
                        <?php endif; ?>
                    </li>
                    <li class="flex items-start gap-2">
                        <div class="h-6 w-5 sm:w-6 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 scale-90"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <?php if($kontak?->alamat): ?>
                            <span class="inline-block text-xs sm:text-sm md:text-base text-gray-200 leading-relaxed"><?php echo e(trim($kontak->alamat)); ?></span>
                        <?php else: ?>
                            <span class="inline-block text-xs sm:text-sm md:text-base text-gray-200 leading-relaxed">Belum ada</span>
                        <?php endif; ?>
                    </li>
                    <li class="flex items-start gap-2">
                        <div class="h-6 w-5 sm:w-6 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 scale-90"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <?php if($kontak?->telepon): ?>
                            <a href="tel:<?php echo e(preg_replace('/[^0-9+]/', '', $kontak->telepon)); ?>" class="inline-block text-xs sm:text-sm md:text-base text-gray-200 hover:text-white transition-colors leading-relaxed">
                                <?php echo e($kontak->telepon); ?>

                            </a>
                        <?php else: ?>
                            <span class="inline-block text-xs sm:text-sm md:text-base text-gray-200 leading-relaxed">Belum ada</span>
                        <?php endif; ?>
                    </li>
                    <li class="flex items-start gap-2">
                        <div class="h-6 w-5 sm:w-6 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 scale-90"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <?php if($kontak?->email): ?>
                            <a href="mailto:<?php echo e($kontak->email); ?>" class="inline-block text-xs sm:text-sm md:text-base text-gray-200 hover:text-white transition-colors leading-relaxed">
                                <?php echo e($kontak->email); ?>

                            </a>
                        <?php else: ?>
                            <span class="inline-block text-xs sm:text-sm md:text-base text-gray-200 leading-relaxed">Belum ada</span>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="w-full mt-8 pt-6 pb-2">
        <p class="text-xs sm:text-sm md:text-base text-gray-200 text-center">
            Copyright © <?php echo e($namaSekolah); ?>

        </p>
    </div>
</footer>
<?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/website/components/layout/footer.blade.php ENDPATH**/ ?>
<!-- Kategori Menu Informasi -->
<div>
    <div>
        <?php if (isset($component)) { $__componentOriginal6a101a87b680dc09f4f04cda5e74cfd1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6a101a87b680dc09f4f04cda5e74cfd1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'website.components.layout.page-title','data' => ['title' => 'Kategori','tag' => 'h3','margin' => 'mb-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('website.components.layout.page-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Kategori','tag' => 'h3','margin' => 'mb-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6a101a87b680dc09f4f04cda5e74cfd1)): ?>
<?php $attributes = $__attributesOriginal6a101a87b680dc09f4f04cda5e74cfd1; ?>
<?php unset($__attributesOriginal6a101a87b680dc09f4f04cda5e74cfd1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6a101a87b680dc09f4f04cda5e74cfd1)): ?>
<?php $component = $__componentOriginal6a101a87b680dc09f4f04cda5e74cfd1; ?>
<?php unset($__componentOriginal6a101a87b680dc09f4f04cda5e74cfd1); ?>
<?php endif; ?>

        <div class="flex flex-col gap-1">
            <a href="/news"
                class="flex items-center justify-between py-2 border-b border-gray-100 hover:text-green-700 transition-all duration-300 group">
                <div class="flex items-center gap-2">
                    <span class="text-green-700 group-hover:translate-x-1 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 sm:h-4 sm:w-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                        </svg>
                    </span>
                    <span
                        class="font-semibold text-[11px] sm:text-[16px] text-black group-hover:text-green-700 transition-colors">
                        Berita
                    </span>
                </div>
            </a>

            <a href="/article"
                class="flex items-center justify-between py-2 border-b border-gray-100 hover:text-green-700 transition-all duration-300 group">
                <div class="flex items-center gap-2">
                    <span class="text-green-700 group-hover:translate-x-1 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 sm:h-4 sm:w-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                        </svg>
                    </span>
                    <span
                        class="font-semibold text-[11px] sm:text-[16px] text-black group-hover:text-green-700 transition-colors">
                        Artikel
                    </span>
                </div>
            </a>

            <a href="/announcement"
                class="flex items-center justify-between py-2 border-b border-gray-100 hover:text-green-700 transition-all duration-300 group">
                <div class="flex items-center gap-2">
                    <span class="text-green-700 group-hover:translate-x-1 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 sm:h-4 sm:w-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                        </svg>
                    </span>
                    <span
                        class="font-semibold text-[11px] sm:text-[16px] text-black group-hover:text-green-700 transition-colors">
                        Pengumuman
                    </span>
                </div>
            </a>

            <a href="/agenda"
                class="flex items-center justify-between py-2 border-b border-gray-100 hover:text-green-700 transition-all duration-300 group">
                <div class="flex items-center gap-2">
                    <span class="text-green-700 group-hover:translate-x-1 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 sm:h-4 sm:w-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                        </svg>
                    </span>
                    <span
                        class="font-semibold text-[11px] sm:text-[16px] text-black group-hover:text-green-700 transition-colors">
                        Agenda
                    </span>
                </div>
            </a>

            <a href="/achievement"
                class="flex items-center justify-between py-2 border-b border-gray-100 last:border-0 hover:text-green-700 transition-all duration-300 group">
                <div class="flex items-center gap-2">
                    <span class="text-green-700 group-hover:translate-x-1 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 sm:h-4 sm:w-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                        </svg>
                    </span>
                    <span
                        class="font-semibold text-[11px] sm:text-[16px] text-black group-hover:text-green-700 transition-colors">
                        Prestasi Siswa
                    </span>
                </div>
            </a>
        </div>
    </div>
</div><?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/website/components/content/category-widget.blade.php ENDPATH**/ ?>
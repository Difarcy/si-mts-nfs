<div class="animate-on-scroll">
    <?php if (isset($component)) { $__componentOriginal6a101a87b680dc09f4f04cda5e74cfd1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6a101a87b680dc09f4f04cda5e74cfd1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'website.components.layout.page-title','data' => ['title' => 'Berita Terbaru','margin' => 'mb-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('website.components.layout.page-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Berita Terbaru','margin' => 'mb-4']); ?>
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
    <?php
        $newsItems = $latestNews ?? collect();
        $fallbackImages = ['img/banner1.jpg', 'img/banner2.jpg', 'img/banner3.jpg'];
    ?>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5 lg:gap-6">
        <?php $__empty_1 = true; $__currentLoopData = $newsItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php
                $image = $item->thumbnail
                    ? asset('storage/' . $item->thumbnail)
                    : asset($fallbackImages[$index % count($fallbackImages)]);

                $dateObj = $item->tanggal_publikasi ?? now();
                $date = \Carbon\Carbon::parse($dateObj)->translatedFormat('d F Y');
                $time = \Carbon\Carbon::parse($dateObj)->format('H:i');

                // Buat ringkasan dari deskripsi
                $excerpt = Str::limit(strip_tags($item->deskripsi), 120);
            ?>
            <article
                class="bg-white shadow-sm overflow-hidden border border-gray-100 hover:shadow-lg transition-all duration-300 group flex flex-col">
                <a href="<?php echo e(route('web.news.detail', $item->id)); ?>" class="w-full block">
                    <img src="<?php echo e($image); ?>" alt="<?php echo e($item->judul); ?>"
                        class="w-full aspect-video object-cover js-img-fallback" loading="lazy"
                        data-fallback-src="<?php echo e(asset('images/background/default-backgrounds.png')); ?>">
                </a>
                <div class="w-full p-4 flex flex-col grow">
                    <h3
                        class="text-sm sm:text-lg md:text-xl font-bold text-gray-900 mb-1 line-clamp-2 hover:text-green-700 transition-colors font-roboto-slab">
                        <a href="<?php echo e(route('web.news.detail', $item->id)); ?>" class="hover:text-green-700 transition-colors">
                            <?php echo e($item->judul); ?>

                        </a>
                    </h3>
                    <a href="<?php echo e(route('web.news.detail', $item->id)); ?>"
                        class="text-xs sm:text-base text-slate-900 line-clamp-2 mb-3 grow text-justify font-lato hover:text-black transition-colors">
                        <?php echo e($excerpt); ?>

                    </a>
                    <div class="mt-auto flex items-center justify-between">
                        <p class="text-xs sm:text-sm text-slate-900 font-lato">
                            <span class="inline-flex items-center gap-2">
                                <span><?php echo e($date); ?></span>
                                <span aria-hidden="true"
                                    style="display:inline-block;width:1px;height:10px;background:rgba(0,0,0,1);vertical-align:middle;"></span>
                                <span><?php echo e($time); ?></span>
                            </span>
                        </p>
                        <a href="<?php echo e(route('web.news.detail', $item->id)); ?>"
                            class="inline-flex items-center gap-1.5 text-green-700 hover:text-green-800 font-bold text-sm transition-colors duration-300 group">
                            Baca Berita
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-3 w-3 sm:h-4 sm:w-4 group-hover:translate-x-1 transition-transform duration-300"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </article>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-full flex items-center justify-center min-h-150">
                <p class="text-[11px] sm:text-base font-semibold text-slate-900 text-center tracking-wider">
                    Belum Ada Berita
                </p>
            </div>
        <?php endif; ?>
    </div>
    <div class="mt-6 text-center">
        <a href="/news"
            class="inline-flex items-center gap-2 text-green-700 hover:text-green-800 font-semibold text-[10px] sm:text-sm transition-colors duration-300 group">
            Lihat Semua Berita
            <svg xmlns="http://www.w3.org/2000/svg"
                class="h-3 w-3 sm:h-4 sm:w-4 group-hover:translate-x-1 transition-transform duration-300" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </a>
    </div>
</div><?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/website/pages/home/sections/latest-news.blade.php ENDPATH**/ ?>
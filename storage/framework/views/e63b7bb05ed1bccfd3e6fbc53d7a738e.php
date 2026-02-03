<div class="animate-on-scroll">
    <?php if (isset($component)) { $__componentOriginal6a101a87b680dc09f4f04cda5e74cfd1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6a101a87b680dc09f4f04cda5e74cfd1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'website.components.layout.page-title','data' => ['title' => 'Artikel Terbaru','margin' => 'mb-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('website.components.layout.page-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Artikel Terbaru','margin' => 'mb-4']); ?>
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
        $articleItems = ($latestArticles ?? collect())->take(4);
        $fallbackImages = ['img/banner1.jpg', 'img/banner2.jpg', 'img/banner3.jpg'];
    ?>
    <div class="space-y-4 min-h-100">
        <?php $__empty_1 = true; $__currentLoopData = $articleItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php
                $image = $item->thumbnail
                    ? asset('storage/' . $item->thumbnail)
                    : asset($fallbackImages[($index + 1) % count($fallbackImages)]);
                $dateObj = $item->tanggal_publikasi ?? $item->created_at;
                $date = $dateObj->translatedFormat('d F Y');
                $time = $dateObj->format('H:i');
                $excerpt = Str::limit(strip_tags($item->deskripsi), 120);
            ?>
            <article
                class="bg-white shadow-sm overflow-hidden border border-gray-100 hover:shadow-lg transition-all duration-300 flex flex-col sm:flex-row group">
                <a href="<?php echo e(route('web.article.detail', $item->id)); ?>" class="relative w-full sm:w-[38%] shrink-0">
                    <div class="w-full aspect-video bg-gray-50 overflow-hidden">
                        <img src="<?php echo e($image); ?>" alt="<?php echo e($item->judul); ?>" class="w-full h-full object-cover js-img-fallback"
                            loading="lazy" data-fallback-src="<?php echo e(asset('images/background/default-backgrounds.png')); ?>">
                    </div>
                </a>
                <div class="w-full sm:w-[62%] p-2 sm:p-2.5 flex flex-col justify-between">
                    <div>
                        <h3
                            class="text-sm sm:text-xl font-bold text-gray-900 mb-0.5 line-clamp-2 hover:text-green-700 transition-colors font-roboto-slab">
                            <a href="<?php echo e(route('web.article.detail', $item->id)); ?>"
                                class="hover:text-green-700 transition-colors">
                                <?php echo e($item->judul); ?>

                            </a>
                        </h3>
                        <a href="<?php echo e(route('web.article.detail', $item->id)); ?>"
                            class="text-xs sm:text-base text-slate-900 line-clamp-2 mb-1 text-justify font-lato hover:text-black transition-colors block">
                            <?php echo e($excerpt); ?>

                        </a>
                    </div>
                    <div class="flex items-center justify-between mt-auto">
                        <p class="text-xs sm:text-sm text-slate-900 font-lato">
                            <span class="inline-flex items-center gap-2">
                                <span><?php echo e($date); ?></span>
                                <span aria-hidden="true"
                                    style="display:inline-block;width:1px;height:10px;background:rgba(0,0,0,1);vertical-align:middle;"></span>
                                <span><?php echo e($time); ?></span>
                            </span>
                        </p>
                        <a href="<?php echo e(route('web.article.detail', $item->id)); ?>"
                            class="inline-flex items-center gap-1.5 text-green-700 hover:text-green-800 font-bold text-xs sm:text-sm transition-colors duration-300 group">
                            Baca Artikel
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
            <div class="flex items-center justify-center min-h-150">
                <p class="text-[11px] sm:text-base font-semibold text-slate-900 text-center tracking-wider">
                    Belum Ada Artikel
                </p>
            </div>
        <?php endif; ?>
    </div>
    <div class="mt-6 text-center">
        <a href="/article"
            class="inline-flex items-center gap-2 text-green-700 hover:text-green-800 font-semibold text-[10px] sm:text-sm transition-colors duration-300 group">
            Lihat Semua Artikel
            <svg xmlns="http://www.w3.org/2000/svg"
                class="h-3 w-3 sm:h-4 sm:w-4 group-hover:translate-x-1 transition-transform duration-300" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </a>
    </div>
</div><?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/website/pages/home/sections/latest-articles.blade.php ENDPATH**/ ?>
<!-- Highlight News Slider -->
<div class="animate-on-scroll">
    <div class="relative overflow-hidden group" id="highlight-slider" data-interval-ms="4000">
        <div class="highlight-slides flex transition-transform duration-500 ease-in-out" id="highlight-slides">
            <?php if(isset($highlightNews) && $highlightNews->count() > 0): ?>
                <?php $__currentLoopData = $highlightNews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $fallbackImages = ['img/banner1.jpg', 'img/banner2.jpg', 'img/banner3.jpg'];
                        $image = $news->thumbnail
                            ? asset('storage/' . $news->thumbnail)
                            : asset($fallbackImages[$index % count($fallbackImages)]);
                        $dateObj = $news->tanggal_publikasi;
                        $date = $dateObj ? $dateObj->translatedFormat('d F Y') : '-';
                        $time = $dateObj ? $dateObj->format('H:i') : '-';
                    ?>
                    <a href="<?php echo e(route('web.news.detail', $news->id)); ?>" class="highlight-slide shrink-0 w-full relative block">
                        <img src="<?php echo e($image); ?>" alt="<?php echo e($news->judul); ?>"
                            class="w-full h-72 sm:h-80 md:h-96 lg:h-112 object-cover js-img-fallback" loading="lazy"
                            data-fallback-src="<?php echo e(asset('images/background/default-backgrounds.png')); ?>">
                        <div class="absolute inset-0 bg-linear-to-t from-black/70 via-black/20 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-4 sm:p-6 text-white">
                            <h3 class="text-lg sm:text-xl md:text-2xl font-bold mb-2 line-clamp-2 drop-shadow-lg font-roboto-slab">
                                <?php echo e($news->judul); ?>

                            </h3>
                            <p class="text-sm sm:text-base opacity-90 drop-shadow-md mt-2 font-lato">
                                <span class="inline-flex items-center gap-2">
                                    <span><?php echo e($date); ?></span>
                                    <span aria-hidden="true" style="display:inline-block;width:1px;height:10px;background:rgba(255,255,255,.7);vertical-align:middle;"></span>
                                    <span><?php echo e($time); ?></span>
                                </span>
                            </p>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <div class="highlight-slide shrink-0 w-full relative">
                    <div class="w-full h-72 sm:h-80 md:h-96 lg:h-112 bg-gray-100 flex items-center justify-center">
                        <p class="text-[11px] sm:text-base font-semibold text-slate-900 text-center tracking-wider">
                            Belum Ada Highlight
                        </p>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Navigation Arrows -->
        <?php if(isset($highlightNews) && $highlightNews->count() > 1): ?>
            <button
                class="absolute left-4 top-1/2 -translate-y-1/2 w-8 h-8 sm:w-10 sm:h-10 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center text-white transition-all duration-200 backdrop-blur-sm opacity-0 group-hover:opacity-100"
                id="highlight-prev">
                <svg class="w-4 h-4 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            <button
                class="absolute right-4 top-1/2 -translate-y-1/2 w-8 h-8 sm:w-10 sm:h-10 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center text-white transition-all duration-200 backdrop-blur-sm opacity-0 group-hover:opacity-100"
                id="highlight-next">
                <svg class="w-4 h-4 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        <?php endif; ?>

        <!-- Indicators -->
        <?php if(isset($highlightNews) && $highlightNews->count() > 1): ?>
            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex space-x-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300"
                id="highlight-indicators">
                <?php for($i = 0; $i < $highlightNews->count(); $i++): ?>
                    <button
                        class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-white/50 hover:bg-white/80 transition-all duration-200 <?php echo e($i === 0 ? 'bg-white' : ''); ?>"
                        data-slide="<?php echo e($i); ?>"></button>
                <?php endfor; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/website/pages/home/sections/highlight-news.blade.php ENDPATH**/ ?>
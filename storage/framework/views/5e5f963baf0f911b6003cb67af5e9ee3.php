<?php
    $hasTicker = isset($tickerItems) && $tickerItems->count() > 0;
    $shouldAnimate = $hasTicker;
?>

<!-- Info Bar -->
<section class="bg-gray-50 my-4 sm:my-6">
    <div class="container mx-auto px-4">
        <div class="flex items-stretch border-y border-gray-200">

            <!-- 1. Kotak Tanggal -->
            <div class="flex items-center bg-green-800 text-white px-3 py-2 sm:px-5 shrink-0">
                <span id="current-date"
                    class="text-[8px] sm:text-sm font-bold whitespace-nowrap tracking-wide uppercase font-lato"></span>
            </div>

            <!-- 2. Kotak Ticker (Meluas) -->
            <div class="flex-1 overflow-hidden bg-white flex items-center px-4 relative">
                <div class="w-full overflow-hidden whitespace-nowrap flex items-center">
                    <?php if($shouldAnimate): ?>
                        <div class="inline-flex animate-marquee will-change-transform">
                            <!-- Original Content -->
                            <div class="flex items-center whitespace-nowrap shrink-0">
                                <?php $__currentLoopData = $tickerItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span class="text-black text-[10px] sm:text-sm font-bold font-jakarta"><?php echo e($item); ?></span>
                                    <span class="mx-6 text-green-500 text-[10px] sm:text-xs">•</span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <!-- Duplicate Content -->
                            <div class="flex items-center whitespace-nowrap shrink-0">
                                <?php $__currentLoopData = $tickerItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span class="text-black text-[10px] sm:text-sm font-bold font-jakarta"><?php echo e($item); ?></span>
                                    <span class="mx-6 text-green-500 text-[10px] sm:text-xs">•</span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="w-full flex items-center justify-center text-slate-900 text-[10px] sm:text-sm italic">
                            Tidak ada informasi terbaru
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- 3. Kotak Waktu -->
            <div class="flex items-center bg-green-800 text-white px-3 py-2 sm:px-5 shrink-0">
                <span id="current-time"
                    class="text-[8px] sm:text-sm font-bold whitespace-nowrap tracking-wider font-lato"></span>
            </div>

        </div>
    </div>
</section>
<?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/website/pages/home/sections/info-ticker.blade.php ENDPATH**/ ?>
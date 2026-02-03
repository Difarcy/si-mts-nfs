<?php
    // Ambil banner dari parameter yang dikirim controller
    $dbBanners = isset($banners) && $banners->count() > 0 ? $banners : collect();

    // Siapkan array gambar untuk slider
    $slideImages = [];

    // Jika ada banner dari DB, gunakan; jika tidak, gunakan default background
    if ($dbBanners->count() > 0) {
        $slideImages = $dbBanners->filter(function ($banner) {
            return $banner->is_active && $banner->path;
        })->sortBy('urutan')->values()->map(function ($banner) {
            $bannerUpdatedAt = time(); // No timestamps in DB, use current time or handle cache busting differently if needed
            $imagePath = 'storage/' . $banner->path;
            $imageUrl = asset('storage/' . $banner->path);

            return [
                'image' => $imageUrl,
                'image_path' => $imagePath,
                'image_version' => $bannerUpdatedAt,
            ];
        })->toArray();
    }
?>

<?php if(empty($slideImages)): ?>
    <!-- Jika tidak ada banner, gunakan default background -->
    <div class="absolute inset-0 z-10">
        <img src="<?php echo e(asset('images/background/default-backgrounds.png')); ?><?php if(file_exists(public_path('images/background/default-backgrounds.png'))): ?>?v=<?php echo e(filemtime(public_path('images/background/default-backgrounds.png'))); ?><?php endif; ?>"
            alt="Banner Default" class="w-full h-full object-cover" loading="lazy" decoding="async">
        <div class="absolute inset-0 bg-linear-to-b from-black/20 to-black/65">
        </div>
    </div>
<?php else: ?>
    <!-- Hanya gambar yang di-slide -->
    <?php $__currentLoopData = $slideImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $slideImage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $imagePath = $slideImage['image_path'] ?? '';
            $imageExists = $imagePath && file_exists(public_path($imagePath));
            if (isset($slideImage['image_version']) && $imageExists) {
                $imageSrc = asset($imagePath) . '?v=' . $slideImage['image_version'];
            } elseif ($imageExists) {
                $imageVersion = filemtime(public_path($imagePath));
                $imageSrc = asset($imagePath) . ($imageVersion ? '?v=' . $imageVersion : '');
            } else {
                $imageSrc = asset('images/background/default-backgrounds.png');
            }
        ?>
        <div class="absolute inset-0 transition-transform duration-1000 ease-in-out transform bg-slate-900 <?php echo e($index === 0 ? 'z-10' : 'z-0'); ?>"
            data-banner-slide data-slide-index="<?php echo e($index); ?>" style="transform: translateX(<?php echo e($index === 0 ? '0' : '100'); ?>%);">
            <img src="<?php echo e($imageSrc); ?>" alt="Banner <?php echo e($index + 1); ?>"
                class="w-full h-full object-cover bg-slate-800 js-img-fallback"
                data-fallback-src="<?php echo e(asset('images/background/default-backgrounds.png')); ?>">
            <div class="absolute inset-0 bg-linear-to-b from-black/20 to-black/65">
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <!-- Indicators -->
    <div class="flex absolute bottom-8 left-1/2 -translate-x-1/2 items-center gap-3 z-40 px-4 py-2 pointer-events-auto opacity-0 invisible transition-all duration-300 ease-out group-hover:opacity-100 group-hover:visible"
        data-banner-indicators>
        <?php $__currentLoopData = $slideImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $slideImage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <button type="button"
                class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full cursor-pointer transition-all duration-300 ease-in-out shrink-0 <?php echo e($index === 0 ? 'bg-white' : 'bg-white/50 hover:bg-white/80'); ?>"
                data-banner-dot data-slide-target="<?php echo e($index); ?>" aria-label="Pilih slide <?php echo e($index + 1); ?>"></button>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>
<?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/website/pages/home/sections/banner.blade.php ENDPATH**/ ?>
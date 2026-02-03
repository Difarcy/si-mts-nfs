<div class="animate-on-scroll">
    <?php if (isset($component)) { $__componentOriginal6a101a87b680dc09f4f04cda5e74cfd1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6a101a87b680dc09f4f04cda5e74cfd1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'website.components.layout.page-title','data' => ['title' => 'Video Kegiatan','margin' => 'mb-6']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('website.components.layout.page-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Video Kegiatan','margin' => 'mb-6']); ?>
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
    <?php if(isset($videoKegiatan) && $videoKegiatan->count() > 0): ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <?php $__currentLoopData = $videoKegiatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="relative aspect-video overflow-hidden rounded-lg shadow-sm group cursor-pointer"
                    data-video-preview
                    data-video-youtube-id="<?php echo e($video->youtube_id); ?>"
                    data-video-thumb="<?php echo e($video->youtube_thumbnail_url); ?>"
                    data-video-link="<?php echo e($video->link); ?>">

                    <div class="absolute inset-0" data-video-preview-media>
                        <?php if($video->youtube_thumbnail_url): ?>
                            <img src="<?php echo e($video->youtube_thumbnail_url); ?>" alt="Thumbnail" class="w-full h-full object-cover">
                        <?php else: ?>
                            <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                            </div>
                        <?php endif; ?>

                        
                        <div class="absolute inset-0 flex items-center justify-center pointer-events-none z-10 transition-opacity duration-300" data-play-button>
                            <svg class="w-12 h-12 sm:w-16 sm:h-16 drop-shadow-lg transition-transform duration-300 group-hover:scale-110" viewBox="0 0 68 48" version="1.1">
                                <path class="text-[#FF0000] opacity-90 group-hover:opacity-100 transition-opacity duration-300" fill="currentColor" d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z"></path>
                                <path fill="#FFFFFF" d="M 45,24 27,14 27,34"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <div class="flex items-center justify-center py-12 min-h-80">
            <p class="text-[11px] sm:text-base font-semibold text-slate-900 text-center tracking-wider">Belum Ada Video
                Kegiatan</p>
        </div>
    <?php endif; ?>
    <div class="mt-4 text-center">
        <a href="/video"
            class="inline-flex items-center gap-2 text-green-700 hover:text-green-800 font-semibold text-[10px] sm:text-sm transition-colors duration-300 group">
            Lihat Semua Video
            <svg xmlns="http://www.w3.org/2000/svg"
                class="h-4 w-4 group-hover:translate-x-1 transition-transform duration-300" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </a>
    </div>
</div>
<?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/website/pages/home/sections/activity-video.blade.php ENDPATH**/ ?>
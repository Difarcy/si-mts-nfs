<!-- Media Sosial -->
<div>
    <div class="space-y-4">
        <?php if (isset($component)) { $__componentOriginal6a101a87b680dc09f4f04cda5e74cfd1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6a101a87b680dc09f4f04cda5e74cfd1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'website.components.layout.page-title','data' => ['title' => 'Media Sosial','tag' => 'h3','margin' => 'mb-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('website.components.layout.page-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Media Sosial','tag' => 'h3','margin' => 'mb-4']); ?>
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
            <!-- Facebook -->
            <?php if(!empty($socialLinks['facebook'])): ?>
                <a href="<?php echo e($socialLinks['facebook']); ?>" target="_blank" rel="noopener noreferrer"
                    class="flex items-center justify-between py-2 border-b border-gray-100 transition-all duration-300 group hover:text-blue-700">
            <?php else: ?>
                <div class="flex items-center justify-between py-2 border-b border-gray-100 transition-all duration-300 cursor-default">
            <?php endif; ?>
                <div class="flex items-center gap-3">
                    <div class="text-blue-600 group-hover:scale-110 transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                        </svg>
                    </div>
                    <span
                        class="font-semibold text-[11px] sm:text-base text-black group-hover:text-current">Facebook</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-3 w-3 sm:h-4 sm:w-4 text-gray-400 group-hover:text-blue-500 group-hover:translate-x-1 transition-transform"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            <?php if(!empty($socialLinks['facebook'])): ?>
                </a>
            <?php else: ?>
                </div>
            <?php endif; ?>

            <!-- Instagram -->
            <?php if(!empty($socialLinks['instagram'])): ?>
                <a href="<?php echo e($socialLinks['instagram']); ?>" target="_blank" rel="noopener noreferrer"
                    class="flex items-center justify-between py-2 border-b border-gray-100 transition-all duration-300 group hover:text-pink-700">
            <?php else: ?>
                <div class="flex items-center justify-between py-2 border-b border-gray-100 transition-all duration-300 cursor-default">
            <?php endif; ?>
                <div class="flex items-center gap-3">
                    <div class="text-pink-600 group-hover:scale-110 transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M7.5 2h9A5.5 5.5 0 0 1 22 7.5v9A5.5 5.5 0 0 1 16.5 22h-9A5.5 5.5 0 0 1 2 16.5v-9A5.5 5.5 0 0 1 7.5 2zM7.5 4A3.5 3.5 0 0 0 4 7.5v9A3.5 3.5 0 0 0 7.5 20h9A3.5 3.5 0 0 0 20 16.5v-9A3.5 3.5 0 0 0 16.5 4h-9z" />
                            <path d="M12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10zm0 2a3 3 0 1 0 0 6 3 3 0 0 0 0-6z" />
                            <path d="M17 6.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                        </svg>
                    </div>
                    <span
                        class="font-semibold text-[11px] sm:text-base text-black group-hover:text-current">Instagram</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-3 w-3 sm:h-4 sm:w-4 text-gray-400 group-hover:text-pink-500 group-hover:translate-x-1 transition-transform"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            <?php if(!empty($socialLinks['instagram'])): ?>
                </a>
            <?php else: ?>
                </div>
            <?php endif; ?>

            <!-- X (Twitter) -->
            <?php if(!empty($socialLinks['x'])): ?>
                <a href="<?php echo e($socialLinks['x']); ?>" target="_blank" rel="noopener noreferrer"
                    class="flex items-center justify-between py-2 border-b border-gray-100 transition-all duration-300 group hover:text-black">
            <?php else: ?>
                <div class="flex items-center justify-between py-2 border-b border-gray-100 transition-all duration-300 cursor-default">
            <?php endif; ?>
                <div class="flex items-center gap-3">
                    <div class="text-gray-900 group-hover:scale-110 transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                        </svg>
                    </div>
                    <span class="font-semibold text-[11px] sm:text-base text-black group-hover:text-current">X</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 text-gray-400 group-hover:text-gray-600 group-hover:translate-x-1 transition-transform"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            <?php if(!empty($socialLinks['x'])): ?>
                </a>
            <?php else: ?>
                </div>
            <?php endif; ?>

            <!-- YouTube -->
            <?php if(!empty($socialLinks['youtube'])): ?>
                <a href="<?php echo e($socialLinks['youtube']); ?>" target="_blank" rel="noopener noreferrer"
                    class="flex items-center justify-between py-2 border-b border-gray-100 transition-all duration-300 group hover:text-red-700">
            <?php else: ?>
                <div class="flex items-center justify-between py-2 border-b border-gray-100 transition-all duration-300 cursor-default">
            <?php endif; ?>
                <div class="flex items-center gap-3">
                    <div class="text-red-600 group-hover:scale-110 transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                        </svg>
                    </div>
                    <span
                        class="font-semibold text-[11px] sm:text-base text-black group-hover:text-current">YouTube</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-3 w-3 sm:h-4 sm:w-4 text-gray-400 group-hover:text-red-500 group-hover:translate-x-1 transition-transform"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            <?php if(!empty($socialLinks['youtube'])): ?>
                </a>
            <?php else: ?>
                </div>
            <?php endif; ?>

            <!-- TikTok -->
            <?php if(!empty($socialLinks['tiktok'])): ?>
                <a href="<?php echo e($socialLinks['tiktok']); ?>" target="_blank" rel="noopener noreferrer"
                    class="flex items-center justify-between py-2 border-b border-gray-100 last:border-0 transition-all duration-300 group hover:text-black">
            <?php else: ?>
                <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-0 transition-all duration-300 cursor-default">
            <?php endif; ?>
                <div class="flex items-center gap-3">
                    <div class="text-black group-hover:scale-110 transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z" />
                        </svg>
                    </div>
                    <span
                        class="font-semibold text-[11px] sm:text-base text-black group-hover:text-current">TikTok</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-3 w-3 sm:h-4 sm:w-4 text-gray-400 group-hover:text-gray-800 group-hover:translate-x-1 transition-transform"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            <?php if(!empty($socialLinks['tiktok'])): ?>
                </a>
            <?php else: ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/website/components/content/social-media-widget.blade.php ENDPATH**/ ?>
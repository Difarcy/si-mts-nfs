<div class="animate-on-scroll">
    <?php if (isset($component)) { $__componentOriginal6a101a87b680dc09f4f04cda5e74cfd1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6a101a87b680dc09f4f04cda5e74cfd1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'website.components.layout.page-title','data' => ['title' => 'Kegiatan Sekolah','margin' => 'mb-6']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('website.components.layout.page-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Kegiatan Sekolah','margin' => 'mb-6']); ?>
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
    <?php if(isset($fotoKegiatan) && $fotoKegiatan->count() > 0): ?>
        <?php
            $topRow = $fotoKegiatan->shuffle()->values();
            $bottomRow = $fotoKegiatan->shuffle()->values();

            $topRowItems = $topRow->concat($topRow);
            $bottomRowItems = $bottomRow->concat($bottomRow);

            $durationTop = 38;
            $durationBottom = 42;
            $delayTop = -1 * (rand(0, $durationTop * 100) / 100);
            $delayBottom = -1 * (rand(0, $durationBottom * 100) / 100);
        ?>
        <div class="space-y-3 overflow-hidden">
            <div class="relative w-full overflow-hidden">
                <div class="flex w-fit gap-3 animate-marquee" style="animation-duration: <?php echo e($durationTop); ?>s; animation-delay: <?php echo e($delayTop); ?>s;">
                    <?php $__currentLoopData = $topRowItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="w-75 h-50 shrink-0 overflow-hidden">
                            <img src="<?php echo e($item->gambar ? asset('storage/' . $item->gambar) : asset('images/background/default-backgrounds.png')); ?>"
                                alt="<?php echo e($item->judul ?? 'Foto Kegiatan'); ?>" class="w-full h-full object-cover">
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="relative w-full overflow-hidden">
                <div class="flex w-fit gap-3 animate-marquee-reverse" style="animation-duration: <?php echo e($durationBottom); ?>s; animation-delay: <?php echo e($delayBottom); ?>s;">
                    <?php $__currentLoopData = $bottomRowItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="w-75 h-50 shrink-0 overflow-hidden">
                            <img src="<?php echo e($item->gambar ? asset('storage/' . $item->gambar) : asset('images/background/default-backgrounds.png')); ?>"
                                alt="<?php echo e($item->judul ?? 'Foto Kegiatan'); ?>" class="w-full h-full object-cover">
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="flex items-center justify-center py-12 min-h-80">
            <p class="text-[11px] sm:text-base font-semibold text-slate-900 text-center tracking-wider">Belum Ada Foto
                Kegiatan</p>
        </div>
    <?php endif; ?>
    
    <?php if(isset($fotoKegiatan) && $fotoKegiatan->count() > 0): ?>
    <div class="mt-4 text-center">
        <a href="/foto"
            class="inline-flex items-center gap-2 text-green-700 hover:text-green-800 font-semibold text-[10px] sm:text-sm transition-colors duration-300 group">
            Lihat Semua
            <svg xmlns="http://www.w3.org/2000/svg"
                class="h-4 w-4 group-hover:translate-x-1 transition-transform duration-300" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </a>
    </div>
    <?php endif; ?>
</div>
<?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/website/pages/home/sections/activity-photo.blade.php ENDPATH**/ ?>
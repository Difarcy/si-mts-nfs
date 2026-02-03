<?php
    // Use widget data from View Composer or fallback to manually passed variable
    $agendaData = $agendaTerbaruWidget ?? ($agendaTerbaru ?? collect());
?>

<!-- Agenda Terbaru Widget -->
<div class="animate-on-scroll">
    <?php if (isset($component)) { $__componentOriginal6a101a87b680dc09f4f04cda5e74cfd1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6a101a87b680dc09f4f04cda5e74cfd1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'website.components.layout.page-title','data' => ['title' => 'Agenda Terbaru','tag' => 'h3','margin' => 'mb-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('website.components.layout.page-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Agenda Terbaru','tag' => 'h3','margin' => 'mb-4']); ?>
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

    <div class="space-y-4">
        <?php $__empty_1 = true; $__currentLoopData = $agendaData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php
                $startDate = \Carbon\Carbon::parse($item->tanggal_mulai);
            ?>
            <div class="pb-3 last:pb-0">
                <a href="<?php echo e(route('web.agenda.detail', $item->id)); ?>" class="block group">
                    <div class="flex items-start gap-3">
                        <div class="shrink-0 bg-green-700 text-white rounded-lg p-2 text-center min-w-[50px] w-12 h-12 flex flex-col items-center justify-center">
                            <div class="text-[10px] font-bold uppercase leading-none mb-0.5">
                                <?php echo e($startDate->translatedFormat('M')); ?>

                            </div>
                            <div class="text-lg font-bold leading-none"><?php echo e($startDate->format('d')); ?></div>
                        </div>
                        <div class="grow min-w-0">
                            <h4
                                class="text-base sm:text-lg font-bold text-black mb-1 line-clamp-2 group-hover:text-green-700 transition-colors font-roboto-slab leading-snug">
                                <?php echo e($item->judul); ?>

                            </h4>

                            <!-- Tanggal -->
                            <div class="flex items-center gap-1.5 mt-1 text-xs sm:text-sm text-slate-900 font-lato">
                                <svg class="w-3 h-3 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span>
                                    <?php echo e($startDate->translatedFormat('d F Y')); ?>

                                    <?php if($item->tanggal_selesai): ?>
                                        - <?php echo e(\Carbon\Carbon::parse($item->tanggal_selesai)->translatedFormat('d F Y')); ?>

                                    <?php endif; ?>
                                </span>
                            </div>

                            <!-- Waktu -->
                            <?php if($item->waktu_mulai): ?>
                                <?php
                                    $start = \Carbon\Carbon::parse($item->waktu_mulai)->format('H.i');
                                    $end = $item->waktu_selesai ? \Carbon\Carbon::parse($item->waktu_selesai)->format('H.i') : 'Selesai';
                                ?>
                                <div class="flex items-center gap-1.5 mt-1 text-xs sm:text-sm text-slate-900 font-lato">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span><?php echo e($start); ?> - <?php echo e($end); ?> WIB</span>
                                </div>
                            <?php endif; ?>

                            <!-- Lokasi -->
                            <?php if($item->lokasi): ?>
                                <div class="flex items-center gap-1.5 mt-1 text-xs sm:text-sm text-slate-900 font-lato truncate">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span class="truncate"><?php echo e($item->lokasi); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="flex items-center justify-center py-8">
                <p class="text-[11px] sm:text-base font-semibold text-slate-900 text-center tracking-wider">
                    Belum Ada Agenda
                </p>
            </div>
        <?php endif; ?>
    </div>

    <div class="mt-4 text-center">
        <a href="<?php echo e(route('web.agenda')); ?>"
            class="inline-flex items-center gap-1 text-green-700 hover:text-green-800 font-semibold text-[10px] sm:text-sm transition-colors duration-300 group">
            Selengkapnya
            <svg xmlns="http://www.w3.org/2000/svg"
                class="h-3 w-3 sm:h-4 sm:w-4 group-hover:translate-x-1 transition-transform duration-300" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </a>
    </div>
</div><?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/website/components/content/agenda-widget.blade.php ENDPATH**/ ?>
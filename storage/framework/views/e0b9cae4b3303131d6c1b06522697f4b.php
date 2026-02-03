<div class="animate-on-scroll">
    <?php if (isset($component)) { $__componentOriginal6a101a87b680dc09f4f04cda5e74cfd1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6a101a87b680dc09f4f04cda5e74cfd1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'website.components.layout.page-title','data' => ['title' => 'Prestasi Siswa','margin' => 'mb-6']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('website.components.layout.page-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Prestasi Siswa','margin' => 'mb-6']); ?>
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
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <?php if(isset($prestasiSiswa) && $prestasiSiswa->count() > 0): ?>
            <?php $__currentLoopData = $prestasiSiswa->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('web.achievement.detail', $item)); ?>"
                    class="group relative block w-full aspect-square overflow-hidden bg-gray-900">
                    <img src="<?php echo e($item->foto_siswa ? asset('storage/' . $item->foto_siswa) : asset('images/background/default-backgrounds.png')); ?>"
                        alt="<?php echo e($item->nama_lomba); ?>" class="absolute inset-0 w-full h-full object-cover" loading="lazy">
                    <div
                        class="absolute inset-0 bg-linear-to-t from-black/90 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                    <div
                        class="absolute inset-0 flex flex-col justify-end p-5 z-10 opacity-0 translate-y-8 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 ease-out">
                        <div class="mb-2">
                            <?php if (isset($component)) { $__componentOriginal6b5ddb037b928dc77d1a4991eb23c8f7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6b5ddb037b928dc77d1a4991eb23c8f7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'website.components.ui.badge','data' => ['variant' => strtolower($item->peringkat)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('website.components.ui.badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(strtolower($item->peringkat))]); ?>
                                <?php echo e($item->peringkat ?? 'Prestasi'); ?>

                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6b5ddb037b928dc77d1a4991eb23c8f7)): ?>
<?php $attributes = $__attributesOriginal6b5ddb037b928dc77d1a4991eb23c8f7; ?>
<?php unset($__attributesOriginal6b5ddb037b928dc77d1a4991eb23c8f7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6b5ddb037b928dc77d1a4991eb23c8f7)): ?>
<?php $component = $__componentOriginal6b5ddb037b928dc77d1a4991eb23c8f7; ?>
<?php unset($__componentOriginal6b5ddb037b928dc77d1a4991eb23c8f7); ?>
<?php endif; ?>
                        </div>
                        <h3
                            class="text-sm sm:text-lg font-bold leading-tight mb-1 line-clamp-2 drop-shadow-md text-white group-hover:text-green-400 transition-colors">
                            <?php echo e($item->nama_lomba); ?>

                        </h3>
                        <p class="text-[10px] sm:text-sm font-medium text-gray-200 truncate drop-shadow-sm">
                            <?php echo e($item->nama_siswa); ?> <?php echo e($item->kelas ? '(' . $item->kelas . ')' : ''); ?>

                        </p>
                    </div>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <div class="col-span-full flex items-center justify-center py-12">
                <p class="text-[11px] sm:text-base font-semibold text-slate-900 text-center tracking-wider">Belum Ada
                    Prestasi</p>
            </div>
        <?php endif; ?>
    </div>
    <div class="mt-6 text-center">
        <a href="<?php echo e(route('web.achievement')); ?>"
            class="inline-flex items-center gap-2 text-green-700 hover:text-green-800 font-semibold text-[10px] sm:text-sm transition-colors duration-300 group">
            Lihat Semua Prestasi
            <svg xmlns="http://www.w3.org/2000/svg"
                class="h-3 w-3 sm:h-4 sm:w-4 group-hover:translate-x-1 transition-transform duration-300" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </a>
    </div>
</div><?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/website/pages/home/sections/student-achievement.blade.php ENDPATH**/ ?>
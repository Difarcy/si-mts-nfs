<?php $__env->startSection('title', 'Tentang Sekolah'); ?>

<?php $__env->startSection('content'); ?>
    <div class="pt-4 sm:pt-6 space-y-6">
        <?php if (isset($component)) { $__componentOriginale44b0f5ba441cef716df532631fccc38 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale44b0f5ba441cef716df532631fccc38 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'website.components.layout.breadcrumb','data' => ['items' => [['label' => 'PROFIL'], ['label' => 'TENTANG SEKOLAH']]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('website.components.layout.breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([['label' => 'PROFIL'], ['label' => 'TENTANG SEKOLAH']])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale44b0f5ba441cef716df532631fccc38)): ?>
<?php $attributes = $__attributesOriginale44b0f5ba441cef716df532631fccc38; ?>
<?php unset($__attributesOriginale44b0f5ba441cef716df532631fccc38); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale44b0f5ba441cef716df532631fccc38)): ?>
<?php $component = $__componentOriginale44b0f5ba441cef716df532631fccc38; ?>
<?php unset($__componentOriginale44b0f5ba441cef716df532631fccc38); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal6a101a87b680dc09f4f04cda5e74cfd1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6a101a87b680dc09f4f04cda5e74cfd1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'website.components.layout.page-title','data' => ['title' => 'Tentang Sekolah']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('website.components.layout.page-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Tentang Sekolah']); ?>
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

        <article class="overflow-hidden w-full">
            <!-- Header Title -->
            <div class="text-center mb-12">
                <h2 class="text-xs sm:text-lg font-bold text-black font-roboto-slab leading-tight">
                    MTs Nurul Falaah Soreang
                </h2>
            </div>

            <!-- Full Width Image -->
            <div class="w-full mb-10">
                <?php if($tentangSekolah?->foto): ?>
                    <div class="relative overflow-hidden rounded-lg shadow-xl border border-gray-100">
                        <img src="<?php echo e(asset('storage/' . $tentangSekolah->foto)); ?>" alt="Gedung Sekolah"
                            class="w-full h-[300px] sm:h-[500px] object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                    </div>
                <?php else: ?>
                    <div class="py-20 flex items-center justify-center text-center">
                        <p class="text-xs sm:text-base font-semibold text-slate-900 tracking-wider">Belum Ada Foto Sekolah</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Content Grid -->
            <div class="space-y-10 w-full">
                <!-- Deskripsi Profil -->
                <section class="w-full">
                    <div class="prose prose-lg max-w-none w-full text-black leading-relaxed text-justify font-inter">
                        <?php if($tentangSekolah?->deskripsi): ?>
                            <?php echo $tentangSekolah->deskripsi; ?>

                        <?php else: ?>
                            <div class="py-20 flex items-center justify-center text-center w-full">
                                <p class="text-xs sm:text-base font-semibold text-slate-900 tracking-wider">Belum Ada Deskripsi
                                    Profil Sekolah</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </section>

                <!-- Sejarah Section -->
                <section class="relative pt-2 border-t border-gray-100 w-full">
                    <?php if (isset($component)) { $__componentOriginal6a101a87b680dc09f4f04cda5e74cfd1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6a101a87b680dc09f4f04cda5e74cfd1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'website.components.layout.page-title','data' => ['title' => 'Sejarah','class' => 'text-2xl sm:text-3xl']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('website.components.layout.page-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Sejarah','class' => 'text-2xl sm:text-3xl']); ?>
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

                    <div class="prose prose-lg max-w-none w-full text-black leading-relaxed text-justify font-inter">
                        <?php if($tentangSekolah?->sejarah): ?>
                            <?php echo $tentangSekolah->sejarah; ?>

                        <?php else: ?>
                            <div class="py-20 flex items-center justify-center text-center w-full">
                                <p class="text-xs sm:text-base font-semibold text-slate-900 tracking-wider">Belum Ada Sejarah
                                    Singkat Sekolah</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </section>
            </div>
        </article>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.layouts.full', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/website/pages/profile/about/index.blade.php ENDPATH**/ ?>
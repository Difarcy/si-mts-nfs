<?php $__env->startSection('title', 'Visi, Misi, dan Tujuan'); ?>

<?php $__env->startSection('content'); ?>
    <div class="pt-4 sm:pt-6 space-y-6">
        <?php if (isset($component)) { $__componentOriginale44b0f5ba441cef716df532631fccc38 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale44b0f5ba441cef716df532631fccc38 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'website.components.layout.breadcrumb','data' => ['items' => [['label' => 'PROFIL'], ['label' => 'VISI, MISI, TUJUAN']]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('website.components.layout.breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([['label' => 'PROFIL'], ['label' => 'VISI, MISI, TUJUAN']])]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'website.components.layout.page-title','data' => ['title' => 'Visi, Misi, dan Tujuan']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('website.components.layout.page-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Visi, Misi, dan Tujuan']); ?>
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

        <div class="space-y-6">
            <!-- Visi -->
            <div class="py-6 sm:py-8">
                <h3
                    class="text-[12px] sm:text-[16px] font-bold text-green-700 mb-6 text-center font-roboto-slab uppercase tracking-widest">
                    - VISI -
                </h3>

                <?php if($visiMisiTujuan?->visi): ?>
                    <div
                        class="prose prose-sm sm:prose-base max-w-none text-black leading-relaxed text-justify font-inter">
                        <?php echo $visiMisiTujuan->visi; ?>

                    </div>
                <?php else: ?>
                    <div class="py-16 flex flex-col items-center justify-center text-center">
                        <p class="text-[11px] sm:text-base font-semibold text-slate-900 tracking-wider">
                            Belum Ada Visi
                        </p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Misi -->
            <div class="py-6 sm:py-8">
                <h3
                    class="text-[12px] sm:text-[16px] font-bold text-green-700 mb-6 text-center font-roboto-slab uppercase tracking-widest">
                    - MISI -
                </h3>

                <?php if($visiMisiTujuan?->misi): ?>
                    <div class="prose prose-sm sm:prose-base max-w-none text-black leading-relaxed text-justify font-inter">
                        <?php echo $visiMisiTujuan->misi; ?>

                    </div>
                <?php else: ?>
                    <div class="py-16 flex flex-col items-center justify-center text-center">
                        <p class="text-[11px] sm:text-base font-semibold text-slate-900 tracking-wider">
                            Belum Ada Misi
                        </p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Tujuan -->
            <div class="py-6 sm:py-8">
                <h3
                    class="text-[12px] sm:text-[16px] font-bold text-green-700 mb-6 text-center font-roboto-slab uppercase tracking-widest">
                    - TUJUAN -
                </h3>

                <?php if($visiMisiTujuan?->tujuan): ?>
                    <div class="prose prose-sm sm:prose-base max-w-none text-black leading-relaxed text-justify font-inter">
                        <?php echo $visiMisiTujuan->tujuan; ?>

                    </div>
                <?php else: ?>
                    <div class="py-16 flex flex-col items-center justify-center text-center">
                        <p class="text-[11px] sm:text-base font-semibold text-slate-900 tracking-wider">
                            Belum Ada Tujuan
                        </p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('sidebar'); ?>
    
    <div class="space-y-6 pt-4 sm:pt-6 lg:pt-[52px]">
        <?php echo $__env->make('website.components.content.news-widget', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->make('website.components.content.article-widget', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/website/pages/profile/vision/index.blade.php ENDPATH**/ ?>
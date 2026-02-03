<?php $__env->startSection('title', 'Detail Pesan'); ?>

<?php $__env->startSection('content'); ?>
    <div class="flex flex-col gap-3">
        
        <?php if (isset($component)) { $__componentOriginalfe7ff6290c4dd6e9c44a868826f51472 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfe7ff6290c4dd6e9c44a868826f51472 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.ui.page-header','data' => ['title' => 'Detail Pesan','subtitle' => 'Membaca isi pesan lengkap dari pengunjung website']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Detail Pesan','subtitle' => 'Membaca isi pesan lengkap dari pengunjung website']); ?>
             <?php $__env->slot('actions', null, []); ?> 
                <?php if (isset($component)) { $__componentOriginala0276693788c189e10dfd0bfb3860e87 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala0276693788c189e10dfd0bfb3860e87 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.form.button','data' => ['variant' => 'secondary','href' => ''.e(route('admin.interaksi.pesan-masuk.index')).'','class' => 'sm:w-24']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.form.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'secondary','href' => ''.e(route('admin.interaksi.pesan-masuk.index')).'','class' => 'sm:w-24']); ?>
                     <?php $__env->slot('icon', null, []); ?> 
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                     <?php $__env->endSlot(); ?>
                    Kembali
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala0276693788c189e10dfd0bfb3860e87)): ?>
<?php $attributes = $__attributesOriginala0276693788c189e10dfd0bfb3860e87; ?>
<?php unset($__attributesOriginala0276693788c189e10dfd0bfb3860e87); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala0276693788c189e10dfd0bfb3860e87)): ?>
<?php $component = $__componentOriginala0276693788c189e10dfd0bfb3860e87; ?>
<?php unset($__componentOriginala0276693788c189e10dfd0bfb3860e87); ?>
<?php endif; ?>
             <?php $__env->endSlot(); ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfe7ff6290c4dd6e9c44a868826f51472)): ?>
<?php $attributes = $__attributesOriginalfe7ff6290c4dd6e9c44a868826f51472; ?>
<?php unset($__attributesOriginalfe7ff6290c4dd6e9c44a868826f51472); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfe7ff6290c4dd6e9c44a868826f51472)): ?>
<?php $component = $__componentOriginalfe7ff6290c4dd6e9c44a868826f51472; ?>
<?php unset($__componentOriginalfe7ff6290c4dd6e9c44a868826f51472); ?>
<?php endif; ?>

        
        <?php if (isset($component)) { $__componentOriginalfdb23fa6017278bcd751b09e9d04fdc0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfdb23fa6017278bcd751b09e9d04fdc0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.ui.card','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
             <?php $__env->slot('header', null, []); ?> 
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-gray-100 border border-black flex items-center justify-center text-sm sm:text-base font-bold">
                            <?php echo e(substr($message->nama, 0, 1)); ?>

                        </div>
                        <div>
                            <h3 class="text-sm sm:text-base font-bold text-black"><?php echo e($message->nama); ?></h3>
                            <p class="text-xs sm:text-sm text-black/60 font-normal">
                                <?php echo e($message->email); ?> <span class="mx-1">•</span> <?php echo e($message->telepon); ?>

                            </p>
                        </div>
                    </div>
                    <div class="text-left sm:text-right">
                        <p class="text-xs sm:text-sm font-normal text-black/60"><?php echo e($message->tanggal->format('d F Y')); ?></p>
                        <p class="text-xs sm:text-sm text-black/60 font-normal">Jam <?php echo e($message->tanggal->format('H:i')); ?> WIB</p>
                    </div>
                </div>
             <?php $__env->endSlot(); ?>

            <div class="p-6 sm:p-8 bg-white min-h-[300px]">
                <div class="max-w-3xl">
                    <h4 class="text-sm sm:text-base font-bold text-black mb-4"><?php echo e($message->subject); ?></h4>
                    <div class="text-sm text-black leading-relaxed space-y-4">
                        <?php echo nl2br(e($message->pesan)); ?>

                    </div>
                </div>
            </div>

             <?php $__env->slot('footer', null, []); ?> 
                <div class="flex justify-end gap-3">
                    <form action="<?php echo e(route('admin.interaksi.pesan-masuk.destroy', $message->id)); ?>" method="POST" onsubmit="return confirm('Hapus pesan ini?');">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <?php if (isset($component)) { $__componentOriginala0276693788c189e10dfd0bfb3860e87 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala0276693788c189e10dfd0bfb3860e87 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.form.button','data' => ['type' => 'submit','variant' => 'delete']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.form.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','variant' => 'delete']); ?>
                             <?php $__env->slot('icon', null, []); ?> 
                                <?php if (isset($component)) { $__componentOriginala3714099ec0154254b0f45a045fc9f67 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala3714099ec0154254b0f45a045fc9f67 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.ui.icons.trash','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.icons.trash'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala3714099ec0154254b0f45a045fc9f67)): ?>
<?php $attributes = $__attributesOriginala3714099ec0154254b0f45a045fc9f67; ?>
<?php unset($__attributesOriginala3714099ec0154254b0f45a045fc9f67); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala3714099ec0154254b0f45a045fc9f67)): ?>
<?php $component = $__componentOriginala3714099ec0154254b0f45a045fc9f67; ?>
<?php unset($__componentOriginala3714099ec0154254b0f45a045fc9f67); ?>
<?php endif; ?>
                             <?php $__env->endSlot(); ?>
                            Hapus Pesan
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala0276693788c189e10dfd0bfb3860e87)): ?>
<?php $attributes = $__attributesOriginala0276693788c189e10dfd0bfb3860e87; ?>
<?php unset($__attributesOriginala0276693788c189e10dfd0bfb3860e87); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala0276693788c189e10dfd0bfb3860e87)): ?>
<?php $component = $__componentOriginala0276693788c189e10dfd0bfb3860e87; ?>
<?php unset($__componentOriginala0276693788c189e10dfd0bfb3860e87); ?>
<?php endif; ?>
                    </form>

                    <?php
                        // Email Logic
                        $replyTo = $message->email;
                        $replySubject = rawurlencode('Re: ' . ($message->subject ?? ''));
                        $replyBody = rawurlencode("Halo {$message->nama},\n\nTerima kasih sudah menghubungi kami.\n\n---\nPesan Anda:\n" . ($message->pesan ?? ''));
                        $gmailUrl = "https://mail.google.com/mail/?view=cm&fs=1&to=" . rawurlencode($replyTo) . "&su={$replySubject}&body={$replyBody}";

                        // WhatsApp Logic
                        $phoneNumber = $message->telepon;
                        // Remove non-numeric characters
                        $cleanPhone = preg_replace('/[^0-9]/', '', $phoneNumber);
                        
                        // Default to original if processing fails, but try to fix 08xx -> 628xx
                        if (substr($cleanPhone, 0, 1) === '0') {
                             $cleanPhone = '62' . substr($cleanPhone, 1);
                        }
                        
                        $waUrl = "https://wa.me/{$cleanPhone}";
                    ?>

                    <?php if (isset($component)) { $__componentOriginala0276693788c189e10dfd0bfb3860e87 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala0276693788c189e10dfd0bfb3860e87 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.form.button','data' => ['href' => ''.e($waUrl).'','variant' => 'secondary','class' => 'bg-green-50 text-green-700 hover:bg-green-100 border-green-200','target' => '_blank','rel' => 'noopener']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.form.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e($waUrl).'','variant' => 'secondary','class' => 'bg-green-50 text-green-700 hover:bg-green-100 border-green-200','target' => '_blank','rel' => 'noopener']); ?>
                          <?php $__env->slot('icon', null, []); ?> 
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                            </svg>
                          <?php $__env->endSlot(); ?>
                         Balas via WhatsApp
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala0276693788c189e10dfd0bfb3860e87)): ?>
<?php $attributes = $__attributesOriginala0276693788c189e10dfd0bfb3860e87; ?>
<?php unset($__attributesOriginala0276693788c189e10dfd0bfb3860e87); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala0276693788c189e10dfd0bfb3860e87)): ?>
<?php $component = $__componentOriginala0276693788c189e10dfd0bfb3860e87; ?>
<?php unset($__componentOriginala0276693788c189e10dfd0bfb3860e87); ?>
<?php endif; ?>

                    <?php if (isset($component)) { $__componentOriginala0276693788c189e10dfd0bfb3860e87 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala0276693788c189e10dfd0bfb3860e87 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.form.button','data' => ['href' => ''.e($gmailUrl).'','variant' => 'primary','target' => '_blank','rel' => 'noopener']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.form.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e($gmailUrl).'','variant' => 'primary','target' => '_blank','rel' => 'noopener']); ?>
                         <?php $__env->slot('icon', null, []); ?> 
                            <?php if (isset($component)) { $__componentOriginal6cabef3e2791e5c4094bea1781c688f7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6cabef3e2791e5c4094bea1781c688f7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.ui.icons.mail','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.icons.mail'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6cabef3e2791e5c4094bea1781c688f7)): ?>
<?php $attributes = $__attributesOriginal6cabef3e2791e5c4094bea1781c688f7; ?>
<?php unset($__attributesOriginal6cabef3e2791e5c4094bea1781c688f7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6cabef3e2791e5c4094bea1781c688f7)): ?>
<?php $component = $__componentOriginal6cabef3e2791e5c4094bea1781c688f7; ?>
<?php unset($__componentOriginal6cabef3e2791e5c4094bea1781c688f7); ?>
<?php endif; ?>
                         <?php $__env->endSlot(); ?>
                        Balas via Email
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala0276693788c189e10dfd0bfb3860e87)): ?>
<?php $attributes = $__attributesOriginala0276693788c189e10dfd0bfb3860e87; ?>
<?php unset($__attributesOriginala0276693788c189e10dfd0bfb3860e87); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala0276693788c189e10dfd0bfb3860e87)): ?>
<?php $component = $__componentOriginala0276693788c189e10dfd0bfb3860e87; ?>
<?php unset($__componentOriginala0276693788c189e10dfd0bfb3860e87); ?>
<?php endif; ?>
                </div>
             <?php $__env->endSlot(); ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfdb23fa6017278bcd751b09e9d04fdc0)): ?>
<?php $attributes = $__attributesOriginalfdb23fa6017278bcd751b09e9d04fdc0; ?>
<?php unset($__attributesOriginalfdb23fa6017278bcd751b09e9d04fdc0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfdb23fa6017278bcd751b09e9d04fdc0)): ?>
<?php $component = $__componentOriginalfdb23fa6017278bcd751b09e9d04fdc0; ?>
<?php unset($__componentOriginalfdb23fa6017278bcd751b09e9d04fdc0); ?>
<?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/admin/pages/interaction/messages/detail.blade.php ENDPATH**/ ?>
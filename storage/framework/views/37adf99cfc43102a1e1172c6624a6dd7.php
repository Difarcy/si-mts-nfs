<?php $__env->startSection('title', 'Tambah Berita'); ?>

<?php $__env->startSection('content'); ?>
    <div class="flex flex-col gap-3" data-page="news-create">
        
        <?php if (isset($component)) { $__componentOriginalfe7ff6290c4dd6e9c44a868826f51472 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfe7ff6290c4dd6e9c44a868826f51472 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.ui.page-header','data' => ['title' => 'Tambah Berita','subtitle' => 'Buat dan publikasikan berita terbaru untuk sekolah']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Tambah Berita','subtitle' => 'Buat dan publikasikan berita terbaru untuk sekolah']); ?>
             <?php $__env->slot('actions', null, []); ?> 
                <div class="flex items-center gap-3">
                    <?php if (isset($component)) { $__componentOriginala0276693788c189e10dfd0bfb3860e87 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala0276693788c189e10dfd0bfb3860e87 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.form.button','data' => ['variant' => 'secondary','href' => ''.e(route('admin.konten.berita.index')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.form.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'secondary','href' => ''.e(route('admin.konten.berita.index')).'']); ?>
                         <?php $__env->slot('icon', null, []); ?> 
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                         <?php $__env->endSlot(); ?>
                        Batal
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.form.button','data' => ['type' => 'submit','variant' => 'add','form' => 'news-form','class' => 'sm:w-24 opacity-50 pointer-events-none','disabled' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.form.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','variant' => 'add','form' => 'news-form','class' => 'sm:w-24 opacity-50 pointer-events-none','disabled' => true]); ?>
                         <?php $__env->slot('icon', null, []); ?> 
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                         <?php $__env->endSlot(); ?>
                        Publish
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
            <form id="news-form" action="<?php echo e(route('admin.konten.berita.store')); ?>" method="POST" data-submit-confirm="Simpan berita ini?"
                enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="p-4 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        
                        <div class="md:col-span-3 space-y-4">
                            
                            <?php if (isset($component)) { $__componentOriginal375f0ed4f8ee156e823aad8b1382f853 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal375f0ed4f8ee156e823aad8b1382f853 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.form.input','data' => ['name' => 'title','label' => 'Judul','placeholder' => 'Masukkan judul berita yang menarik...','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.form.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'title','label' => 'Judul','placeholder' => 'Masukkan judul berita yang menarik...','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal375f0ed4f8ee156e823aad8b1382f853)): ?>
<?php $attributes = $__attributesOriginal375f0ed4f8ee156e823aad8b1382f853; ?>
<?php unset($__attributesOriginal375f0ed4f8ee156e823aad8b1382f853); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal375f0ed4f8ee156e823aad8b1382f853)): ?>
<?php $component = $__componentOriginal375f0ed4f8ee156e823aad8b1382f853; ?>
<?php unset($__componentOriginal375f0ed4f8ee156e823aad8b1382f853); ?>
<?php endif; ?>

                            
                            <?php if (isset($component)) { $__componentOriginaldc7fa6334b1909b429708920f13a8b57 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldc7fa6334b1909b429708920f13a8b57 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.form.upload-image','data' => ['label' => 'Thumbnail','name' => 'thumbnail','height' => '!h-[400px]','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.form.upload-image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Thumbnail','name' => 'thumbnail','height' => '!h-[400px]','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldc7fa6334b1909b429708920f13a8b57)): ?>
<?php $attributes = $__attributesOriginaldc7fa6334b1909b429708920f13a8b57; ?>
<?php unset($__attributesOriginaldc7fa6334b1909b429708920f13a8b57); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldc7fa6334b1909b429708920f13a8b57)): ?>
<?php $component = $__componentOriginaldc7fa6334b1909b429708920f13a8b57; ?>
<?php unset($__componentOriginaldc7fa6334b1909b429708920f13a8b57); ?>
<?php endif; ?>

                            
                            <?php if (isset($component)) { $__componentOriginaldc7fa6334b1909b429708920f13a8b57 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldc7fa6334b1909b429708920f13a8b57 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.form.upload-image','data' => ['label' => 'Gambar','name' => 'image','multiple' => 'true','height' => '!h-[400px]','helperText' => 'Maksimal 6 gambar sekaligus.','maxFiles' => '6']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.form.upload-image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Gambar','name' => 'image','multiple' => 'true','height' => '!h-[400px]','helper-text' => 'Maksimal 6 gambar sekaligus.','max-files' => '6']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldc7fa6334b1909b429708920f13a8b57)): ?>
<?php $attributes = $__attributesOriginaldc7fa6334b1909b429708920f13a8b57; ?>
<?php unset($__attributesOriginaldc7fa6334b1909b429708920f13a8b57); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldc7fa6334b1909b429708920f13a8b57)): ?>
<?php $component = $__componentOriginaldc7fa6334b1909b429708920f13a8b57; ?>
<?php unset($__componentOriginaldc7fa6334b1909b429708920f13a8b57); ?>
<?php endif; ?>

                            
                            <?php if (isset($component)) { $__componentOriginal5f8711bac92b9cbfae758724ea0086d0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5f8711bac92b9cbfae758724ea0086d0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.form.textarea','data' => ['name' => 'content','label' => 'Deskripsi','placeholder' => 'Tuliskan detail berita di sini...','rows' => '15','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.form.textarea'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'content','label' => 'Deskripsi','placeholder' => 'Tuliskan detail berita di sini...','rows' => '15','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5f8711bac92b9cbfae758724ea0086d0)): ?>
<?php $attributes = $__attributesOriginal5f8711bac92b9cbfae758724ea0086d0; ?>
<?php unset($__attributesOriginal5f8711bac92b9cbfae758724ea0086d0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5f8711bac92b9cbfae758724ea0086d0)): ?>
<?php $component = $__componentOriginal5f8711bac92b9cbfae758724ea0086d0; ?>
<?php unset($__componentOriginal5f8711bac92b9cbfae758724ea0086d0); ?>
<?php endif; ?>
                        </div>

                        
                        <div class="md:col-span-1 space-y-4">
                            
                            <?php if (isset($component)) { $__componentOriginalb8e0e7f71ebea210035a0cca5390ed63 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb8e0e7f71ebea210035a0cca5390ed63 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.form.select-input','data' => ['name' => 'status','label' => 'Status','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.form.select-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'status','label' => 'Status','required' => true]); ?>
                                <option value="publish">Publish</option>
                                <option value="draft">Draft</option>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb8e0e7f71ebea210035a0cca5390ed63)): ?>
<?php $attributes = $__attributesOriginalb8e0e7f71ebea210035a0cca5390ed63; ?>
<?php unset($__attributesOriginalb8e0e7f71ebea210035a0cca5390ed63); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb8e0e7f71ebea210035a0cca5390ed63)): ?>
<?php $component = $__componentOriginalb8e0e7f71ebea210035a0cca5390ed63; ?>
<?php unset($__componentOriginalb8e0e7f71ebea210035a0cca5390ed63); ?>
<?php endif; ?>

                            
                            <?php if (isset($component)) { $__componentOriginal375f0ed4f8ee156e823aad8b1382f853 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal375f0ed4f8ee156e823aad8b1382f853 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.form.input','data' => ['name' => 'author','label' => 'Penulis','placeholder' => 'Nama penulis...','value' => ''.e($defaultAuthor).'','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.form.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'author','label' => 'Penulis','placeholder' => 'Nama penulis...','value' => ''.e($defaultAuthor).'','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal375f0ed4f8ee156e823aad8b1382f853)): ?>
<?php $attributes = $__attributesOriginal375f0ed4f8ee156e823aad8b1382f853; ?>
<?php unset($__attributesOriginal375f0ed4f8ee156e823aad8b1382f853); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal375f0ed4f8ee156e823aad8b1382f853)): ?>
<?php $component = $__componentOriginal375f0ed4f8ee156e823aad8b1382f853; ?>
<?php unset($__componentOriginal375f0ed4f8ee156e823aad8b1382f853); ?>
<?php endif; ?>

                            
                            <div x-data="{ 
                                                            isScheduled: false,
                                                            isManual: false,
                                                            timer: null,
                                                            fillCurrentDateTime() {
                                                                if (this.isManual) return;
                                                                const now = new Date();
                                                                const year = now.getFullYear();
                                                                const month = String(now.getMonth() + 1).padStart(2, '0');
                                                                const day = String(now.getDate()).padStart(2, '0');
                                                                const hours = String(now.getHours()).padStart(2, '0');
                                                                const minutes = String(now.getMinutes()).padStart(2, '0');

                                                                if (this.$refs.dateInput) {
                                                                    this.$refs.dateInput.value = `${year}-${month}-${day}`;
                                                                }
                                                                if (this.$refs.timeInput) {
                                                                    this.$refs.timeInput.value = `${hours}:${minutes}`;
                                                                }
                                                            },
                                                            startTimer() {
                                                                this.fillCurrentDateTime();
                                                                this.timer = setInterval(() => this.fillCurrentDateTime(), 1000);
                                                            },
                                                            stopTimer() {
                                                                if (this.timer) clearInterval(this.timer);
                                                            }
                                                        }" x-init="$watch('isScheduled', value => {
                                                            if (value) startTimer();
                                                            else { stopTimer(); isManual = false; }
                                                        })" class="space-y-3 pt-2 border-t border-gray-100"
                                data-hide-on-draft="true">
                                <?php if (isset($component)) { $__componentOriginald457ea4cccb32554c2839194ab661968 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald457ea4cccb32554c2839194ab661968 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.form.checkbox','data' => ['name' => 'is_scheduled','label' => 'Jadwalkan','xModel' => 'isScheduled']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.form.checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'is_scheduled','label' => 'Jadwalkan','x-model' => 'isScheduled']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald457ea4cccb32554c2839194ab661968)): ?>
<?php $attributes = $__attributesOriginald457ea4cccb32554c2839194ab661968; ?>
<?php unset($__attributesOriginald457ea4cccb32554c2839194ab661968); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald457ea4cccb32554c2839194ab661968)): ?>
<?php $component = $__componentOriginald457ea4cccb32554c2839194ab661968; ?>
<?php unset($__componentOriginald457ea4cccb32554c2839194ab661968); ?>
<?php endif; ?>

                                <div x-show="isScheduled" x-transition class="space-y-3" style="display: none;">
                                    <?php if (isset($component)) { $__componentOriginal375f0ed4f8ee156e823aad8b1382f853 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal375f0ed4f8ee156e823aad8b1382f853 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.form.input','data' => ['type' => 'date','name' => 'published_date','label' => 'Tanggal','required' => true,':required' => 'isScheduled','xRef' => 'dateInput','@input' => 'isManual = true; stopTimer()','@focus' => 'isManual = true; stopTimer()']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.form.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'date','name' => 'published_date','label' => 'Tanggal','required' => true,':required' => 'isScheduled','x-ref' => 'dateInput','@input' => 'isManual = true; stopTimer()','@focus' => 'isManual = true; stopTimer()']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal375f0ed4f8ee156e823aad8b1382f853)): ?>
<?php $attributes = $__attributesOriginal375f0ed4f8ee156e823aad8b1382f853; ?>
<?php unset($__attributesOriginal375f0ed4f8ee156e823aad8b1382f853); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal375f0ed4f8ee156e823aad8b1382f853)): ?>
<?php $component = $__componentOriginal375f0ed4f8ee156e823aad8b1382f853; ?>
<?php unset($__componentOriginal375f0ed4f8ee156e823aad8b1382f853); ?>
<?php endif; ?>

                                    <?php if (isset($component)) { $__componentOriginal375f0ed4f8ee156e823aad8b1382f853 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal375f0ed4f8ee156e823aad8b1382f853 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.form.input','data' => ['type' => 'time','name' => 'published_time','label' => 'Waktu','required' => true,':required' => 'isScheduled','xRef' => 'timeInput','@input' => 'isManual = true; stopTimer()','@focus' => 'isManual = true; stopTimer()']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.form.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'time','name' => 'published_time','label' => 'Waktu','required' => true,':required' => 'isScheduled','x-ref' => 'timeInput','@input' => 'isManual = true; stopTimer()','@focus' => 'isManual = true; stopTimer()']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal375f0ed4f8ee156e823aad8b1382f853)): ?>
<?php $attributes = $__attributesOriginal375f0ed4f8ee156e823aad8b1382f853; ?>
<?php unset($__attributesOriginal375f0ed4f8ee156e823aad8b1382f853); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal375f0ed4f8ee156e823aad8b1382f853)): ?>
<?php $component = $__componentOriginal375f0ed4f8ee156e823aad8b1382f853; ?>
<?php unset($__componentOriginal375f0ed4f8ee156e823aad8b1382f853); ?>
<?php endif; ?>

                                    <div x-show="!isManual"
                                        class="flex items-center gap-1.5 text-[10px] text-green-600 font-medium bg-green-50 px-2 py-1 rounded-md w-fit">
                                        <span class="relative flex h-2 w-2">
                                            <span
                                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                            <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                                        </span>
                                        Waktu berjalan real-time
                                    </div>
                                </div>
                            </div>

                            
                            <div class="pt-2 border-t border-gray-100" data-hide-on-draft="true">
                                <?php if (isset($component)) { $__componentOriginald457ea4cccb32554c2839194ab661968 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald457ea4cccb32554c2839194ab661968 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.form.checkbox','data' => ['name' => 'is_highlight','label' => 'Jadikan Highlight']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.form.checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'is_highlight','label' => 'Jadikan Highlight']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald457ea4cccb32554c2839194ab661968)): ?>
<?php $attributes = $__attributesOriginald457ea4cccb32554c2839194ab661968; ?>
<?php unset($__attributesOriginald457ea4cccb32554c2839194ab661968); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald457ea4cccb32554c2839194ab661968)): ?>
<?php $component = $__componentOriginald457ea4cccb32554c2839194ab661968; ?>
<?php unset($__componentOriginald457ea4cccb32554c2839194ab661968); ?>
<?php endif; ?>
                            </div>

                            
                            <div class="pt-2 border-t border-gray-100">
                                <?php if (isset($component)) { $__componentOriginalf8bb3e2b06506fff910970ba33b7afd4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8bb3e2b06506fff910970ba33b7afd4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.form.tags-input','data' => ['name' => 'tags','label' => 'Tags','placeholder' => 'Ketik tag lalu tekan Enter...','class' => '!min-h-[200px]']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.form.tags-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'tags','label' => 'Tags','placeholder' => 'Ketik tag lalu tekan Enter...','class' => '!min-h-[200px]']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf8bb3e2b06506fff910970ba33b7afd4)): ?>
<?php $attributes = $__attributesOriginalf8bb3e2b06506fff910970ba33b7afd4; ?>
<?php unset($__attributesOriginalf8bb3e2b06506fff910970ba33b7afd4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf8bb3e2b06506fff910970ba33b7afd4)): ?>
<?php $component = $__componentOriginalf8bb3e2b06506fff910970ba33b7afd4; ?>
<?php unset($__componentOriginalf8bb3e2b06506fff910970ba33b7afd4); ?>
<?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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

<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/admin/pages/content/news/create.blade.php ENDPATH**/ ?>
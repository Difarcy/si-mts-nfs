<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
    <div class="flex flex-col gap-3 pb-4">
        
        <?php if (isset($component)) { $__componentOriginalfe7ff6290c4dd6e9c44a868826f51472 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfe7ff6290c4dd6e9c44a868826f51472 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.ui.page-header','data' => ['title' => 'Dashboard','subtitle' => 'Selamat datang di Dashboard MTs Nurul Falaah']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Dashboard','subtitle' => 'Selamat datang di Dashboard MTs Nurul Falaah']); ?>
             <?php $__env->slot('actions', null, []); ?> 
                <?php if (isset($component)) { $__componentOriginala0276693788c189e10dfd0bfb3860e87 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala0276693788c189e10dfd0bfb3860e87 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.form.button','data' => ['variant' => 'info','href' => ''.e(route('web.home')).'','target' => '_blank']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.form.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'info','href' => ''.e(route('web.home')).'','target' => '_blank']); ?>
                     <?php $__env->slot('icon', null, []); ?> 
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                     <?php $__env->endSlot(); ?>
                    <span class="hidden sm:inline">Lihat Situs</span>
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

        
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            
            <?php if (isset($component)) { $__componentOriginal2ecef3de8af70632d6a65b398670d0bf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ecef3de8af70632d6a65b398670d0bf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.ui.stats-card','data' => ['label' => 'Berita','value' => ''.e($stats->news_publish + $stats->news_draft).'','color' => 'blue','href' => route('admin.konten.berita.index')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.stats-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Berita','value' => ''.e($stats->news_publish + $stats->news_draft).'','color' => 'blue','href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.konten.berita.index'))]); ?>
                 <?php $__env->slot('icon', null, []); ?> 
                    <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                        </path>
                    </svg>
                 <?php $__env->endSlot(); ?>
                 <?php $__env->slot('footer', null, []); ?> 
                    <span class="text-slate-900 font-bold"><?php echo e($stats->news_publish); ?> Terbit</span>
                    <span class="text-slate-400">|</span>
                    <span class="text-slate-900 font-bold"><?php echo e($stats->news_draft); ?> Draft</span>
                 <?php $__env->endSlot(); ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ecef3de8af70632d6a65b398670d0bf)): ?>
<?php $attributes = $__attributesOriginal2ecef3de8af70632d6a65b398670d0bf; ?>
<?php unset($__attributesOriginal2ecef3de8af70632d6a65b398670d0bf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ecef3de8af70632d6a65b398670d0bf)): ?>
<?php $component = $__componentOriginal2ecef3de8af70632d6a65b398670d0bf; ?>
<?php unset($__componentOriginal2ecef3de8af70632d6a65b398670d0bf); ?>
<?php endif; ?>

            
            <?php if (isset($component)) { $__componentOriginal2ecef3de8af70632d6a65b398670d0bf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ecef3de8af70632d6a65b398670d0bf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.ui.stats-card','data' => ['label' => 'Artikel','value' => ''.e($stats->article_publish + $stats->article_draft).'','color' => 'green','href' => route('admin.konten.artikel.index')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.stats-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Artikel','value' => ''.e($stats->article_publish + $stats->article_draft).'','color' => 'green','href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.konten.artikel.index'))]); ?>
                 <?php $__env->slot('icon', null, []); ?> 
                    <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                        </path>
                    </svg>
                 <?php $__env->endSlot(); ?>
                 <?php $__env->slot('footer', null, []); ?> 
                    <span class="text-slate-900 font-bold"><?php echo e($stats->article_publish); ?> Terbit</span>
                    <span class="text-slate-400">|</span>
                    <span class="text-slate-900 font-bold"><?php echo e($stats->article_draft); ?> Draft</span>
                 <?php $__env->endSlot(); ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ecef3de8af70632d6a65b398670d0bf)): ?>
<?php $attributes = $__attributesOriginal2ecef3de8af70632d6a65b398670d0bf; ?>
<?php unset($__attributesOriginal2ecef3de8af70632d6a65b398670d0bf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ecef3de8af70632d6a65b398670d0bf)): ?>
<?php $component = $__componentOriginal2ecef3de8af70632d6a65b398670d0bf; ?>
<?php unset($__componentOriginal2ecef3de8af70632d6a65b398670d0bf); ?>
<?php endif; ?>

            
            <?php if (isset($component)) { $__componentOriginal2ecef3de8af70632d6a65b398670d0bf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ecef3de8af70632d6a65b398670d0bf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.ui.stats-card','data' => ['label' => 'Komentar','value' => ''.e($stats->comments_pending).'','color' => 'purple','href' => route('admin.interaksi.komentar.index')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.stats-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Komentar','value' => ''.e($stats->comments_pending).'','color' => 'purple','href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.interaksi.komentar.index'))]); ?>
                 <?php $__env->slot('icon', null, []); ?> 
                    <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                        </path>
                    </svg>
                 <?php $__env->endSlot(); ?>
                 <?php $__env->slot('footer', null, []); ?> 
                    <span class="text-slate-900 font-bold"><?php echo e($stats->comments_pending); ?> Menunggu Persetujuan</span>
                 <?php $__env->endSlot(); ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ecef3de8af70632d6a65b398670d0bf)): ?>
<?php $attributes = $__attributesOriginal2ecef3de8af70632d6a65b398670d0bf; ?>
<?php unset($__attributesOriginal2ecef3de8af70632d6a65b398670d0bf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ecef3de8af70632d6a65b398670d0bf)): ?>
<?php $component = $__componentOriginal2ecef3de8af70632d6a65b398670d0bf; ?>
<?php unset($__componentOriginal2ecef3de8af70632d6a65b398670d0bf); ?>
<?php endif; ?>

            
            <?php if (isset($component)) { $__componentOriginal2ecef3de8af70632d6a65b398670d0bf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ecef3de8af70632d6a65b398670d0bf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.ui.stats-card','data' => ['label' => 'Pesan Masuk','value' => ''.e($stats->messages_new).'','color' => 'pink','href' => route('admin.interaksi.pesan-masuk.index')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.stats-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Pesan Masuk','value' => ''.e($stats->messages_new).'','color' => 'pink','href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.interaksi.pesan-masuk.index'))]); ?>
                 <?php $__env->slot('icon', null, []); ?> 
                    <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                        </path>
                    </svg>
                 <?php $__env->endSlot(); ?>
                 <?php $__env->slot('footer', null, []); ?> 
                    <span class="text-slate-900 font-bold"><?php echo e($stats->messages_new); ?> Pesan Baru</span>
                 <?php $__env->endSlot(); ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ecef3de8af70632d6a65b398670d0bf)): ?>
<?php $attributes = $__attributesOriginal2ecef3de8af70632d6a65b398670d0bf; ?>
<?php unset($__attributesOriginal2ecef3de8af70632d6a65b398670d0bf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ecef3de8af70632d6a65b398670d0bf)): ?>
<?php $component = $__componentOriginal2ecef3de8af70632d6a65b398670d0bf; ?>
<?php unset($__componentOriginal2ecef3de8af70632d6a65b398670d0bf); ?>
<?php endif; ?>
        </div>

        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            <a href="<?php echo e(route('admin.konten.berita.create')); ?>"
                class="bg-white border border-gray-200 hover:border-green-500 hover:shadow-md transition-all p-4 rounded-xl flex flex-col items-center justify-center gap-2 group text-center">
                <div
                    class="p-3 bg-blue-50 text-blue-600 rounded-full group-hover:bg-blue-600 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                        </path>
                    </svg>
                </div>
                <span class="text-xs sm:text-sm font-bold text-slate-900 group-hover:text-green-600 mt-1">Tulis
                    Berita</span>
            </a>

            <a href="<?php echo e(route('admin.konten.artikel.create')); ?>"
                class="bg-white border border-gray-200 hover:border-green-500 hover:shadow-md transition-all p-4 rounded-xl flex flex-col items-center justify-center gap-2 group text-center">
                <div
                    class="p-3 bg-green-50 text-green-600 rounded-full group-hover:bg-green-600 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                        </path>
                    </svg>
                </div>
                <span class="text-xs sm:text-sm font-bold text-slate-900 group-hover:text-green-600 mt-1">Tulis
                    Artikel</span>
            </a>

            <a href="<?php echo e(route('admin.konten.pengumuman.create')); ?>"
                class="bg-white border border-gray-200 hover:border-green-500 hover:shadow-md transition-all p-4 rounded-xl flex flex-col items-center justify-center gap-2 group text-center">
                <div
                    class="p-3 bg-yellow-50 text-yellow-600 rounded-full group-hover:bg-yellow-500 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z">
                        </path>
                    </svg>
                </div>
                <span class="text-xs sm:text-sm font-bold text-slate-900 group-hover:text-green-600 mt-1">Buat
                    Pengumuman</span>
            </a>

            <a href="<?php echo e(route('admin.konten.agenda.create')); ?>"
                class="bg-white border border-gray-200 hover:border-green-500 hover:shadow-md transition-all p-4 rounded-xl flex flex-col items-center justify-center gap-2 group text-center">
                <div
                    class="p-3 bg-purple-50 text-purple-600 rounded-full group-hover:bg-purple-600 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
                <span class="text-xs sm:text-sm font-bold text-slate-900 group-hover:text-green-600 mt-1">Tambah
                    Agenda</span>
            </a>

            <a href="<?php echo e(route('admin.media.foto.index')); ?>"
                class="bg-white border border-gray-200 hover:border-green-500 hover:shadow-md transition-all p-4 rounded-xl flex flex-col items-center justify-center gap-2 group text-center">
                <div
                    class="p-3 bg-pink-50 text-pink-600 rounded-full group-hover:bg-pink-600 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
                <span class="text-xs sm:text-sm font-bold text-slate-900 group-hover:text-green-600 mt-1">Upload Foto</span>
            </a>

            <a href="<?php echo e(route('admin.media.video.create')); ?>"
                class="bg-white border border-gray-200 hover:border-green-500 hover:shadow-md transition-all p-4 rounded-xl flex flex-col items-center justify-center gap-2 group text-center">
                <div
                    class="p-3 bg-red-50 text-red-600 rounded-full group-hover:bg-red-600 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
                <span class="text-xs sm:text-sm font-bold text-slate-900 group-hover:text-green-600 mt-1">Upload
                    Video</span>
            </a>
        </div>

        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                <div class="p-4 border-b border-gray-100 flex items-center justify-between">
                    <h2 class="text-sm sm:text-base font-bold text-slate-900">Komentar Terbaru</h2>
                    <a href="<?php echo e(route('admin.interaksi.komentar.index')); ?>"
                        class="text-xs sm:text-sm text-green-600 hover:text-green-700 font-medium">Lihat Semua</a>
                </div>
                <div class="p-4 overflow-y-auto custom-scrollbar flex flex-col" style="height: 500px;">
                    <?php if($komentar_terbaru->isEmpty()): ?>
                        
                        <div class="flex-1 flex flex-col items-center justify-center text-slate-500">
                            <svg class="w-12 h-12 mx-auto text-slate-300 mb-3" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                </path>
                            </svg>
                            <p class="text-xs sm:text-sm">Belum ada komentar terbaru</p>
                        </div>
                    <?php else: ?>
                        <div class="space-y-3">
                            <?php $__currentLoopData = $komentar_terbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $komentar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $isRead = $komentar->is_read;
                                ?>
                                <a href="<?php echo e(route('admin.interaksi.komentar.show', $komentar->id)); ?>"
                                    class="block p-2 sm:p-3 rounded-lg border border-gray-100 hover:bg-gray-50 transition-colors group">
                                    <div class="flex items-center justify-between mb-1">
                                        <span
                                            class="text-xs sm:text-sm <?php echo e(!$isRead ? 'font-bold text-black' : 'font-normal text-black'); ?>"><?php echo e($komentar->nama); ?></span>
                                        <span
                                            class="text-[10px] sm:text-xs <?php echo e(!$isRead ? 'font-bold text-black' : 'font-normal text-black'); ?>"><?php echo e(optional($komentar->tanggal)->diffForHumans()); ?></span>
                                    </div>
                                    <div class="flex items-center gap-2 mb-1">
                                        <?php if($komentar->status === 'approved'): ?>
                                            <?php if (isset($component)) { $__componentOriginal7fa95ce53b108be002cc50811befd399 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7fa95ce53b108be002cc50811befd399 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.ui.badge','data' => ['variant' => 'publish']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'publish']); ?>Disetujui <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7fa95ce53b108be002cc50811befd399)): ?>
<?php $attributes = $__attributesOriginal7fa95ce53b108be002cc50811befd399; ?>
<?php unset($__attributesOriginal7fa95ce53b108be002cc50811befd399); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7fa95ce53b108be002cc50811befd399)): ?>
<?php $component = $__componentOriginal7fa95ce53b108be002cc50811befd399; ?>
<?php unset($__componentOriginal7fa95ce53b108be002cc50811befd399); ?>
<?php endif; ?>
                                        <?php else: ?>
                                            <?php if (isset($component)) { $__componentOriginal7fa95ce53b108be002cc50811befd399 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7fa95ce53b108be002cc50811befd399 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.ui.badge','data' => ['variant' => 'highlight']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'highlight']); ?>Pending <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7fa95ce53b108be002cc50811befd399)): ?>
<?php $attributes = $__attributesOriginal7fa95ce53b108be002cc50811befd399; ?>
<?php unset($__attributesOriginal7fa95ce53b108be002cc50811befd399); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7fa95ce53b108be002cc50811befd399)): ?>
<?php $component = $__componentOriginal7fa95ce53b108be002cc50811befd399; ?>
<?php unset($__componentOriginal7fa95ce53b108be002cc50811befd399); ?>
<?php endif; ?>
                                        <?php endif; ?>

                                        <?php
                                            $tipeData = [
                                                'news' => ['label' => 'Berita', 'variant' => 'berita'],
                                                'article' => ['label' => 'Artikel', 'variant' => 'artikel'],
                                                'announcement' => ['label' => 'Pengumuman', 'variant' => 'pengumuman'],
                                                'agenda' => ['label' => 'Agenda', 'variant' => 'agenda'],
                                                'achievement' => ['label' => 'Prestasi Siswa', 'variant' => 'prestasi'],
                                            ];
                                            $currentTipe = $tipeData[$komentar->konten_tipe] ?? ['label' => $komentar->konten_tipe, 'variant' => 'default'];
                                        ?>

                                        <?php if (isset($component)) { $__componentOriginal7fa95ce53b108be002cc50811befd399 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7fa95ce53b108be002cc50811befd399 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.ui.badge','data' => ['variant' => $currentTipe['variant']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($currentTipe['variant'])]); ?>
                                            <?php echo e($currentTipe['label']); ?>

                                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7fa95ce53b108be002cc50811befd399)): ?>
<?php $attributes = $__attributesOriginal7fa95ce53b108be002cc50811befd399; ?>
<?php unset($__attributesOriginal7fa95ce53b108be002cc50811befd399); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7fa95ce53b108be002cc50811befd399)): ?>
<?php $component = $__componentOriginal7fa95ce53b108be002cc50811befd399; ?>
<?php unset($__componentOriginal7fa95ce53b108be002cc50811befd399); ?>
<?php endif; ?>
                                    </div>
                                    <p
                                        class="text-xs sm:text-sm line-clamp-2 <?php echo e(!$isRead ? 'font-normal text-black' : 'font-normal text-black'); ?>">
                                        <?php echo e($komentar->isi); ?></p>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                <div class="p-4 border-b border-gray-100 flex items-center justify-between">
                    <h2 class="text-sm sm:text-base font-bold text-slate-900">Pesan Masuk</h2>
                    <a href="<?php echo e(route('admin.interaksi.pesan-masuk.index')); ?>"
                        class="text-xs sm:text-sm text-green-600 hover:text-green-700 font-medium">Lihat Semua</a>
                </div>
                <div class="p-4 overflow-y-auto custom-scrollbar flex flex-col" style="height: 500px;">
                    <?php if($pesan_terbaru->isEmpty()): ?>
                        
                        <div class="flex-1 flex flex-col items-center justify-center text-slate-500">
                            <svg class="w-12 h-12 mx-auto text-slate-300 mb-3" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                            <p class="text-xs sm:text-sm">Belum ada pesan baru</p>
                        </div>
                    <?php else: ?>
                        <div class="space-y-3">
                            <?php $__currentLoopData = $pesan_terbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pesan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('admin.interaksi.pesan-masuk.show', $pesan->id)); ?>"
                                    class="block p-2 sm:p-3 rounded-lg border border-gray-100 hover:bg-gray-50 transition-colors group">
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="text-xs sm:text-sm font-bold text-slate-900"><?php echo e($pesan->nama); ?></span>
                                        <span
                                            class="text-[10px] sm:text-xs text-slate-900 font-bold"><?php echo e($pesan->tanggal->diffForHumans()); ?></span>
                                    </div>
                                    <h3 class="text-sm sm:text-base font-bold text-slate-900 mb-1 truncate"><?php echo e($pesan->subject); ?>

                                    </h3>
                                    <p class="text-xs sm:text-sm text-slate-900 line-clamp-2 font-normal"><?php echo e($pesan->pesan); ?></p>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm lg:col-span-2">
                <div class="p-4 border-b border-gray-100 flex items-center justify-between">
                    <h2 class="text-sm sm:text-base font-bold text-slate-900">Agenda Terdekat</h2>
                    <a href="<?php echo e(route('admin.konten.agenda.index')); ?>"
                        class="text-xs sm:text-sm text-green-600 hover:text-green-700 font-medium">Lihat Semua</a>
                </div>
                <div class="p-4 overflow-y-auto custom-scrollbar flex flex-col" style="height: 500px;">
                    <?php if($agenda->isEmpty()): ?>
                        
                        <div class="flex-1 flex flex-col items-center justify-center text-slate-500">
                            <svg class="w-12 h-12 mx-auto text-slate-300 mb-3" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            <p class="text-xs sm:text-sm">Belum ada agenda terdekat</p>
                        </div>
                    <?php else: ?>
                        <div class="space-y-3">
                            <?php $__currentLoopData = $agenda; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div
                                    class="flex items-center gap-3 p-3 rounded-lg border border-gray-100 hover:bg-gray-50 transition-colors">
                                    <div
                                        class="w-12 h-12 rounded-lg bg-green-700 text-white flex flex-col items-center justify-center shrink-0">
                                        <span
                                            class="text-[10px] font-bold uppercase mb-0.5 leading-none"><?php echo e($item->tanggal_mulai?->translatedFormat('M')); ?></span>
                                        <span class="text-lg font-bold leading-none"><?php echo e($item->tanggal_mulai?->format('d')); ?></span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-base font-bold text-slate-900 truncate"><?php echo e($item->judul); ?></h3>

                                        
                                        <div class="flex items-center gap-1.5 mt-1">
                                            <svg class="w-3 h-3 text-slate-800" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            <span class="text-sm text-slate-900 font-medium">
                                                <?php echo e($item->tanggal_mulai?->format('d/m/Y')); ?>

                                                <?php if($item->tanggal_selesai): ?>
                                                    - <?php echo e($item->tanggal_selesai->format('d/m/Y')); ?>

                                                <?php endif; ?>
                                            </span>
                                        </div>

                                        <div class="flex items-center gap-2 mt-1">
                                            <span class="text-sm text-slate-800 font-normal flex items-center gap-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <?php echo e(\Carbon\Carbon::parse($item->waktu_mulai)->format('H:i')); ?>

                                                <?php if($item->waktu_selesai && $item->waktu_selesai !== '00:00:00'): ?>
                                                    - <?php echo e(\Carbon\Carbon::parse($item->waktu_selesai)->format('H:i')); ?>

                                                <?php else: ?>
                                                    - Selesai
                                                <?php endif; ?>
                                            </span>
                                            <span class="text-sm text-slate-300">|</span>
                                            <span class="text-sm text-slate-800 font-normal flex items-center gap-1 truncate">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                    </path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                                <?php echo e($item->lokasi); ?>

                                            </span>
                                        </div>
                                    </div>
                                    <a href="<?php echo e(route('admin.konten.agenda.edit', $item->id)); ?>"
                                        class="p-2 text-slate-400 hover:text-green-600 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                            </path>
                                        </svg>
                                    </a>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/admin/pages/dashboard/index.blade.php ENDPATH**/ ?>
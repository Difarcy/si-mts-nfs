<?php if($berita->count() > 0): ?>
    
    <div x-show="view === 'table'" data-admin-view-panel="table">
        <div class="h-[300px] sm:h-[360px] overflow-y-auto">
            <?php if (isset($component)) { $__componentOriginal722fc7edbde74caa9ff525bc9925b331 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal722fc7edbde74caa9ff525bc9925b331 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.ui.table','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                 <?php $__env->slot('thead', null, []); ?> 
                    <tr>
                        <th class="px-2 sm:px-4 py-2 sm:py-3 text-center text-[10px] sm:text-xs">Judul</th>
                        <th class="px-2 sm:px-4 py-2 sm:py-3 text-center w-20 sm:w-28 text-[10px] sm:text-xs">Status</th>
                        <th class="px-2 sm:px-4 py-2 sm:py-3 text-center w-28 sm:w-44 text-[10px] sm:text-xs">Tanggal Publikasi</th>
                        <th class="px-2 sm:px-4 py-2 sm:py-3 text-center w-20 sm:w-28 text-[10px] sm:text-xs">Aksi</th>
                    </tr>
                 <?php $__env->endSlot(); ?>

                <?php $__currentLoopData = $berita; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $isLocked = $item->tanggal_publikasi && $item->tanggal_publikasi->isFuture();
                    ?>
                    <tr class="hover:bg-gray-50/50 transition-colors" data-admin-item="table" data-id="<?php echo e($item->id); ?>"
                        data-status="<?php echo e($item->status); ?>" data-title="<?php echo e($item->judul); ?>"
                        data-search="<?php echo e($item->judul); ?> <?php echo e(strip_tags($item->deskripsi)); ?>">
                        <td class="px-2 sm:px-4 py-2 sm:py-3">
                            <div class="flex flex-col">
                                <span
                                    class="text-[11px] sm:text-sm font-bold text-black line-clamp-1 leading-tight"><?php echo e($item->judul); ?></span>
                                <span
                                    class="text-[9px] sm:text-[11px] text-slate-900 line-clamp-1 mt-0.5"><?php echo e(Str::limit(strip_tags($item->deskripsi), 150)); ?></span>
                            </div>
                        </td>
                        <td class="px-2 sm:px-4 py-2 sm:py-3 text-center">
                            <div class="flex flex-col items-center gap-1 sm:gap-1.5">
                                <?php if (isset($component)) { $__componentOriginal7fa95ce53b108be002cc50811befd399 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7fa95ce53b108be002cc50811befd399 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.ui.badge','data' => ['variant' => $item->status,'class' => 'scale-75 sm:scale-100 origin-center']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->status),'class' => 'scale-75 sm:scale-100 origin-center']); ?>
                                    <?php echo e(ucfirst($item->status)); ?>

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
                                <?php if($item->is_highlight): ?>
                                    <?php if (isset($component)) { $__componentOriginal7fa95ce53b108be002cc50811befd399 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7fa95ce53b108be002cc50811befd399 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.ui.badge','data' => ['variant' => 'highlight','class' => 'scale-75 sm:scale-100 origin-center !text-[10px] sm:!text-[11px]']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'highlight','class' => 'scale-75 sm:scale-100 origin-center !text-[10px] sm:!text-[11px]']); ?>
                                        Highlight
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
                                <?php endif; ?>
                            </div>
                        </td>
                        <td class="px-2 sm:px-4 py-2 sm:py-3 text-center text-black">
                            <div class="flex flex-col sm:flex-row items-center justify-center sm:gap-2 whitespace-nowrap">
                                <span
                                    class="text-[9px] sm:text-xs font-semibold text-black"><?php echo e($item->tanggal_publikasi ? $item->tanggal_publikasi->format('m/d/Y') : '-'); ?></span>
                                <?php if($item->tanggal_publikasi): ?>
                                    <div class="hidden sm:block w-px h-3 bg-black"></div>
                                    <span
                                        class="text-[9px] sm:text-xs font-semibold text-black"><?php echo e($item->tanggal_publikasi->format('H:i')); ?></span>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td class="px-2 sm:px-4 py-2 sm:py-3">
                            <div class="flex items-center justify-center gap-1 sm:gap-2">
                                <?php if($isLocked): ?>
                                    <?php if (isset($component)) { $__componentOriginala0276693788c189e10dfd0bfb3860e87 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala0276693788c189e10dfd0bfb3860e87 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.form.button','data' => ['variant' => 'edit','type' => 'button','disabled' => true,'class' => '!p-1.5 sm:!p-2 !bg-slate-300 !text-slate-600 cursor-not-allowed hover:!bg-slate-300','title' => 'Tidak bisa diubah sebelum waktu publish']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.form.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'edit','type' => 'button','disabled' => true,'class' => '!p-1.5 sm:!p-2 !bg-slate-300 !text-slate-600 cursor-not-allowed hover:!bg-slate-300','title' => 'Tidak bisa diubah sebelum waktu publish']); ?>
                                         <?php $__env->slot('icon', null, []); ?> 
                                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                                </path>
                                            </svg>
                                         <?php $__env->endSlot(); ?>
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
                                <?php else: ?>
                                    <?php if (isset($component)) { $__componentOriginala0276693788c189e10dfd0bfb3860e87 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala0276693788c189e10dfd0bfb3860e87 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.form.button','data' => ['variant' => 'edit','href' => ''.e(route('admin.konten.berita.edit', $item->id)).'','class' => '!p-1.5 sm:!p-2','title' => 'Ubah']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.form.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'edit','href' => ''.e(route('admin.konten.berita.edit', $item->id)).'','class' => '!p-1.5 sm:!p-2','title' => 'Ubah']); ?>
                                         <?php $__env->slot('icon', null, []); ?> 
                                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                         <?php $__env->endSlot(); ?>
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
                                <?php endif; ?>

                                <?php if (isset($component)) { $__componentOriginala0276693788c189e10dfd0bfb3860e87 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala0276693788c189e10dfd0bfb3860e87 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.form.button','data' => ['variant' => 'delete','class' => '!p-1.5 sm:!p-2','title' => 'Hapus','dataNewsDelete' => true,'dataNewsId' => ''.e($item->id).'','dataNewsTitle' => ''.e($item->judul).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.form.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'delete','class' => '!p-1.5 sm:!p-2','title' => 'Hapus','data-news-delete' => true,'data-news-id' => ''.e($item->id).'','data-news-title' => ''.e($item->judul).'']); ?>
                                     <?php $__env->slot('icon', null, []); ?> 
                                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                     <?php $__env->endSlot(); ?>
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
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal722fc7edbde74caa9ff525bc9925b331)): ?>
<?php $attributes = $__attributesOriginal722fc7edbde74caa9ff525bc9925b331; ?>
<?php unset($__attributesOriginal722fc7edbde74caa9ff525bc9925b331); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal722fc7edbde74caa9ff525bc9925b331)): ?>
<?php $component = $__componentOriginal722fc7edbde74caa9ff525bc9925b331; ?>
<?php unset($__componentOriginal722fc7edbde74caa9ff525bc9925b331); ?>
<?php endif; ?>
        </div>
    </div>

    
    <div x-show="view === 'grid'" data-admin-view-panel="grid">
        <?php if (isset($component)) { $__componentOriginal81577aaa19c88b5c8d2f51c900327654 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal81577aaa19c88b5c8d2f51c900327654 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.ui.grid','data' => ['cols' => 'grid-cols-1 sm:grid-cols-2 lg:grid-cols-3']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.grid'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['cols' => 'grid-cols-1 sm:grid-cols-2 lg:grid-cols-3']); ?>
            <?php $__currentLoopData = $berita; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $isLocked = $item->tanggal_publikasi && $item->tanggal_publikasi->isFuture();
                ?>
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition-all group relative flex flex-col h-full"
                    data-admin-item="grid" data-id="<?php echo e($item->id); ?>" data-status="<?php echo e($item->status); ?>"
                    data-title="<?php echo e($item->judul); ?>" data-search="<?php echo e($item->judul); ?> <?php echo e(strip_tags($item->deskripsi)); ?>">
                    <div class="relative aspect-video overflow-hidden shrink-0">
                        <?php if($item->thumbnail): ?>
                            <img src="<?php echo e(asset('storage/' . $item->thumbnail)); ?>" alt="Thumbnail"
                                class="w-full h-full object-cover">
                        <?php else: ?>
                            <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="p-5 flex flex-col flex-grow min-h-[180px]">
                        <div class="mb-3 flex flex-wrap gap-1.5">
                            <?php if (isset($component)) { $__componentOriginal7fa95ce53b108be002cc50811befd399 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7fa95ce53b108be002cc50811befd399 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.ui.badge','data' => ['variant' => $item->status,'class' => '!px-2 !py-0.5 text-[9px] font-bold']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->status),'class' => '!px-2 !py-0.5 text-[9px] font-bold']); ?>
                                <?php echo e(ucfirst($item->status)); ?>

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
                            <?php if($item->is_highlight): ?>
                                <?php if (isset($component)) { $__componentOriginal7fa95ce53b108be002cc50811befd399 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7fa95ce53b108be002cc50811befd399 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.ui.badge','data' => ['variant' => 'highlight','class' => '!px-2 !py-0.5 text-[9px] font-bold']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'highlight','class' => '!px-2 !py-0.5 text-[9px] font-bold']); ?>
                                    Highlight
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
                            <?php endif; ?>
                        </div>

                        <div class="flex-grow space-y-1.5">
                            <h4
                                class="text-[12px] sm:text-[15px] font-bold text-black line-clamp-2 leading-tight h-[2.6em] text-justify">
                                <?php echo e($item->judul); ?>

                            </h4>
                            <p class="text-[10px] sm:text-[11px] text-slate-900 line-clamp-3 leading-relaxed mt-2 text-justify">
                                <?php echo e(Str::limit(strip_tags($item->deskripsi), 150)); ?>

                            </p>
                        </div>

                        <div class="mt-4 flex items-center justify-between gap-2">
                            <div class="flex items-center gap-2 text-[9px] sm:text-[11px] text-black font-medium">
                                <div class="flex items-center gap-1">
                                    <svg class="w-2.5 h-2.5 sm:w-3.5 sm:h-3.5 text-black" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span><?php echo e($item->tanggal_publikasi ? $item->tanggal_publikasi->format('m/d/Y') : '-'); ?></span>
                                </div>
                                <div class="w-[1px] h-2.5 bg-black"></div>
                                <div class="flex items-center gap-1">
                                    <svg class="w-2.5 h-2.5 sm:w-3.5 sm:h-3.5 text-black" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span><?php echo e($item->status === 'draft' ? '-' : ($item->tanggal_publikasi ? $item->tanggal_publikasi->format('H:i') : '-')); ?></span>
                                </div>
                            </div>

                            <div class="flex gap-1 sm:gap-1.5">
                                <?php if($isLocked): ?>
                                    <?php if (isset($component)) { $__componentOriginala0276693788c189e10dfd0bfb3860e87 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala0276693788c189e10dfd0bfb3860e87 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.form.button','data' => ['variant' => 'edit','type' => 'button','disabled' => true,'class' => '!p-1.5 sm:!p-2 !bg-slate-300 !text-slate-600 cursor-not-allowed hover:!bg-slate-300','title' => 'Tidak bisa diubah sebelum waktu publish']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.form.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'edit','type' => 'button','disabled' => true,'class' => '!p-1.5 sm:!p-2 !bg-slate-300 !text-slate-600 cursor-not-allowed hover:!bg-slate-300','title' => 'Tidak bisa diubah sebelum waktu publish']); ?>
                                         <?php $__env->slot('icon', null, []); ?> 
                                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                                </path>
                                            </svg>
                                         <?php $__env->endSlot(); ?>
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
                                <?php else: ?>
                                    <?php if (isset($component)) { $__componentOriginala0276693788c189e10dfd0bfb3860e87 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala0276693788c189e10dfd0bfb3860e87 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.form.button','data' => ['variant' => 'edit','href' => ''.e(route('admin.konten.berita.edit', $item->id)).'','class' => '!p-1.5 sm:!p-2','title' => 'Ubah']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.form.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'edit','href' => ''.e(route('admin.konten.berita.edit', $item->id)).'','class' => '!p-1.5 sm:!p-2','title' => 'Ubah']); ?>
                                         <?php $__env->slot('icon', null, []); ?> 
                                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                         <?php $__env->endSlot(); ?>
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
                                <?php endif; ?>
                                <?php if (isset($component)) { $__componentOriginala0276693788c189e10dfd0bfb3860e87 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala0276693788c189e10dfd0bfb3860e87 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.form.button','data' => ['variant' => 'delete','class' => '!p-1.5 sm:!p-2','title' => 'Hapus','dataNewsDelete' => true,'dataNewsId' => ''.e($item->id).'','dataNewsTitle' => ''.e($item->judul).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.form.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'delete','class' => '!p-1.5 sm:!p-2','title' => 'Hapus','data-news-delete' => true,'data-news-id' => ''.e($item->id).'','data-news-title' => ''.e($item->judul).'']); ?>
                                     <?php $__env->slot('icon', null, []); ?> 
                                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                     <?php $__env->endSlot(); ?>
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
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal81577aaa19c88b5c8d2f51c900327654)): ?>
<?php $attributes = $__attributesOriginal81577aaa19c88b5c8d2f51c900327654; ?>
<?php unset($__attributesOriginal81577aaa19c88b5c8d2f51c900327654); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal81577aaa19c88b5c8d2f51c900327654)): ?>
<?php $component = $__componentOriginal81577aaa19c88b5c8d2f51c900327654; ?>
<?php unset($__componentOriginal81577aaa19c88b5c8d2f51c900327654); ?>
<?php endif; ?>
    </div>
<?php else: ?>
    <?php
        $hasSearch = request()->filled('search');
        $hasFilter = request()->filled('status') || request()->filled('sort');
    ?>
    <?php if($hasSearch && $hasFilter): ?>
        <div class="min-h-[300px] sm:min-h-[360px] flex flex-col items-center justify-center text-center">
            <svg class="w-24 h-24 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
            </svg>
            <p class="text-sm font-semibold text-black mb-1">Data tidak ditemukan.</p>
            <p class="text-sm text-black mb-6 max-w-xs">Tidak ada berita yang cocok dengan pencarian
                "<?php echo e(request('search')); ?>" dan filter yang dipilih.</p>
        </div>
    <?php elseif($hasSearch): ?>
        <div class="min-h-[300px] sm:min-h-[360px] flex flex-col items-center justify-center text-center">
            <svg class="w-24 h-24 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
            </svg>
            <p class="text-sm font-semibold text-black mb-1">Hasil pencarian tidak ditemukan.</p>
            <p class="text-sm text-black/60 mb-6 max-w-xs">Tidak ada berita yang sesuai dengan pencarian
                "<?php echo e(request('search')); ?>".</p>
        </div>
    <?php elseif($hasFilter): ?>
        <div class="min-h-[300px] sm:min-h-[360px] flex flex-col items-center justify-center text-center">
            <svg class="w-24 h-24 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
            </svg>
            <p class="text-sm font-semibold text-black mb-1">Data tidak ditemukan.</p>
            <p class="text-sm text-black/60 mb-6 max-w-xs">Tidak ada berita yang cocok dengan filter yang dipilih.</p>
        </div>
    <?php else: ?>
        <div class="min-h-[300px] sm:min-h-[360px] flex flex-col items-center justify-center text-center">
            <svg class="w-24 h-24 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
            </svg>
            <p class="text-sm text-black mb-6 max-w-xs">Mulai kelola informasi sekolah Anda dengan membuat berita pertama.
            </p>
            <?php if (isset($component)) { $__componentOriginala0276693788c189e10dfd0bfb3860e87 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala0276693788c189e10dfd0bfb3860e87 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.form.button','data' => ['variant' => 'add','href' => ''.e(route('admin.konten.berita.create')).'','dataAction' => 'add-news']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.form.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'add','href' => ''.e(route('admin.konten.berita.create')).'','data-action' => 'add-news']); ?>
                 <?php $__env->slot('icon', null, []); ?> 
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                 <?php $__env->endSlot(); ?>
                Tambah Berita Pertama
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
    <?php endif; ?>
<?php endif; ?><?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/admin/partials/content/news/list.blade.php ENDPATH**/ ?>
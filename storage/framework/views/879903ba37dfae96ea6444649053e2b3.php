<?php $__env->startSection('title', 'Pesan Masuk'); ?>

<?php $__env->startSection('content'); ?>
    <div class="flex flex-col gap-3" data-page="inbox-list">
        
        <?php if (isset($component)) { $__componentOriginalfe7ff6290c4dd6e9c44a868826f51472 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfe7ff6290c4dd6e9c44a868826f51472 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.ui.page-header','data' => ['title' => 'Pesan Masuk','subtitle' => 'Daftar pesan yang dikirim melalui halaman kontak website']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Pesan Masuk','subtitle' => 'Daftar pesan yang dikirim melalui halaman kontak website']); ?>
             <?php $__env->slot('actions', null, []); ?> 
                <div class="flex items-center gap-2 sm:gap-3"></div>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.ui.card','data' => ['dataAdminList' => 'true','dataAdminListMode' => 'server','bodyClass' => 'p-0']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['data-admin-list' => 'true','data-admin-list-mode' => 'server','bodyClass' => 'p-0']); ?>
             <?php $__env->slot('header', null, []); ?> 
                <div class="flex flex-wrap gap-1.5 sm:gap-2 items-center">
                    <?php if (isset($component)) { $__componentOriginal9f71420b4ed7c1f765b52038d30434cb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9f71420b4ed7c1f765b52038d30434cb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.form.input-search','data' => ['placeholder' => 'Cari pesan...','name' => 'search','value' => ''.e(request('search')).'','autocomplete' => 'off']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.form.input-search'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['placeholder' => 'Cari pesan...','name' => 'search','value' => ''.e(request('search')).'','autocomplete' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('off')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9f71420b4ed7c1f765b52038d30434cb)): ?>
<?php $attributes = $__attributesOriginal9f71420b4ed7c1f765b52038d30434cb; ?>
<?php unset($__attributesOriginal9f71420b4ed7c1f765b52038d30434cb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9f71420b4ed7c1f765b52038d30434cb)): ?>
<?php $component = $__componentOriginal9f71420b4ed7c1f765b52038d30434cb; ?>
<?php unset($__componentOriginal9f71420b4ed7c1f765b52038d30434cb); ?>
<?php endif; ?>

                    <div class="flex gap-1.5 sm:gap-2">
                        <?php if (isset($component)) { $__componentOriginal09b770d5fcf03bf9fffd31c74624d06b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal09b770d5fcf03bf9fffd31c74624d06b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.form.filter-sort','data' => ['name' => 'sort']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.form.filter-sort'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'sort']); ?>
                            <option value="latest" <?php echo e(request('sort', 'latest') === 'latest' ? 'selected' : ''); ?>>Terbaru</option>
                            <option value="oldest" <?php echo e(request('sort') === 'oldest' ? 'selected' : ''); ?>>Terlama</option>
                            <option value="az" <?php echo e(request('sort') === 'az' ? 'selected' : ''); ?>>A-Z</option>
                            <option value="za" <?php echo e(request('sort') === 'za' ? 'selected' : ''); ?>>Z-A</option>
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal09b770d5fcf03bf9fffd31c74624d06b)): ?>
<?php $attributes = $__attributesOriginal09b770d5fcf03bf9fffd31c74624d06b; ?>
<?php unset($__attributesOriginal09b770d5fcf03bf9fffd31c74624d06b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal09b770d5fcf03bf9fffd31c74624d06b)): ?>
<?php $component = $__componentOriginal09b770d5fcf03bf9fffd31c74624d06b; ?>
<?php unset($__componentOriginal09b770d5fcf03bf9fffd31c74624d06b); ?>
<?php endif; ?>
                    </div>
                </div>
             <?php $__env->endSlot(); ?>

            <?php if (isset($component)) { $__componentOriginal711bc76f6dcd7f8bc65b1953c579cb84 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal711bc76f6dcd7f8bc65b1953c579cb84 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.interaction.list-toolbar','data' => ['items' => $messages,'paginationId' => 'inbox-pagination-container']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.interaction.list-toolbar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($messages),'paginationId' => 'inbox-pagination-container']); ?>
                 <?php $__env->slot('dropdownItems', null, []); ?> 
                    <button type="button" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-50">Semua</button>
                    <button type="button" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-50">Tidak ada</button>
                    <button type="button" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-50">Dibaca</button>
                    <button type="button" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-50">Belum dibaca</button>
                 <?php $__env->endSlot(); ?>

                 <?php $__env->slot('defaultActions', null, []); ?> 
                    <button class="toolbar-btn-default p-2 text-gray-600 hover:bg-gray-100 rounded-full transition-colors" title="Tandai Semua Dibaca" data-url="<?php echo e(route('admin.interaksi.pesan-masuk.mark-all-read')); ?>" data-method="PUT">
                        <?php if (isset($component)) { $__componentOriginal29ef65940692c2912b6b050ab6ded59c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal29ef65940692c2912b6b050ab6ded59c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.ui.icons.mail-open','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.icons.mail-open'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal29ef65940692c2912b6b050ab6ded59c)): ?>
<?php $attributes = $__attributesOriginal29ef65940692c2912b6b050ab6ded59c; ?>
<?php unset($__attributesOriginal29ef65940692c2912b6b050ab6ded59c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal29ef65940692c2912b6b050ab6ded59c)): ?>
<?php $component = $__componentOriginal29ef65940692c2912b6b050ab6ded59c; ?>
<?php unset($__componentOriginal29ef65940692c2912b6b050ab6ded59c); ?>
<?php endif; ?>
                    </button>
                 <?php $__env->endSlot(); ?>

                 <?php $__env->slot('bulkActions', null, []); ?> 
                    <button class="p-2 text-gray-600 hover:text-red-600 hover:bg-gray-100 rounded-full transition-colors" title="Hapus Terpilih">
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
                    </button>

                    <button id="bulk-toggle-status-btn" class="p-2 text-gray-600 hover:text-black hover:bg-gray-100 rounded-full transition-colors" title="Tandai Dibaca">
                        <?php if (isset($component)) { $__componentOriginal29ef65940692c2912b6b050ab6ded59c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal29ef65940692c2912b6b050ab6ded59c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.ui.icons.mail-open','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.icons.mail-open'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal29ef65940692c2912b6b050ab6ded59c)): ?>
<?php $attributes = $__attributesOriginal29ef65940692c2912b6b050ab6ded59c; ?>
<?php unset($__attributesOriginal29ef65940692c2912b6b050ab6ded59c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal29ef65940692c2912b6b050ab6ded59c)): ?>
<?php $component = $__componentOriginal29ef65940692c2912b6b050ab6ded59c; ?>
<?php unset($__componentOriginal29ef65940692c2912b6b050ab6ded59c); ?>
<?php endif; ?>
                    </button>
                 <?php $__env->endSlot(); ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal711bc76f6dcd7f8bc65b1953c579cb84)): ?>
<?php $attributes = $__attributesOriginal711bc76f6dcd7f8bc65b1953c579cb84; ?>
<?php unset($__attributesOriginal711bc76f6dcd7f8bc65b1953c579cb84); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal711bc76f6dcd7f8bc65b1953c579cb84)): ?>
<?php $component = $__componentOriginal711bc76f6dcd7f8bc65b1953c579cb84; ?>
<?php unset($__componentOriginal711bc76f6dcd7f8bc65b1953c579cb84); ?>
<?php endif; ?>

            <div id="inbox-list-container">
            <?php if($messages->count() > 0): ?>
                <div class="h-[500px] overflow-y-auto">
                    
                    <div class="flex flex-col border-t border-gray-200">
                        <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="message-row group flex items-center px-3 sm:px-4 py-2 border-b border-gray-200 hover:shadow-[0_1px_3px_0_rgba(60,64,67,0.3),0_4px_8px_3px_rgba(60,64,67,0.15)] hover:z-10 relative transition-shadow cursor-pointer <?php echo e($message->status === 'unread' ? 'bg-white font-bold' : 'bg-gray-50/50 font-normal'); ?>"
                                data-status="<?php echo e($message->status); ?>"
                                onclick="if(!event.target.closest('.message-checkbox-container') && !event.target.closest('button') && !event.target.closest('input') && !event.target.closest('a')) window.location='<?php echo e(route('admin.interaksi.pesan-masuk.show', $message->id)); ?>'">
                                
                                
                                <div class="flex items-stretch h-8 flex-shrink-0 message-checkbox-container z-20 relative" onclick="event.stopPropagation()">
                                    <div class="px-2 rounded-sm hover:bg-gray-200 cursor-pointer flex items-center justify-center transition-colors" onclick="this.querySelector('input').click()">
                                        <div class="w-4 h-4 border-2 border-gray-500 rounded sm:w-4 sm:h-4 flex items-center justify-center bg-white relative pointer-events-none">
                                            <input type="checkbox" class="message-checkbox w-full h-full opacity-0 cursor-pointer absolute z-10 pointer-events-auto" value="<?php echo e($message->id); ?>" onclick="event.stopPropagation()">
                                            <svg class="w-3 h-3 text-gray-600 hidden checked-icon pointer-events-none" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg>
                                        </div>
                                    </div>
                                </div>

                                
                                <div class="w-[7.5rem] sm:w-[9.5rem] md:w-[11.5rem] flex-shrink-0 font-roboto-slab truncate text-xs sm:text-sm <?php echo e($message->status === 'unread' ? 'font-bold text-black' : 'text-black/70'); ?>">
                                    <?php echo e($message->nama); ?>

                                </div>

                                
                                <div class="flex-1 min-w-0 font-roboto-slab grid grid-cols-[auto_1fr] items-center gap-1">
                                    
                                    <span class="truncate text-xs sm:text-sm <?php echo e($message->status === 'unread' ? 'font-bold text-black' : 'text-black/70'); ?>">
                                        <?php echo e($message->subject); ?>

                                    </span>
                                    
                                    <span class="text-xs sm:text-sm text-black font-normal truncate">
                                        - <?php echo e($message->pesan); ?>

                                    </span>
                                </div>

                                
                                <div class="w-24 sm:w-32 flex-shrink-0 text-right px-2 flex items-center justify-end relative">
                                    
                                    <span class="text-[10px] sm:text-xs whitespace-nowrap group-hover:hidden <?php echo e($message->status === 'unread' ? 'text-black' : 'text-black/60 font-normal'); ?>">
                                        <?php if($message->tanggal->isToday()): ?>
                                            <?php echo e($message->tanggal->format('H:i')); ?>

                                        <?php elseif($message->tanggal->isCurrentYear()): ?>
                                            <?php echo e($message->tanggal->format('M d')); ?>

                                        <?php else: ?>
                                            <?php echo e($message->tanggal->format('j/n/y')); ?>

                                        <?php endif; ?>
                                    </span>

                                    
                                    <div class="hidden group-hover:flex items-center justify-end gap-1 absolute right-2 top-1/2 -translate-y-1/2 pl-2">
                                        <form action="<?php echo e(route('admin.interaksi.pesan-masuk.destroy', $message->id)); ?>" method="POST" onsubmit="return confirm('Hapus pesan ini?');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="p-2 text-gray-500 hover:text-red-600 hover:bg-gray-100 rounded-full transition-colors" title="Hapus" onclick="event.stopPropagation()">
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
                                            </button>
                                        </form>
                                        
                                        <?php if($message->status === 'read'): ?>
                                            <button type="button" 
                                                data-url="<?php echo e(route('admin.interaksi.pesan-masuk.mark-unread', $message->id)); ?>"
                                                data-method="PUT"
                                                class="action-btn-ajax p-2 text-gray-500 hover:text-black hover:bg-gray-100 rounded-full transition-colors" title="Tandai Belum Dibaca">
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
                                            </button>
                                        <?php else: ?>
                                            <button type="button" 
                                                data-url="<?php echo e(route('admin.interaksi.pesan-masuk.mark-read', $message->id)); ?>"
                                                data-method="PUT"
                                                class="action-btn-ajax p-2 text-gray-500 hover:text-black hover:bg-gray-100 rounded-full transition-colors" title="Tandai Sudah Dibaca">
                                                <?php if (isset($component)) { $__componentOriginal29ef65940692c2912b6b050ab6ded59c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal29ef65940692c2912b6b050ab6ded59c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.ui.icons.mail-open','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.icons.mail-open'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal29ef65940692c2912b6b050ab6ded59c)): ?>
<?php $attributes = $__attributesOriginal29ef65940692c2912b6b050ab6ded59c; ?>
<?php unset($__attributesOriginal29ef65940692c2912b6b050ab6ded59c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal29ef65940692c2912b6b050ab6ded59c)): ?>
<?php $component = $__componentOriginal29ef65940692c2912b6b050ab6ded59c; ?>
<?php unset($__componentOriginal29ef65940692c2912b6b050ab6ded59c); ?>
<?php endif; ?>
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php else: ?>
                <?php
                    $hasSearch = request()->filled('search');
                    // Only consider sort a filter if it's NOT the default 'latest'
                    $hasFilter = request()->filled('status') || (request()->filled('sort') && request('sort') !== 'latest');
                ?>
                <?php if($hasSearch && $hasFilter): ?>
                    <div class="min-h-[300px] sm:min-h-[360px] flex flex-col items-center justify-center text-center">
                        <svg class="w-24 h-24 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                        <p class="text-sm font-semibold text-black mb-1">Data tidak ditemukan.</p>
                        <p class="text-sm text-black/60 mb-6 max-w-xs">Tidak ada pesan yang cocok dengan pencarian
                            "<?php echo e(request('search')); ?>" dan filter yang dipilih.</p>
                    </div>
                <?php elseif($hasSearch): ?>
                    <div class="min-h-[300px] sm:min-h-[360px] flex flex-col items-center justify-center text-center">
                        <svg class="w-24 h-24 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                        <p class="text-sm font-semibold text-black mb-1">Hasil pencarian tidak ditemukan.</p>
                        <p class="text-sm text-black/60 mb-6 max-w-xs">Tidak ada pesan yang sesuai dengan pencarian
                            "<?php echo e(request('search')); ?>".</p>
                    </div>
                <?php elseif($hasFilter): ?>
                    <div class="min-h-[300px] sm:min-h-[360px] flex flex-col items-center justify-center text-center">
                        <svg class="w-24 h-24 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                        <p class="text-sm font-semibold text-black mb-1">Data tidak ditemukan.</p>
                        <p class="text-sm text-black/60 mb-6 max-w-xs">Tidak ada pesan yang cocok dengan filter yang dipilih.</p>
                    </div>
                <?php else: ?>
                    <div class="py-28 flex flex-col items-center justify-center text-center">
                        
                        <svg class="w-24 h-24 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>

                        
                        <p class="text-sm text-black/60 mb-6 max-w-xs">Belum ada pesan yang masuk. Semua pertanyaan atau masukan
                            dari pengunjung website akan muncul di sini.</p>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            </div>
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

<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/admin/pages/interaction/messages/index.blade.php ENDPATH**/ ?>
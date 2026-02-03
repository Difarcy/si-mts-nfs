<?php $__env->startSection('title', 'Berita'); ?>

<?php $__env->startSection('content'); ?>
    <div class="flex flex-col gap-3" data-page="news-list">
        
        <?php if (isset($component)) { $__componentOriginalfe7ff6290c4dd6e9c44a868826f51472 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfe7ff6290c4dd6e9c44a868826f51472 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.ui.page-header','data' => ['title' => 'Berita','subtitle' => 'Kelola informasi berita terbaru sekolah Anda']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Berita','subtitle' => 'Kelola informasi berita terbaru sekolah Anda']); ?>
             <?php $__env->slot('actions', null, []); ?> 
                <?php if($berita->count() > 0): ?>
                    <?php if (isset($component)) { $__componentOriginala0276693788c189e10dfd0bfb3860e87 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala0276693788c189e10dfd0bfb3860e87 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.form.button','data' => ['variant' => 'add','href' => ''.e(route('admin.konten.berita.create')).'','dataAction' => 'add-news','class' => 'sm:w-24']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.form.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'add','href' => ''.e(route('admin.konten.berita.create')).'','data-action' => 'add-news','class' => 'sm:w-24']); ?>
                         <?php $__env->slot('icon', null, []); ?> 
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                         <?php $__env->endSlot(); ?>
                        Tambah
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.ui.card','data' => ['dataAdminList' => 'true','dataAdminListMode' => 'server','xData' => '{ 
                view: localStorage.getItem(\'admin_view_type:news\') || localStorage.getItem(\'admin_view_type\') || \'table\' 
            }','xInit' => '$watch(\'view\', value => { localStorage.setItem(\'admin_view_type:news\', value); document.documentElement.dataset.adminViewType = value; })','bodyClass' => 'p-3 sm:p-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['data-admin-list' => 'true','data-admin-list-mode' => 'server','x-data' => '{ 
                view: localStorage.getItem(\'admin_view_type:news\') || localStorage.getItem(\'admin_view_type\') || \'table\' 
            }','x-init' => '$watch(\'view\', value => { localStorage.setItem(\'admin_view_type:news\', value); document.documentElement.dataset.adminViewType = value; })','bodyClass' => 'p-3 sm:p-4']); ?>
             <?php $__env->slot('header', null, []); ?> 
                <div class="flex flex-wrap gap-1.5 sm:gap-2 items-center">
                    <?php if (isset($component)) { $__componentOriginal9f71420b4ed7c1f765b52038d30434cb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9f71420b4ed7c1f765b52038d30434cb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.form.input-search','data' => ['placeholder' => 'Cari berita...','name' => 'search','value' => ''.e(request('search')).'','autocomplete' => 'off']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.form.input-search'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['placeholder' => 'Cari berita...','name' => 'search','value' => ''.e(request('search')).'','autocomplete' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('off')]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.form.filter-sort','data' => ['name' => 'status']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.form.filter-sort'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'status']); ?>
                            <option value="">Semua Status</option>
                            <option value="publish" <?php echo e(request('status') === 'publish' ? 'selected' : ''); ?>>Publish</option>
                            <option value="draft" <?php echo e(request('status') === 'draft' ? 'selected' : ''); ?>>Draft</option>
                            <option value="nonaktif" <?php echo e(request('status') === 'nonaktif' ? 'selected' : ''); ?>>Nonaktif
                            </option>
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
                            <option value="latest" <?php echo e(request('sort', 'latest') === 'latest' ? 'selected' : ''); ?>>Terbaru
                            </option>
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

                    <?php if (isset($component)) { $__componentOriginal4438ec70cf51c1de794a3afae1fa266a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4438ec70cf51c1de794a3afae1fa266a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin.components.ui.view-switcher','data' => ['activeView' => 'view']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.view-switcher'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['activeView' => 'view']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4438ec70cf51c1de794a3afae1fa266a)): ?>
<?php $attributes = $__attributesOriginal4438ec70cf51c1de794a3afae1fa266a; ?>
<?php unset($__attributesOriginal4438ec70cf51c1de794a3afae1fa266a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4438ec70cf51c1de794a3afae1fa266a)): ?>
<?php $component = $__componentOriginal4438ec70cf51c1de794a3afae1fa266a; ?>
<?php unset($__componentOriginal4438ec70cf51c1de794a3afae1fa266a); ?>
<?php endif; ?>
                </div>
             <?php $__env->endSlot(); ?>

            <div id="news-list-container">
                <?php echo $__env->make('admin.partials.content.news.list', ['berita' => $berita], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>

             <?php $__env->slot('footer', null, []); ?> 
                <div id="news-pagination-container">
                    <?php echo $__env->make('admin.partials.content.news.pagination', ['berita' => $berita], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/admin/pages/content/news/index.blade.php ENDPATH**/ ?>
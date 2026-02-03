<?php
    $now = \Carbon\Carbon::now();
    $selectedMonth = (int) request()->get('cal_month', $now->month);
    $selectedYear = (int) request()->get('cal_year', $now->year);

    // Validate month and year
    $selectedMonth = max(1, min(12, $selectedMonth));
    $selectedYear = max(2000, min(2100, $selectedYear));

    $firstDay = \Carbon\Carbon::create($selectedYear, $selectedMonth, 1);
    $lastDay = $firstDay->copy()->endOfMonth();
    $startDate = $firstDay->copy()->startOfWeek(\Carbon\CarbonInterface::SUNDAY);
    $endDate = $lastDay->copy()->endOfWeek(\Carbon\CarbonInterface::SATURDAY);

    $monthsNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $daysShort = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
?>

<div class="animate-on-scroll">
    <?php if (isset($component)) { $__componentOriginal6a101a87b680dc09f4f04cda5e74cfd1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6a101a87b680dc09f4f04cda5e74cfd1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'website.components.layout.page-title','data' => ['title' => 'Kalender','tag' => 'h3','margin' => 'mb-6']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('website.components.layout.page-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Kalender','tag' => 'h3','margin' => 'mb-6']); ?>
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

    <div class="bg-white border border-gray-100 shadow-sm overflow-hidden" data-calendar-init="true"
        data-selected-month="<?php echo e($selectedMonth); ?>" data-selected-year="<?php echo e($selectedYear); ?>"
        data-now-year="<?php echo e($now->year); ?>" data-now-month="<?php echo e($now->month); ?>" data-now-day="<?php echo e($now->day); ?>">

        <!-- Header: Month & Navigation -->
        <div class="bg-green-700 px-4 py-3 flex items-center justify-between text-white">
            <button type="button" data-calendar-action="prev"
                class="p-1.5 hover:bg-white/20 rounded-lg transition-colors focus:outline-none group"
                aria-label="Bulan Sebelumnya">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <div class="text-center">
                <h4 id="calendar-title"
                    class="text-xs sm:text-sm font-bold uppercase tracking-widest whitespace-nowrap">
                    <?php echo e($monthsNames[$selectedMonth - 1]); ?> <?php echo e($selectedYear); ?>

                </h4>
            </div>

            <button type="button" data-calendar-action="next"
                class="p-1.5 hover:bg-white/20 rounded-lg transition-colors focus:outline-none group"
                aria-label="Bulan Selanjutnya">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>

        <div class="p-3">
            <!-- Day Names -->
            <div class="grid grid-cols-7 mb-2">
                <?php $__currentLoopData = $daysShort; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex items-center justify-center py-1">
                        <span
                            class="text-[10px] sm:text-xs font-bold <?php echo e($day === 'Min' ? 'text-red-500' : 'text-black'); ?> uppercase tracking-tighter">
                            <?php echo e($day); ?>

                        </span>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Calendar Days -->
            <div id="calendar-grid" class="grid grid-cols-7 border-t border-l border-gray-50">
                <?php $currentDate = $startDate->copy(); ?>
                <?php while($currentDate <= $endDate): ?>
                    <?php
                        $isCurrentMonth = $currentDate->month == $selectedMonth;
                        $isToday = $currentDate->isToday() && $currentDate->month == $now->month && $currentDate->year == $now->year;
                        $isSunday = $currentDate->dayOfWeek == 0;
                    ?>
                    <div class="aspect-square border-r border-b border-gray-50 p-0.5 relative group">
                        <div data-date="<?php echo e($currentDate->format('Y-m-d')); ?>"
                            class="w-full h-full flex flex-col items-center justify-center rounded transition-all duration-200 cursor-pointer
                                                                <?php echo e($isCurrentMonth ? ($isSunday ? 'text-red-500' : 'text-gray-700') : 'text-gray-300'); ?>

                                                                <?php echo e($isToday ? 'bg-green-700 text-white font-bold' : 'hover:bg-green-50 hover:text-green-700'); ?>">

                            <span
                                class="text-[10px] sm:text-sm <?php echo e($isToday ? 'scale-110' : ''); ?> pointer-events-none"><?php echo e($currentDate->day); ?></span>

                            <?php if($isToday): ?>
                                <span class="absolute top-1 right-1 w-1.5 h-1.5 bg-white rounded-full animate-pulse pointer-events-none"></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php $currentDate->addDay(); ?>
                <?php endwhile; ?>
            </div>
        </div>

        <!-- Footer Legend / Info -->
        <div class="bg-gray-50 px-3 py-2 border-t border-gray-100 flex items-center justify-between">
            <div class="flex items-center gap-1.5">
                <span class="w-2 h-2 bg-green-700 rounded-full"></span>
                <span class="text-[10px] text-gray-500 font-medium">Hari Ini</span>
            </div>
            <div class="flex items-center gap-1.5">
                <span class="w-2 h-2 bg-black rounded-full"></span>
                <span class="text-[10px] text-gray-500 font-medium">Libur/Ahad</span>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/website/components/content/calendar-widget.blade.php ENDPATH**/ ?>
<section class="py-12 md:py-20 bg-gray-50 scroll-mt-20" id="jadwal">
    <div class="container mx-auto px-4">
        <div class="text-center mb-10 md:mb-16 scroll-animate">
            <div
                class="inline-block bg-green-700 text-white font-black text-lg sm:text-2xl md:text-2xl px-6 md:px-10 py-2.5 md:py-3 transform -skew-x-12 uppercase shadow-lg mb-2">
                Alur & Jadwal Pendaftaran
            </div>
            <p class="text-black mt-4 max-w-2xl mx-auto text-xs md:text-base font-normal">Ikuti langkah-langkah berikut
                untuk melakukan pendaftaran siswa baru di
                <?php echo e($globalSchoolProfile?->nama_sekolah ?? 'MTs Nurul Falaah'); ?>.
            </p>
        </div>

        <?php
            $waveConfigs = [
                1 => [
                    'roman' => 'I',
                    'title' => 'Gelombang I',
                    'accent' => 'green',
                    'label' => 'JALUR UNGGULAN & PRESTASI',
                ],
                2 => [
                    'roman' => 'II',
                    'title' => 'Gelombang II',
                    'accent' => 'amber',
                    'label' => 'JALUR REGULER',
                ],
            ];

            $stages = [1, 2, 3, 4, 5];

            $formatDate = function ($date) {
                try {
                    return \Carbon\Carbon::parse($date)->format('d/m/Y');
                } catch (\Throwable $e) {
                    return null;
                }
            };
        ?>

        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 md:gap-16">
                <?php $__currentLoopData = $waveConfigs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wave => $cfg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $accent = $cfg['accent'];
                        $timelineLine = $accent === 'green' ? 'before:bg-green-100' : 'before:bg-amber-100';
                        $badgeBg = $accent === 'green' ? 'bg-green-50 text-green-700 border-green-100' : 'bg-amber-50 text-amber-700 border-amber-100';
                        $stepBorder = $accent === 'green' ? 'border-green-600 group-hover:bg-green-600' : 'border-amber-500 group-hover:bg-amber-500';
                        $stepText = $accent === 'green' ? 'text-green-700' : 'text-amber-600';
                        $stepRing = $accent === 'green' ? 'ring-green-100 bg-green-700' : 'ring-amber-100 bg-amber-500';
                    ?>

                    <div class="<?php echo e($wave === 2 ? 'mt-8 lg:mt-0' : ''); ?>">
                        <div class="flex items-center gap-3 md:gap-4 mb-8 md:mb-10">
                            <div
                                class="w-10 h-10 md:w-14 md:h-14 <?php echo e($stepRing); ?> text-white rounded-xl md:rounded-2xl flex items-center justify-center font-black text-lg md:text-2xl shadow-lg md:shadow-xl ring-4">
                                <?php echo e($cfg['roman']); ?>

                            </div>
                            <div>
                                <h3 class="text-lg md:text-2xl font-black text-gray-800 uppercase leading-none"><?php echo e($cfg['title']); ?></h3>
                                <p class="<?php echo e($accent === 'green' ? 'text-green-600' : 'text-amber-600'); ?> text-[9px] md:text-sm font-bold tracking-[0.1em] md:tracking-[0.2em] mt-1">
                                    <?php echo e($cfg['label']); ?>

                                </p>
                            </div>
                        </div>

                        <div class="space-y-0 relative before:absolute before:inset-0 before:ml-[19px] md:before:ml-[27px] before:w-0.5 <?php echo e($timelineLine); ?> before:pointer-events-none">
                            <?php $__currentLoopData = $stages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $nmKey = "g{$wave}t{$stage}nm";
                                    $stKey = "g{$wave}t{$stage}st";
                                    $enKey = "g{$wave}t{$stage}en";

                                    $nm = $spmb?->{$nmKey};
                                    $st = $spmb?->{$stKey};
                                    $en = $spmb?->{$enKey};

                                    $nmText = $nm ? $nm : 'Belum ada';
                                    $stText = $st ? $formatDate($st) : null;
                                    $enText = $en ? $formatDate($en) : null;
                                    $dateText = ($stText && $enText)
                                        ? ($stText . ' - ' . $enText)
                                        : (($stText || $enText) ? ($stText ?? $enText) : 'Belum diatur');
                                ?>

                                <div class="relative flex gap-5 md:gap-8 <?php echo e($stage === 5 ? '' : 'pb-8 md:pb-10'); ?> group">
                                    <div
                                        class="shrink-0 w-10 h-10 md:w-14 md:h-14 bg-white border-2 <?php echo e($stepBorder); ?> rounded-xl md:rounded-2xl flex items-center justify-center relative z-10 transition-all group-hover:text-white shadow-sm">
                                        <span class="font-black <?php echo e($accent === 'green' ? 'group-hover:text-white' : 'group-hover:text-white'); ?> text-sm md:text-lg"><?php echo e($stage); ?></span>
                                    </div>
                                    <div class="pt-0.5 md:pt-1">
                                        <p class="text-[9px] md:text-[10px] font-black <?php echo e($stepText); ?> uppercase tracking-widest mb-1">Tahap <?php echo e($stage); ?></p>
                                        <h4 class="text-base md:text-lg font-bold text-gray-900 mb-2 leading-tight"><?php echo e($nmText); ?></h4>
                                        <span class="inline-block px-2.5 py-0.5 md:px-3 md:py-1 <?php echo e($badgeBg); ?> rounded-full text-[10px] md:text-xs font-bold border">
                                            <?php echo e($dateText); ?>

                                        </span>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>
<?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/website/pages/spmb/sections/schedule.blade.php ENDPATH**/ ?>
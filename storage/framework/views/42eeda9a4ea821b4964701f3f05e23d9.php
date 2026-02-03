

<?php $__env->startSection('title', 'Beranda'); ?>

<?php $__env->startSection('hero'); ?>
    <section class="w-full relative overflow-hidden">
        <div class="relative group h-64 sm:h-112 md:h-128 lg:h-144 w-full overflow-hidden flex" data-banner-slider>
            <?php echo $__env->make('website.pages.home.sections.banner', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php echo $__env->make('website.pages.home.sections.hero-content', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
    </section>
    <?php echo $__env->make('website.pages.home.sections.info-ticker', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="space-y-4 sm:space-y-6">
        <?php echo $__env->make('website.pages.home.sections.highlight-news', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->make('website.pages.home.sections.latest-news', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->make('website.pages.home.sections.promosi-banner', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->make('website.pages.home.sections.latest-articles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->make('website.pages.home.sections.student-achievement', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->make('website.pages.home.sections.activity-photo', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->make('website.pages.home.sections.activity-video', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('sidebar'); ?>
    <?php echo $__env->make('website.components.content.headmaster-greeting', ['kepalaMadrasah' => $kepalaMadrasah ?? null], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('website.components.content.announcement-widget', ['infoTerkini' => $infoTerkini ?? collect()], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('website.components.content.agenda-widget', ['agendaTerbaru' => $agendaTerbaru ?? collect()], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('website.components.content.social-media-widget', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('website.components.content.category-widget', ['postCategories' => $postCategories ?? []], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('website.components.content.calendar-widget', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\si-mts-nfs\resources\views/website/pages/home/index.blade.php ENDPATH**/ ?>
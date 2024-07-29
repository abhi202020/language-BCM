<section id="why-choose" class="why-choose-section backgroud-style <?php echo e(isset($class) ? $class : ''); ?>">
    <div class="container">
        <div class="section-title mb20 headline text-center ">
            <span class="subtitle text-uppercase"><?php echo e(env('APP_NAME')); ?> <?php echo app('translator')->get('labels.frontend.layouts.partials.advantages'); ?></span>
            <h2>Reason <span>Why Choose <?php echo e(env('APP_NAME')); ?>.</span></h2>
        </div>
        <div class="extra-features-content">
            <div class="row">
                <?php $__currentLoopData = $reasons->take(9); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="extra-left-content col-md-4 col-sm-6">
                        <div class="extra-icon-text text-left">
                            <div class="features-icon gradient-bg text-center">
                                <i class="<?php echo e($item->icon); ?>"></i>
                            </div>
                            <div class="features-text">
                                <div class="features-text-title">
                                    <h3><?php echo e($item->title); ?></h3>
                                </div>
                                <div class="features-text-dec">
                                    <span><?php echo e($item->content); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <!-- // extra-left-content -->
            </div><!-- /row -->
        </div>
    </div>
</section>
<?php /**PATH C:\xampp\htdocs\language\resources\views\frontend\layouts\partials\why_choose_us.blade.php ENDPATH**/ ?>
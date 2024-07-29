<section id="sponsor" class="sponsor-section">
    <div class="container">
        <div class="section-title-2 mb65 headline text-left ">
            <h2><?php echo e(env('APP_NAME')); ?> <span><?php echo app('translator')->get('labels.frontend.layouts.partials.sponsors'); ?></span></h2>
        </div>
        <div class="sponsor-item sponsor-1 text-center">
            <?php $__currentLoopData = $sponsors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sponsor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="sponsor-pic text-center">
                    <a href="<?php echo e(($sponsor->link != "") ? $sponsor->link : '#'); ?>">
                        <img src=<?php echo e(asset("storage/uploads/".$sponsor->logo)); ?> alt="<?php echo e($sponsor->name); ?>">
                    </a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php /**PATH C:\xampp\htdocs\language\resources\views\frontend\layouts\partials\sponsors.blade.php ENDPATH**/ ?>
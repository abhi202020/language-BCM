<section id="testimonial_2" class="testimonial_2_section">
    <div class="container">
        <div class="testimonial-slide">
            <div class="section-title-2 mb65 headline text-left">
                <h2><?php echo app('translator')->get('labels.frontend.layouts.partials.students_testimonial'); ?></h2>
            </div>
            <?php if($testimonials->count() > 0): ?>

                <div id="testimonial-slide-item" class="testimonial-slide-area">
                    <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="student-qoute ">
                            <p><?php echo e($item->content); ?></p>
                            <div class="student-name-designation">
                                <span class="st-name bold-font"><?php echo e($item->name); ?> </span>
                                <span class="st-designation"><?php echo e($item->occupation); ?></span>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php /**PATH C:\xampp\htdocs\language\resources\views\frontend\layouts\partials\testimonial.blade.php ENDPATH**/ ?>
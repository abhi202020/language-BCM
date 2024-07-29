<?php $__env->startPush('after-styles'); ?>
    <style>
        .panel-group .panel-title .btn-link {
            width: 95%;
        }

        .panel-group .panel-title .btn-link:after {
            right: 0px;
        }

        .panel-group .panel-title .btn-link:before {
            right: 0px;
        }
    </style>
<?php $__env->stopPush(); ?>
<section id="faq" class="faq-section faq-secound-home-version faq_3 backgroud-style">
    <div class="container">
        <div class="section-title mb45 headline text-center ">
            <span class="subtitle text-uppercase"><?php echo e(env('APP_NAME')); ?> <?php echo app('translator')->get('labels.frontend.layouts.partials.faq'); ?></span>
            <h2><?php echo app('translator')->get('labels.frontend.layouts.partials.faq_full'); ?></h2>

        </div>

        <div class="faq-tab mb65">
            <div class="faq-tab-ques  ul-li">
                <div class="tab-button text-center mb65 ">
                    <ul class="product-tab">
                        <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li rel="tab<?php echo e($faq->id); ?>"><?php echo e($faq->name); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <!-- /tab-head -->

                <!-- tab content -->
                <div class="tab-container">
                    <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div id="tab<?php echo e($category->id); ?>" class="tab-content-1 pt35">
                            <div id="accordion" class="panel-group">
                                <div class="row ml-0 mr-0">
                                    <?php if(count($category->faqs) > 0): ?>
                                        <?php $__currentLoopData = $category->faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-md-6">
                                                <div class="panel">
                                                    <div class="panel-title"
                                                         id="heading<?php echo e($category->id.'-'.$item->id); ?>">
                                                        <h3 class="mb-0">
                                                            <button class="btn btn-link collapsed"
                                                                    data-toggle="collapse"
                                                                    data-target="#collapse<?php echo e($category->id.'-'.$item->id); ?>"
                                                                    aria-expanded="false"
                                                                    aria-controls="collapse<?php echo e($category->id.'-'.$item->id); ?>">
                                                                <?php echo e($item->question); ?>

                                                            </button>
                                                        </h3>
                                                    </div>

                                                    <div id="collapse<?php echo e($category->id.'-'.$item->id); ?>"
                                                         class="collapse "
                                                         aria-labelledby="heading<?php echo e($category->id.'-'.$item->id); ?>"
                                                         data-parent="#accordion">
                                                        <div class="panel-body">
                                                            <?php echo e($item->answer); ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div>
                                <!-- end of #accordion -->
                            </div>
                        </div>
                        <!-- #tab1 -->
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php /**PATH C:\xampp\htdocs\language\resources\views\frontend\layouts\partials\faq-with-bg.blade.php ENDPATH**/ ?>
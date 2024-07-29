

<?php $__env->startSection('title', trans('labels.frontend.home.title').' | '.app_name()); ?>
<?php $__env->startSection('meta_description', ''); ?>
<?php $__env->startSection('meta_keywords',''); ?>

<?php $__env->startSection('css'); ?>
    <style>
        .my-alert{
            top: 40%;
            position: absolute;
            right: 0;
            z-index: 1000;
            left: 0;
            margin: auto;
            width: 40%;
        }
        @media  only screen and  (max-width: 768px) {
            .my-alert{
                width: 100%;
            }
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if(session()->has('alert')): ?>
        <div class="alert alert-light alert-dismissible fade my-alert show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong><?php echo e(session('alert')); ?></strong>
        </div>
    <?php endif; ?>

    <!-- Start of slider section
    ============================================= -->
    <?php echo $__env->make('frontend.layouts.partials.slider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- End of slider section
            ============================================= -->


    <?php if($sections->counters->status == 1): ?>
        <!-- Start of Search Courses
        ============================================= -->
        <section id="search-course" class="search-course-section search-course-secound">
            <div class="container">
                <div class="search-counter-up">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="counter-icon-number ">
                                <div class="counter-icon">
                                    <i class="text-gradiant flaticon-graduation-hat"></i>
                                </div>
                                <div class="counter-number">
                                    <span class=" bold-font"><?php echo e($total_students); ?></span>
                                    <p><?php echo app('translator')->get('labels.frontend.home.students_enrolled'); ?></p>
                                </div>
                            </div>
                        </div>
                        <!-- /counter -->

                        <div class="col-md-4">
                            <div class="counter-icon-number ">
                                <div class="counter-icon">
                                    <i class="text-gradiant flaticon-book"></i>
                                </div>
                                <div class="counter-number">
                                    <span class="bold-font"><?php echo e($total_courses); ?></span>
                                    <p><?php echo app('translator')->get('labels.frontend.home.online_available_courses'); ?></p>
                                </div>
                            </div>
                        </div>
                        <!-- /counter -->

                        <div class="col-md-3">
                            <div class="counter-icon-number ">
                                <div class="counter-icon">
                                    <i class="text-gradiant flaticon-group"></i>
                                </div>
                                <div class="counter-number">
                                    <span class="bold-font"><?php echo e($total_teachers); ?></span>
                                    <p><?php echo app('translator')->get('labels.frontend.home.teachers'); ?></p>
                                </div>
                            </div>
                        </div>
                        <!-- /counter -->
                    </div>
                </div>
            </div>
        </section>
        <!-- End of Search Courses
            ============================================= -->
    <?php endif; ?>

    <?php if($sections->latest_news->status == 1): ?>
        <!-- Start latest section
        ============================================= -->
        <?php echo $__env->make('frontend.layouts.partials.latest_news',['pt'=>'pt-5'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- End latest section
            ============================================= -->
    <?php endif; ?>

    <?php if($sections->popular_courses->status == 1): ?>
        <?php echo $__env->make('frontend.layouts.partials.popular_courses',['class'=>'popular-three' ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>



    <?php if($sections->reasons->status == 1): ?>
        <!-- Start why choose section
        ============================================= -->
        <?php echo $__env->make('frontend.layouts.partials.why_choose_us', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- End why choose section
        ============================================= -->
    <?php endif; ?>



    <?php if($sections->featured_courses->status == 1): ?>
        <!-- Start of best course
        ============================================= -->
        <?php echo $__env->make('frontend.layouts.partials.browse_courses', ['class'=>'bg-white pb-5' ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- End of best course
            ============================================= -->
    <?php endif; ?>


    <?php if($sections->teachers->status == 1): ?>
        <!-- Start of genius teacher v2
        ============================================= -->
        <section id="genius-teacher-2" class="genius-teacher-section-2">
            <div class="container">
                <div class="section-title mb20  headline text-left">
                    <span class="subtitle ml42 text-uppercase"><?php echo app('translator')->get('labels.frontend.home.learn_new_skills'); ?></span>
                    <h2><?php echo app('translator')->get('labels.frontend.home.popular_teachers'); ?>.</h2>
                </div>
                <?php if(count($teachers)> 0): ?>
                    <div class="teacher-third-slide">
                        <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="teacher-double">
                                    <div class="teacher-img-content relative-position">
                                        <img height="210px" width="210px" src="<?php echo e($item->picture); ?>" alt="">
                                        <div class="teacher-cntent">
                                            <div class="teacher-social-name ul-li-block">
                                                <ul>
                                                    <li><a href="<?php echo e('mailto:'.$item->email); ?>"><i class="fa fa-envelope"></i></a></li>
                                                    <li><a href="<?php echo e(route('admin.messages',['teacher_id'=>$item->id])); ?>"><i class="fa fa-comments"></i></a></li>
                                                </ul>
                                                <div class="teacher-name">
                                                    <span><?php echo e($item->full_name); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>

    <?php if($sections->faq->status == 1): ?>
        <?php echo $__env->make('frontend.layouts.partials.faq-with-bg', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <?php if($sections->testimonial->status == 1): ?>
        <?php echo $__env->make('frontend.layouts.partials.testimonial', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>


    <?php if($sections->sponsors->status == 1): ?>
        <?php if(count($sponsors) > 0 ): ?>
            <?php echo $__env->make('frontend.layouts.partials.sponsors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    <?php endif; ?>


    <?php if($sections->course_by_category->status == 1): ?>
        <?php echo $__env->make('frontend.layouts.partials.course_by_category', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>


    <?php if($sections->contact_us->status == 1): ?>
        <?php echo $__env->make('frontend.layouts.partials.contact_area', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>


<?php $__env->stopSection(); ?>
<?php $__env->startPush('after-scripts'); ?>
    <script>
        $('ul.product-tab').find('li:first').addClass('active');
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.app'.config('theme_layout'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\language\resources\views\frontend\index-3.blade.php ENDPATH**/ ?>
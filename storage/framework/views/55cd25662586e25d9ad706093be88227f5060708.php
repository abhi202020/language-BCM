

<?php $__env->startSection('title', trans('labels.frontend.home.title').' | '.app_name()); ?>
<?php $__env->startSection('meta_description', ''); ?>
<?php $__env->startSection('meta_keywords',''); ?>

<?php $__env->startPush("after-styles"); ?>
    <style>
        #search-course-2 {
            padding-bottom: 125px;
        }
        .my-alert{
            position: absolute;
            z-index: 10;
            left: 0;
            right: 0;
            top: 25%;
            width: 50%;
            margin: auto;
            display: inline-block;
        }
        #search-course .search-group select{
            background-color: white!important;
        }
        .teacher-img-content img{
            height: 100%;
            object-fit: cover;
        }
    </style>
<?php $__env->stopPush(); ?>
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
        <section id="search-course" class="search-course-section search-course-third">
            <div class="container">
                <div class="search-counter-up">
                    <div class="version-four">
                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <div class="counter-icon-number">
                                    <div class="counter-icon">
                                        <i class="text-gradiant flaticon-graduation-hat"></i>
                                    </div>
                                    <div class="counter-number">
                                        <span class="bold-font"><?php echo e($total_students); ?></span>
                                        <p><?php echo app('translator')->get('labels.frontend.home.students_enrolled'); ?></p>
                                    </div>
                                </div>
                            </div>
                            <!-- /counter -->

                            <div class="col-md-4">
                                <div class="counter-icon-number">
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
                                <div class="counter-icon-number">
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
            </div>
        </section>
        <!-- End of Search Courses
            ============================================= -->
    <?php endif; ?>

    <?php if($sections->popular_courses->status == 1): ?>
        <?php echo $__env->make('frontend.layouts.partials.popular_courses',['class'=>'popular-three'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>


    <?php if($sections->reasons->status == 1): ?>
        <!-- Start why choose section
        ============================================= -->
        <?php echo $__env->make('frontend.layouts.partials.why_choose_us',['class'=>'pb-5'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- End why choose section
        ============================================= -->
    <?php endif; ?>



    <?php if($sections->featured_courses->status == 1): ?>
        <!-- Start of best course
        ============================================= -->
        <div id="best-product">
            <?php echo $__env->make('frontend.layouts.partials.browse_courses', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <!-- End of best course
            ============================================= -->
    <?php endif; ?>


    <?php if($sections->course_by_category->status == 1): ?>
        <!-- Start of Categories
    ============================================= -->
        <div class="about-course-categori one-page-category about-teacher-2">
            <div class="container">
                <div class="category-slide text-center">
                    <?php if($course_categories->count() > 0): ?>
                        <?php $__currentLoopData = $course_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('courses.category',['category'=>$category->slug])); ?>">
                                <div class="category-icon-title text-center">
                                    <div class="category-icon">
                                        <i class="text-gradiant <?php echo e($category->icon); ?>"></i>
                                    </div>
                                    <div class="category-title">
                                        <h4><?php echo e($category->name); ?></h4>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!-- End of Categories
       ============================================= -->
    <?php endif; ?>


    <?php if($sections->teachers->status == 1): ?>
        <section id="genius-teacher-2" class="genius-teacher-section-2 one-page-teacher backgroud-style">
            <div class="container">
                <div class="section-title mb20  headline text-center">
                    <span class="subtitle text-uppercase"><?php echo app('translator')->get('labels.frontend.home.learn_new_skills'); ?></span>
                    <h2><?php echo app('translator')->get('labels.frontend.home.popular_teachers'); ?>.</h2>
                </div>
                <?php if(count($teachers)> 0): ?>
                    <div class="teacher-third-slide">
                        <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>




    <?php if($sections->latest_news->status == 1): ?>
        <?php echo $__env->make('frontend.layouts.partials.latest_news', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>



    <?php if($sections->search_section->status == 1): ?>
    <section id="search-course-2" class="search-course-section home-third-course-search backgroud-style">
        <div class="container">
            <div class="section-title mb20 headline text-center">
                <span class="subtitle text-uppercase"><?php echo app('translator')->get('labels.frontend.home.learn_new_skills'); ?></span>
                <h2><?php echo app('translator')->get('labels.frontend.home.search_courses'); ?></h2>
            </div>
            <div id="search-course" class="search-course mb30 relative-position">
                <form action="<?php echo e(route('search')); ?>" method="get">

                    <div class="input-group search-group">
                        <input class="course" name="q" type="text"
                               placeholder="<?php echo app('translator')->get('labels.frontend.home.search_course_placeholder'); ?>">
                        <select name="category" class="select form-control">
                            <?php if(count($categories) > 0 ): ?>
                                <option value=""><?php echo app('translator')->get('labels.frontend.course.select_category'); ?></option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <option>><?php echo app('translator')->get('labels.frontend.home.no_data_available'); ?></option>
                            <?php endif; ?>

                        </select>
                        <div class="nws-button position-relative text-center  gradient-bg text-capitalize">
                            <button type="submit"
                                    value="Submit"><?php echo app('translator')->get('labels.frontend.home.search_course'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- End of Search Courses
        ============================================= -->
    <?php endif; ?>



    <?php if($sections->faq->status == 1): ?>
        <!-- Start FAQ section
        ============================================= -->
        <?php echo $__env->make('frontend.layouts.partials.faq-with-bg', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- End FAQ section
            ============================================= -->
    <?php endif; ?>


    <?php if($sections->testimonial->status == 1): ?>
        <!-- Start of testimonial secound section
        ============================================= -->
        <?php echo $__env->make('frontend.layouts.partials.testimonial', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- End  of testimonial secound section
            ============================================= -->
    <?php endif; ?>


    <?php if($sections->sponsors->status == 1): ?>
        <?php if(count($sponsors) > 0 ): ?>
            <!-- Start of sponsor section
        ============================================= -->
            <?php echo $__env->make('frontend.layouts.partials.sponsors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!-- End of sponsor section
       ============================================= -->
        <?php endif; ?>
    <?php endif; ?>



    <?php if($sections->contact_form->status == 1): ?>
        <!-- Start of contact area form
        ============================================= -->
    <section id="contact-form" class="contact-form-area_3">
        <div class="container">
            <div class="section-title mb45 headline text-center">
                <h2><?php echo app('translator')->get('labels.frontend.contact.send_us_a_message'); ?></h2>
            </div>

            <div class="contact_third_form">
                <form class="contact_form" action="<?php echo e(route('contact.send')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="contact-info">
                                <input class="name" name="name" type="text" placeholder="<?php echo app('translator')->get('labels.frontend.contact.your_name'); ?>">
                                <?php if($errors->has('name')): ?>
                                    <span class="help-block text-danger"><?php echo e($errors->first('name')); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="contact-info">
                                <input class="email" name="email" type="email" placeholder="<?php echo app('translator')->get('labels.frontend.contact.your_email'); ?>">
                                <?php if($errors->has('email')): ?>
                                    <span class="help-block text-danger"><?php echo e($errors->first('email')); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="contact-info">
                                <input class="number" name="phone" type="number" placeholder="<?php echo app('translator')->get('labels.frontend.contact.phone_number'); ?>">
                                <?php if($errors->has('phone')): ?>
                                    <span class="help-block text-danger"><?php echo e($errors->first('phone')); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <textarea name="message" placeholder="<?php echo app('translator')->get('labels.frontend.contact.message'); ?>"></textarea>
                    <?php if($errors->has('message')): ?>
                        <span class="help-block text-danger"><?php echo e($errors->first('message')); ?></span>
                    <?php endif; ?>
                    <div class="nws-button text-center  gradient-bg text-uppercase">
                        <button type="submit" value="Submit"><?php echo app('translator')->get('labels.frontend.contact.send_email'); ?> <i class="fas fa-caret-right"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- End of contact area form
        ============================================= -->
    <?php endif; ?>


    <?php if($sections->contact_us->status == 1): ?>
        <!-- Start of contact area
        ============================================= -->
        <?php echo $__env->make('frontend.layouts.partials.contact_area', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- End of contact area
            ============================================= -->
    <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.app'.config('theme_layout'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\language\resources\views\frontend\index-4.blade.php ENDPATH**/ ?>
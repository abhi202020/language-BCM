
<?php $no_footer = true; ?>

<?php $__env->startSection('title', trans('labels.frontend.home.title').' | '.app_name()); ?>
<?php $__env->startSection('meta_description', ''); ?>
<?php $__env->startSection('meta_keywords',''); ?>

<?php $__env->startPush("after-styles"); ?>
    <style>
        #search-course {
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

        #search-course select{
            background-color: #4273e1!important;
            color: white!important;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php
    $footer_data = json_decode(config('footer_data'));
?>

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


    <?php if($sections->sponsors->status == 1): ?>
        <?php if(count($sponsors) > 0 ): ?>
    <!-- Start of sponsor section
        ============================================= -->
    <div id="sponsor" class="sponsor-section sponsor-2">
        <div class="container">
            <div class="sponsor-item">
                <?php $__currentLoopData = $sponsors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sponsor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="sponsor-pic text-center">
                        <a href="<?php echo e(($sponsor->link != "") ? $sponsor->link : '#'); ?>">
                            <img src=<?php echo e(asset("storage/uploads/".$sponsor->logo)); ?> alt="<?php echo e($sponsor->name); ?>">
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
   <?php endif; ?>
    <!-- End of sponsor section
        ============================================= -->


    <!-- Start popular course
        ============================================= -->
    <?php if($sections->popular_courses->status == 1): ?>
        <?php echo $__env->make('frontend.layouts.partials.popular_courses', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <!-- End popular course
    ============================================= -->

    <?php if($sections->search_section->status == 1): ?>
        <!-- Start of Search Courses
    ============================================= -->
        <section id="search-course" class="search-course-section home-secound-course-search backgroud-style">
            <div class="container">
                <div class="section-title mb20 headline text-center">
                    <span class="subtitle text-uppercase"><?php echo app('translator')->get('labels.frontend.home.learn_new_skills'); ?></span>
                    <h2><?php echo app('translator')->get('labels.frontend.home.search_courses'); ?></h2>
                </div>
                <div class="search-course mb30 relative-position">
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
                                <button type="submit" value="Submit"><?php echo app('translator')->get('labels.frontend.home.search_course'); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="search-counter-up">
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
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

                        <div class="col-md-4 col-sm-4">
                            <div class="counter-icon-number ">
                                <div class="counter-icon">
                                    <i class="text-gradiant flaticon-book"></i>
                                </div>
                                <div class="counter-number">
                                    <span class=" bold-font"><?php echo e($total_courses); ?></span>
                                    <p><?php echo app('translator')->get('labels.frontend.home.online_available_courses'); ?></p>
                                </div>
                            </div>
                        </div>
                        <!-- /counter -->


                        <div class="col-md-4 col-sm-4">
                            <div class="counter-icon-number ">
                                <div class="counter-icon">
                                    <i class="text-gradiant flaticon-group"></i>
                                </div>
                                <div class="counter-number">
                                    <span class=" bold-font"><?php echo e($total_teachers); ?></span>
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
        <?php echo $__env->make('frontend.layouts.partials.latest_news', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- End latest section
            ============================================= -->
    <?php endif; ?>


    <?php if($sections->featured_courses->status == 1): ?>
        <!-- Start of best course
        ============================================= -->
        <?php echo $__env->make('frontend.layouts.partials.browse_courses', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- End of best course
            ============================================= -->
    <?php endif; ?>



    <?php if($sections->faq->status == 1): ?>
        <!-- Start FAQ section
        ============================================= -->
        <?php echo $__env->make('frontend.layouts.partials.faq',['classes' => 'faq-secound-home-version backgroud-style'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- End FAQ section
            ============================================= -->
    <?php endif; ?>


    <?php if($sections->course_by_category->status == 1): ?>
        <!-- Start Course category
        ============================================= -->
        <section id="course-category" class="course-category-section home-secound-version">
            <div class="container">
                <div class="section-title mb20 headline text-left">
                    <span class="subtitle ml42 text-uppercase"><?php echo app('translator')->get('labels.frontend.layouts.partials.courses_categories'); ?></span>
                    <h2><?php echo app('translator')->get('labels.frontend.layouts.partials.browse_course_by_category'); ?></h2>
                </div>
                <div class="category-item category-slide-item">
                    <?php if($course_categories): ?>
                        <?php $__currentLoopData = $course_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($key%2 == 0): ?>
                                <div class="category-slide-content">
                                    <?php endif; ?>
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
                                    <?php if($key%2 == 1): ?>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <!-- End Course category
            ============================================= -->
    <?php endif; ?>

    <?php if($sections->testimonial->status == 1): ?>
        <!-- Start secound testimonial section
        ============================================= -->
    <section id="testimonial-secound" class="secound-testimoinial-section">
        <div class="container">
            <div class="testimonial-slide">
                <div class="section-title mb35 headline text-center">
                    <span class="subtitle text-uppercase"><?php echo app('translator')->get('labels.frontend.home.what_they_say_about_us'); ?></span>
                    <h2><?php echo app('translator')->get('labels.frontend.layouts.partials.students_testimonial'); ?></h2>
                </div>
                <?php if($testimonials->count() > 0): ?>
                <div class="testimonial-secound-slide-area">
                    <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <div class="student-qoute text-center">
                        <p><?php echo e($item->content); ?></p>
                        <div class="student-name-designation">
                            <span class="st-name bold-font"><?php echo e($item->name); ?>  </span>
                            <span class="st-designation"><?php echo e($item->occupation); ?></span>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <!-- End secound testimonial section
        ============================================= -->
    <?php endif; ?>


    <?php if($sections->teachers->status == 1): ?>
        <!-- Start secound teacher section
        ============================================= -->
    <section id="teacher-2" class="secound-teacher-section">
        <div class="container">
            <div class="section-title mb35 headline text-left">
                <span class="subtitle ml42  text-uppercase"><?php echo app('translator')->get('labels.frontend.home.our_professionals'); ?></span>
                <h2><?php echo e(env('APP_NAME')); ?> <span><?php echo app('translator')->get('labels.frontend.home.teachers'); ?>.</span></h2>
            </div>
            <div class="teacher-secound-slide">
                <?php if(count($teachers)> 0): ?>
                    <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="teacher-img-text relative-position text-center">
                            <div class="teacher-img-social relative-position" >
                                <img height="200px" width="200px" src="<?php echo e($item->picture); ?>" alt="<?php echo e($item->full_name); ?>">
                                <div class="blakish-overlay"></div>
                                <div class="teacher-social-list ul-li">
                                    <ul>
                                        <li><a href="<?php echo e('mailto:'.$item->email); ?>"><i class="fa fa-envelope"></i></a></li>
                                        <li><a href="<?php echo e(route('admin.messages',['teacher_id'=>$item->id])); ?>"><i class="fa fa-comments"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="teacher-name-designation mt15">
                                <span class="teacher-name"><?php echo e($item->full_name); ?></span>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

            </div>

            <div class="genius-btn gradient-bg text-center text-uppercase ul-li-block bold-font">
                <a href="<?php echo e(route('teachers.index')); ?>"><?php echo app('translator')->get('labels.frontend.home.all_teachers'); ?> <i class="fas fa-caret-right"></i></a>
            </div>
        </div>
    </section>
    <!-- End teacher section
        ============================================= -->
    <?php endif; ?>

    <?php if($sections->contact_us->status == 1): ?>
        <!-- Start Of scound contact section
        ============================================= -->
    <section id="contact_secound" class="contact_secound_section backgroud-style">
        <div class="container">
            <div class="contact_secound_content">
                <div class="row">
                    <div class="col-md-6">
                        <?php if(config('contact_data') != ""): ?>
                            <?php
                                $contact_data = contact_data(config('contact_data'));
                            ?>
                        <div class="contact-left-content">
                            <div class="section-title  mb45 headline text-left">
                                <span class="subtitle ml42  text-uppercase"><?php echo app('translator')->get('labels.frontend.layouts.partials.contact_us'); ?></span>
                                <h2><span><?php echo app('translator')->get('labels.frontend.layouts.partials.get_in_touch'); ?></span></h2>
                                <p>
                                    <?php echo e($contact_data["short_text"]["value"]); ?>

                                </p>
                            </div>

                            <div class="contact-address">
                                <div class="contact-address-details">
                                    <div class="address-icon relative-position text-center float-left">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="address-details ul-li-block">
                                        <ul>
                                            <?php if($contact_data["primary_address"]["status"] == 1): ?>
                                                <li>
                                                    <span><?php echo app('translator')->get('labels.frontend.layouts.partials.primary'); ?>: </span><?php echo e($contact_data["primary_address"]["value"]); ?>

                                                </li>
                                            <?php endif; ?>

                                            <?php if($contact_data["secondary_address"]["status"] == 1): ?>
                                                <li>
                                                    <span><?php echo app('translator')->get('labels.frontend.layouts.partials.second'); ?>: </span><?php echo e($contact_data["secondary_address"]["value"]); ?>

                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>

                                <div class="contact-address-details">
                                    <div class="address-icon relative-position text-center float-left">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div class="address-details ul-li-block">
                                        <ul>
                                            <?php if($contact_data["primary_phone"]["status"] == 1): ?>
                                                <li>
                                                    <span><?php echo app('translator')->get('labels.frontend.layouts.partials.primary'); ?>: </span><?php echo e($contact_data["primary_phone"]["value"]); ?>

                                                </li>
                                            <?php endif; ?>

                                            <?php if($contact_data["secondary_phone"]["status"] == 1): ?>
                                                <li>
                                                    <span><?php echo app('translator')->get('labels.frontend.layouts.partials.second'); ?>: </span><?php echo e($contact_data["secondary_phone"]["value"]); ?>

                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>

                                <div class="contact-address-details">
                                    <div class="address-icon relative-position text-center float-left">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="address-details ul-li-block">
                                        <ul>
                                            <?php if($contact_data["primary_email"]["status"] == 1): ?>
                                                <li>
                                                    <span><?php echo app('translator')->get('labels.frontend.layouts.partials.primary'); ?>: </span><?php echo e($contact_data["primary_email"]["value"]); ?>

                                                </li>
                                            <?php endif; ?>

                                            <?php if($contact_data["secondary_email"]["status"] == 1): ?>
                                                <li>
                                                    <span><?php echo app('translator')->get('labels.frontend.layouts.partials.second'); ?>: </span><?php echo e($contact_data["secondary_email"]["value"]); ?>

                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                       <?php endif; ?>
                    </div>

                    <div class="col-md-6">
                        <div class="contact_secound_form text-white">
                            <div class="section-title-2 mb65 headline text-left">
                                <h2><?php echo app('translator')->get('labels.frontend.contact.send_us_a_message'); ?></h2>
                            </div>
                            <form class="contact_form" action="<?php echo e(route('contact.send')); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="contact-info">
                                    <input class="name <?php if($errors->has('name')): ?> border-bottom border-danger <?php endif; ?>" name="name" type="text" placeholder="<?php echo app('translator')->get('labels.frontend.contact.your_name'); ?>">
                                </div>
                                <div class="contact-info">
                                    <input class="email  <?php if($errors->has('email')): ?> border-bottom border-danger <?php endif; ?>" name="email" type="email" placeholder="<?php echo app('translator')->get('labels.frontend.contact.your_email'); ?>">
                                </div>
                                <textarea name="message" class="<?php if($errors->has('message')): ?> border-bottom border-danger <?php endif; ?>" placeholder="<?php echo app('translator')->get('labels.frontend.contact.message'); ?>"></textarea>

                                <div class="nws-button text-center  gradient-bg text-capitalize">
                                    <button type="submit" value="Submit"><?php echo app('translator')->get('labels.frontend.contact.send_message_now'); ?> <i
                                                class="fas fa-caret-right"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer_2 backgroud-style">
            <div class="container">
                <div class="back-top text-center mb45">
                    <a class="scrollup" href="#"><img src=<?php echo e(asset("assets/img/banner/bt.png")); ?> alt=""></a>
                </div>
                <div class="footer_2_logo text-center">
                    <img src=<?php echo e(asset("storage/logos/".config('logo_w_image'))); ?> alt="">
                </div>

                <div class="footer_2_subs text-center">
                    <?php if($footer_data->short_description->status == 1): ?>
                    <p><?php echo $footer_data->short_description->text; ?> </p>
                    <?php endif; ?>

                    <?php if($footer_data->newsletter_form->status == 1): ?>
                    <div class="subs-form relative-position">
                        <form action="<?php echo e(route("subscribe")); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <input class="email" name="subs_email" required type="email" placeholder="<?php echo app('translator')->get('labels.frontend.layouts.partials.email_address'); ?>.">
                            <div class="nws-button text-center  gradient-bg text-uppercase">
                                <button type="submit" value="Submit"><?php echo app('translator')->get('labels.frontend.layouts.partials.subscribe_now'); ?></button>
                            </div>
                            <?php if($errors->has('subs_email')): ?>
                                <p class="text-danger text-left"><?php echo e($errors->first('subs_email')); ?></p>
                            <?php endif; ?>
                        </form>
                    </div>
                    <?php endif; ?>
                </div>
                <?php if($footer_data->bottom_footer->status == 1): ?>
                <div class="copy-right-menu">
                    <div class="row">
                        <?php if($footer_data->copyright_text->status == 1): ?>
                        <div class="col-md-5">
                            <div class="copy-right-text">
                                <p><?php echo $footer_data->copyright_text->text; ?></p>
                            </div>
                        </div>
                        <?php endif; ?>

                            <?php if(($footer_data->social_links->status == 1) && (count($footer_data->social_links->links) > 0)): ?>
                        <div class="col-md-3">
                            <div class="footer-social  text-center ul-li">
                                <ul>
                                    <?php $__currentLoopData = $footer_data->social_links->links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><a href="<?php echo e($item->link); ?>"><i class="<?php echo e($item->icon); ?>"></i></a></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                         <?php endif; ?>

                            <?php if(($footer_data->bottom_footer_links->status == 1) && (count($footer_data->bottom_footer_links->links) > 0)): ?>
                        <div class="col-md-4">
                            <div class="copy-right-menu-item float-right ul-li">
                                <ul>
                                    <?php $__currentLoopData = $footer_data->bottom_footer_links->links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><a href="<?php echo e($item->link); ?>"><?php echo e($item->label); ?></a></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <li><a href="<?php echo e(route('frontend.certificates.getVerificationForm')); ?>"><?php echo app('translator')->get('labels.frontend.layouts.partials.certificate_verification'); ?></a></li>
                                </ul>
                            </div>
                        </div>
                         <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <!-- ENd Of scound contact section
        ============================================= -->
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-scripts'); ?>
    <script>
        $('ul.product-tab').find('li:first').addClass('active');
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layouts.app'.config('theme_layout'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\language\resources\views\frontend\index-2.blade.php ENDPATH**/ ?>
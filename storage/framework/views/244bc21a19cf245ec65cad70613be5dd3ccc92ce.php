<!-- sidebar for dashboard -->

<?php $request = app('Illuminate\Http\Request'); ?>

<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">
                <?php echo app('translator')->get('menus.backend.sidebar.general.dashboard'); ?>
            </li>

            <!-- dashboard -->
            <li class="nav-item">
                <a class="nav-link <?php echo e(active_class(Active::checkUriPattern('admin/dashboard'))); ?>"
                    href="<?php echo e(route('admin.dashboard')); ?>">
                    <i class="nav-icon icon-speedometer"></i> <?php echo app('translator')->get('menus.backend.sidebar.dashboard'); ?>
                </a>
            </li>

            <!--=======================Custom menus===============================-->
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order_access')): ?>
                <li class="nav-item ">
                    <a class="nav-link <?php echo e($request->segment(1) == 'orders' ? 'active' : ''); ?>"
                        href="<?php echo e(route('admin.orders.index')); ?>">
                        <i class="nav-icon icon-bag"></i>
                        <span class="title"><?php echo app('translator')->get('menus.backend.sidebar.orders.title'); ?></span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if($logged_in_user->isAdmin()): ?>
                <li class="nav-item ">
                    <a class="nav-link <?php echo e($request->segment(2) == 'teachers' ? 'active' : ''); ?>"
                        href="<?php echo e(route('admin.teachers.index')); ?>">
                        <i class="nav-icon icon-directions"></i>
                        <span class="title"><?php echo app('translator')->get('menus.backend.sidebar.teachers.title'); ?></span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('blog_access')): ?>
                <li class="nav-item ">
                    <a class="nav-link <?php echo e($request->segment(2) == 'blogs' ? 'active' : ''); ?>"
                        href="<?php echo e(route('admin.blogs.index')); ?>">
                        <i class="nav-icon icon-book-open"></i>
                        <span class="title"><?php echo app('translator')->get('menus.backend.sidebar.blogs.title'); ?></span>
                    </a>
                </li>
            <?php endif; ?>

            <!-- dont know how to change blog to forum without error -->
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('blog_access')): ?>
                <li class="nav-item ">
                    <a class="nav-link <?php echo e(request()->segment(2) == 'forums-category' ? 'active' : ''); ?>"
                        href="<?php echo e(route('admin.forums-category.index')); ?>">
                        <i class="nav-icon icon-book-open"></i>
                        <span class="title"><?php echo app('translator')->get('menus.backend.sidebar.forum.title'); ?></span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('category_access')): ?>
                <li class="nav-item ">
                    <a class="nav-link <?php echo e($request->segment(2) == 'categories' ? 'active' : ''); ?>"
                        href="<?php echo e(route('admin.categories.index')); ?>">
                        <i class="nav-icon icon-folder-alt"></i>
                        <span class="title"><?php echo app('translator')->get('menus.backend.sidebar.categories.title'); ?></span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if(!$logged_in_user->hasRole('student') && ($logged_in_user->hasRole('teacher') || $logged_in_user->isAdmin() || $logged_in_user->hasAnyPermission(['course_access', 'lesson_access', 'test_access', 'question_access', 'bundle_access']))): ?>
                <li
                    class="nav-item nav-dropdown <?php echo e(active_class(Active::checkUriPattern(['user/courses*','user/lessons*','user/tests*','user/questions*','user/live-lessons*','user/live-lesson-slots*']),'open')); ?>">
                    <a class="nav-link nav-dropdown-toggle <?php echo e(active_class(Active::checkUriPattern('admin/*'))); ?>"
                        href="#">
                        <i class="nav-icon icon-puzzle"></i> <?php echo app('translator')->get('menus.backend.sidebar.courses.management'); ?>
                    </a>

                    <ul class="nav-dropdown-items">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('course_access')): ?>
                            <li class="nav-item ">
                                <a class="nav-link <?php echo e($request->segment(2) == 'courses' ? 'active' : ''); ?>"
                                    href="<?php echo e(route('admin.courses.index')); ?>">
                                    <span class="title"><?php echo app('translator')->get('menus.backend.sidebar.courses.title'); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('lesson_access')): ?>
                            <li class="nav-item ">
                                <a class="nav-link <?php echo e($request->segment(2) == 'lessons' ? 'active' : ''); ?>"
                                    href="<?php echo e(route('admin.lessons.index')); ?>">
                                    <span class="title"><?php echo app('translator')->get('menus.backend.sidebar.lessons.title'); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('live_lesson_access')): ?>
                            <li class="nav-item ">
                                <a class="nav-link <?php echo e($request->segment(2) == 'live-lessons' ? 'active' : ''); ?>"
                                    href="<?php echo e(route('admin.live-lessons.index')); ?>">
                                    <span class="title"><?php echo app('translator')->get('menus.backend.sidebar.live_lessons.title'); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('live_lesson_slot_access')): ?>
                            <li class="nav-item ">
                                <a class="nav-link <?php echo e($request->segment(2) == 'live-lesson-slots' ? 'active' : ''); ?>"
                                    href="<?php echo e(route('admin.live-lesson-slots.index')); ?>">
                                    <span
                                        class="title"><?php echo app('translator')->get('menus.backend.sidebar.live_lesson_slots.title'); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>

                    </ul>
                </li>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('bundle_access')): ?>
                    <li class="nav-item ">
                        <a class="nav-link <?php echo e($request->segment(2) == 'bundles' ? 'active' : ''); ?>"
                            href="<?php echo e(route('admin.bundles.index')); ?>">
                            <i class="nav-icon icon-layers"></i>
                            <span class="title"><?php echo app('translator')->get('Bundles Management'); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>

            <?php if($logged_in_user->isAdmin() || $logged_in_user->hasAnyPermission(['blog_access', 'page_access', 'reason_access'])): ?>
                <li class="nav-item nav-dropdown <?php echo e(active_class(Active::checkUriPattern(['user/contact','user/sponsors*','user/testimonials*','user/faqs*','user/footer*','user/blogs','user/sitemap*']),'open')); ?>">
                    <a class="nav-link nav-dropdown-toggle <?php echo e(active_class(Active::checkUriPattern('admin/*'))); ?>"
                        href="#">
                        <i class="nav-icon icon-note"></i> <?php echo app('translator')->get('menus.backend.sidebar.site-management.title'); ?>
                    </a>

                    <ul class="nav-dropdown-items">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('page_access')): ?>
                            <li class="nav-item ">
                                <a class="nav-link <?php echo e($request->segment(2) == 'pages' ? 'active' : ''); ?>"
                                    href="<?php echo e(route('admin.pages.index')); ?>">
                                    <span class="title"><?php echo app('translator')->get('menus.backend.sidebar.pages.title'); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('reason_access')): ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e($request->segment(2) == 'reasons' ? 'active' : ''); ?>"
                                    href="<?php echo e(route('admin.reasons.index')); ?>">
                                    <span class="title"><?php echo app('translator')->get('menus.backend.sidebar.reasons.title'); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if($logged_in_user->isAdmin()): ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e(active_class(Active::checkUriPattern('admin/menu-manager'))); ?>"
                                    href="<?php echo e(route('admin.menu-manager')); ?>">
                                    <?php echo e(__('menus.backend.sidebar.menu-manager.title')); ?></a>
                            </li>


                            <li class="nav-item ">
                                <a class="nav-link <?php echo e(active_class(Active::checkUriPattern('admin/sliders*'))); ?>"
                                    href="<?php echo e(route('admin.sliders.index')); ?>">
                                    <span class="title"><?php echo app('translator')->get('menus.backend.sidebar.hero-slider.title'); ?></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link <?php echo e($request->segment(2) == 'testimonials' ? 'active' : ''); ?>"
                                    href="<?php echo e(route('admin.testimonials.index')); ?>">
                                    <span
                                        class="title"><?php echo app('translator')->get('menus.backend.sidebar.testimonials.title'); ?></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link <?php echo e($request->segment(2) == 'contact' ? 'active' : ''); ?>"
                                    href="<?php echo e(route('admin.contact-settings')); ?>">
                                    <span class="title"><?php echo app('translator')->get('menus.backend.sidebar.contact.title'); ?></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link <?php echo e($request->segment(2) == 'footer' ? 'active' : ''); ?>"
                                    href="<?php echo e(route('admin.footer-settings')); ?>">
                                    <span class="title"><?php echo app('translator')->get('menus.backend.sidebar.footer.title'); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php else: ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('reason_access')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e($request->segment(2) == 'reasons' ? 'active' : ''); ?>"
                            href="<?php echo e(route('admin.reasons.index')); ?>">
                            <i class="nav-icon icon-layers"></i>
                            <span class="title"><?php echo app('translator')->get('menus.backend.sidebar.reasons.title'); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>

            <!-- messages -->
            <li class="nav-item">
                <a class="nav-link <?php echo e($request->segment(1) == 'messages' ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.messages')); ?>">
                    <i class="nav-icon icon-envelope-open"></i> <span
                        class="title"><?php echo app('translator')->get('menus.backend.sidebar.messages.title'); ?></span>
                </a>
            </li>
            
            <!-- user invoices  -->
            <?php if($logged_in_user->hasRole('student')): ?>
                <li class="nav-item ">
                    <a class="nav-link <?php echo e($request->segment(2) == 'invoices' ? 'active' : ''); ?>"
                        href="<?php echo e(route('admin.invoices.index')); ?>">
                        <i class="nav-icon icon-book-open"></i>
                        <span class="title"><?php echo app('translator')->get('menus.backend.sidebar.invoices.title'); ?></span>
                    </a>
                </li>
            <?php endif; ?>

            <!-- user Zoom meetings -->
            <?php if($logged_in_user->hasRole('student')): ?>
                <li class="nav-item ">
                    <a class="nav-link <?php echo e($request->segment(2) == 'zoom' ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.zoom.index')); ?>">
                    <i class="nav-icon icon-book-open"></i>
                    <span class="title"><?php echo app('translator')->get('menus.backend.sidebar.zoom.title'); ?></span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if($logged_in_user->isAdmin()): ?>
                <li class="nav-item ">
                    <a class="nav-link <?php echo e($request->segment(1) == 'contact-requests' ? 'active' : ''); ?>"
                        href="<?php echo e(route('admin.contact-requests.index')); ?>">
                        <i class="nav-icon icon-envelope-letter"></i>
                        <span class="title">Contact Requests/Leads</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link <?php echo e($request->segment(1) == 'contact-requests' ? 'active' : ''); ?>"
                        href="<?php echo e(route('admin.coupons.index')); ?>">
                        <i class="nav-icon icon-star"></i>
                        <span class="title"><?php echo app('translator')->get('menus.backend.sidebar.coupons.title'); ?></span>
                    </a>
                </li>
            <?php endif; ?>

            <!-- account -->
            <li class="nav-item ">
                <a class="nav-link <?php echo e($request->segment(1) == 'account' ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.account')); ?>">
                    <i class="nav-icon icon-key"></i>
                    <span class="title"><?php echo app('translator')->get('menus.backend.sidebar.account.title'); ?></span>
                </a>
            </li>
            <?php if($logged_in_user->hasRole('student')): ?>
            <?php endif; ?>

            <?php if($logged_in_user->isAdmin()): ?>

                <li class="nav-title">
                    <?php echo app('translator')->get('menus.backend.sidebar.system'); ?>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(active_class(Active::checkUriPattern('admin/auth/user*'))); ?>"
                        href="<?php echo e(route('admin.auth.user.index')); ?>">
                        <i class="nav-icon icon-user"></i> <?php echo app('translator')->get('labels.backend.access.users.management'); ?>

                        <?php if($pending_approval > 0): ?>
                            <span class="badge badge-danger"><?php echo e($pending_approval); ?></span>
                        <?php endif; ?>
                    </a>
                </li>

                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(active_class(Active::checkUriPattern('admin/auth/user*'))); ?>"
                            href="<?php echo e(route('admin.auth.user.index')); ?>">
                            <?php echo app('translator')->get('labels.backend.access.users.management'); ?>

                            <?php if($pending_approval > 0): ?>
                                <span class="badge badge-danger"><?php echo e($pending_approval); ?></span>
                            <?php endif; ?>
                        </a>
                    </li>
                </ul>
                <li class="divider"></li>

                <li class="nav-item nav-dropdown <?php echo e(active_class(Active::checkUriPattern('admin/*'), 'open')); ?>">
                    <a class="nav-link nav-dropdown-toggle <?php echo e(active_class(Active::checkUriPattern('admin/settings*'))); ?>"
                        href="#">
                        <i class="nav-icon icon-settings"></i> <?php echo app('translator')->get('menus.backend.sidebar.settings.title'); ?>
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(active_class(Active::checkUriPattern('admin/settings'))); ?>"
                                href="<?php echo e(route('admin.general-settings')); ?>">
                                <?php echo app('translator')->get('menus.backend.sidebar.settings.general'); ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(active_class(Active::checkUriPattern('admin/settings/zoom-settings*'))); ?>"
                                href="<?php echo e(route('admin.zoom-settings')); ?>">
                                Zoom Settings
                            </a>
                        </li>
                    </ul>
                </li>

                <li
                    class="nav-item nav-dropdown <?php echo e(active_class(Active::checkUriPattern('admin/log-viewer*'), 'open')); ?>">
                    <a class="nav-link nav-dropdown-toggle <?php echo e(active_class(Active::checkUriPattern('admin/log-viewer*'))); ?>"
                        href="#">
                        <i class="nav-icon icon-list"></i> <?php echo app('translator')->get('menus.backend.sidebar.debug-site.title'); ?>
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(active_class(Active::checkUriPattern('admin/log-viewer'))); ?>"
                                href="<?php echo e(route('log-viewer::dashboard')); ?>">
                                <?php echo app('translator')->get('menus.backend.log-viewer.dashboard'); ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(active_class(Active::checkUriPattern('admin/log-viewer/logs*'))); ?>"
                                href="<?php echo e(route('log-viewer::logs.list')); ?>">
                                <?php echo app('translator')->get('menus.backend.log-viewer.logs'); ?>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if($logged_in_user->hasRole('teacher')): ?>
                <li class="nav-item ">
                    <a class="nav-link <?php echo e($request->segment(2) == 'payments' ? 'active' : ''); ?>"
                        href="<?php echo e(route('admin.payments')); ?>">
                        <i class="nav-icon icon-wallet"></i>
                        <span class="title"><?php echo app('translator')->get('menus.backend.sidebar.payments.title'); ?></span>
                    </a>
                </li>
            <?php endif; ?>

        </ul>
    </nav>

    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
<!--sidebar-->
<?php /**PATH C:\xampp\htdocs\language\resources\views/backend/includes/sidebar.blade.php ENDPATH**/ ?>
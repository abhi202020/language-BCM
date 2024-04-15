<!-- sidebar for dashboard -->

@inject('request', 'Illuminate\Http\Request')

<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">
                @lang('menus.backend.sidebar.general.dashboard')
            </li>

            <!-- dashboard -->
            <li class="nav-item">
                <a class="nav-link {{ active_class(Active::checkUriPattern('admin/dashboard')) }}"
                    href="{{ route('admin.dashboard') }}">
                    <i class="nav-icon icon-speedometer"></i> @lang('menus.backend.sidebar.dashboard')
                </a>
            </li>

            <!--=======================Custom menus===============================-->
            @can('order_access')
                <li class="nav-item ">
                    <a class="nav-link {{ $request->segment(1) == 'orders' ? 'active' : '' }}"
                        href="{{ route('admin.orders.index') }}">
                        <i class="nav-icon icon-bag"></i>
                        <span class="title">@lang('menus.backend.sidebar.orders.title')</span>
                    </a>
                </li>
            @endcan

            @if ($logged_in_user->isAdmin())
                <li class="nav-item ">
                    <a class="nav-link {{ $request->segment(2) == 'teachers' ? 'active' : '' }}"
                        href="{{ route('admin.teachers.index') }}">
                        <i class="nav-icon icon-directions"></i>
                        <span class="title">@lang('menus.backend.sidebar.teachers.title')</span>
                    </a>
                </li>
            @endif

            @can('blog_access')
                <li class="nav-item ">
                    <a class="nav-link {{ $request->segment(2) == 'blogs' ? 'active' : '' }}"
                        href="{{ route('admin.blogs.index') }}">
                        <i class="nav-icon icon-book-open"></i>
                        <span class="title">@lang('menus.backend.sidebar.blogs.title')</span>
                    </a>
                </li>
            @endcan

            <!-- dont know how to change blog to forum without error -->
            @can('blog_access')
                <li class="nav-item ">
                    <a class="nav-link {{ request()->segment(2) == 'forums-category' ? 'active' : '' }}"
                        href="{{ route('admin.forums-category.index') }}">
                        <i class="nav-icon icon-book-open"></i>
                        <span class="title">@lang('menus.backend.sidebar.forum.title')</span>
                    </a>
                </li>
            @endcan

            @can('category_access')
                <li class="nav-item ">
                    <a class="nav-link {{ $request->segment(2) == 'categories' ? 'active' : '' }}"
                        href="{{ route('admin.categories.index') }}">
                        <i class="nav-icon icon-folder-alt"></i>
                        <span class="title">@lang('menus.backend.sidebar.categories.title')</span>
                    </a>
                </li>
            @endcan

            @if (!$logged_in_user->hasRole('student') && ($logged_in_user->hasRole('teacher') || $logged_in_user->isAdmin() || $logged_in_user->hasAnyPermission(['course_access', 'lesson_access', 'test_access', 'question_access', 'bundle_access'])))
                <li
                    class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern(['user/courses*','user/lessons*','user/tests*','user/questions*','user/live-lessons*','user/live-lesson-slots*']),'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/*')) }}"
                        href="#">
                        <i class="nav-icon icon-puzzle"></i> @lang('menus.backend.sidebar.courses.management')
                    </a>

                    <ul class="nav-dropdown-items">
                        @can('course_access')
                            <li class="nav-item ">
                                <a class="nav-link {{ $request->segment(2) == 'courses' ? 'active' : '' }}"
                                    href="{{ route('admin.courses.index') }}">
                                    <span class="title">@lang('menus.backend.sidebar.courses.title')</span>
                                </a>
                            </li>
                        @endcan

                        @can('lesson_access')
                            <li class="nav-item ">
                                <a class="nav-link {{ $request->segment(2) == 'lessons' ? 'active' : '' }}"
                                    href="{{ route('admin.lessons.index') }}">
                                    <span class="title">@lang('menus.backend.sidebar.lessons.title')</span>
                                </a>
                            </li>
                        @endcan

                        @can('live_lesson_access')
                            <li class="nav-item ">
                                <a class="nav-link {{ $request->segment(2) == 'live-lessons' ? 'active' : '' }}"
                                    href="{{ route('admin.live-lessons.index') }}">
                                    <span class="title">@lang('menus.backend.sidebar.live_lessons.title')</span>
                                </a>
                            </li>
                        @endcan

                        @can('live_lesson_slot_access')
                            <li class="nav-item ">
                                <a class="nav-link {{ $request->segment(2) == 'live-lesson-slots' ? 'active' : '' }}"
                                    href="{{ route('admin.live-lesson-slots.index') }}">
                                    <span
                                        class="title">@lang('menus.backend.sidebar.live_lesson_slots.title')</span>
                                </a>
                            </li>
                        @endcan

                    </ul>
                </li>
                @can('bundle_access')
                    <li class="nav-item ">
                        <a class="nav-link {{ $request->segment(2) == 'bundles' ? 'active' : '' }}"
                            href="{{ route('admin.bundles.index') }}">
                            <i class="nav-icon icon-layers"></i>
                            <span class="title">@lang('Bundles Management')</span>
                        </a>
                    </li>
                @endcan
            @endif

            @if ($logged_in_user->isAdmin() || $logged_in_user->hasAnyPermission(['blog_access', 'page_access', 'reason_access']))
                <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern(['user/contact','user/sponsors*','user/testimonials*','user/faqs*','user/footer*','user/blogs','user/sitemap*']),'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/*')) }}"
                        href="#">
                        <i class="nav-icon icon-note"></i> @lang('menus.backend.sidebar.site-management.title')
                    </a>

                    <ul class="nav-dropdown-items">
                        @can('page_access')
                            <li class="nav-item ">
                                <a class="nav-link {{ $request->segment(2) == 'pages' ? 'active' : '' }}"
                                    href="{{ route('admin.pages.index') }}">
                                    <span class="title">@lang('menus.backend.sidebar.pages.title')</span>
                                </a>
                            </li>
                        @endcan
                        @can('reason_access')
                            <li class="nav-item">
                                <a class="nav-link {{ $request->segment(2) == 'reasons' ? 'active' : '' }}"
                                    href="{{ route('admin.reasons.index') }}">
                                    <span class="title">@lang('menus.backend.sidebar.reasons.title')</span>
                                </a>
                            </li>
                        @endcan
                        @if ($logged_in_user->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link {{ active_class(Active::checkUriPattern('admin/menu-manager')) }}"
                                    href="{{ route('admin.menu-manager') }}">
                                    {{ __('menus.backend.sidebar.menu-manager.title') }}</a>
                            </li>


                            <li class="nav-item ">
                                <a class="nav-link {{ active_class(Active::checkUriPattern('admin/sliders*')) }}"
                                    href="{{ route('admin.sliders.index') }}">
                                    <span class="title">@lang('menus.backend.sidebar.hero-slider.title')</span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ $request->segment(2) == 'testimonials' ? 'active' : '' }}"
                                    href="{{ route('admin.testimonials.index') }}">
                                    <span
                                        class="title">@lang('menus.backend.sidebar.testimonials.title')</span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ $request->segment(2) == 'contact' ? 'active' : '' }}"
                                    href="{{ route('admin.contact-settings') }}">
                                    <span class="title">@lang('menus.backend.sidebar.contact.title')</span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ $request->segment(2) == 'footer' ? 'active' : '' }}"
                                    href="{{ route('admin.footer-settings') }}">
                                    <span class="title">@lang('menus.backend.sidebar.footer.title')</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @else
                @can('reason_access')
                    <li class="nav-item">
                        <a class="nav-link {{ $request->segment(2) == 'reasons' ? 'active' : '' }}"
                            href="{{ route('admin.reasons.index') }}">
                            <i class="nav-icon icon-layers"></i>
                            <span class="title">@lang('menus.backend.sidebar.reasons.title')</span>
                        </a>
                    </li>
                @endcan
            @endif

            <!-- messages -->
            <li class="nav-item">
                <a class="nav-link {{ $request->segment(1) == 'messages' ? 'active' : '' }}"
                    href="{{ route('admin.messages') }}">
                    <i class="nav-icon icon-envelope-open"></i> <span
                        class="title">@lang('menus.backend.sidebar.messages.title')</span>
                </a>
            </li>
            
            <!-- user invoices  -->
            @if ($logged_in_user->hasRole('student'))
                <li class="nav-item ">
                    <a class="nav-link {{ $request->segment(2) == 'invoices' ? 'active' : '' }}"
                        href="{{ route('admin.invoices.index') }}">
                        <i class="nav-icon icon-book-open"></i>
                        <span class="title">@lang('menus.backend.sidebar.invoices.title')</span>
                    </a>
                </li>
            @endif

            <!-- user Zoom meetings -->
            @if ($logged_in_user->hasRole('student'))
                <li class="nav-item ">
                    <a class="nav-link {{ $request->segment(2) == 'zoom' ? 'active' : '' }}"
                    href="{{ route('admin.zoom.index') }}">
                    <i class="nav-icon icon-book-open"></i>
                    <span class="title">@lang('menus.backend.sidebar.zoom.title')</span>
                    </a>
                </li>
            @endif

            @if ($logged_in_user->isAdmin())
                <li class="nav-item ">
                    <a class="nav-link {{ $request->segment(1) == 'contact-requests' ? 'active' : '' }}"
                        href="{{ route('admin.contact-requests.index') }}">
                        <i class="nav-icon icon-envelope-letter"></i>
                        <span class="title">Contact Requests/Leads</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link {{ $request->segment(1) == 'contact-requests' ? 'active' : '' }}"
                        href="{{ route('admin.coupons.index') }}">
                        <i class="nav-icon icon-star"></i>
                        <span class="title">@lang('menus.backend.sidebar.coupons.title')</span>
                    </a>
                </li>
            @endif

            <!-- account -->
            <li class="nav-item ">
                <a class="nav-link {{ $request->segment(1) == 'account' ? 'active' : '' }}"
                    href="{{ route('admin.account') }}">
                    <i class="nav-icon icon-key"></i>
                    <span class="title">@lang('menus.backend.sidebar.account.title')</span>
                </a>
            </li>
            @if ($logged_in_user->hasRole('student'))
            @endif

            @if ($logged_in_user->isAdmin())

                <li class="nav-title">
                    @lang('menus.backend.sidebar.system')
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/user*')) }}"
                        href="{{ route('admin.auth.user.index') }}">
                        <i class="nav-icon icon-user"></i> @lang('labels.backend.access.users.management')

                        @if ($pending_approval > 0)
                            <span class="badge badge-danger">{{ $pending_approval }}</span>
                        @endif
                    </a>
                </li>

                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/user*')) }}"
                            href="{{ route('admin.auth.user.index') }}">
                            @lang('labels.backend.access.users.management')

                            @if ($pending_approval > 0)
                                <span class="badge badge-danger">{{ $pending_approval }}</span>
                            @endif
                        </a>
                    </li>
                </ul>
                <li class="divider"></li>

                <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('admin/*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/settings*')) }}"
                        href="#">
                        <i class="nav-icon icon-settings"></i> @lang('menus.backend.sidebar.settings.title')
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/settings')) }}"
                                href="{{ route('admin.general-settings') }}">
                                @lang('menus.backend.sidebar.settings.general')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/settings/zoom-settings*')) }}"
                                href="{{ route('admin.zoom-settings') }}">
                                Zoom Settings
                            </a>
                        </li>
                    </ul>
                </li>

                <li
                    class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/log-viewer*')) }}"
                        href="#">
                        <i class="nav-icon icon-list"></i> @lang('menus.backend.sidebar.debug-site.title')
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/log-viewer')) }}"
                                href="{{ route('log-viewer::dashboard') }}">
                                @lang('menus.backend.log-viewer.dashboard')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/log-viewer/logs*')) }}"
                                href="{{ route('log-viewer::logs.list') }}">
                                @lang('menus.backend.log-viewer.logs')
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            @if ($logged_in_user->hasRole('teacher'))
                <li class="nav-item ">
                    <a class="nav-link {{ $request->segment(2) == 'payments' ? 'active' : '' }}"
                        href="{{ route('admin.payments') }}">
                        <i class="nav-icon icon-wallet"></i>
                        <span class="title">@lang('menus.backend.sidebar.payments.title')</span>
                    </a>
                </li>
            @endif

        </ul>
    </nav>

    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
<!--sidebar-->

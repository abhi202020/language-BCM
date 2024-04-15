<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="{{ route('frontend.index') }}">
        <img class="navbar-brand-full" src="{{asset('storage/logos/'.config('logo_b_image'))}}"  height="25" alt="Square Logo">
        <img class="navbar-brand-minimized" src="{{asset('storage/logos/'.config('logo_popup'))}}" height="30" alt="Square Logo">
    </a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>

    <ul class="nav navbar-nav d-md-down-none">
        <li class="nav-item px-5">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">@lang('Back to Dashboard')</a>
        </li>
    </ul>

    <ul class="nav navbar-nav ml-auto mr-4">
        <li class="nav-item d-md-down-none">
            <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="icon-envelope"></i>
                <span class="badge badge-pill d-none badge-success unreadMessageCounter"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header text-center">
                    <strong>@lang('navs.general.messages')</strong>
                </div>
                <div class="unreadMessages">
                   <p class="mb-0 text-center py-2">@lang('navs.general.no_messages')</p>
                </div>


            </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
              @if( $logged_in_user->picture != null)
            <img src="{{ $logged_in_user->picture }}" class="img-avatar" alt="{{ $logged_in_user->email }}">
              @endif
              <span style="right: 0;left: inherit" class="badge d-md-none d-lg-none d-none mob-notification badge-success">!</span>
            <span class="d-md-down-none">{{ $logged_in_user->full_name }}</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-header text-center">
              <strong>@lang('navs.general.account')</strong>
            </div>

            <a class="dropdown-item" href="{{route('admin.messages')}}">
              <i class="fa fa-envelope"></i> @lang('navs.general.messages')
              <span class="badge unreadMessageCounter d-none badge-success">5</span>
            </a>

            <a class="dropdown-item" href="{{ route('admin.account') }}">
              <i class="fa fa-user"></i> @lang('navs.general.profile')
            </a>

            <div class="divider"></div>
            <a class="dropdown-item" href="{{ route('frontend.auth.logout') }}">
                <i class="fas fa-lock"></i> @lang('navs.general.logout')
            </a>
          </div>
        </li>
    </ul>
</header>

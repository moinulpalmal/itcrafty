<!-- BEGIN: Header-->
<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-static-top navbar-dark bg-gradient-x-grey-blue navbar-border navbar-brand-center">

    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="feather icon-menu font-large-1"></i></a></li>
                <li class="nav-item"><a class="navbar-brand" href="{{route('home')}}"><img class="brand-logo" alt="stack admin logo" src="{{ asset('/stack-admin/app-assets/images/logo/stack-logo-light.png') }}">
                        <h2 class="brand-text">IT Crafty</h2>
                    </a></li>
                <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="fa fa-ellipsis-v"></i></a></li>
            </ul>
        </div>
        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="feather icon-menu"></i></a></li>
                    <li class="nav-item d-none d-md-block"><a class="nav-link" onclick="refresh()" href="#" title="Refresh"><i class="fa fa-refresh"></i></a></li>
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#" title="Maximize"><i class="ficon feather icon-maximize"></i></a></li>
                </ul>
                <ul class="nav navbar-nav float-right">
                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <div class="avatar avatar-online">
                                <img
                                    @if(Auth::user()->profile_picture == "user.png")
                                    @if(Auth::user()->gender == "M") src="{{asset('/images/user/male_profile.png')}}"
                                    @elseif(Auth::user()->gender == "F") src="{{asset('/images/user/female_profile.png')}}"
                                    @else src="{{ asset('/stack-admin') }}/app-assets/images/portrait/small/avatar-s-1.png"
                                    @endif
                                    @else src="{{asset(Auth::user()->profile_picture)}}"
                                    @endif alt="{{Auth::user()->name}}"><i></i></div><span class="user-name">
                                {{Auth::user()->name}}
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{route('home.profile')}}"><i class="feather icon-user"></i> Profile</a>
                            <a class="dropdown-item" href="{{route('home.profile.change-password')}}"><i class="fa fa-key"></i> Change Password</a>
                            {{--<a class="dropdown-item" href="user-cards.html"><i class="feather icon-check-square"></i> Task</a>
                            <a class="dropdown-item" href="app-chat.html"><i class="feather icon-message-square"></i> Chats</a>--}}
                            {{--<div class="dropdown-divider"></div>--}}
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="feather icon-power"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<!-- END: Header-->










{{--<section id="header">
    <header class="clearfix">
        <!-- Branding -->
        <div class="branding">
            <a class="brand" href="{{route('start')}}">
                <span><strong>G</strong> Library</span>
            </a>
            <a role="button" tabindex="0" class="offcanvas-toggle visible-xs-inline"><i class="fa fa-bars"></i></a>
        </div>
        <!-- Branding end -->
    <!-- Left-side navigation -->
    <ul class="nav-left pull-left list-unstyled list-inline">
        <li class="sidebar-collapse divided-right">
            <a role="button" tabindex="0" class="collapse-sidebar">
                <i class="fa fa-outdent"></i>
            </a>
        </li>
    </ul>
    <!-- Left-side navigation end -->
    <!-- Right-side navigation -->
        <ul class="nav-right pull-right list-inline">
            <li class="dropdown nav-profile">
                <a href class="dropdown-toggle" data-toggle="dropdown">
                    @if(Auth::user()->gender == "M")
                        <img src="{{ asset('/') }}back-end/assets/images/male_profile.png" alt="" class="img-circle size-30x30">
                    @elseif(Auth::user()->gender == "F")
                        <img src="{{ asset('/') }}back-end/assets/images/female_profile.png" alt="" class="img-circle size-30x30">
                    @else
                        <img src="{{ asset('/') }}back-end/assets/images/male_profile.png" alt="" class="img-circle size-30x30">
                    @endif
                    <span>{{ Auth::user()->name }} <i class="fa fa-angle-down"></i></span>
                    --}}{{--                        <span>John Douey <i class="fa fa-angle-down"></i></span>--}}{{--
                </a>

                <ul class="dropdown-menu animated littleFadeInRight" role="menu">

                    @if(Auth::user()->gender != "O")
                    <li>
                        <a href="{{route('home.profile')}}" role="button" tabindex="0">
                            <span class="badge bg-greensea pull-right"></span>
                            <i class="fa fa-user"></i>Profile
                        </a>
                    </li>
                    <li>
                        <a href="{{route('home.profile.change-password')}}" role="button" tabindex="0">
                            <span class="badge bg-greensea pull-right"></span>
                            <i class="fa fa-key"></i>Change Password
                        </a>
                    </li>
                    @endif
                   --}}{{-- <li>
                        <a role="button" tabindex="0">
                            <span class="label bg-lightred pull-right">new</span>
                            <i class="fa fa-check"></i>Tasks
                        </a>
                    </li>
                    <li>
                        <a role="button" tabindex="0">
                            <i class="fa fa-cog"></i>Settings
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a role="button" tabindex="0">
                            <i class="fa fa-lock"></i>Lock
                        </a>
                    </li>--}}{{--
                    <li>
                        <a class="button" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out"></i>Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>

                </ul>

            </li>

            --}}{{--<li class="toggle-right-sidebar">
                <a role="button" tabindex="0">
                    <i class="fa fa-comments"></i>
                </a>
            </li>--}}{{--
        </ul>
        <!-- Right-side navigation end -->
    </header>

</section>--}}

<section id="header">
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
                    @else
                        <img src="{{ asset('/') }}back-end/assets/images/female_profile.png" alt="" class="img-circle size-30x30">
                        @endif
                    <span>{{ Auth::user()->name }} <i class="fa fa-angle-down"></i></span>
                    {{--                        <span>John Douey <i class="fa fa-angle-down"></i></span>--}}
                </a>

                <ul class="dropdown-menu animated littleFadeInRight" role="menu">

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
                    {{-- <li>
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
                     </li>--}}
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

            {{--<li class="toggle-right-sidebar">
                <a role="button" tabindex="0">
                    <i class="fa fa-comments"></i>
                </a>
            </li>--}}
        </ul>
        <!-- Right-side navigation end -->
    </header>

</section>

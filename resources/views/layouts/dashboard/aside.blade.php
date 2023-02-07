@if(auth()->user())

    @if (auth()->user()->hasRole('Super Admin') || auth()->user()->hasRole('Admin'))
        <div class="leftside-menu">
            @else
                <div class="leftside-menu not-superadmin">@endif
                <!-- Logo Light -->
                    <a href="{{route('dashboard.Receiptemployee')}}" class="logo logo-light">
                <span class="logo-lg">
                    <img src="{{asset('dashboardstyle/assets/images/logo-white.png')}}" alt="logo" height="50">
                </span>
                        <span class="logo-sm">
                    <img src="{{asset('dashboardstyle/assets/images/logo-white-sm.png')}}" alt="small logo" height="40">
                </span>
                    </a>

                    <!-- Logo Dark -->
                    <a href="{{route('dashboard.Receiptemployee')}}" class="logo logo-dark">
                <span class="logo-lg">
                    <img src="{{asset('dashboardstyle/assets/images/logo.png')}}" alt="dark logo" height="50">
                </span>
                        <span class="logo-sm">
                    <img src="{{asset('dashboardstyle/assets/images/logo-sm.png')}}" alt="small logo" height="40">
                </span>
                    </a>

                    <!-- Sidebar Hover Menu Toggle Button -->
                    <button type="button" class="btn button-sm-hover p-0" data-bs-toggle="tooltip" data-bs-placement="right"
                            title="Toggle to small/big">
                        <i class="ri-checkbox-blank-circle-line align-middle"></i>
                    </button>

                    <!-- Sidebar -left -->
                    <div class="h-100" id="leftside-menu-container" data-simplebar>
                        <!-- Leftbar User -->
                        <div class="leftbar-user">
                            <a href="{{route('dashboard.Receiptemployee')}}">
                                <img src="{{asset('dashboardstyle/assets/images/logo.png')}}" alt="user-image" height="42"
                                     class="rounded-circle shadow-sm">
                                <span class="leftbar-user-name">Dominic Keller</span>
                            </a>
                        </div>

                        <!--- Sidemenu -->
                        <ul class="side-nav mt-5">


                            <li class="side-nav-item">
                                <a href="{{route('dashboard.Receiptemployee')}}" class="side-nav-link">
                                    <i class="uil-home-alt"></i>
                                    {{--                    <span class="badge bg-success float-end">4</span>--}}
                                    <span> @lang('site.Receipt of the employee') </span>
                                </a>
                            </li>

    {{--                        @if (auth()->user()->hasRole('Super Admin'))--}}

                                <li class="side-nav-item">
                                    <a data-bs-toggle="collapse" href="#sidebarSettings" aria-expanded="false"
                                       aria-controls="sidebarSettings" class="side-nav-link">
                                        <i class="uil-wrench"></i>
                                        <span> @lang('site.settings') </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="sidebarSettings">
                                        <ul class="side-nav-second-level">
                                            @if (auth()->user()->hasPermission('read_users'))
                                                <li><a href="{{route('dashboard.users.index')}}">@lang('site.users')</a>
                                                </li>
                                            @endif
                                            @if (auth()->user()->hasPermission('read_roles'))

                                                <li><a href="{{route('dashboard.roles.index')}}">@lang('site.roles')</a>
                                                </li>
                                            @endif

                                            @if (auth()->user()->hasPermission('read_countries'))
                                                <li>
                                                    <a href="{{route('dashboard.countries.index')}}">@lang('site.countries')
                                                        @lang('site.cities')</a>
                                                </li>
                                            @endif
                                            {{--                            @if (auth()->user()->hasPermission('read_cities'))--}}
                                            {{--                                <li><a href="{{route('dashboard.cities.index')}}">@lang('site.cities')</a>
                                </li>--}}
                                            {{--                            @endif--}}


                                            @if (auth()->user()->hasPermission('read_currencies'))
                                                <li>
                                                    <a href="{{route('dashboard.currencies.index')}}">@lang('site.currencies')</a>
                                                </li>
                                            @endif

                                            @if (auth()->user()->hasPermission('read_branches'))
                                                <li>
                                                    <a href="{{route('dashboard.branches.index')}}">@lang('site.branches')</a>
                                                </li>
                                            @endif



                                            @if (auth()->user()->hasPermission('read_categories'))
                                                <li>
                                                    <a href="{{route('dashboard.categories.index')}}">@lang('site.categories')</a>
                                                </li>

                                            @endif
                                            @if (auth()->user()->hasPermission('read_pages'))
                                                <li><a href="{{route('dashboard.pages.index')}}">@lang('site.pages')</a>
                                                </li>
                                            @endif

                                        </ul>
                                    </div>
                                </li>

                                <li class="side-nav-item">
                                    <a data-bs-toggle="collapse" href="#sidebarEmployee" aria-expanded="false"
                                       aria-controls="sidebarEmployee"
                                       class="side-nav-link">
                                        <i class="uil uil-users-alt"></i>
                                        <span> @lang('site.employee') </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="sidebarEmployee">
                                        <ul class="side-nav-second-level">
                                            @if (auth()->user()->hasPermission('read_employee'))
                                                <li>
                                                    <a href="{{route('dashboard.employee.index')}}">@lang('site.employee')</a>
                                                </li>
                                                @if (auth()->user()->hasPermission('read_salaries'))

                                                    <li>
                                                        <a href="{{route('dashboard.salarywedgesfirst')}}">@lang('site.salaries_wages')</a>
                                                    </li>



                                                    <li>
                                                        <a href="{{route('dashboard.salaries.index')}}">@lang('site.Reportsalaries')</a>
                                                    </li>
                                                @endif

                                                {{--                <!--        <li><a href="{{route('dashboard.loans.index')}}">@lang('site.loans')</a>-->--}}
                                                {{--                <!--</li>-->--}}

                                                {{--                <!--<li><a href="{{route('dashboard.discounts.index')}}">@lang('site.discounts')</a>-->--}}
                                                {{--                <!--</li>-->--}}

                                                {{--                <!--<li><a href="{{route('dashboard.rewards.index')}}">@lang('site.rewards')</a>-->--}}
                                                {{--                <!--</li>-->--}}
                                            @endif


                                            @if (auth()->user()->hasPermission('read_LeaveAttendence'))

                                                <li><a href="{{route('dashboard.periods.index')}}">@lang('site.periods')</a>
                                                </li>


                                                <li>
                                                    <a href="{{route('dashboard.leaveAttendees')}}">@lang('site.LeaveAttendence')</a>
                                                </li>

                                            @endif

                                            @if (auth()->user()->hasPermission('read_linkeds'))

                                                <li><a href="{{route('dashboard.linkeds.index')}}">@lang('site.linkeds')</a>
                                                </li>

                                            @endif
                                            @if (auth()->user()->hasPermission('read_ratings'))
                                                <li><a href="{{route('dashboard.ratings.index')}}">@lang('site.ratings')</a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </li>

    {{--                        @endif--}}

                            <li class="side-nav-item">
                                <a data-bs-toggle="collapse" href="#sidebarManagement" aria-expanded="false"
                                   aria-controls="sidebarManagement"
                                   class="side-nav-link">
                                    <i class="uil-clipboard-notes"></i>
                                    <span>@lang('site.tasks_management') </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarManagement">
                                    <ul class="side-nav-second-level">
                                        <li><a href="{{route('tasks.board')}}">@lang('tasks::menue.home')</a></li>
                                    </ul>
                                </div>
                            </li>


                        </ul>
                        <!--- End Sidemenu -->


                        <div class="clearfix"></div>
                    </div>
                </div>
@endif
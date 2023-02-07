@if (auth()->user()->hasRole('Super Admin'))
    <div class="sidebar-wrapper hhhh p-0">
        <div class="close-btn">
            <i class="fa-solid fa-xmark"></i>
        </div>
        <div class="sidebar-logo">
            <a href="{{route('dashboard.Receiptemployee')}}"><img src="{{asset('assets/images/logo/logo.png')}}"
                                                                  alt="logo"></a>
        </div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">


                    <!--<li class="sidebar-list">-->
                <!--    <a class="sidebar-link sidebar-title link-nav" href="{{route('dashboard.Receiptemployee')}}">-->
                    <!--        <i data-feather="home"> </i>-->
                <!--        <span> @lang('site.Receipt of the employee')</span>-->
                    <!--    </a>-->
                    <!--</li>-->

                    @if (auth()->user()->hasRole('Super Admin'))

                        <li class="sidebar-list">
                            <a class="sidebar-link sidebar-title" href="#">
                                <i data-feather="settings"></i>
                                <span class="lan-6">@lang('site.settings')  </span>
                            </a>
                            <ul class="sidebar-submenu">
                                @if (auth()->user()->hasPermission('read_users'))
                                    <li><a href="{{route('dashboard.users.index')}}">@lang('site.users')</a></li>
                                @endif
                                @if (auth()->user()->hasPermission('read_roles'))

                                    <li><a href="{{route('dashboard.roles.index')}}">@lang('site.roles')</a></li>
                                @endif

                                @if (auth()->user()->hasPermission('read_countries'))
                                    <li><a href="{{route('dashboard.countries.index')}}">@lang('site.countries') @lang('site.cities')</a></li>
                                @endif
                                {{--                            @if (auth()->user()->hasPermission('read_cities'))--}}
                                {{--                                <li><a href="{{route('dashboard.cities.index')}}">@lang('site.cities')</a></li>--}}
                                {{--                            @endif--}}
                                @if (auth()->user()->hasPermission('read_currencies'))
                                    <li><a href="{{route('dashboard.currencies.index')}}">@lang('site.currencies')</a></li>
                                @endif

                                @if (auth()->user()->hasPermission('read_branches'))
                                    <li><a href="{{route('dashboard.branches.index')}}">@lang('site.branches')</a></li>
                                @endif



                                @if (auth()->user()->hasPermission('read_categories'))
                                    <li><a href="{{route('dashboard.categories.index')}}">@lang('site.categories')</a></li>

                                @endif
                                @if (auth()->user()->hasPermission('read_pages'))
                                    <li><a href="{{route('dashboard.pages.index')}}">@lang('site.pages')</a></li>
                                @endif





                            </ul>
                        </li>

                        <li class="sidebar-list">
                            <a class="sidebar-link sidebar-title" href="#">
                                <i data-feather="file-text"></i>
                                <span class="lan-6">@lang('site.Accounts') </span>
                            </a>
                            <ul class="sidebar-submenu">

                            </ul>
                        </li>



                        <li class="sidebar-list">
                            <a class="sidebar-link sidebar-title" href="#">
                                <i data-feather="command"></i>
                                <span class="lan-6">@lang('site.employee')</span>
                            </a>
                            <ul class="sidebar-submenu">
                                @if (auth()->user()->hasPermission('read_employee'))
                                    <li><a href="{{route('dashboard.employee.index')}}">@lang('site.employee')</a></li>

                                    <li><a href="{{route('dashboard.salaries_wages_data.index')}}">@lang('site.salaries_wages')</a>
                                    </li>

                                <!--        <li><a href="{{route('dashboard.loans.index')}}">@lang('site.loans')</a>-->
                                    <!--</li>-->

                                <!--<li><a href="{{route('dashboard.discounts.index')}}">@lang('site.discounts')</a>-->
                                    <!--</li>-->

                                <!--<li><a href="{{route('dashboard.rewards.index')}}">@lang('site.rewards')</a>-->
                                    <!--</li>-->
                                @endif


                                @if (auth()->user()->hasPermission('read_LeaveAttendence'))

                                    <li><a href="{{route('dashboard.periods.index')}}">@lang('site.periods')</a></li>


                                    <li><a href="{{route('dashboard.leaveAttendees')}}">@lang('site.LeaveAttendence')</a>
                                    </li>

                                @endif
                                @if (auth()->user()->hasPermission('read_salaries'))
                                    {{--                            <li><a href="{{route('dashboard.salaries_wages.index')}}">@lang('site.salaries_wages')</a></li>--}}
                                    <li><a href="{{route('dashboard.salaries.index')}}">@lang('site.salaries')</a></li>
                                @endif
                                @if (auth()->user()->hasPermission('read_linkeds'))

                                    <li><a href="{{route('dashboard.linkeds.index')}}">@lang('site.linkeds')</a></li>

                                @endif
                                @if (auth()->user()->hasPermission('read_ratings'))
                                    <li><a href="{{route('dashboard.ratings.index')}}">@lang('site.ratings')</a></li>

                                @endif
                                @if (auth()->user()->hasPermission('read_dailytasks'))
                                    <li><a href="{{route('dashboard.dailytasks.index')}}">@lang('site.dailytasks')</a></li>

                                @endif



                            </ul>
                        </li>




                        <li class="sidebar-list">
                            <a class="sidebar-link sidebar-title" href="#">
                                <i data-feather="box"></i>
                                <span class="lan-6">@lang('site.reports') </span>
                            </a>
                            <ul class="sidebar-submenu">
                                @if (auth()->user()->hasPermission('read_employee'))
                                    <li><a href="{{route('dashboard.ReportEmployee')}}">@lang('site.employee')</a></li>
                                    <li><a href="{{route('dashboard.salaries_wages.create')}}">@lang('site.salaries_wages')</a></li>


                                @endif
                                @if (auth()->user()->hasPermission('read_ratings'))
                                    <li><a href="{{route('dashboard.ReportRatings')}}">@lang('site.ratings')</a></li>

                                @endif
                            </ul>
                        </li>

                        {{--            @if (auth()->user()->hasPermission('tasks_management'))--}}
                        <li class="sidebar-list">
                            <a class="sidebar-link sidebar-title" href="#">
                                <i data-feather="list"></i>
                                <span class="lan-6">@lang('site.tasks_management') </span>
                            </a>
                            <ul class="sidebar-submenu">
                                <li><a href="{{route('tasks.board')}}">@lang('tasks::menue.home')</a></li>
                                {{-- <li><a href="{{route('tasks.board')}}">@lang('tasks::todo.plural_name')</a></li>--}}
{{--                                <li><a href="{{route('tasks.board')}}">@lang('tasks::workspaces.plural_name')</a></li>--}}
{{--                                <li><a href="{{route('tasks.board')}}">@lang('tasks::statuses.plural_name')</a></li>--}}
                            </ul>
                        </li>
                        {{--               @endif--}}

                    @endif

                </ul>
            </div>
        </nav>









    </div>
@endif
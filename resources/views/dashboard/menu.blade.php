<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-closed" data-keep-expanded="false"
            data-auto-scroll="true"
            data-slide-speed="200" style="padding-top: 20px">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <li class="sidebar-toggler-wrapper hide">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler"></div>
                <!-- END SIDEBAR TOGGLER BUTTON -->
            </li>
            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->

            <li class="nav-item  {!! Route::current()->getName() == 'Dashboard.landing' ? 'start active open' : '' !!}">
                <a href="{{route('Dashboard.landing')}}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="selected"></span>

                </a>
            </li>

            <li class="nav-item {!! strpos(Route::current()->getName(), 'ben') !== false  ? 'active open' : '' !!}">

                <a href="{{route('Dashboard.ben.crud.list')}}" class="nav-link nav-toggle">
                    <i class="fa fa-users"></i>
                    <span class="title">Beneficiaries</span>
                    <span class="selected"></span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  {!! Request::is('*crud*') ? 'active' : '' !!}">
                        <a href="{{route('Dashboard.ben.crud.list')}}" class="nav-link ">
                            <span class="title">Database</span>
                        </a>
                    </li>
                    <li class="nav-item  {!! Request::is('*stats*') ? 'active' : '' !!}">
                        <a href="{{route('Dashboard.ben.stats')}}" class="nav-link ">
                            <span class="title">Statistics</span>
                            <span class="selected"></span>
                            <span class="arrow "></span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item {!! strpos(Route::current()->getName(), 'org') !== false  ? 'active open' : '' !!} ">
                <a href="{{route('Dashboard.org.crud.list')}}" class="nav-link nav-toggle">
                    <i class="fa fa-user"></i>
                    <span class="title">Services Providers</span>
                    <span class="selected"></span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {!! Request::is('*crud*') ? 'active' : '' !!}">
                        <a href="{{route('Dashboard.org.crud.list')}}" class="nav-link ">
                            <span class="title">Database</span>
                        </a>
                    </li>
                    <li class="nav-item  {!! Request::is('*verify*') ? 'active' : '' !!}">
                        <a href="{{route('Dashboard.org.verify.list','org')}}"
                           class="nav-link ">
                            <span class="title">Organization</span>
                        </a>
                    </li>
                    <li class="nav-item  {!! Request::is('*stats*') ? 'active' : '' !!}">
                        <a href="{{route('Dashboard.org.stats')}}" class="nav-link ">
                            <span class="title">Statistics</span>
                        </a>
                    </li>
                </ul>

            </li>
            <li class="nav-item  {!! strpos(Route::current()->getName(), 'work') !== false  ? 'active open' : '' !!}">
                <a href="{{route('Dashboard.work.crud.list')}}" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">Social Workers</span>
                    <span class="selected"></span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  {!! Request::is('*crud*') ? 'active' : '' !!}">
                        <a href="{{route('Dashboard.work.crud.list')}}" class="nav-link ">
                            <span class="title">Database</span>
                        </a>
                    </li>
                    <li class="nav-item  {!! Request::is('*hire*') ? 'active' : '' !!}">
                        <a href="{{route('Dashboard.work.hire')}}" class="nav-link ">
                            <span class="title">Hiring</span>
                        </a>
                    </li>
                    <li class="nav-item  {!! Request::is('*monitor*') ? 'active' : '' !!}">
                        <a href="{{route('Dashboard.work.monitor')}}" class="nav-link ">
                            <span class="title">monitoring and evaluation</span>
                        </a>
                    </li>
                    <li class="nav-item  {!! Request::is('*stats*') ? 'active' : '' !!}">
                        <a href="{{route('Dashboard.work.stats')}}" class="nav-link ">
                            <span class="title">Statistics</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item  {!! strpos(Route::current()->getName(), 'admin') !== false  ? 'active open' : '' !!}">
                <a href="{{route('Dashboard.admin.crud.list')}}" class="nav-link nav-toggle">
                    <i class="icon-bulb"></i>
                    <span class="title">Account Management</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {!! Request::is('*crud*') ? 'active' : '' !!} ">
                        <a href="{{route('Dashboard.admin.crud.list')}}" class="nav-link ">
                            <span class="title">Manage</span>
                        </a>
                    </li>
                    <li class="nav-item {!! Request::is('*crud/create*') ? 'active' : '' !!} ">
                        <a href="{{route('Dashboard.admin.crud.create')}}" class="nav-link ">
                            <span class="title">Add</span>
                        </a>
                    </li>

                </ul>
            </li>
        </ul>
        <!-- END SIDEBAR MENU -->
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
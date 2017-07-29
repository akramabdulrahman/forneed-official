<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apppagespage-sidebar-menu-light" class right aftpagespage-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apppagespage-sidebar-menu-hover-submenu" class right aftpagespage-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apppagespage-sidebar-menu-closed" class right aftpagespage-sidebar-menu" to collappagespage-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
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

            <li class="nav-item  {!! Route::current()->getName() == 'endusers.org.index' ? 'start active open' : '' !!}">
                <a href="{{route('endusers.org.index')}}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="selected"></span>

                </a>
            </li>

            <?php if (Request::is('*surveys*') || Request::is('*questions*')) {
                $projectSub = true;
            } else {
                $projectSub = false;
            } ?>
            <li class="nav-item  {!! strpos(Route::current()->getName(), 'projects') !== false  ? 'active open' : '' !!}">
                <a href="{{route('endusers.org.projects.list')}}" class="nav-link nav-toggle">
                    <i class="fa fa-tasks"></i>
                    <span class="title">Projects</span>
                    <span class="selected"></span>
                </a>
                @if($projectSub)
                    <ul class="sub-menu">
                        <li class="nav-item  {!! Request::is('*surveys*') ? 'active' : '' !!}">
                            <a href="{{route('endusers.org.projects.list')}}" class="nav-link ">
                                <span class="title">Surveys</span>
                            </a>
                        </li>
                        <li class="nav-item  {!! Request::is('*questions*') ? 'active' : '' !!}">
                            <a href="{{route('endusers.org.projects.list')}}" class="nav-link ">
                                <span class="title">Questions</span>
                            </a>
                        </li>
                    </ul>
                @endif
            </li>

            <li class="nav-item  {!! Route::current()->getName() == 'endusers.org.stats' ? 'start active open' : '' !!}">
                <a href="{{route('endusers.org.stats')}}" class="nav-link nav-toggle">
                    <i class=" fa fa-pie-chart"></i>
                    <span class="title">Statistics</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item  {!! Route::current()->getName() == 'endusers.org.performance' ? 'start active open' : '' !!}">
                <a href="{{route('endusers.org.performance')}}" class="nav-link nav-toggle">
                    <i class="fa fa-bar-chart"></i>
                    <span class="title">Performance Report</span>
                    <span class="selected"></span>
                </a>
            </li>

        </ul>
        <!-- END SIDEBAR MENU -->
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
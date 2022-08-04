<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="{{ route('admin.home') }}" class="brand-link">
        <strong>INS</strong>
        <span class="brand-text font-weight-light"> | LOGIKEYE</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('admin.home') }}" class="nav-link {{ request()->is('admin') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <p>
                            <span>{{ trans('global.dashboard') }}</span>
                        </p>
                    </a>
                </li>

                    <!-- <li class="nav-item">
                        <a href="{{ route('admin.operating_status') }}" class="nav-link {{ request()->is('admin/operating_status') || request()->is('admin/operating_status/*') ? 'active' : '' }}">
                            <i class="fas fa-tasks">

                            </i>
                            <p>
                                <span>Operating Status</span>
                            </p>
                        </a>
                    </li> -->

                @can('machine_status')
                    <li class="nav-item">
                        <a href="{{ url('admin/machine_status') }}" class="nav-link {{ request()->is('admin/machine_status') || request()->is('admin/machine_status/*') ? 'active' : '' }}">
                            <i class="fas fa-battery-half">

                            </i>
                            <p>
                                <span>{{ trans('global.machine.title_st') }}</span>
                            </p>
                        </a>
                    </li>
                @endcan

                    


                @can('machine_status')
                    <li class="nav-item">
                        <a href="{{ url('admin/machine') }}" class="nav-link {{ request()->is('admin/machine') || request()->is('admin/machine/*') ? 'active' : '' }}">
                            <i class="fas fa-industry">

                            </i>
                            <p>
                                <span>{{ trans('global.machine.title') }} List</span>
                            </p>
                        </a>
                    </li>
                @endcan


                <li class="nav-item">
                    <a href="{{ route('admin.npt') }}" class="nav-link {{ request()->is('admin/npt') || request()->is('admin/npt/*') ? 'active' : '' }}">
                        <i class="fas fa-clock">

                        </i>
                        <p>
                            <span>Non Productive Time</span>
                        </p>
                    </a>
                </li>


                <li class="nav-item has-treeview {{ request()->is('record*') ? 'menu-open' : '' }}">
                    <a class="nav-link nav-dropdown-toggle">
                        <i class="fas fa-tasks">

                        </i>
                        <p>
                            <span>Record</span>
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('record.index') }}" class="nav-link {{ request()->is('record/index') ? 'active' : '' }}">
                                <i class="fas fa-calendar">

                                </i>
                                <p>
                                    <span>Date Wise</span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('record.machine.index') }}" class="nav-link {{ request()->is('record/machine/index') || request()->is('record/machine*') ? 'active' : '' }}">
                                <i class="fa fa-luggage-cart">

                                </i>
                                <p>
                                    <span>Machine Wise Records </span>
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>


                @can('setup')
                    <li class="nav-item has-treeview {{ request()->is('admin/setup*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle">
                            <i class="fas fa-cog">

                            </i>
                            <p>
                                <span>Admin Menu</span>
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('setup')
                                <li class="nav-item">
                                    <a href="{{ route('admin.setup.location') }}" class="nav-link {{ request()->is('admin/setup/location*') ? 'active' : '' }}">
                                        <i class="fas fa-map-marker">

                                        </i>
                                        <p>
                                            <span>Location Management</span>
                                        </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('admin.setup.line') }}" class="nav-link {{ request()->is('admin/setup/line*') ? 'active' : '' }}">
                                        <i class="fas fa-grip-lines">

                                        </i>
                                        <p>
                                            <span>Line Management</span>
                                        </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('admin.setup.machine') }}" class="nav-link {{ request()->is('admin/setup/machine*') ? 'active' : '' }}">
                                        <i class="fas fa-tram"></i>

                                        </i>
                                        <p>
                                            <span>Machine Management</span>
                                        </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('admin.setup.operator') }}" class="nav-link {{ request()->is('admin/setup/operator*') ? 'active' : '' }}">
                                        <i class="fas fa-temperature-high">

                                        </i>
                                        <p>
                                            <span>Operator Management</span>
                                        </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('admin.setup.item') }}" class="nav-link {{ request()->is('admin/setup/item*') ? 'active' : '' }}">
                                        <i class="fas fa-sitemap"></i>
                                        <p>
                                            <span>Item Management</span>
                                        </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('admin.setup.process') }}" class="nav-link {{ request()->is('admin/setup/process*') ? 'active' : '' }}">
                                        <i class="fas fa-microchip"></i>
                                        <p>
                                            <span>Process Management</span>
                                        </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('admin.setup.target') }}" class="nav-link {{ request()->is('admin/setup/target*') ? 'active' : '' }}">
                                        <i class="fas fa-dot-circle"></i>
                                        <p>
                                            <span>Target Management</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            {{-- @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route('admin.roles.index') }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                        <i class="fas fa-briefcase">

                                        </i>
                                        <p>
                                            <span>{{ trans('global.role.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                        <i class="fas fa-user">

                                        </i>
                                        <p>
                                            <span>{{ trans('global.user.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan --}}
                        </ul>
                    </li>
                @endcan

                @can('user_management_access')
                    <li class="nav-item has-treeview {{ request()->is('admin/permissions*') ? 'menu-open' : '' }} {{ request()->is('admin/roles*') ? 'menu-open' : '' }} {{ request()->is('admin/users*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle">
                            <i class="fas fa-users">

                            </i>
                            <p>
                                <span>{{ trans('global.userManagement.title') }}</span>
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route('admin.permissions.index') }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                        <i class="fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            <span>{{ trans('global.permission.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route('admin.roles.index') }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                        <i class="fas fa-briefcase">

                                        </i>
                                        <p>
                                            <span>{{ trans('global.role.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                        <i class="fas fa-user">

                                        </i>
                                        <p>
                                            <span>{{ trans('global.user.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                
                @can('setup')
                    <li class="nav-item">
                        <a href="{{ route('api_install') }}" class="nav-link {{ request()->is('api_install') || request()->is('api_install/*') ? 'active' : '' }}">
                            <i class="fas fa-clock">

                            </i>
                            <p>
                                <span>Run Artisan Command</span>
                            </p>
                        </a>
                    </li>
                @endcan

                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <p>
                            <i class="fas fa-sign-out-alt">

                            </i>
                            <span>{{ trans('global.logout') }}</span>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
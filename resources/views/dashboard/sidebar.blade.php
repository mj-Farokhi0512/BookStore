        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo">
                </a>
                <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                    <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
                    <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
                </a>
            </div>

            <div class="menu-inner-shadow"></div>

            <ul class="menu-inner py-1">
                <!-- Dashboards -->
                <li class="menu-item">
                    <a href="{{ route('dashboard') }}" class="menu-link">
                        <i class="menu-icon tf-icons ti ti-smart-home"></i>
                        <div data-i18n="Dashboards">داشبورد</div>
                    </a>
                </li>

                <!-- Apps & Pages -->
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">برنامه &amp; Pages</span>
                </li>
                @role('MANAGER')
                    <li class="menu-item">
                        <a href="{{ route('dashboard.users') }}" class="menu-link">
                            <i class="menu-icon tf-icons ti ti-users"></i>
                            <div data-i18n="Users">Users</div>
                        </a>
                    </li>
                @endrole

                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons ti ti-settings"></i>
                        <div data-i18n="Roles & Permissions">Roles & Permissions</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="app-access-roles.html" class="menu-link">
                                <div data-i18n="Roles">Roles</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="app-access-permission.html" class="menu-link">
                                <div data-i18n="Permission">Permission</div>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </aside>
        <!-- / Menu -->

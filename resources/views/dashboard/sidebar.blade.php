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
                <div data-i18n="داشبورد">Dashboard</div>
            </a>
        </li>

        <!-- Apps & Pages -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">برنامه و صفحات</span>
        </li>
        @role('MANAGER|ADMIN')
            <li class="menu-item">
                <a href="{{ route('books') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-book"></i>
                    <div data-i18n="کتاب ها">کتاب ها</div>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('tag_category') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-color-swatch"></i>
                    <div data-i18n="دسته بندی و برچسب">دسته بندی و برچسب</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons ti ti-settings"></i>
                    <div data-i18n="نقش و دسترسی">نقش و دسترسی</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="app-access-roles.html" class="menu-link">
                            <div data-i18n="نقش ها">نقش ها</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="app-access-permission.html" class="menu-link">
                            <div data-i18n="دسترسی ها">دسترسی ها</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endrole

        @role('MANAGER')
            <li class="menu-item">
                <a href="{{ route('users') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-users"></i>
                    <div data-i18n="کاربران">کاربران</div>
                </a>
            </li>
        @endrole
        @role('USER')
            <li class="menu-item">
                <a href="{{ route('cart') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-shopping-cart"></i>
                    <div data-i18n="سبدخرید">سبدخرید</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('paids') }}" class="menu-link">
                    <i class="menu-icon tf-icons fa-regular fa-dollar-sign"></i>
                    <div data-i18n="پرداخت ها">پرداخت ها</div>
                </a>
            </li>
        @endrole
        <li class="menu-item">
            <a href="{{ route('profile') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-user"></i>
                <div data-i18n="پروفایل">پروفایل</div>
            </a>
        </li>
    </ul>
</aside>
<!-- / Menu -->

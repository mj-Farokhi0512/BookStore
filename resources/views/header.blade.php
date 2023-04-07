<!-- Header -->
@php
    $user = Auth::user();
@endphp
<header class="site-header mo-left header style-1">
    <!-- Main Header -->
    <div class="header-info-bar">
        <div class="container clearfix">
            <!-- Website Logo -->
            <div class="logo-header logo-dark">
                <a href="{{ route('home') }}"><img src="{{ asset('images/logo_1.png') }}" alt="logo"></a>
            </div>

            <!-- EXTRA NAV -->
            <div class="extra-nav">
                <div class="extra-cell">
                    <ul class="navbar-nav header-right">
                        @can('read_cart')
                            <li class="nav-item">
                                <a class="nav-link" href="wishlist.html">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                        width="24px" fill="#000000">
                                        <path d="M0 0h24v24H0V0z" fill="none" />
                                        <path
                                            d="M16.5 3c-1.74 0-3.41.81-4.5 2.09C10.91 3.81 9.24 3 7.5 3 4.42 3 2 5.42 2 8.5c0 3.78 3.4 6.86 8.55 11.54L12 21.35l1.45-1.32C18.6 15.36 22 12.28 22 8.5 22 5.42 19.58 3 16.5 3zm-4.4 15.55l-.1.1-.1-.1C7.14 14.24 4 11.39 4 8.5 4 6.5 5.5 5 7.5 5c1.54 0 3.04.99 3.57 2.36h1.87C13.46 5.99 14.96 5 16.5 5c2 0 3.5 1.5 3.5 3.5 0 2.89-3.14 5.74-7.9 10.05z" />
                                    </svg>
                                    @auth
                                        <span class="badge">21</span>
                                    @endauth
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('cart') }}">
                                    <button type="button" class="nav-link box cart-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                            width="24px" fill="#000000">
                                            <path d="M0 0h24v24H0V0z" fill="none" />
                                            <path
                                                d="M15.55 13c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.37-.66-.11-1.48-.87-1.48H5.21l-.94-2H1v2h2l3.6 7.59-1.35 2.44C4.52 15.37 5.48 17 7 17h12v-2H7l1.1-2h7.45zM6.16 6h12.15l-2.76 5H8.53L6.16 6zM7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z" />
                                        </svg>
                                        @auth
                                            <span class="badge"
                                                id="cart_count">{{ count($user->orders()->wherePivotNull('deleted_at')->wherePivot('paid', false)->get()) }}</span>

                                        @endauth
                                    </button>
                                </a>
                            </li>
                        @endcan
                        @auth
                            <li class="nav-item dropdown profile-dropdown  ms-4">
                                <a class="nav-link" href="{{ route('dashboard') }}" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <img src="{{ $user->profile ? asset('storage/' . $user->profile) : asset('dash/images/profile-placeholder.png') }}"
                                        alt="/">
                                    <div class="profile-info">
                                        <h6 class="title">{{ $user->name }}</h6>
                                        <span>{{ $user->email }}</span>
                                    </div>
                                </a>
                                <div class="dropdown-menu py-0 dropdown-menu-end">
                                    <div class="dropdown-header">
                                        <h6 class="m-0">{{ $user->name }}</h6>
                                        <span>{{ $user->email }}</span>
                                    </div>
                                    <div class="dropdown-body">
                                        <a href="{{ route('profile') }}"
                                            class="dropdown-item d-flex justify-content-between align-items-center ai-icon">
                                            <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24"
                                                    width="20px" fill="#000000">
                                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                                    <path
                                                        d="M12 6c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2m0 10c2.7 0 5.8 1.29 6 2H6c.23-.72 3.31-2 6-2m0-12C9.79 4 8 5.79 8 8s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 10c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                                </svg>
                                                <span class="ms-2">Profile</span>
                                            </div>
                                        </a>
                                        @can('read_cart')
                                            <a href="#"
                                                class="dropdown-item d-flex justify-content-between align-items-center ai-icon">
                                                <div>
                                                    <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24"
                                                        width="20px" fill="#000000">
                                                        <path d="M0 0h24v24H0V0z" fill="none" />
                                                        <path
                                                            d="M15.55 13c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.37-.66-.11-1.48-.87-1.48H5.21l-.94-2H1v2h2l3.6 7.59-1.35 2.44C4.52 15.37 5.48 17 7 17h12v-2H7l1.1-2h7.45zM6.16 6h12.15l-2.76 5H8.53L6.16 6zM7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z" />
                                                    </svg>
                                                    <span class="ms-2">My Order</span>
                                                </div>
                                            </a>
                                            <a href="#"
                                                class="dropdown-item d-flex justify-content-between align-items-center ai-icon">
                                                <div>
                                                    <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24"
                                                        width="20px" fill="#000000">
                                                        <path d="M0 0h24v24H0V0z" fill="none" />
                                                        <path
                                                            d="M16.5 3c-1.74 0-3.41.81-4.5 2.09C10.91 3.81 9.24 3 7.5 3 4.42 3 2 5.42 2 8.5c0 3.78 3.4 6.86 8.55 11.54L12 21.35l1.45-1.32C18.6 15.36 22 12.28 22 8.5 22 5.42 19.58 3 16.5 3zm-4.4 15.55l-.1.1-.1-.1C7.14 14.24 4 11.39 4 8.5 4 6.5 5.5 5 7.5 5c1.54 0 3.04.99 3.57 2.36h1.87C13.46 5.99 14.96 5 16.5 5c2 0 3.5 1.5 3.5 3.5 0 2.89-3.14 5.74-7.9 10.05z" />
                                                    </svg>
                                                    <span class="ms-2">Wishlist</span>
                                                </div>
                                            </a>
                                        @endcan
                                    </div>
                                    <div class="dropdown-footer">
                                        <a class="btn btn-primary w-100 btnhover btn-sm" href="shop-login.html">Log
                                            Out</a>
                                    </div>
                                </div>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>

            <!-- header search nav -->
            <div class="header-search-nav">
                <form class="header-item-search mx-auto">
                    <div class="input-group search-input">
                        <select class="default-select">
                            <option>Category</option>
                            <option>Tag</option>
                            <option>Name</option>
                        </select>
                        <input type="text" class="form-control" aria-label="Text input with dropdown button"
                            placeholder="Search Books Here">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Main Header End -->

    <!-- Main Header -->
    <div class="sticky-header main-bar-wraper navbar-expand-lg">
        <div class="main-bar clearfix">
            <div class="container clearfix d-lg-flex">
                <!-- Website Logo -->
                <div class="logo-header logo-dark">
                    <a href="{{ route('home') }}"><img src="{{ asset('images/logo_1.png') }}" alt="logo"></a>
                </div>

                <!-- Nav Toggle Button -->
                <button class="navbar-toggler collapsed navicon justify-content-end" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>


                <!-- Main Nav -->
                <div class="header-nav navbar-collapse collapse justify-content-start" id="navbarNavDropdown">
                    <div class="logo-header logo-dark">
                        <a href="{{ route('home') }}"><img src="{{ asset('images/logo_1.png') }}" alt></a>
                    </div>
                    <form class="search-input">
                        <div class="input-group">
                            <input type="text" class="form-control" aria-label="Text input with dropdown button"
                                placeholder="Search Books Here">
                            <button class="btn" type="button"><i class="flaticon-loupe"></i></button>
                        </div>
                    </form>
                    <ul class="nav navbar-nav">
                        <li><a href="{{ route('home') }}"><span>خانه</span></a>
                        </li>
                        <li><a href="contact-us.html"><span>کتاب ها</span></a></li>
                    </ul>
                </div>
                <!-- EXTRA NAV -->
                <div class="extra-nav">
                    @auth
                        <div class="extra-cell">
                            <a href="{{ route('dashboard') }}" class="btn btn-primary btnhover">داشبورد</a>
                        </div>
                    @else
                        <div class="extra-cell">
                            <a href="{{ route('login') }}" class="btn btn-primary btnhover">ورود</a>
                        </div>
                        <div class="extra-cell">
                            <a href="{{ route('register') }}" class="btn btn-primary btnhover">ثبت نام</a>
                        </div>
                    @endauth

                </div>
            </div>
        </div>
    </div>
    <!-- Main Header End -->

</header>

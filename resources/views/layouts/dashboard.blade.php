<!DOCTYPE html>
<html class="light-style layout-navbar-fixed layout-menu-fixed" dir="rtl" data-theme="theme-default"
    data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <!--
    <title>
      Content navbar + Sidebar - Layouts | Vuexy - Bootstrap Admin Template
    </title>

    <meta
      name="description"
      content="Start your development with a Dashboard for Bootstrap 5"
    />
    <meta
      name="keywords"
      content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5"
    /> -->
    <!-- Canonical SEO -->
    <!-- ? PROD Only: Google Tag Manager (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
    <!-- <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                "gtm.start": new Date().getTime(),
                event: "gtm.js"
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != "dataLayer" ? "&l=" + l : "";
            j.async = true;
            j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, "script", "dataLayer", "GTM-5J3LMKC");
    </script> -->
    <!-- End Google Tag Manager -->

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="./images/favicon/favicon.ico" />

    <!-- Fonts -->
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin /> -->
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    {{-- <link rel="stylesheet" href="{{ asset('dash/css/fontawesome.css') }}" /> --}}
    <link rel="stylesheet" href="{{ asset('css/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome/css/solid.css') }}">
    <link rel="stylesheet" href="{{ asset('dash/css/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('dash/css/flag-icons.css') }}" />

    <!-- Core CSS -->

    <link rel="stylesheet" href="{{ asset('dash/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('dash/css/theme-default.css') }}" />
    <link rel="stylesheet" href="{{ asset('dash/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('dash/css/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('dash/css/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('dash/css/typeahead.css') }}" />

    <link rel="stylesheet" href="{{ asset('dash/css/theme-default.css') }}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('dash/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ asset('dash/js/template-customizer.js') }}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('dash/js/config.js') }}"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            @include('dashboard.sidebar')


            <!-- Layout container -->
            <div class="layout-page">
                @include('dashboard.navbar')

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl d-flex align-items-stretch flex-grow-1 p-0">
                        @yield('content')
                    </div>
                    <!-- / Content -->

                    @include('dashboard.footer')

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('dash/js/jquery.js') }}"></script>
    <script src="{{ asset('dash/js/popper.js') }}"></script>
    <script src="{{ asset('dash/js/bootstrap.js') }}"></script>
    <script src="{{ asset('dash/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('dash/js/node-waves.js') }}"></script>

    <script src="{{ asset('dash/js/hammer.js') }}"></script>
    <script src="{{ asset('dash/js/i18n.js') }}"></script>
    <script src="{{ asset('dash/js/typeahead.js') }}"></script>

    <script src="{{ asset('dash/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{ asset('dash/js/main.js') }}"></script>

    <!-- Page JS -->
</body>

</html>

<!-- beautify ignore:end -->

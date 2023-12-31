<!DOCTYPE html>
<html dir="ltr" lang="en">
    @include('components.theme.head')

    @if (Request::segment(1) === 'root')
        @php
            $menus = Config::get('variable.navigation.root');
        @endphp
    @elseif (Request::segment(1) === 'admin')
        @php
            $menus = Config::get('variable.navigation.admin');
        @endphp
    @else
        @php
            $menus = Config::get('variable.navigation.staff');
        @endphp
    @endif

    <body>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
            @include('components.theme.header')
            
            @include('components.theme.sidebar', ['menus' => $menus])

            <div class="page-wrapper">
                @include('components.theme.breadcrumb', ['menus' => $menus, 'path' => parse_url(url()->current())['path']])

                <!-- ============================================================== -->
                <!-- Container fluid  -->
                <!-- ============================================================== -->
                <div class="container-fluid">
                    <!-- ============================================================== -->
                    <!-- Start Page Content -->
                    <!-- ============================================================== -->
                    <div class="row">
                        @if (\Session::has('success'))
                            <div class="col-12">
                                <div class="alert alert-success" role="alert">
                                    {{ \Session::get('success') }}
                                </div>
                            </div>
                        @endif

                        @if (\Session::has('error'))
                            <div class="col-12">
                                <div class="alert alert-danger" role="alert">
                                    {{ \Session::get('error') }}
                                </div>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="col-12">
                                <div class="alert alert-danger" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        @yield('content')
                    </div>
                    <!-- ============================================================== -->
                    <!-- End PAge Content -->
                    <!-- ============================================================== -->
                </div>
                <!-- ============================================================== -->
                <!-- End Container fluid  -->
                <!-- ============================================================== -->

                @include('components.theme.footer')
            </div>
            <!-- ============================================================== -->
            <!-- End Page wrapper  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Wrapper -->
        <!-- ============================================================== -->

        @include('components.theme.jsfiles')

        @yield('jscode')
    </body>
</html>

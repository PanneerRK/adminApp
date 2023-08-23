<!doctype html>
<html>
<head>
   @include('includes.head')
</head>
<body>
 <!-- Layout wrapper -->
 <div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
        <!-- Menu -->
        @include('includes.dash_aside')
        <!-- / Menu -->
        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->
            @include('includes.dash_navbar')
            <!-- / Navbar -->
            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->
                @yield('content')
                <!-- / Content -->
                <!-- Footer -->
                @include('includes.copyright_footer')
                <!-- / Footer -->
            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
  </div>
  <!-- Overlay -->
  <div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->
@include('includes.dash_footer')
</body>
</html>
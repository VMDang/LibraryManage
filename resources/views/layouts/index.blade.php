<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('title-page')
    <link rel="icon" href="{{asset("img/LibraryLogo.png")}}" type="image/x-icon" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset("themes/plugins/fontawesome-free/css/all.min.css")}}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{asset('themes/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('themes/plugins/toastr/toastr.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('themes/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('themes/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('themes/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('themes/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('themes/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('themes/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="{{ asset('themes/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('themes/plugins/summernote/summernote-bs4.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset("themes/dist/css/adminlte.min.css")}}">
    <!-- CSRF Token -->
    
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    
    @yield('style')
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">">
<div class="wrapper">

    <!-- Preloader -->
    @yield('preloader')

    <!-- Navbar -->
    @yield('navbar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @yield('sidebar')

    <!-- Content Wrapper. Contains page content -->
    @yield('content')
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    @yield('footer')
</div>
<!-- ./wrapper -->


<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{asset("themes/plugins/jquery/jquery.min.js")}}"></script>
<script src="{{asset("themes/plugins/jquery-ui/jquery-ui.min.js")}}"></script>
<!-- Bootstrap -->
<script src="{{asset("themes/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
<!-- ChartJS -->
<script src="{{ asset('themes/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('themes/plugins/sparklines/sparkline.js') }}"></script>
<!-- jquery-validation -->
<script src="{{asset('themes/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('themes/plugins/jquery-validation/additional-methods.min.js')}}"></script>
<!-- Moment -->
<script src="{{ asset('themes/plugins/moment/moment.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('themes/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('themes/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- SweetAlert2 -->
<script src="{{asset('themes/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<!-- Toastr -->
<script src="{{asset('themes/plugins/toastr/toastr.min.js')}}"></script>
<!-- DataTables -->
<script src="{{ asset('themes/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('themes/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('themes/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('themes/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<!-- SweetAlert2 -->
<script src="{{ asset('themes/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('themes/plugins/chart.js/Chart.min.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('themes/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('themes/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{asset("themes/dist/js/adminlte.js")}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset("themes/dist/js/demo.js")}}"></script>

<script src="{{asset("js/base.js")}}" defer></script>
<script type="text/javascript">
    const BASE_URL = '{{url('')}}';
    const datetimepickerFormat = '{{config('app.datetimepickerFormat')}}';
    let currentMaxDate = '{{date("d/m/Y")}}';
</script>
<script  type = "module"  src = "https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js" > </script> 
<script  nomodule  src = "https://unpkg .com/ionicons@7.1.0/dist/ionicons/ionicons.js" > </script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
@yield('script')
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="author" content="PIXINVENT">
    <title>ITCRAFTY - @yield('title')</title>
    <link rel="apple-touch-icon" href="{{ asset('/imageFolder/favicon.ico') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/imageFolder/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/stack-admin/app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/stack-admin/app-assets/vendors/css/charts/jquery-jvectormap-2.0.3.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/stack-admin/app-assets/vendors/css/charts/morris.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/stack-admin/app-assets/vendors/css/extensions/unslider.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/stack-admin/app-assets/vendors/css/weather-icons/climacons.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/stack-admin/app-assets/vendors/css/forms/selects/select2.min.css') }}">


    <link rel="stylesheet" type="text/css" href="{{ asset('/stack-admin/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/stack-admin/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/stack-admin/app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css') }}">


    <link rel="stylesheet" type="text/css" href="{{ asset('/stack-admin/app-assets/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/stack-admin/app-assets/vendors/css/forms/icheck/custom.css') }}">

    {{--    <link rel="stylesheet" type="text/css" href="{{ asset('/stack-admin/app-assets/vendors/css/extensions/sweetalert2.min.css') }}">--}}


    <!-- END: Vendor CSS-->
    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/stack-admin/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/stack-admin/app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/stack-admin/app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/stack-admin/app-assets/css/components.css') }}">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/stack-admin/app-assets/css/core/menu/menu-types/horizontal-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/stack-admin/app-assets/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/stack-admin/app-assets/css/core/colors/palette-climacon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/stack-admin/app-assets/fonts/simple-line-icons/style.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/stack-admin/app-assets/fonts/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/stack-admin/app-assets/fonts/meteocons/style.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/stack-admin/app-assets/css/pages/users.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/stack-admin/app-assets/css/plugins/forms/checkboxes-radios.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/stack-admin/app-assets/css/pages/app-invoice.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('/stack-admin/app-assets/css/pages/card-statistics.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/stack-admin/app-assets/css/pages/vertical-timeline.css') }}">

    <!-- link(rel='stylesheet', type='text/css', href=app_assets_path+'/css'+rtl+'/pages/users.css')-->
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/arifcss.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/stack-admin/assets/css/style.css') }}">
    <!-- END: Custom CSS-->
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="horizontal-layout horizontal-menu 2-columns  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns">
@include('layouts.admin.header')
@include('layouts.admin.nav-bar')
<div class="app-content content">
    @yield('content')
</div>
@yield('page-modals')

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>
<!-- BEGIN: Footer-->
<footer class="footer fixed-bottom footer-dark">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">Copyright &copy; {{\Carbon\Carbon::now()->year}} <a class="text-bold-800 grey darken-2" href="https://www.palmalgarments.com/" target="_blank">Palmal Group of Industries </a></span><span class="float-md-right d-none d-lg-block">Designed & Developed By <a class="text-bold-800 grey darken-2" href="https://www.moinularif.com/" target="_blank">Kazi Moinul Hossain Arif</a></span></p>
</footer>
<!-- END: Footer-->
{{--venddor scripts--}}
<!-- ============================================
        ============== Vendor JavaScripts ===============
        ============================================= -->
@yield('pageVendorScripts')
<!-- BEGIN: Vendor JS-->
<script src="{{ asset('/stack-admin/app-assets/vendors/js/vendors.min.js') }}"></script>
<!-- BEGIN Vendor JS-->
<!-- BEGIN: Page Vendor JS-->

<script src="{{ asset('/stack-admin/app-assets/vendors/js/ui/jquery.sticky.js') }}"></script>
<script src="{{ asset('/stack-admin/app-assets/vendors/js/extensions/jquery.knob.min.js') }}"></script>
<script src="{{ asset('/stack-admin/app-assets/js/scripts/extensions/knob.js') }}"></script>

<script src="{{ asset('/stack-admin/app-assets/vendors/js/charts/raphael-min.js') }}"></script>
<script src="{{ asset('/stack-admin/app-assets/vendors/js/charts/morris.min.js') }}"></script>
<script src="{{ asset('/stack-admin/app-assets/vendors/js/charts/jvector/jquery-jvectormap-2.0.3.min.js') }}"></script>
<script src="{{ asset('/stack-admin/app-assets/vendors/js/charts/jvector/jquery-jvectormap-world-mill.js') }}"></script>
<script src="{{ asset('/stack-admin/app-assets/vendors/js/charts/chart.min.js') }}"></script>
<script src="{{ asset('/stack-admin/app-assets/vendors/js/charts/jquery.sparkline.min.js') }}"></script>

<script src="{{ asset('/stack-admin/app-assets/vendors/js/charts/leaflet/leaflet.js') }}"></script>
<script src="{{ asset('/stack-admin/app-assets/vendors/js/charts/apexcharts/apexcharts.min.js') }}"></script>

<script src="{{ asset('/stack-admin/app-assets/data/jvector/visitor-data.js') }}"></script>
<script src="{{ asset('/stack-admin/app-assets/vendors/js/extensions/unslider-min.js') }}"></script>

<script src="{{ asset('/stack-admin/app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('/stack-admin/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/stack-admin/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/stack-admin/app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js') }}"></script>
{{--<script src="{{ asset('/stack-admin/app-assets/js/scripts/tables/datatables/datatable-basic.js') }}"></script>
<script src="{{ asset('/stack-admin/app-assets/js/scripts/tables/datatables/datatable-styling.js') }}"></script>
<script src="{{ asset('/stack-admin/app-assets/js/scripts/tables/datatables/datatable-advanced.js') }}"></script>--}}
<script src="{{ asset('/stack-admin/app-assets/vendors/js/tables/jszip.min.js') }}"></script>
<script src="{{ asset('/stack-admin/app-assets/vendors/js/tables/pdfmake.min.js') }}"></script>
<script src="{{ asset('/stack-admin/app-assets/vendors/js/tables/vfs_fonts.js') }}"></script>
<script src="{{ asset('/stack-admin/app-assets/vendors/js/tables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('/stack-admin/app-assets/vendors/js/tables/buttons.print.min.js') }}"></script>
<script src="{{ asset('/stack-admin/app-assets/vendors/js/tables/buttons.colVis.min.js') }}"></script>


<script src="{{ asset('/stack-admin/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="{{ asset('/stack-admin/app-assets/js/scripts/forms/select/form-select2.js') }}"></script>
<script src="{{ asset('/stack-admin/app-assets/vendors/js/forms/icheck/icheck.min.js') }}"></script>

<script src="{{ asset('/stack-admin/app-assets/js/scripts/forms/checkbox-radio.js') }}"></script>

<script src="{{ asset('/stack-admin/app-assets/js/scripts/customizer.js') }}"></script>
{{--<script src="{{ asset('/stack-admin/app-assets/js/scripts/ui/breadcrumbs-with-stats.js') }}"></script>
<script src="{{ asset('/stack-admin/app-assets/js/scripts/pages/bootstrap-toast.js') }}"></script>--}}
{{--<script src="{{ asset('/stack-admin/app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>--}}
<script src="{{ asset('/js/sweetalert.js') }}"></script>
{{--<script src="../../../app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>--}}

{{--<script src="{{ asset('/stack-admin/stack-admin/app-assets/vendors/js/bootstrap.min.js.map') }}"></script>--}}

<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{ asset('/stack-admin/app-assets/js/core/app-menu.js') }}"></script>
<script src="{{ asset('/stack-admin/app-assets/js/core/app.js') }}"></script>
<script src="{{ asset('/stack-admin/app-assets/js/scripts/pages/app-invoice.js') }}"></script>


<!-- END: Theme JS-->
@yield('pageScripts')
</body>
</html>



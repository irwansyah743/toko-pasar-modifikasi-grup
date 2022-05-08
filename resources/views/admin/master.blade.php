<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('admin-theme/images/favicon.ico') }}">

    <title>Sunny Admin - Dashboard</title>

    <!-- Vendors Style-->
    <link rel="stylesheet" href="{{ asset('admin-theme/css/vendors_css.css') }}">

    <!-- Style-->
    <link rel="stylesheet" href="{{ asset('admin-theme/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-theme/css/skin_color.css') }}">

</head>

<body class="hold-transition dark-skin sidebar-mini theme-primary fixed">

    @yield('content')


    <!-- Vendor JS -->
    <script src="{{ asset('admin-theme/js/vendors.min.js') }}"></script>
    <script src="{{ asset('assets/icons/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/easypiechart/dist/jquery.easypiechart.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/apexcharts-bundle/irregular-data-series.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/apexcharts-bundle/dist/apexcharts.js') }}"></script>

    <!-- Sunny Admin App -->
    <script src="{{ asset('admin-theme/js/template.js') }}"></script>
    <script src="{{ asset('admin-theme/js/pages/dashboard.js') }}"></script>


</body>

</html>

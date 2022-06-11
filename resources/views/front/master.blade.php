<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">
    <title>Flipmart premium HTML5 & CSS3 Template</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{ asset('front-theme/assets/css/bootstrap.css') }}">


    <!-- Customizable CSS -->
    <link rel="stylesheet" href="{{ asset('front-theme/assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('front-theme/assets/css/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('front-theme/assets/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('front-theme/assets/css/owl.transitions.css') }}">
    <link rel="stylesheet" href="{{ asset('front-theme/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front-theme/assets/css/rateit.css') }}">
    <link rel="stylesheet" href="{{ asset('front-theme/assets/css/bootstrap-select.min.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet" />

    <!-- Icons/Glyphs -->
    <link rel="stylesheet" href="{{ asset('assets/icons/font-awesome/css/font-awesome.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('front-theme/assets/css/font-awesome.css') }}"> --}}

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800'
        rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
</head>

<body class="cnt-home">
    <!-- ============================================== HEADER ============================================== -->
    @include('front.components.header')

    <!-- ============================================== HEADER : END ============================================== -->
    @yield('content')
    <!-- /#top-banner-and-menu -->

    <!-- ============================================================= FOOTER ============================================================= -->
    @include('front.components.footer')
    <!-- ============================================================= FOOTER : END============================================================= -->

    <!-- For demo purposes – can be removed on production -->

    <!-- For demo purposes – can be removed on production : End -->
    {{-- Custom JS --}}
    <script src="{{ asset('js/upload_preview.js') }}"></script>

    <!-- JavaScripts placed at the end of the document so the pages load faster -->
    <script src="{{ asset('front-theme/assets/js/jquery-1.11.1.min.js') }}"></script>
    <script src="{{ asset('front-theme/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front-theme/assets/js/bootstrap-hover-dropdown.min.js') }}"></script>
    <script src="{{ asset('front-theme/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('front-theme/assets/js/echo.min.js') }}"></script>
    <script src="{{ asset('front-theme/assets/js/jquery.easing-1.3.min.js') }}"></script>
    <script src="{{ asset('front-theme/assets/js/bootstrap-slider.min.js') }}"></script>
    <script src="{{ asset('front-theme/assets/js/jquery.rateit.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front-theme/assets/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('front-theme/assets/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('front-theme/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('front-theme/assets/js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @if (Session::has('message'))
        <script>
            let type = "{{ Session::get('alert-type') }}";
            switch (type) {
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;
                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;
                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;
                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
        </script>
    @endif
</body>

</html>

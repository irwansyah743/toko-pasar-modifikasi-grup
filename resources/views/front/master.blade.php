<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">
    <title>@yield('title') </title>

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
    <script src="{{ asset('js/add_cart.js') }}"></script>

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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    <!-- Add to Cart Product Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><b id="pname"></b> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModel">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-4">

                            <div class="card" style="width: 18rem;">

                                <img src=" " class="card-img-top" alt="..."
                                    style="height: 200px; width: 180px;" id="pimage">

                            </div>

                        </div><!-- // end col md -->


                        <div class="col-md-4">

                            <ul class="list-group">
                                <li class="list-group-item">Product Price: <strong id="price"
                                        class="text-danger"></strong>&nbsp;<del id="oldprice"></del> </li>
                                <li class="list-group-item">Product Code: <strong id="pcode"></strong></li>
                                <li class="list-group-item">Category: <strong id="pcategory"></strong></li>
                                <li class="list-group-item">Brand: <strong id="pbrand"></strong></li>
                                <li class="list-group-item">Stock: <strong id="pstock"></strong></li>
                            </ul>
                        </div><!-- // end col md -->


                        <div class="col-md-4">

                            <div class="form-group">
                                <label for="pcolor">Choose Color</label>
                                <select class="form-control" id="pcolor" name="pcolor">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div> <!-- // end form group -->


                            <div class="form-group">
                                <label for="psize">Choose Size</label>
                                <select class="form-control" id="psize" name="psize">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div> <!-- // end form group -->

                            <div class="form-group">
                                <label for="qty">Quantity</label>
                                <input type="number" class="form-control" id="qty" value="1"
                                    min="1">
                            </div> <!-- // end form group -->
                            <input type="hidden" id="pid" />
                            <button type="submit" class="btn btn-primary mb-2" onclick="addToCart()">Add to
                                Cart</button>


                        </div><!-- // end col md -->


                    </div> <!-- // end row -->


                </div> <!-- // end modal Body -->
            </div> <!-- // end modal Body -->

        </div>
    </div>

    <!-- End Add to Cart Product Modal -->



</body>

</html>

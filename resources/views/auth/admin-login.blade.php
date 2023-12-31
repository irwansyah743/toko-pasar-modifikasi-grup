<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('admin-theme/images/favicon.ico') }}">

    <title>Toko Pasar Modifikasi Grup Admin - Log in </title>

    <!-- Vendors Style-->
    <link rel="stylesheet" href="{{ asset('admin-theme/css/vendors_css.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet" />

    <!-- Style-->
    <link rel="stylesheet" href="{{ asset('admin-theme/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-theme/css/skin_color.css') }}">

</head>

<body class="hold-transition theme-primary bg-gradient-primary">

    <div class="container h-p100">
        <div class="row align-items-center justify-content-md-center h-p100">

            <div class="col-12">
                <div class="row justify-content-center no-gutters">
                    <div class="col-lg-4 col-md-5 col-12">
                        <div class="content-top-agile p-10">
                            <h2 class="text-white">Masuk untuk memulai</h2>
                        </div>
                        <div class="p-30 rounded30 box-shadowed b-2 b-dashed">
                            <form method="POST"
                                action="{{ isset($guard) ? url($guard . '/login') : route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-transparent text-white"><i
                                                    class="ti-user"></i></span>
                                        </div>
                                        <input id="email"
                                            class="form-control pl-15 bg-transparent text-white plc-white  @error('email') is-invalid @enderror"
                                            type="email" name="email" :value="old('email')" required autofocus
                                            placeholder="Email">
                                        @error('email')
                                            <div class="invalid-feedback alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text  bg-transparent text-white"><i
                                                    class="ti-lock"></i></span>
                                        </div>
                                        <input type="password" id="password"
                                            class="form-control pl-15 bg-transparent text-white plc-white  @error('password') is-invalid @enderror"
                                            type="password" name="password" required autocomplete="current-password"
                                            placeholder="Password">
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="checkbox text-white">
                                            <input type="checkbox" id="basic_checkbox_1" name="remember">
                                            <label for="basic_checkbox_1">{{ __('Remember me') }}</label>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-6">
                                        @if (Route::has('password.request'))
                                            <div class="fog-pwd text-right">
                                                <a href="{{ route('password.request') }}"
                                                    class="text-white hover-info"><i class="ion ion-locked"></i>
                                                    {{ __('Forgot your password?') }}</a><br>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-info btn-rounded mt-10">SIGN IN</button>
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </form>

                            {{-- <div class="text-center text-white">
                                <p class="mt-20">- Sign With -</p>
                                <p class="gap-items-2 mb-20">
                                    <a class="btn btn-social-icon btn-round btn-outline btn-white" href="#"><i
                                            class="fa fa-facebook"></i></a>
                                    <a class="btn btn-social-icon btn-round btn-outline btn-white" href="#"><i
                                            class="fa fa-twitter"></i></a>
                                    <a class="btn btn-social-icon btn-round btn-outline btn-white" href="#"><i
                                            class="fa fa-google-plus"></i></a>
                                    <a class="btn btn-social-icon btn-round btn-outline btn-white" href="#"><i
                                            class="fa fa-instagram"></i></a>
                                </p>
                            </div> --}}

                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Vendor JS -->
    <script src="{{ asset('admin-theme/js/vendors.min.js') }}"></script>
    <script src="{{ asset('assets/icons/feather-icons/feather.min.js') }}"></script>
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

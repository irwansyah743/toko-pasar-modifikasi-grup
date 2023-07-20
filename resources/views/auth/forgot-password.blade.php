@extends('front.master')
@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="home.html">Home</a></li>
                    <li class='active'>Forgot password</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->

    <div class="body-content">
        <div class="container">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible " role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="sign-in-page">
                <div class="row">
                    <!-- Sign-in -->
                    <div class="col-md-6 col-sm-6 sign-in">
                        <h4 class="">Lupa Password</h4>
                        <p class="">Lupa Password?.</p>
                        <form class="register-form outer-top-xs" role="form" method="POST" {{ route('password.email') }}>
                            @csrf
                            <input name="login_form" type="hidden" value=1 />
                            <div class="form-group">
                                <label class="info-title" for="email">Alamat Email <span>*</span></label>
                                <input type="email" name="email" value="{{ old('email') }}"
                                    class="form-control unicase-form-control text-input  @error('email') is-invalid @enderror"
                                    id="email">
                                @error('email')
                                    <div class="invalid-feedback text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">
                                {{ __('Email Password Reset Link') }}</button>
                        </form>
                    </div>
                    <!-- Sign-in -->

                </div><!-- /.row -->
            </div><!-- /.sigin-in-->
        </div>
    </div>
    @include('front.components.brands')
@endsection

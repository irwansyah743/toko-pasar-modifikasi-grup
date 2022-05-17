@extends('front.master')
@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="home.html">Home</a></li>
                    <li class='active'>Login</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->

    <div class="body-content">
        @if (session('status'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="container">
            <div class="sign-in-page">
                <div class="row">
                    <!-- Sign-in -->
                    <div class="col-md-6 col-sm-6 sign-in">
                        <h4 class="">Sign in</h4>
                        <p class="">Hello, Welcome to your account.</p>
                        <div class="social-sign-in outer-top-xs">
                            <a href="#" class="facebook-sign-in"><i class="fa fa-facebook"></i> Sign In with Facebook</a>
                            <a href="#" class="twitter-sign-in"><i class="fa fa-twitter"></i> Sign In with Twitter</a>
                        </div>
                        <form class="register-form outer-top-xs" role="form" method="POST"
                            action="{{ isset($guard) ? url($guard . '/login') : route('login') }}" novalidate>
                            @csrf
                            <input name="login_form" type="hidden" value=1 />
                            <div class="form-group">
                                <label class="info-title" for="email_login">Email Address <span>*</span></label>
                                <input type="email" name="email" value="{{ old('email') }}"
                                    class="form-control unicase-form-control text-input @if (isset($_POST['submit_login'])) @error('email') is-invalid @enderror @endif"
                                    id="email_login">

                                @error('email')
                                    <div class="invalid-feedback text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <div class="form-group">
                                <label class="info-title" for="password_login">Password <span>*</span></label>
                                <input type="password" name="password"
                                    class="form-control unicase-form-control text-input   @if (isset($_POST['submit_login'])) @error('password') is-invalid @enderror @endif"
                                    id="password_login">

                                @error('password')
                                    <div class="invalid-feedback text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <div class="radio outer-xs">
                                <label>
                                    <input type="radio" name="remember" id="optionsCheckbox2">{{ __('Remember me') }}
                                </label>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="forgot-password pull-right">
                                        {{ __('Forgot your password?') }}</a>
                                @endif
                            </div>
                            <input type="submit" class="btn-upper btn btn-primary checkout-page-button" name="submit_login"
                                value="Login">
                        </form>
                    </div>
                    <!-- Sign-in -->

                    <!-- create a new account -->
                    <div class="col-md-6 col-sm-6 create-new-account">
                        <h4 class="checkout-subtitle">Create a new account</h4>
                        <p class="text title-tag-line">Create your new account.</p>
                        <form class="register-form outer-top-xs" role="form" method="POST"
                            action="{{ route('register') }}" novalidate>
                            @csrf
                            <div class="form-group">
                                <label class="info-title" for="name">Name <span>*</span></label>
                                <input type="text"
                                    class="form-control unicase-form-control text-input @error('name') is-invalid @enderror"
                                    id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                                    autocomplete="name">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="email">Email <span>*</span></label>
                                <input type="email"
                                    class="form-control unicase-form-control text-input @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="password">Password <span>*</span></label>
                                <input type="password"
                                    class="form-control unicase-form-control text-input @error('password') is-invalid @enderror"
                                    id="password" type="password" name="password" required autocomplete="new-password">
                                @error('password')
                                    <div class="invalid-feedback text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="password_confirmation">Confirm Password
                                    <span>*</span></label>
                                <input type="password" class="form-control unicase-form-control text-input"
                                    id="password_confirmation" type="password" name="password_confirmation" required
                                    autocomplete="new-password">
                            </div>
                            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                <div class="mt-4">
                                    <x-jet-label for="terms">
                                        <div class="flex items-center">
                                            <x-jet-checkbox name="terms" id="terms" />

                                            <div class="ml-2">
                                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
    'terms_of_service' => '<a target="_blank" href="' . route('terms.show') . '" class="underline text-sm text-gray-600 hover:text-gray-900">' . __('Terms of Service') . '</a>',
    'privacy_policy' => '<a target="_blank" href="' . route('policy.show') . '" class="underline text-sm text-gray-600 hover:text-gray-900">' . __('Privacy Policy') . '</a>',
]) !!}
                                            </div>
                                        </div>
                                    </x-jet-label>
                                </div>
                            @endif
                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Sign Up</button>
                        </form>


                    </div>
                    <!-- create a new account -->
                </div><!-- /.row -->
            </div><!-- /.sigin-in-->
        </div>
    </div>
    @include('front.components.brands')
@endsection

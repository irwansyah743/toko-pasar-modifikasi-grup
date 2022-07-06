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

        <div class="container">
            <div class="sign-in-page">
                <div class="row">
                    <!-- Sign-in -->
                    <div class="col-md-6 col-sm-6 sign-in">
                        <h4 class="">Sign in</h4>
                        <p class="">Hello, Welcome to your account.</p>
                        {{-- <div class="social-sign-in outer-top-xs">
                            <a href="#" class="facebook-sign-in"><i class="fa fa-facebook"></i> Sign In with Facebook</a>
                            <a href="#" class="twitter-sign-in"><i class="fa fa-twitter"></i> Sign In with Twitter</a>
                        </div> --}}
                        <form class="register-form outer-top-xs" role="form" method="POST"
                            action="{{ isset($guard) ? url($guard . '/login') : route('login') }}" novalidate>
                            @csrf
                            <input name="login_form" type="hidden" value=1 />
                            <div class="form-group">
                                <label class="info-title" for="email_login">Email Address <span>*</span></label>
                                <input type="email" name="email" value="{{ old('email') }}"
                                    class="form-control unicase-form-control text-input  @error('email') is-invalid @enderror"
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
                                    class="form-control unicase-form-control text-input    @error('password') is-invalid @enderror"
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
                                    id="name" type="text" name="name" value="{{ old('name') }}"
                                    autocomplete="name">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="emailRegister">Email <span>*</span></label>
                                <input type="email"
                                    class="form-control unicase-form-control text-input  @error('emailRegister') is-invalid @enderror"
                                    id="emailRegister" name="emailRegister" value="{{ old('emailRegister') }}">
                                @error('emailRegister')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="phone">Phone number <span>*</span></label>
                                <input type="text"
                                    class="form-control unicase-form-control text-input @error('phone') is-invalid @enderror"
                                    id="phone" name="phone" value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="passwordRegister">Password <span>*</span></label>
                                <input type="password"
                                    class="form-control unicase-form-control text-input @error('passwordRegister') is-invalid @enderror"
                                    id="passwordRegister" type="passwordRegister" name="passwordRegister"
                                    autocomplete="new-password">
                                @error('passwordRegister')
                                    <div class="invalid-feedback text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="passwordRegister_confirmation">Confirm Password
                                    <span>*</span></label>
                                <input type="password" class="form-control unicase-form-control text-input"
                                    id="passwordRegister_confirmation" type="passwordRegister"
                                    name="passwordRegister_confirmation" autocomplete="new-password">
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
                            <input type="submit" class="btn-upper btn btn-primary checkout-page-button"
                                name="submit_register" value="Sign up">
                        </form>


                    </div>
                    <!-- create a new account -->
                </div><!-- /.row -->
            </div><!-- /.sigin-in-->
        </div>
    </div>
    @include('front.components.brands')
@endsection

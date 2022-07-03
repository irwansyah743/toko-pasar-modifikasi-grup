@extends('front.master')
@section('content')
    <div class="body-content outer-top-bd">
        <div class="container">
            <div class="x-page inner-bottom-sm">
                <div class="row">
                    <div class="col-md-12 x-text text-center">
                        <div class="row" style="display: flex; justify-content:center;">
                            <div class="col-md-5">
                                <img src="{{ asset('storage/404.png') }}" alt="" style="width: 100%;">
                            </div>

                        </div>

                        <a href="{{ url('/') }}"><i class="fa fa-home"></i> Go To Homepage</a>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.sigin-in-->
        </div><!-- /.container -->
    </div><!-- /.body-content -->
@endsection

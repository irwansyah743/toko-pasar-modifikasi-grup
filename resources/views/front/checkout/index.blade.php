@extends('front.master')
@section('content')
@section('title')
    My Checkout
@endsection


<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="home.html">Home</a></li>
                <li class='active'>Checkout</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->




<div class="body-content">
    <div class="container">
        <div class="checkout-box ">
            <div class="row">
                <div class="col-md-8">
                    <div class="panel-group checkout-steps" id="accordion">
                        <!-- checkout-step-01  -->
                        <div class="panel panel-default checkout-step-01">

                            <!-- panel-heading -->

                            <!-- panel-heading -->

                            <div id="collapseOne" class="panel-collapse collapse in">

                                <!-- panel-body  -->
                                <div class="panel-body">
                                    <div class="row">

                                        <!-- guest-login -->
                                        <h4 class="unicase-checkout-title mb-4"><b>Shipping Address</b></h4>


                                        <form class="register-form" action="{{ route('checkout.store') }}"
                                            method="POST">
                                            @csrf

                                            <div class="col-md-6 col-sm-6 already-registered-login">
                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1"><b>Shipping
                                                            Name</b> <span class="text-danger">*</span></label>
                                                    <input type="text" name="shipping_name"
                                                        class="form-control unicase-form-control text-input"
                                                        id="exampleInputEmail1" placeholder="Full Name"
                                                        value="{{ Auth::user()->name }}" required="">
                                                </div> <!-- // end form group  -->


                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1"><b>Email </b>
                                                        <span class="text-danger">*</span></label>
                                                    <input type="email" name="shipping_email"
                                                        class="form-control unicase-form-control text-input"
                                                        id="exampleInputEmail1" placeholder="Email"
                                                        value="{{ Auth::user()->email }}" required="">
                                                </div> <!-- // end form group  -->


                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1"><b>Phone</b>
                                                        <span class="text-danger">*</span></label>
                                                    <input type="number" name="shipping_phone"
                                                        class="form-control unicase-form-control text-input"
                                                        id="exampleInputEmail1" placeholder="Phone"
                                                        value="{{ Auth::user()->phone }}" required="">
                                                </div> <!-- // end form group  -->


                                                <div class="form-group">
                                                    <label class="info-title" for="post_code"><b>Post Code </b>
                                                        <span class="text-danger">*</span></label>
                                                    <input type="text" name="post_code"
                                                        class="form-control unicase-form-control text-input"
                                                        id="post_code" placeholder="Post Code">
                                                </div> <!-- // end form group  -->
                                                <hr>
                                                <div class="form-group">
                                                    <div class="panel-heading">
                                                        <h4 class="unicase-checkout-title mb-4">Select Payment Method
                                                        </h4>
                                                    </div>


                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Stripe</label>
                                                            <input type="radio" name="payment_method" value="stripe">
                                                            <img
                                                                src="{{ asset('front-theme/assets/images/payments/4.png') }}">
                                                        </div> <!-- end col md 4 -->

                                                        <div class="col-md-4">
                                                            <label for="">Card</label>
                                                            <input type="radio" name="payment_method" value="card">
                                                            <img
                                                                src="{{ asset('front-theme/assets/images/payments/3.png') }}">
                                                        </div> <!-- end col md 4 -->

                                                        <div class="col-md-4">
                                                            <label for="">Cash</label>
                                                            <input type="radio" name="payment_method" value="cash">
                                                            <img
                                                                src="{{ asset('front-theme/assets/images/payments/2.png') }}">
                                                        </div> <!-- end col md 4 -->


                                                    </div> <!-- // end row  -->
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 already-registered-login">


                                                <div class="form-group">
                                                    <label class="info-title" for="provinsi"><b>Provinsi</b>
                                                        <span class="text-danger">*</span></label>
                                                    <input type="text" name="provinsi"
                                                        class="form-control unicase-form-control text-input"
                                                        id="provinsi" value="{{ old('provinsi') }}">
                                                </div> <!-- // end form group  -->


                                                <div class="form-group">
                                                    <label class="info-title" for="kabupaten"><b>Kabupaten</b>
                                                        <span class="text-danger">*</span></label>
                                                    <input type="text" name="kabupaten"
                                                        class="form-control unicase-form-control text-input"
                                                        id="kabupaten" value="{{ old('kabupaten') }}">
                                                </div> <!-- // end form group  -->


                                                <div class="form-group">
                                                    <label class="info-title" for="kecamatan"><b>Kecamatan</b>
                                                        <span class="text-danger">*</span></label>
                                                    <input type="text" name="kecamatan"
                                                        class="form-control unicase-form-control text-input"
                                                        id="kecamatan" value="{{ old('kecamatan') }}">
                                                </div> <!-- // end form group  -->

                                                <div class="form-group">
                                                    <label class="info-title" for="address"><b>Address</b>
                                                        <span class="text-danger">*</span></label>
                                                    <input type="text" name="address"
                                                        class="form-control unicase-form-control text-input"
                                                        id="address" value="{{ old('address') }}">
                                                </div> <!-- // end form group  -->


                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1">Notes
                                                    </label>
                                                    <textarea class="form-control" cols="30" rows="5" placeholder="Notes" name="notes"></textarea>
                                                </div> <!-- // end form group  -->








                                            </div>
                                            <!-- already-registered-login -->
                                            <button type="submit"
                                                class="btn-upper btn btn-primary checkout-page-button"
                                                style="float:right;">Payment
                                                Step</button>
                                        </form>



                                        <!-- guest-login -->





                                        <!-- already-registered-login -->


                                    </div>
                                </div>
                                <!-- panel-body  -->

                            </div><!-- row -->
                        </div>
                        <!-- End checkout-step-01  -->




                    </div><!-- /.checkout-steps -->
                </div>




                <div class="col-md-4">
                    <!-- checkout-progress-sidebar -->
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Your Checkout Progress</h4>
                                </div>
                                <div class="">
                                    <ul class="nav nav-checkout-progress list-unstyled">

                                        @foreach ($carts as $item)
                                            <li>
                                                <strong>Image: </strong>
                                                <img src="{{ asset('storage/' . $item->options->image) }}"
                                                    style="height: 50px; width: 50px;">
                                            </li>

                                            <li>
                                                <strong>Qty: </strong>
                                                ({{ $item->qty }})
                                                <strong>Color: </strong>
                                                {{ $item->options->color }}

                                                <strong>Size: </strong>
                                                {{ $item->options->size }}
                                            </li>
                                        @endforeach
                                        <hr>
                                        <li>
                                            @if (Session::has('coupon'))
                                                <strong>SubTotal: </strong> ${{ $cartTotal }}
                                                <hr>

                                                <strong>Coupon Name : </strong>
                                                {{ session()->get('coupon')['coupon_name'] }}
                                                ( {{ session()->get('coupon')['coupon_discount'] }} % )
                                                <hr>

                                                <strong>Coupon Discount : </strong>
                                                Rp.{{ session()->get('coupon')['discount_amount'] }}K
                                                <hr>

                                                <strong>Grand Total : </strong>
                                                Rp.{{ session()->get('coupon')['total_amount'] }}K
                                                <hr>
                                            @else
                                                <strong>SubTotal: </strong> Rp.{{ $cartTotal }}K
                                                <hr>

                                                <strong>Grand Total : </strong> Rp.{{ $cartTotal }}K
                                                <hr>
                                            @endif

                                        </li>



                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- checkout-progress-sidebar -->
                </div>







                </form>
            </div><!-- /.row -->
        </div><!-- /.checkout-box -->
        <!-- === ===== BRANDS CAROUSEL ==== ======== -->








        <!-- ===== == BRANDS CAROUSEL : END === === -->
    </div><!-- /.container -->
</div><!-- /.body-content -->




@endsection

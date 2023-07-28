@extends('front.master')
@section('content')
@section('title')
    My Checkout
@endsection
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="SB-Mid-client-GMO4riIFVRiZr0wb"></script>
<!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->

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
                                                    <label class="info-title" for="nama_pengiriman"><b>Shipping
                                                            Name</b> <span class="text-danger">*</span></label>
                                                    <input type="text" name="nama_pengiriman"
                                                        class="form-control unicase-form-control text-input"
                                                        id="nama_pengiriman" placeholder="Full Name"
                                                        value="{{ Auth::user()->name }}" required=""
                                                        onchange="checkForm()">
                                                </div> <!-- // end form group  -->


                                                <div class="form-group">
                                                    <label class="info-title" for="email_pengiriman"><b>Email </b>
                                                        <span class="text-danger">*</span></label>
                                                    <input type="email" name="email_pengiriman"
                                                        class="form-control unicase-form-control text-input"
                                                        id="email_pengiriman" placeholder="Email"
                                                        value="{{ Auth::user()->email }}" required=""
                                                        onchange="checkForm()">
                                                </div> <!-- // end form group  -->


                                                <div class="form-group">
                                                    <label class="info-title" for="no_telepon_pengiriman"><b>Phone</b>
                                                        <span class="text-danger">*</span></label>
                                                    <input type="number" name="no_telepon_pengiriman"
                                                        class="form-control unicase-form-control text-input"
                                                        id="no_telepon_pengiriman" placeholder="Phone"
                                                        value="{{ Auth::user()->phone }}" required=""
                                                        onchange="checkForm()">
                                                </div> <!-- // end form group  -->


                                                <div class="form-group">
                                                    <label class="info-title" for="kode_pos"><b>Post Code </b>
                                                        <span class="text-danger">*</span></label>
                                                    <input type="text" name="kode_pos"
                                                        class="form-control unicase-form-control text-input"
                                                        id="kode_pos" placeholder="Post Code" required
                                                        onchange="checkForm()">
                                                </div> <!-- // end form group  -->
                                                <hr>
                                            </div>
                                            <div class="col-md-6 col-sm-6 already-registered-login">
                                                <div class="form-group">
                                                    <label class="info-title" for="provinsi"><b>Provinsi</b>
                                                        <span class="text-danger">*</span></label>
                                                    <input type="text" name="provinsi"
                                                        class="form-control unicase-form-control text-input"
                                                        id="provinsi" value="{{ old('provinsi') }}" required
                                                        onchange="checkForm()">
                                                </div> <!-- // end form group  -->


                                                <div class="form-group">
                                                    <label class="info-title" for="kabupaten"><b>Kabupaten</b>
                                                        <span class="text-danger">*</span></label>
                                                    <input type="text" name="kabupaten"
                                                        class="form-control unicase-form-control text-input"
                                                        id="kabupaten" value="{{ old('kabupaten') }}" required
                                                        onchange="checkForm()">
                                                </div> <!-- // end form group  -->


                                                <div class="form-group">
                                                    <label class="info-title" for="kecamatan"><b>Kecamatan</b>
                                                        <span class="text-danger">*</span></label>
                                                    <input type="text" name="kecamatan"
                                                        class="form-control unicase-form-control text-input"
                                                        id="kecamatan" value="{{ old('kecamatan') }}" required
                                                        onchange="checkForm()">
                                                </div> <!-- // end form group  -->

                                                <div class="form-group">
                                                    <label class="info-title" for="alamat"><b>Alamat</b>
                                                        <span class="text-danger">*</span></label>
                                                    <input type="text" name="alamat"
                                                        class="form-control unicase-form-control text-input"
                                                        id="alamat" value="{{ old('alamat') }}" required
                                                        onchange="checkForm()">
                                                </div> <!-- // end form group  -->


                                                <div class="form-group">
                                                    <label class="info-title" for="catatan">catatan
                                                    </label>
                                                    <textarea id="catatan" class="form-control" cols="30" rows="5" placeholder="catatan" name="catatan"
                                                        onchange="checkForm()"></textarea>
                                                </div> <!-- // end form group  -->








                                            </div>
                                            <!-- already-registered-login -->

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
                                                <span
                                                    id="nama_kupon">{{ session()->get('coupon')['nama_kupon'] }}</span>
                                                ( {{ session()->get('coupon')['coupon_discount'] }} % )
                                                <hr>

                                                <strong>Coupon Discount : </strong>
                                                Rp. <span
                                                    id="coupon_discount">{{ session()->get('coupon')['discount_amount'] }}</span>
                                                <hr>

                                                <strong>Grand Total :
                                                    Rp.{{ session()->get('coupon')['total_amount'] }}</strong>
                                                <hr>
                                            @else
                                                <strong>SubTotal: </strong> Rp.{{ $cartTotal }}
                                                <hr>

                                                <strong>Grand Total : Rp.{{ $cartTotal }}</strong>
                                                <hr>
                                            @endif

                                        </li>



                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>

                    <button type="button" id="pay-button" disabled
                        class="btn-upper btn btn-primary checkout-page-button mb-5" style="float:right;">Pay
                        Now</button>
                </div>
                <!-- checkout-progress-sidebar -->








                </form>
            </div><!-- /.row -->
        </div><!-- /.checkout-box -->
        <!-- === ===== BRANDS CAROUSEL ==== ======== -->








        <!-- ===== == BRANDS CAROUSEL : END === === -->
    </div><!-- /.container -->
</div><!-- /.body-content -->



{{-- Custom JS --}}
<script src="{{ asset('js/midtrans.js') }}"></script>
@endsection

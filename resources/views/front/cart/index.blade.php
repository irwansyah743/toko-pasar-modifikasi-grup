@extends('front.master')
@section('content')

@section('title')
    My Cart Page
@endsection


<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="home.html">Home</a></li>
                <li class='active'>Keranjang</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="row ">
            <div class="shopping-cart">
                <div class="shopping-cart-table ">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="cart-romove item">Gambar</th>
                                    <th class="cart-description item">Nama</th>
                                    <th class="cart-product-name item">Warna</th>
                                    <th class="cart-edit item">Ukuran</th>
                                    <th class="cart-kuantitas item">Jumlah</th>
                                    <th class="cart-sub-total item">Subtotal</th>
                                    <th class="cart-total last-item">Hapus</th>
                                </tr>
                            </thead>
                            <tbody id="cartPage">


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-12 estimate-ship-tax">
            </div>

<!-- 
            <div class="col-md-4 col-sm-12 estimate-ship-tax">

                <table class="table" id="couponField"
                    style="display:{{ Session::has('coupon') ? 'none' : 'block' }}">
                    <thead>
                        <tr>
                            <th>
                                <span class="estimate-title">kode Diskon</span>
                                <p>Masukan kode Diskon jika Memilikinya..</p>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control unicase-form-control text-input"
                                        placeholder="You Coupon.." id="nama_kupon">
                                </div>
                                <div class="clearfix pull-right">
                                    <button type="submit" class="btn-upper btn btn-primary"
                                        onclick="applyCoupon()">APPLY
                                        COUPON</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>/ -->





            <div class="col-md-4 col-sm-12 cart-shopping-total">
                <table class="table">
                    <!-- <thead id="couponCalField">

                    </thead> -->
                    <tbody>
                        <tr>
                            <td>
                                <div class="cart-checkout-btn pull-right">
                                    <a href="{{ route('checkout') }}" type="submit"
                                        class="btn btn-primary checkout-btn">PROCCED TO CHEKOUT</a>

                                </div>
                            </td>
                        </tr>
                    </tbody><!-- /tbody -->
                </table><!-- /table -->
            </div><!-- /.cart-shopping-total -->









        </div><!-- /.row -->
    </div><!-- /.sign-in-->



    <br>
    @include('front.components.brands')
</div>




@endsection

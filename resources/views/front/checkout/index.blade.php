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
                                        <h4 class="unicase-checkout-title mb-4"><b>Alamat Pengiriman</b></h4>


                                        <form class="register-form" action="{{ route('checkout.store') }}"
                                            method="POST">
                                            @csrf

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="info-title" for="nama_pengiriman"><b>Pilih Alamat</b> <span class="text-danger">*</span></label>
                                                </div>

                                                <div class="form-group" style="margin-left: 15px;">
                                                    <label class="radio"><input type="radio" class="alamat_choose" name="alamat_choose" value="alamat_utama" checked>Alamat Utama</label>
                                                    <label class="radio"><input type="radio" class="alamat_choose" name="alamat_choose" value="alamat_lain">Alamat Lain</label>
                                                </div>

                                                <hr>
                                            </div>

                                            <div class="col-md-6 col-sm-6 already-registered-login">
                                                <div class="form-group">
                                                    <label class="info-title" for="nama_pengiriman"><b>Nama Pengirim</b> <span class="text-danger">*</span></label>
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
                                                    <label class="info-title" for="no_telepon_pengiriman"><b>Telepon</b>
                                                        <span class="text-danger">*</span></label>
                                                    <input type="number" name="no_telepon_pengiriman"
                                                        class="form-control unicase-form-control text-input"
                                                        id="no_telepon_pengiriman" placeholder="Phone"
                                                        value="{{ Auth::user()->phone }}" required=""
                                                        onchange="checkForm()">
                                                </div> <!-- // end form group  -->


                                                <div class="form-group">
                                                    <label class="info-title" for="kode_pos"><b>Kode Pos </b>
                                                        <span class="text-danger">*</span></label>

                                                    <input type="text" class="form-control" name="kode_pos" id="kode_pos" readonly value="45362">

                                                    {{-- <input type="text" name="kode_pos"
                                                        class="form-control unicase-form-control text-input"
                                                        id="kode_pos" placeholder="Post Code" required
                                                        onchange="checkForm()" value="{{ Auth::user()->kode_pos }}"> --}}
                                                </div> <!-- // end form group  -->
                                                <hr>
                                            </div>
                                            <div class="col-md-6 col-sm-6 already-registered-login">
                                                <div class="form-group">
                                                    <label class="info-title" for="provinsi"><b>Provinsi</b>
                                                        <span class="text-danger">*</span></label>

                                                    <input type="text" class="form-control" name="provinsi" id="provinsi" readonly value="Jawa Barat">

                                                    {{-- <select class="form-control unicase-form-control @error('provinsi') is-invalid @enderror" name="provinsi" id="provinsi" required onchange="checkForm()">
                                                        <option value="">== Pilh Provinsi ==</option>
                                                        @foreach ($provinsiList as $provinsi)
                                                            <option
                                                                value="{{ $provinsi['province_id'] }}"
                                                                {{ Auth::user()->provinsi == $provinsi['province'] ? 'selected' : '' }}
                                                            >{{ $provinsi['province'] }}</option>
                                                        @endforeach
                                                    </select> --}}
                                                </div> <!-- // end form group  -->


                                                <div class="form-group">
                                                    <label class="info-title" for="kabupaten"><b>Kabupaten</b>
                                                        <span class="text-danger">*</span></label>

                                                    <input type="text" class="form-control" name="kabupaten" id="kabupaten" readonly value="Kabupaten Sumedang">

                                                    {{-- <select class="form-control unicase-form-control @error('kabupaten') is-invalid @enderror" name="kabupaten" id="kabupaten" required onchange="checkForm()">
                                                        <option value="">== Pilh Kabupaten/Kota ==</option>
                                                        @foreach ($kabupatenList as $kabupaten)
                                                            <option
                                                                value="{{ $kabupaten['city_id'] }}"
                                                                {{ Auth::user()->kabupaten == $kabupaten['type'] . ' ' . $kabupaten['city_name'] ? 'selected' : '' }}
                                                            >{{ $kabupaten['type'] }} {{ $kabupaten['city_name'] }}</option>
                                                        @endforeach
                                                    </select> --}}

                                                    {{-- <input type="text" name="kabupaten"
                                                        class="form-control unicase-form-control text-input"
                                                        id="kabupaten" value="{{ Auth::user()->kabupaten }}" required
                                                        onchange="checkForm()"> --}}
                                                </div> <!-- // end form group  -->


                                                <div class="form-group">
                                                    <label class="info-title" for="kecamatan"><b>Kecamatan</b>
                                                        <span class="text-danger">*</span></label>

                                                    <input type="text" class="form-control" name="kecamatan" id="kecamatan" readonly value="Tanjungsari">

                                                    {{-- <input type="text" name="kecamatan"
                                                        class="form-control unicase-form-control text-input"
                                                        id="kecamatan" value="{{ Auth::user()->kecamatan }}" required
                                                        onchange="checkForm()"> --}}
                                                </div> <!-- // end form group  -->

                                                <div class="form-group">
                                                    <label class="info-title" for="alamat"><b>Alamat</b>
                                                        <span class="text-danger">*</span></label>
                                                    <input type="text" name="alamat"
                                                        class="form-control unicase-form-control text-input"
                                                        id="alamat" value="{{ Auth::user()->alamat }}" required
                                                        onchange="checkForm()">
                                                </div> <!-- // end form group  -->


                                                <div class="form-group">
                                                    <label class="info-title" for="catatan">Catatan
                                                    </label>
                                                    <textarea id="catatan" class="form-control" cols="30" rows="5" placeholder="catatan" name="catatan"
                                                        onchange="checkForm()"></textarea>
                                                </div> <!-- // end form group  -->
                                            </div>
                                            <!-- already-registered-login -->

                                            {{-- <div class="col-md-12">
                                                <hr>

                                                <div class="form-group">
                                                    <label class="info-title"><b>Pilih Ongkos Kirim</b> <span class="text-danger">*</span></label>
                                                    <select name="ongkir_choose" id="ongkir_choose" class="form-control unicase-form-control" required onchange="checkForm()">
                                                        <option value="">== Pilih Ongkos Kirim ==</option>
                                                    </select>
                                                </div>


                                            </div> --}}

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
                                    <h4 class="unicase-checkout-title">progres checkout anda</h4>
                                </div>
                                <div class="">
                                    <ul class="nav nav-checkout-progress list-unstyled">

                                        @foreach ($carts as $item)
                                            <li>
                                                <strong>Gambar: </strong>
                                                <img src="{{ asset('storage/' . $item->options->image) }}"
                                                    style="height: 50px; width: 50px;">
                                            </li>

                                            <li>
                                                <strong>kuantitas: </strong>
                                                ({{ $item->qty }})
                                                <strong>Color: </strong>
                                                {{ $item->options->warna }}

                                                <strong>ukuran: </strong>
                                                {{ $item->options->ukuran }}
                                            </li>
                                        @endforeach
                                        <hr>
                                        <li>
                                            @if (Session::has('coupon'))
                                                <strong>SubTotal: </strong> Rp.{{ $cartTotal }}
                                                <hr>

                                                <strong>Nama Kupon : </strong>
                                                <span
                                                    id="nama_kupon">{{ session()->get('coupon')['nama_kupon'] }}</span>
                                                ( {{ session()->get('coupon')['coupon_discount'] }} % )
                                                <hr>

                                                <strong>Kupon Diskon : </strong>
                                                Rp. <span
                                                    id="coupon_discount">{{ session()->get('coupon')['discount_amount'] }}</span>
                                                <hr>

                                                <strong>Total Keseluruhan :
                                                    Rp.{{ session()->get('coupon')['total_amount'] }}</strong>
                                                <hr>
                                            @else
                                                <strong>SubTotal: </strong> Rp.{{ number_format($cartTotal, 0, '.', '.') }}
                                                <hr>

                                                <strong>Ongkos Kirim : Rp.10.000,-</strong>
                                                <hr>

                                                <input type="hidden" name="ongkir_choose" id="ongkir_choose" value="10000">

                                                <strong>Total Keseluruhan : Rp.{{ number_format($cartTotal + 10000, 0, '.', '.') }}</strong>
                                                <hr>
                                            @endif

                                        </li>



                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>

                    <button type="button" id="pay-button" disabled
                        class="btn-upper btn btn-primary checkout-page-button mb-5" style="float:right;">Bayar Sekarang</button>
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
<script>
// function ongkir() {
//     var kabupaten = document.getElementById('kabupaten').value;

//     fetch("{{ url('/rajaongkir/ongkir/') }}?id_kabupaten_asal=23&id_kabupaten_tujuan="+ kabupaten +"&berat=1000&kurir=jne")
//         .then(response => response.json())
//         .then(data => {
//             if(data == null || data.length == 0){
//                 document.getElementById('ongkir_choose').innerHTML = `<option value="">== Pilih Ongkos Kirim ==</option>`;
//                 return;
//             }

//             var temp = `<option value="">== Pilih Ongkos Kirim ==</option>`;

//             data[0].costs.forEach(function(cost) {
//                 cost.cost.forEach(function(c) {
//                     temp += `<option value="${cost.service}_${c.value}">JNE ${cost.service} (${c.etd} Hari) - Rp. ${c.value}</option>`;
//                 });
//             });

//             document.getElementById('ongkir_choose').innerHTML = temp;
//         });
// }

document.addEventListener('DOMContentLoaded', function() {
    // Getting all radio buttons with class 'alamat_choose'
    const radioButtons = document.querySelectorAll('.alamat_choose');

    // Adding event listener to each radio button
    radioButtons.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === "alamat_utama") {
                // Perform action for Alamat Utama
                console.log("Alamat Utama selected");
                document.getElementById('alamat').value = `{{ Auth::user()->alamat }}`;
            } else if (this.value === "alamat_lain") {
                // Perform action for Alamat Lain
                console.log("Alamat Lain selected");
                document.getElementById('alamat').value = '';
            }

            checkForm();
        });
    });

    checkForm();

    // document.getElementById('provinsi').addEventListener('change', function() {
    //     var provinsi_id = this.value;
    //     if (provinsi_id != '') {
    //         fetch("{{ url('/rajaongkir/provinsi/') }}/" + provinsi_id)
    //             .then(response => response.json())
    //             .then(data => {
    //                 var holder = `<option value="">== Pilih Kabupaten/Kota ==</option>`;
    //                 data.forEach(function(kabupaten) {
    //                     holder += '<option value="' +
    //                         kabupaten.city_id + '">' + kabupaten.type + ' ' + kabupaten
    //                         .city_name + '</option>';
    //                 });

    //                 document.getElementById('kabupaten').removeAttribute('disabled');
    //                 document.getElementById('kabupaten').innerHTML = holder;

    //                 document.getElementById('kabupaten').value = '{{ Auth::user()->kabupaten }}';
    //             });
    //     } else {
    //         document.getElementById('kabupaten').setAttribute('disabled', 'disabled');
    //         document.getElementById('kabupaten').innerHTML = '<option value="">== Pilih Kabupaten/Kota ==</option>';
    //     }
    // });

    // document.getElementById('kabupaten').addEventListener('change', function() {
    //     ongkir();
    // });

    // ongkir();
});
</script>
@endsection

@extends('front.master')
@section('content')
    <div class="body-content mt-4">
        <div class="container">
            <div class="row">
                @include('front.common.user_sidebar')

                @if ($orderDetail->status == 'to be paid')

                    <div class="col-md-10">
                        @if (\Carbon\Carbon::now() < \Carbon\Carbon::parse($orderDetail->created_at)->addHours(24))
                            <div class="text-center mt-5 mb-5">
                                <h4>Batas Waktu Pembayaran (1x24 Jam):</43>
                                <p style="font-size: 30px;" id="countdown"></p>
                            </div>

                            <div class="text-center alert alert-danger" style="font-size: 18px;">
                                <strong>Pembayaran Belum Selesai!</strong>
                                <br>
                                Mohon Selesaikan Pembayaran dalam waktu 1x24 Jam Terlebih dahulu dengan menekan tombol <b>"Bayar Sekarang"</b> dibawah ini.
                            </div>

                            <button class="btn btn-success btn-block btn-lg mb-5" onclick="payNow()">Bayar Sekarang</button>
                        @else
                            <div class="text-center alert alert-danger" style="font-size: 18px;">
                                <strong>Order Expire!</strong>
                                <br>
                                Silahkan untuk melakukan pembelian dan checkout barang kembali.
                            </div>
                        @endif
                    </div>


                @endif


                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <h4>Shipping Details</h4>
                        </div>
                        <hr>
                        <div class="card-body" style="background: #E9EBEC;">
                            <table class="table">
                                <tr>
                                    <th> Shipping Name: </th>
                                    <th> {{ $orderDetail->user->name }} </th>
                                </tr>

                                <tr>
                                    <th> Shipping Phone: </th>
                                    <th> {{ $orderDetail->shipping->no_telepon_pengiriman }} </th>
                                </tr>

                                <tr>
                                    <th> Shipping Email: </th>
                                    <th> {{ $orderDetail->user->email }} </th>
                                </tr>

                                <tr>
                                    <th> Division: </th>
                                    <th> {{ $orderDetail->shipping->provinsi }} </th>
                                </tr>

                                <tr>
                                    <th> District: </th>
                                    <th> {{ $orderDetail->shipping->kabupaten }} </th>
                                </tr>

                                <tr>
                                    <th> State: </th>
                                    <th> {{ $orderDetail->shipping->kecamatan }} </th>
                                </tr>

                                <tr>
                                    <th> Post Code: </th>
                                    <th> {{ $orderDetail->shipping->kode_pos }} </th>
                                </tr>

                                <tr>
                                    <th> Order Date: </th>
                                    <th> {{ $orderDetail->tanggal_pesanan }} </th>
                                </tr>
                                <tr>
                                    <th> Delivery Status: </th>
                                    <th>
                                        <span class="badge badge-pill badge-warning"
                                            style="background:{{ $orderDetail->shipping->status_pengiriman == 0 ? '#EF3737' : '#418DB9' }} ; ">{{ $orderDetail->shipping->status_pengiriman == 0 ? 'Waitlist' : 'Sent' }}
                                        </span>
                                    </th>
                                </tr>
                                @if ($orderDetail->shipping->status_pengiriman == 1)
                                    <tr>
                                        <th> Resi NO: </th>
                                        <th>
                                            <span class="badge badge-pill badge-warning"
                                                style="background:#EF3737 ; ">{{ $orderDetail->shipping->resi }}
                                            </span>
                                        </th>
                                    </tr>
                                @endif

                            </table>


                        </div>

                    </div>

                </div> <!-- // end col md -5 -->
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <h4>Order Details

                            </h4>
                        </div>
                        <hr>
                        <div class="card-body" style="background: #E9EBEC;">
                            <table class="table">
                                <tr>
                                    <th> Name: </th>
                                    <th> {{ $orderDetail->user->name }} </th>
                                </tr>

                                <tr>
                                    <th> Phone: </th>
                                    <th> {{ $orderDetail->user->phone }} </th>
                                </tr>

                                <tr>
                                    <th> Payment Type: </th>
                                    <th> {{ ucwords($orderDetail->tipe_pembayaran) }} </th>
                                </tr>

                                <tr>
                                    <th> Trans ID: </th>
                                    <th> {{ $orderDetail->id_transaksi }} </th>
                                </tr>

                                <tr>
                                    <th> Order ID: </th>
                                    <th class="text-danger"> {{ $orderDetail->id_pesanan }} </th>
                                </tr>

                                <tr>
                                    <th> Order Total: </th>
                                    <th>{{ $orderDetail->nominal_total }} </th>
                                </tr>

                                <tr>
                                    <th> Order: </th>
                                    <th>
                                        <span class="badge badge-pill badge-warning"
                                            style="background: #418DB9;">{{ $orderDetail->status }} </span>
                                    </th>
                                </tr>



                            </table>


                        </div>

                    </div>

                </div> <!-- // 2ND end col md -5 -->

                <div class="row">



                    <div class="col-md-12">

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>

                                    <tr style="background: #e2e2e2;">
                                        <td class="col-md-1">
                                            <label for=""> Image</label>
                                        </td>

                                        <td class="col-md-3">
                                            <label for=""> Product Name </label>
                                        </td>

                                        <td class="col-md-3">
                                            <label for=""> Product Code</label>
                                        </td>


                                        <td class="col-md-2">
                                            <label for=""> Color </label>
                                        </td>

                                        <td class="col-md-2">
                                            <label for=""> Size </label>
                                        </td>

                                        <td class="col-md-1">
                                            <label for=""> Quantity </label>
                                        </td>

                                        <td class="col-md-1">
                                            <label for=""> Price </label>
                                        </td>

                                    </tr>

                                    @foreach ($orderItem as $item)
                                        <tr>
                                            <td class="col-md-1">
                                                <label for=""><img
                                                        src="{{ asset('storage/' . $item->product->product_thambnail) }}"
                                                        height="50px;" width="50px;"> </label>
                                            </td>

                                            <td class="col-md-3">
                                                <label for=""> {{ $item->product->product_name }}</label>
                                            </td>


                                            <td class="col-md-3">
                                                <label for=""> {{ $item->product->product_code }}</label>
                                            </td>

                                            <td class="col-md-2">
                                                <label for=""> {{ ucwords($item->color) }}</label>
                                            </td>

                                            <td class="col-md-2">
                                                <label for=""> {{ ucwords($item->size) }}</label>
                                            </td>

                                            <td class="col-md-2">
                                                <label for=""> {{ $item->qty }}</label>
                                            </td>

                                            <td class="col-md-2">
                                                <label for="">
                                                    Rp.{{ $item->product->discount_price ? $item->product->discount_price : $item->product->selling_price }}
                                                    (Rp.
                                                    {{ $item->product->discount_price ? $item->product->discount_price * $item->qty : $item->product->selling_price * $item->qty }})
                                                </label>
                                            </td>

                                        </tr>
                                    @endforeach





                                </tbody>

                            </table>

                        </div>





                    </div> <!-- / end col md 8 -->












                </div> <!-- // END ORDER ITEM ROW -->



            </div> <!-- // end row -->

        </div>

    </div>

    @if ($orderDetail->status == 'to be paid')
        <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
        <script>
            function payNow()
            {
                window.snap.pay('{{ $orderDetail->snap_token }}', {
                    onSuccess: function(result){
                        /* You may add your own implementation here */
                        location.reload();
                        console.log(result);
                    },
                    onPending: function(result){
                        /* You may add your own implementation here */
                        console.log(result);

                    },
                    onError: function(result){
                        /* You may add your own implementation here */
                        console.log(result);

                    },
                    onClose: function(){
                        /* You may add your own implementation here */
                        alert('Mohon untuk selesaikan pembayaran!');
                    }
                });
            }
        </script>

        <script>
            // Set the date we're counting down to
            var countDownDate = new Date("{{ \Carbon\Carbon::parse($orderDetail->created_at)->addHours(24)->format('M j, Y H:i:s') }}").getTime();

            // Update the count down every 1 second
            var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            document.getElementById("countdown").innerHTML = hours + " Jam "
            + minutes + " Menit " + seconds + " Detik ";

            // If the count down is over, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("countdown").innerHTML = "EXPIRED";
            }
            }, 1000);
        </script>
    @endif

@endsection

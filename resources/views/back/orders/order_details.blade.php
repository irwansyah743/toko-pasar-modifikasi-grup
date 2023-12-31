@extends('admin.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->

    <div class="container-full">
        <!-- Content Header (Page header) -->


        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Detail Pesanan</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">Detail Pesanan</li>

                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>



        <!-- Main content -->
        <section class="content">
            <div class="row">


                <div class="col-md-6 col-12">
                    <div class="box box-bordered border-primary">
                        <div class="box-header with-border">
                            <h4 class="box-title"><strong>Detail Pengiriman</strong> </h4>
                        </div>


                        <table class="table">
                            <tr>
                                <th> Nama Pengirim : </th>
                                <th> {{ $orderDetail->user->name }} </th>
                            </tr>

                            <tr>
                                <th> SNo Telepon Pengirim : </th>
                                <th> {{ $orderDetail->user->phone }} </th>
                            </tr>

                            <tr>
                                <th> Email Pengirim : </th>
                                <th> {{ $orderDetail->user->email }} </th>
                            </tr>

                            <tr>
                                <th> Provinsi : </th>
                                <th> {{ $orderDetail->shipping->provinsi }} </th>
                            </tr>

                            <tr>
                                <th> Kabupaten : </th>
                                <th> {{ $orderDetail->shipping->kabupaten }} </th>
                            </tr>

                            <tr>
                                <th> Kecamatan : </th>
                                <th>{{ $orderDetail->shipping->kecamatan }} </th>
                            </tr>

                            <tr>
                                <th> Kode pos : </th>
                                <th> {{ $orderDetail->shipping->kode_pos }} </th>
                            </tr>

                            <tr>
                                <th> Tanggal Pesanan : </th>
                                <th> {{ $orderDetail->tanggal_pesanan }} </th>
                            </tr>

                            <tr>
                                <th> Kurir : </th>
                                <th> {{ $orderDetail->shipping->kurir }} </th>
                            </tr>

                            <tr>
                                <th> Ongkos Kirim : </th>
                                <th> {{ $orderDetail->shipping->ongkos_kirim }} </th>
                            </tr>

                            <tr>
                                <th> Status Kirim : </th>
                                <th>
                                    <span class="badge badge-pill badge-warning"
                                        style="background:{{ $orderDetail->shipping->status_pengiriman == 0 ? '#EF3737' : '#418DB9' }} ; ">{{ $orderDetail->shipping->status_pengiriman == 0 ? 'Waitlist' : 'Sent' }}
                                    </span>
                                </th>
                            </tr>
                            @if ($orderDetail->shipping->resi !== null)
                                <tr>
                                    <th> No Resi : </th>
                                    <th> {{ $orderDetail->shipping->resi }} </th>
                                </tr>
                            @else
                                <form action="{{ url('orders/shipping/' . $orderDetail->id_pengiriman) }}" method="post">
                                    @csrf
                                    <tr>
                                        <th> No Resi </th>
                                        <th><input type="hidden" name="id_pesanan" value="{{ $orderDetail->getKey() }}">
                                            <input type="text" name="resi" required>
                                        </th>
                                    </tr>
                                    <th></th>
                                    <th> <button type="submit" id="delivery-button" class="btn btn-primary">Mark as
                                            Sent</button></th>
                                </form>
                            @endif

                        </table>



                    </div>
                </div> <!--  // cod md -6 -->


                <div class="col-md-6 col-12">
                    <div class="box box-bordered border-primary">
                        <div class="box-header with-border">
                            <h4 class="box-title"><strong>Detail Pesanan</strong></h4>
                        </div>


                        <table class="table">
                            <tr>
                                <th> Nama : </th>
                                <th> {{ $orderDetail->user->name }} </th>
                            </tr>

                            <tr>
                                <th> Telepon : </th>
                                <th> {{ $orderDetail->user->phone }} </th>
                            </tr>

                            <tr>
                                <th> tipe Pembayaran : </th>
                                <th> {{ ucwords($orderDetail->tipe_pembayaran) }} </th>
                            </tr>

                            <tr>
                                <th> ID Transaksi : </th>
                                <th> {{ $orderDetail->id_transaksi }} </th>
                            </tr>

                            <tr>
                                <th> Pesanan : </th>
                                <th class="text-danger"> {{ $orderDetail->id_pesanan }} </th>
                            </tr>

                            <tr>
                                <th> Total Pesanan : </th>
                                <th>Rp. {{ $orderDetail->nominal_total }} </th>
                            </tr>

                            <tr>
                                <th> Pesanan : </th>
                                <th>
                                    <span class="badge badge-pill badge-warning"
                                        style="background: #418DB9;">{{ $orderDetail->status }} </span>
                                </th>
                            </tr>



                        </table>



                    </div>
                </div> <!--  // cod md -6 -->





                <div class="col-md-12 col-12">
                    <div class="box box-bordered border-primary">
                        <div class="box-header with-border">

                        </div>



                        <table class="table">
                            <tbody>

                                <tr>
                                    <td width="10%">
                                        <label for=""> Gambar</label>
                                    </td>

                                    <td width="20%">
                                        <label for=""> Nama Produk </label>
                                    </td>

                                    <td width="10%">
                                        <label for=""> kode Produk</label>
                                    </td>


                                    <td width="10%">
                                        <label for=""> Warna </label>
                                    </td>

                                    <td width="10%">
                                        <label for=""> Ukuran </label>
                                    </td>

                                    <td width="10%">
                                        <label for=""> Kuantitas </label>
                                    </td>

                                    <td width="10%">
                                        <label for=""> Harga </label>
                                    </td>

                                </tr>


                                @foreach ($orderItem as $item)
                                    <tr>
                                        <td width="10%">
                                            <label for=""><img
                                                    src="{{ asset('storage/' . $item->product->thumbnail_produk) }}"
                                                    height="70px;" width="50px;"> </label>
                                        </td>

                                        <td width="20%">
                                            <label for=""> {{ $item->product->nama_produk }}</label>
                                        </td>


                                        <td width="10%">
                                            <label for=""> {{ $item->product->kode_produk }}</label>
                                        </td>

                                        <td width="10%">
                                            <label for=""> {{ $item->warna }}</label>
                                        </td>

                                        <td width="10%">
                                            <label for=""> {{ $item->ukuran }}</label>
                                        </td>

                                        <td width="10%">
                                            <label for=""> {{ $item->kuantitas }}</label>
                                        </td>

                                        <td width="10%">
                                            <label for="">
                                                Rp.{{ $item->product->harga_diskon ? $item->product->harga_diskon : $item->product->harga_jual }}
                                                (Rp.
                                                {{ $item->product->harga_diskon ? $item->product->harga_diskon * $item->kuantitas : $item->product->harga_jual * $item->kuantitas }})
                                            </label>
                                        </td>

                                    </tr>
                                @endforeach





                            </tbody>

                        </table>











                    </div>
                </div> <!--  // cod md -12 -->
















            </div>
            <!-- /. end row -->
        </section>
        <!-- /.content -->

    </div>
@endsection

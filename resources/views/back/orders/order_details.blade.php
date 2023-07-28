@extends('admin.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->

    <div class="container-full">
        <!-- Content Header (Page header) -->


        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Order Details</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">Order Details</li>

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
                            <h4 class="box-title"><strong>Shipping Details</strong> </h4>
                        </div>


                        <table class="table">
                            <tr>
                                <th> Shipping Name : </th>
                                <th> {{ $orderDetail->user->name }} </th>
                            </tr>

                            <tr>
                                <th> Shipping Phone : </th>
                                <th> {{ $orderDetail->user->phone }} </th>
                            </tr>

                            <tr>
                                <th> Shipping Email : </th>
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
                                <th> Post Code : </th>
                                <th> {{ $orderDetail->shipping->kode_pos }} </th>
                            </tr>

                            <tr>
                                <th> Order Date : </th>
                                <th> {{ $orderDetail->tanggal_pesanan }} </th>
                            </tr>
                            <tr>
                                <th> Delivery Status : </th>
                                <th>
                                    <span class="badge badge-pill badge-warning"
                                        style="background:{{ $orderDetail->shipping->status_pengiriman == 0 ? '#EF3737' : '#418DB9' }} ; ">{{ $orderDetail->shipping->status_pengiriman == 0 ? 'Waitlist' : 'Sent' }}
                                    </span>
                                </th>
                            </tr>
                            @if ($orderDetail->shipping->resi !== null)
                                <tr>
                                    <th> Resi NO : </th>
                                    <th> {{ $orderDetail->shipping->resi }} </th>
                                </tr>
                            @else
                                <form action="{{ url('orders/shipping/' . $orderDetail->id_pengiriman) }}" method="post">
                                    @csrf
                                    <tr>
                                        <th> Resi NO </th>
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
                            <h4 class="box-title"><strong>Order Details</strong></h4>
                        </div>


                        <table class="table">
                            <tr>
                                <th> Name : </th>
                                <th> {{ $orderDetail->user->name }} </th>
                            </tr>

                            <tr>
                                <th> Phone : </th>
                                <th> {{ $orderDetail->user->phone }} </th>
                            </tr>

                            <tr>
                                <th> Payment Type : </th>
                                <th> {{ ucwords($orderDetail->tipe_pembayaran) }} </th>
                            </tr>

                            <tr>
                                <th> Tranx ID : </th>
                                <th> {{ $orderDetail->id_transaksi }} </th>
                            </tr>

                            <tr>
                                <th> Order : </th>
                                <th class="text-danger"> {{ $orderDetail->id_pesanan }} </th>
                            </tr>

                            <tr>
                                <th> Order Total : </th>
                                <th>Rp. {{ $orderDetail->nominal_total }} </th>
                            </tr>

                            <tr>
                                <th> Order : </th>
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
                                        <label for=""> Image</label>
                                    </td>

                                    <td width="20%">
                                        <label for=""> Product Name </label>
                                    </td>

                                    <td width="10%">
                                        <label for=""> Product Code</label>
                                    </td>


                                    <td width="10%">
                                        <label for=""> Color </label>
                                    </td>

                                    <td width="10%">
                                        <label for=""> Size </label>
                                    </td>

                                    <td width="10%">
                                        <label for=""> Quantity </label>
                                    </td>

                                    <td width="10%">
                                        <label for=""> Price </label>
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

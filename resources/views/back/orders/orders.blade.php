@extends('admin.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->

    <div class="container-full">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content">
            <div class="row">



                <div class="col-12">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ $orderType }} Orders List</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Date </th>
                                            <th>Order </th>
                                            <th>Amount </th>
                                            <th>Payment </th>
                                            <th>Status </th>
                                            <th>Delivery </th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $item)
                                            <tr>
                                                <td> {{ $item->tanggal_pesanan }} </td>
                                                <td> {{ $item->id_pesanan }} </td>
                                                <td> Rp. {{ $item->nominal_total }} </td>

                                                <td> {{ ucwords($item->tipe_pembayaran) }} </td>
                                                <td> <span class="badge badge-pill badge-primary">{{ $item->status }}
                                                    </span> </td>
                                                <td> <span
                                                        class="badge badge-pill {{ $item->shipping->status_pengiriman == 0 ? 'badge-danger' : 'badge-primary' }} ">{{ $item->shipping->status_pengiriman == 0 ? 'Waitlist' : 'Sent' }}
                                                    </span> </td>

                                                <td width="25%">
                                                    <a href="{{ route('pending.order.details', $item->getKey()) }}"
                                                        class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i>
                                                    </a>
                                                    <a href="mailto:{{ $item->shipping->email_pengiriman }}"
                                                        class="btn btn-danger" title="Send Email" id="delete">
                                                        <i class="fa fa-envelope"></i></a>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->


                </div>
                <!-- /.col -->






            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>
@endsection

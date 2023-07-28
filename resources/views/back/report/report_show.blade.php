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
                            <h3 class="box-title">Order List</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Date </th>
                                            <th>Invoice </th>
                                            <th>Amount </th>
                                            <th>Payment </th>
                                            <th>Status </th>
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

                                                <td width="25%">
                                                    <a target="_blank" href="{{ route('invoice.download', $item->id) }}"
                                                        class="btn btn-danger" title="Invoice Download">
                                                        <i class="fa fa-download"></i></a>
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

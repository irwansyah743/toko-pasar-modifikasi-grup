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
                            <h3 class="box-title">Semua Review Publish </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>rangkuman </th>
                                            <th>komentar </th>
                                            <th>User </th>
                                            <th>Product </th>
                                            <th>Status </th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($review as $item)
                                            <tr>
                                                <td> {{ $item->rangkuman }} </td>
                                                <td> {{ $item->komentar }} </td>
                                                <td> {{ $item->user->name }} </td>

                                                <td> {{ $item->product->nama_produk }} </td>
                                                <td>
                                                    @if ($item->status == 0)
                                                        <span class="badge badge-pill badge-primary">Pending </span>
                                                    @elseif($item->status == 1)
                                                        <span class="badge badge-pill badge-success">Publish </span>
                                                    @endif

                                                </td>

                                                <td width="25%">
                                                    <form method="POST" id="{{ 'deletereview' . $item->getKey() }}"
                                                        style="display:inline;">
                                                        @csrf
                                                        <button type="button" class="btn btn-danger delete-button"
                                                            onclick="deleteConfirmation('review',{{ $item->getKey() }})">
                                                            <i class="fa fa-trash"></i></button>

                                                    </form>
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

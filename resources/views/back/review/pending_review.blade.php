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
                            <h3 class="box-title">Pending All Reviews </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Summary </th>
                                            <th>Comment </th>
                                            <th>User </th>
                                            <th>Product </th>
                                            <th>Status </th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($review as $item)
                                            <tr>
                                                <td> {{ $item->summary }} </td>
                                                <td> {{ $item->comment }} </td>
                                                <td> {{ $item->user->name }} </td>

                                                <td> {{ $item->product->product_name }} </td>
                                                <td>
                                                    @if ($item->status == 0)
                                                        <span class="badge badge-pill badge-primary">Pending </span>
                                                    @elseif($item->status == 1)
                                                        <span class="badge badge-pill badge-success">Publish </span>
                                                    @endif

                                                </td>

                                                <td width="25%">

                                                    <form method="POST" action="{{ route('review.approve', $item->id) }}"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('put')
                                                        <button class="btn btn-danger delete-button">Approve
                                                        </button>

                                                    </form>
                                                    <form method="POST" id="{{ 'deletereview' . $item->id }}"
                                                        style="display:inline;">
                                                        @csrf
                                                        <button type="button" class="btn btn-danger delete-button"
                                                            onclick="deleteConfirmation('review',{{ $item->id }})">
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

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
                            <h3 class="box-title">Total Admin User </h3>
                            <a href="{{ route('add.admin') }}" class="btn btn-primary" style="float: right;">Add Admin
                                User</a>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Image </th>
                                            <th>Name </th>
                                            <th>Email </th>
                                            <th>Access </th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($adminuser as $item)
                                            <tr>
                                                <td> <img style="width: 50px; height: 50px;"
                                                        src="{{ asset('storage/' . $item->profile_photo_path) }}"> </td>
                                                <td> {{ $item->name }} </td>
                                                <td> {{ $item->email }} </td>

                                                <td>
                                                    @if ($item->brand == 1)
                                                        <span class="badge btn-primary">Brand</span>
                                                    @else
                                                    @endif

                                                    @if ($item->category == 1)
                                                        <span class="badge btn-secondary">Category</span>
                                                    @else
                                                    @endif


                                                    @if ($item->product == 1)
                                                        <span class="badge btn-success">Product</span>
                                                    @else
                                                    @endif


                                                    @if ($item->slider == 1)
                                                        <span class="badge btn-danger">Slider</span>
                                                    @else
                                                    @endif


                                                    @if ($item->coupon == 1)
                                                        <span class="badge btn-warning">Coupons</span>
                                                    @else
                                                    @endif



                                                    @if ($item->review == 1)
                                                        <span class="badge btn-secondary">Review</span>
                                                    @else
                                                    @endif


                                                    @if ($item->orders == 1)
                                                        <span class="badge btn-success">Orders</span>
                                                    @else
                                                    @endif

                                                    @if ($item->report == 1)
                                                        <span class="badge btn-warning">Reports</span>
                                                    @else
                                                    @endif

                                                    @if ($item->alluser == 1)
                                                        <span class="badge btn-info">Alluser</span>
                                                    @else
                                                    @endif

                                                    @if ($item->alladmin == 1)
                                                        <span class="badge btn-dark">Adminuserrole</span>
                                                    @else
                                                    @endif
                                                </td>


                                                <td width="25%">
                                                    <a href="{{ route('admin.edit', $item->id) }}" class="btn btn-info"
                                                        title="Edit Data"><i class="fa fa-pencil"></i> </a>

                                                    <form method="POST" id="{{ 'deleteadmin' . $item->id }}"
                                                        style="display:inline;">
                                                        @csrf
                                                        <button type="button" class="btn btn-danger delete-button"
                                                            onclick="deleteConfirmation('admin',{{ $item->id }})">
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

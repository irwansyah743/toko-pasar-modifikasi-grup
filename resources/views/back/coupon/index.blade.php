@extends('admin.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->

    <div class="container-full">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content">
            <div class="row">



                <div class="col-8">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Daftar Kupon</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nama Kupon </th>
                                            <th>Kupon Diskon</th>
                                            <th>Validitas </th>
                                            <th>Status </th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($coupons as $coupon)
                                            <tr>
                                                <td> {{ $coupon->nama_kupon }} </td>
                                                <td> {{ $coupon->diskon_kupon }}% </td>
                                                <td width="25%">
                                                    {{ Carbon\Carbon::parse($coupon->validitas_kupon)->format('D, d F Y') }}
                                                </td>

                                                <td>
                                                    @if ($coupon->validitas_kupon >= Carbon\Carbon::now()->format('Y-m-d'))
                                                        <span class="badge badge-pill badge-success"> Valid </span>
                                                    @else
                                                        <span class="badge badge-pill badge-danger"> Invalid </span>
                                                    @endif

                                                </td>

                                                <td width="25%">
                                                    <a href="{{ route('coupon.edit', $coupon->getKey()) }}" class="btn btn-info"
                                                        title="Edit Data"><i class="fa fa-pencil"></i> </a>
                                                    <form method="POST" id="{{ 'deletecoupon' . $coupon->getKey() }}"
                                                        style="display:inline;">
                                                        @csrf
                                                        <button type="button" class="btn btn-danger delete-button"
                                                            onclick="deleteConfirmation('coupon',{{ $coupon->getKey() }})">
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


                <!--   ------------ Add Category Page -------- -->


                <div class="col-4">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Coupon </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">


                                <form method="post" action="{{ route('coupon.store') }}" novalidate>
                                    @csrf


                                    <div class="form-group">
                                        <h5>Coupon Name <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="nama_kupon"
                                                class="form-control @error('nama_kupon') is-invalid @enderror">
                                            @error('nama_kupon')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <h5>Coupon Discount(%) <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="number" name="diskon_kupon"
                                                class="form-control @error('diskon_kupon') is-invalid @enderror">
                                            @error('diskon_kupon')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <h5>Coupon Validity Date <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="date" name="validitas_kupon"
                                                class="form-control @error('validitas_kupon') is-invalid @enderror"
                                                min="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                                            @error('validitas_kupon')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add New">
                                    </div>
                                </form>





                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>




            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>
@endsection

@extends('admin.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->

    <div class="container-full">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content">
            <div class="row">






                <!--   ------------ Add Coupon Page -------- -->


                <div class="col-12">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Coupon </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">


                                <form method="post" action="{{ route('coupon.update', $coupon->getKey()) }}" novalidate>
                                    @csrf
                                    @method('put')


                                    <div class="form-group">
                                        <h5>Nama Kupon <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="nama_kupon" class="form-control"
                                                value="{{ old('nama_kupon', $coupon->nama_kupon) }}">
                                            @error('nama_kupon')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <h5>Kupon Diskon(%) <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="diskon_kupon" class="form-control"
                                                value="{{ old('diskon_kupon', $coupon->diskon_kupon) }}">
                                            @error('diskon_kupon')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <h5>Tanggal Validitas kupon <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="date" name="validitas_kupon" class="form-control"
                                                min="{{ Carbon\Carbon::now()->format('Y-m-d') }}"
                                                value="{{ old('validitas_kupon', $coupon->validitas_kupon) }}">
                                            @error('validitas_kupon')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update">
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

@extends('admin.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->

    <div class="container-full">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content">

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Suplier </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    <form method="post" action="{{ url('suplier/' . $suplier->getKey()) }}" enctype="multipart/form-data"
                        novalidate>
                        @csrf
                        @method('put')

                        <input type="hidden" name="id" value="{{ $suplier->getKey() }}">

                        <div class="form-group">
                            <h5>Nama Suplier <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="nama_suplier"
                                    class="form-control  @error('nama_suplier') is-invalid @enderror"
                                    value="{{ old('nama_suplier', $suplier->nama_suplier) }}">
                                @error('nama_suplier')
                                    <div class="invalid-feedback text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <h5>Alamat Suplier <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="alamat_suplier"
                                    class="form-control  @error('alamat_suplier') is-invalid @enderror"
                                    value="{{ old('alamat_suplier', $suplier->alamat_suplier) }}">
                                @error('alamat_suplier')
                                    <div class="invalid-feedback text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <h5>Pengajuan Stok <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="pengajuan_stok"
                                    class="form-control  @error('pengajuan_stok') is-invalid @enderror"
                                    value="{{ old('pengajuan_stok', $suplier->pengajuan_stok) }}">
                                @error('pengajuan_stok')
                                    <div class="invalid-feedback text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="text-xs-right mt-2">
                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update">
                        </div>
                    </form>


                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </section>
        <!-- /.content -->

    </div>
@endsection

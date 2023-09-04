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
                            <h3 class="box-title">Daftar Supplier <span class="badge badge-pill badge-danger">
                                    {{ count($supliers) }} </span></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nama Suplier</th>
                                            <th>Alamat</th>
                                            <th>Pengajuan Stok</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($supliers as $suplier)
                                            <tr>
                                                <td>{{ $suplier->nama_suplier }}</td>
                                                <td>{{ $suplier->alamat_suplier }}</td>
                                                <td>{{ $suplier->pengajuan_stok }}</td>
                                                <td>
                                                    <a href="{{ url('suplier/' . $suplier->getKey()) }}" class="btn btn-info"
                                                        title="Edit Data"><i class="fa fa-pencil"></i> </a>

                                                    <form method="POST" id="{{ 'deletesuplier' . $suplier->getKey() }}"
                                                        style="display:inline;">
                                                        @csrf
                                                        <button type="button" class="btn btn-danger delete-button"
                                                            onclick="deleteConfirmation('suplier',{{ $suplier->getKey() }})">
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


                <!--   ------------ Add Suplier Page -------- -->


                <div class="col-4">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Tambah Suplier </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="post" action="{{ route('suplier.store') }}" enctype="multipart/form-data"
                                    novalidate>
                                    @csrf


                                    <div class="form-group">
                                        <h5>Nama Suplier <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="nama_suplier"
                                                class="form-control @error('nama_suplier') is-invalid @enderror"
                                                value="{{ old('nama_suplier') }}">
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
                                                class="form-control @error('alamat_suplier') is-invalid @enderror"
                                                value="{{ old('alamat_suplier') }}">
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
                                                class="form-control @error('pengajuan_stok') is-invalid @enderror"
                                                value="{{ old('pengajuan_stok') }}">
                                            @error('pengajuan_stok')
                                                <div class="invalid-feedback text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5 mt-4" value="Add New">
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

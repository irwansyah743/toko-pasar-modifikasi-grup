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
                            <h3 class="box-title">Brand List <span class="badge badge-pill badge-danger">
                                    {{ count($brands) }} </span></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Brand</th>
                                            <th>Image</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($brands as $brand)
                                            <tr>
                                                <td>{{ $brand->brand_name }}</td>
                                                <td><img src="{{ asset('storage/' . $brand->brand_image) }}"
                                                        style="width: 70px; height: 40px;"> </td>
                                                <td>
                                                    <a href="{{ url('brand/' . $brand->id) }}" class="btn btn-info"
                                                        title="Edit Data"><i class="fa fa-pencil"></i> </a>

                                                    <form method="POST" id="{{ 'deletebrand' . $brand->id }}"
                                                        style="display:inline;">
                                                        @csrf
                                                        <button type="button" class="btn btn-danger delete-button"
                                                            onclick="deleteConfirmation('brand',{{ $brand->id }})">
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


                <!--   ------------ Add Brand Page -------- -->


                <div class="col-4">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Brand </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="post" action="{{ route('brand.store') }}" enctype="multipart/form-data"
                                    novalidate>
                                    @csrf


                                    <div class="form-group">
                                        <h5>Brand name <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="brand_name"
                                                class="form-control @error('brand_name') is-invalid @enderror"
                                                value="{{ old('brand_name') }}">
                                            @error('brand_name')
                                                <div class="invalid-feedback text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Brand image <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" name="brand_image"
                                                class="form-control @error('brand_image') is-invalid @enderror"
                                                onchange="previewImage()" id="input_image">
                                            @error('brand_image')
                                                <div class="invalid-feedback text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <img class="mt-2" src=""
                                                style="display: none; width:100px; height:100px;" alt="User Avatar"
                                                id="img-preview">
                                        </div>


                                        <div class="text-xs-right">
                                            <input type="submit" class="btn btn-rounded btn-primary mb-5 mt-4"
                                                value="Add New">
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

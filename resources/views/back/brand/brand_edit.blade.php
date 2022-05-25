@extends('admin.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->

    <div class="container-full">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content">

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Brand </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    <form method="post" action="{{ url('brand/' . $brand->id) }}" enctype="multipart/form-data"
                        novalidate>
                        @csrf
                        @method('put')

                        <input type="hidden" name="id" value="{{ $brand->id }}">
                        <div class="form-group">
                            <h5>Brand name <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="brand_name"
                                    class="form-control  @error('brand_name') is-invalid @enderror"
                                    value="{{ old('brand_name', $brand->brand_name) }}">
                                @error('brand_name')
                                    <div class="invalid-feedback text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Brand image <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="hidden" value="{{ $brand->brand_image }}" name="old_image">
                                        <input type="file" name="brand_image"
                                            class="form-control  @error('brand_image') is-invalid @enderror"
                                            onchange="previewImage()" id="input_image">
                                        @error('brand_image')
                                            <div class="invalid-feedback text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <img class="rounded-circle" src="{{ url('storage/' . $brand->brand_image) }}"
                                    alt="User Avatar" style="width: 100px; height:100px;" id="img-preview">
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

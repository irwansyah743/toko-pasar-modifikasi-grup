@extends('admin.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->

    <div class="container-full">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!--   ------------ Edit Slider Page -------- -->
                <div class="col-12">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Slider </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">


                                <form method="post" action="{{ route('slider.update', $slider->id) }}"
                                    enctype="multipart/form-data" novalidate>
                                    @csrf
                                    @method('put')

                                    <div class="form-group">
                                        <h5>Slider Title <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" value="{{ old('title', $slider->title) }}" name="title"
                                                class="form-control @error('title') is-invalid @enderror">
                                            @error('title')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>Slider Decriptio <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <textarea id="editor1" name="description" rows="10" cols="80"
                                                class="form-control @error('description') is-invalid @enderror">{{ old('description', $slider->description) }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <h5>Slider Image <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="hidden" name="old_image" value="{{ $slider->slider_img }}">
                                            <input type="file" name="slider_img"
                                                class="form-control @error('slider_img') is-invalid @enderror"
                                                onchange="previewImage()" id="input_image">
                                            @error('slider_img')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <img class="mt-2" alt="Slider Image"
                                                style="width:1000px; height:500px;" id="img-preview"
                                                src="{{ asset('storage/' . $slider->slider_img) }}">
                                        </div>
                                    </div>


                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Slider">
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

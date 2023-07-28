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
                            <h3 class="box-judul">Edit Slider </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">


                                <form method="post" action="{{ route('slider.update', $slider->id) }}"
                                    enctype="multipart/form-data" novalidate>
                                    @csrf
                                    @method('put')

                                    <div class="form-group">
                                        <h5>Judul <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" value="{{ old('judul', $slider->judul) }}" name="judul"
                                                class="form-control @error('judul') is-invalid @enderror">
                                            @error('judul')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>Slider Decriptio <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <textarea id="editor1" name="deskripsi" rows="10" cols="80"
                                                class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $slider->deskripsi) }}</textarea>
                                            @error('deskripsi')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <h5>Gambar Banner <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="hidden" name="old_image" value="{{ $slider->gambar_banner }}">
                                            <input type="file" name="gambar_banner"
                                                class="form-control @error('gambar_banner') is-invalid @enderror"
                                                onchange="previewImage()" id="input_image">
                                            @error('gambar_banner')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <img class="mt-2" alt="Gambar Banner"
                                                style="width:1000px; height:500px;" id="img-preview"
                                                src="{{ asset('storage/' . $slider->gambar_banner) }}">
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

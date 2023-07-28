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
                            <h3 class="box-title">Slider List</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Gambar Banner </th>
                                            <th>Judul</th>
                                            <th>Decription</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sliders as $slider)
                                            <tr>

                                                <td><img src="{{ asset('storage/' . $slider->gambar_banner) }}"
                                                        style="width: 70px; height: 40px;"> </td>
                                                <td>
                                                    @if ($slider->judul == null)
                                                        <span class="badge badge-pill badge-danger"> No Title </span>
                                                    @else
                                                        {{ $slider->judul }}
                                                    @endif
                                                </td>

                                                <td>{!! $slider->deskripsi !!}</td>
                                                <td>
                                                    @if ($slider->status == 1)
                                                        <span class="badge badge-pill badge-success"> Active </span>
                                                    @else
                                                        <span class="badge badge-pill badge-danger"> InActive </span>
                                                    @endif

                                                </td>

                                                <td width="30%">
                                                    <a href="{{ route('slider.edit', $slider->getKey()) }}"
                                                        class="btn btn-info" title="Edit Data"><i
                                                            class="fa fa-pencil"></i> </a>


                                                    <form method="POST" id="{{ 'deleteslider' . $slider->getKey() }}"
                                                        style="display:inline;">
                                                        @csrf
                                                        <button type="button" class="btn btn-danger delete-button"
                                                            onclick="deleteConfirmation('slider',{{ $slider->getKey() }})">
                                                            <i class="fa fa-trash"></i></button>
                                                    </form>

                                                    @if ($slider->status == 1)
                                                        <form method="POST"
                                                            action="{{ route('slider.inactive', $slider->getKey()) }}"
                                                            style="display:inline;">
                                                            @csrf
                                                            @method('put')
                                                            <button type="submit" class="btn btn-danger" title="Inactivate">
                                                                <i class="fa fa-arrow-down"></i></button>
                                                        </form>
                                                    @else
                                                        <form method="POST"
                                                            action="{{ route('slider.active', $slider->getKey()) }}"
                                                            style="display:inline;">
                                                            @csrf
                                                            @method('put')
                                                            <button type="submit" class="btn btn-success" title="Activate">
                                                                <i class="fa fa-arrow-up"></i></button>
                                                        </form>
                                                    @endif

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


                <!--   ------------ Add Slider Page -------- -->


                <div class="col-4">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Slider </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">


                                <form method="post" action="{{ route('slider.store') }}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <h5>Judul <span class="text-danger">*</span>
                                        </h5>
                                        <div class="controls">
                                            <input type="text" name="judul" value="{{ old('judul') }}"
                                                class="form-control @error('judul') is-invalid @enderror">
                                            @error('judul')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Deskripsi Banner <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <textarea id="editor1" name="deskripsi" rows="10" cols="80"
                                                class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi') }}</textarea>
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
                                            <input type="file" name="gambar_banner"
                                                class="form-control @error('gambar_banner') is-invalid @enderror"
                                                onchange="previewImage()" id="input_image">
                                            @error('gambar_banner')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <img class="mt-2" src="" style="display: none; width:100%;"
                                                alt="Gambar Banner" id="img-preview">
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

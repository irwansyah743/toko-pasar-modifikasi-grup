@extends('admin.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->

    <div class="container-full">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content">

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Category </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    <form method="post" action="{{ url('category/' . $category->getKey()) }}" enctype="multipart/form-data"
                        novalidate>
                        @csrf
                        @method('put')

                        <input type="hidden" name="id" value="{{ $category->getKey() }}">
                        <div class="form-group">
                            <h5>Category name <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="nama_kategori"
                                    class="form-control  @error('nama_kategori') is-invalid @enderror"
                                    value="{{ old('nama_kategori', $category->nama_kategori) }}">
                                @error('nama_kategori')
                                    <div class="invalid-feedback text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <h5>Category icon <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="ikon_kategori"
                                    class="form-control  @error('ikon_kategori') is-invalid @enderror"
                                    value="{{ old('ikon_kategori', $category->ikon_kategori) }}">
                                @error('ikon_kategori')
                                    <div class="invalid-feedback text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Gambar Kategori <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="hidden" value="{{ $category->gambar_kategori }}" name="old_image">
                                        <input type="file" name="gambar_kategori"
                                            class="form-control  @error('gambar_kategori') is-invalid @enderror"
                                            onchange="previewImage()" id="input_image">
                                        @error('gambar_kategori')
                                            <div class="invalid-feedback text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <img src="{{ url('storage/' . $category->gambar_kategori) }}" alt="User Avatar"
                                    style="width: 100px; height:100px;" id="img-preview">
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

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
                            <h3 class="box-title">Category List <span class="badge badge-pill badge-danger">
                                    {{ count($categories) }} </span></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Category icon </th>
                                            <th>Category image </th>
                                            <th>Category</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td> <span><i class="{{ $category->ikon_kategori }}"></i></span> </td>
                                                <td>
                                                    <img src="{{ asset('storage/' . $category->gambar_kategori) }}" style="width: 70px; height: 40px;"></td>

                                                <td>{{ $category->nama_kategori }}</td>
                                                <td>
                                                    <a href="{{ url('category/' . $category->id) }}"
                                                        class="btn btn-info" title="Edit Data"><i
                                                            class="fa fa-pencil"></i> </a>

                                                    <form method="POST" id="{{ 'deletecategory' . $category->id }}"
                                                        style="display:inline;">
                                                        @csrf
                                                        @if (!$subcategoriesToDelete->contains('category_id', $category->id))
                                                            <button type="button" class="btn btn-danger delete-button"
                                                                onclick="deleteConfirmation('category',{{ $category->id }})">
                                                                <i class="fa fa-trash"></i></button>
                                                        @endif
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
                            <h3 class="box-title">Add Category </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="post" action="{{ route('category.store') }}" enctype="multipart/form-data"
                                    novalidate>
                                    @csrf
                                    <div class="form-group">
                                        <h5>Category name <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="nama_kategori"
                                                class="form-control @error('nama_kategori') is-invalid @enderror"
                                                value="{{ old('nama_kategori') }}">
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
                                                class="form-control @error('ikon_kategori') is-invalid @enderror"
                                                value="{{ old('ikon_kategori') }}">
                                            @error('ikon_kategori')
                                                <div class="invalid-feedback text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>Category image <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" name="gambar_kategori"
                                                class="form-control @error('gambar_kategori') is-invalid @enderror"
                                                onchange="previewImage()" id="input_image">
                                            @error('gambar_kategori')
                                                <div class="invalid-feedback text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <img class="mt-2" src=""
                                                style="display: none; width:100px; height:100px;" alt="User Avatar"
                                                id="img-preview">
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

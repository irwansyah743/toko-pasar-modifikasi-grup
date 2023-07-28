@extends('admin.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->

    <div class="container-full">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit SubCategory </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">


                                <form method="post" action="{{ url('subcategory/' . $subcategory->getKey()) }}">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="id" value="{{ $subcategory->getKey() }}">

                                    <div class="form-group">
                                        <h5>Category Select <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="id_kategori"
                                                class="form-control @error('id_kategori') is-invalid @enderror">
                                                <option value="" @selected(old('id_kategori') == '') disabled>- Select
                                                    Category -
                                                </option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->getKey() }}" @selected(old('id_kategori') == $category->getKey() || $subcategory->id_kategori == $category->getKey())>
                                                        {{ $category->nama_kategori }}</option>
                                                @endforeach
                                            </select>
                                            @error('id_kategori')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <h5>SubCategory<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="nama_subkategori"
                                                class="form-control @error('nama_subkategori') is-invalid @enderror"
                                                value="{{ old('nama_subkategori', $subcategory->nama_subkategori) }}">
                                            @error('nama_subkategori')
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

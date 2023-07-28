@extends('admin.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->

    <div class="container-full">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content">
            <div class="row">

                <!--   ------------ Add Sub Sub Category Page -------- -->


                <div class="col-12">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Sub-SubCategory </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">


                                <form method="post" action="{{ url('subsubcategory/' . $subsubcategory->getKey()) }}">
                                    @csrf
                                    @method('put')
                                    <div class="form-group">
                                        <h5>Category Select <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="id_kategori" id="id_kategori"
                                                class="form-control @error('id_kategori') is-invalid @enderror">
                                                <option value="" @selected(old('id_kategori') == '') disabled>- Select
                                                    Category -
                                                </option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->getKey() }}" @selected($category->getKey() == $subsubcategory->category->getKey() || old('id_kategori') == $category->getKey())>
                                                        {{ $category->nama_kategori }}</option>
                                                @endforeach
                                            </select>
                                            @error('id_kategori')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>SubCategory Select <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="id_subkategori" id="id_subkategori"
                                                class="form-control @error('id_subkategori') is-invalid @enderror">
                                                <option value="" @selected(old('id_subkategori') == '') disabled>- Select
                                                    SubCategory -
                                                </option>
                                                @if (old('id_subkategori', $subsubcategory->subcategory->getKey()))
                                                    @foreach ($subcategories as $subcategory)
                                                        @if (old('id_subkategori') == $subcategory->getKey() || $subcategory->category->getKey() == old('id_kategori') || $subcategory->category->getKey() == $subsubcategory->category->getKey())
                                                            <option value="{{ $subcategory->getKey() }}"
                                                                @selected(old('id_subkategori') == $subcategory->getKey() || $subcategory->getKey() == $subsubcategory->subcategory->getKey())>
                                                                {{ $subcategory->nama_subkategori }}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('id_subkategori')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <h5>subsubcategory<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="nama_subsubkategori"
                                                class="form-control @error('nama_subsubkategori') is-invalid @enderror"
                                                value="{{ old('nama_subsubkategori', $subsubcategory->nama_subsubkategori) }} ">
                                            @error('nama_subsubkategori')
                                                <div class="invalid-feedback text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
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
    <script type="text/javascript" src="{{ asset('js/subcategory_select.js') }}"></script>
@endsection

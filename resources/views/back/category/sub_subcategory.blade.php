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
                            <h3 class="box-title">SubSubCategory List <span class="badge badge-pill badge-danger">
                                    {{ count($subsubcategories) }} </span> </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SubSubCategory</th>
                                            <th>SubCategory</th>
                                            <th>Category </th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subsubcategories as $subsubcategory)
                                            <tr>
                                                <td>{{ $subsubcategory->nama_subsubkategori }}</td>
                                                <td>{{ $subsubcategory->subcategory->nama_subkategori }}</td>
                                                <td> {{ $subsubcategory->category->nama_kategori }} </td>
                                                <td width="30%">
                                                    <a href="{{ url('subsubcategory/' . $subsubcategory->getKey()) }}"
                                                        class="btn btn-info" title="Edit Data"><i
                                                            class="fa fa-pencil"></i> </a>
                                                    <form method="POST"
                                                        id="{{ 'deletesubsubcategory' . $subsubcategory->getKey() }}"
                                                        style="display:inline;">
                                                        @csrf
                                                        <button type="button" class="btn btn-danger delete-button"
                                                            onclick="deleteConfirmation('subsubcategory',{{ $subsubcategory->getKey() }})">
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


                <!--   ------------ Add Category Page -------- -->


                <div class="col-4">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add SubSubCategory </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">


                                <form method="post" action="{{ route('subsubcategory.store') }}">
                                    @csrf
                                    <div class="form-group">
                                        <h5>Category Select <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="id_kategori" id="id_kategori"
                                                class="form-control @error('id_kategori') is-invalid @enderror">
                                                <option value="" @selected(old('id_kategori') == '') disabled>- Select
                                                    Category -
                                                </option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->getKey() }}" @selected(old('id_kategori') == $category->getKey())>
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
                                                @if (old('id_subkategori'))
                                                    @foreach ($subcategories as $subcategory)
                                                        @if (old('id_subkategori') == $subcategory->getKey() || $subcategory->category->getKey() == old('id_kategori'))
                                                            <option value="{{ $subcategory->getKey() }}"
                                                                @selected(old('id_subkategori') == $subcategory->getKey())>
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
                                                value="{{ old('nama_subsubkategori') }}">
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

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
                            <h3 class="box-title">SubCategory List <span class="badge badge-pill badge-danger">
                                    {{ count($subcategories) }} </span> </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SubCategory</th>
                                            <th>Category </th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subcategories as $subcategory)
                                            <tr>
                                                <td>{{ $subcategory->subcategory_name }}</td>
                                                <td> {{ $subcategory->category->nama_kategori }} </td>
                                                <td width="30%">
                                                    <a href="{{ url('subcategory/' . $subcategory->id) }}"
                                                        class="btn btn-info" title="Edit Data"><i
                                                            class="fa fa-pencil"></i> </a>
                                                    <form method="POST" id="{{ 'deletesubcategory' . $subcategory->id }}"
                                                        style="display:inline;">
                                                        @csrf
                                                        @if (!$subsubcategoriesToDelete->contains('id_subkategori', $subcategory->id))
                                                            <button type="button" class="btn btn-danger delete-button"
                                                                onclick="deleteConfirmation('subcategory',{{ $subcategory->id }})">
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


                <!--   ------------ Add Category Page -------- -->


                <div class="col-4">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add SubCategory </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">


                                <form method="post" action="{{ route('subcategory.store') }}">
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
                                                    <option value="{{ $category->id }}" @selected(old('id_kategori') == $category->id)>
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
                                        <h5>SubCategory<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="subcategory_name"
                                                class="form-control @error('subcategory_name') is-invalid @enderror"
                                                value="{{ old('subcategory_name') }}">
                                            @error('subcategory_name')
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
@endsection

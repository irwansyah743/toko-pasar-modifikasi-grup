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
                                                <td>{{ $subsubcategory->subsubcategory_name }}</td>
                                                <td>{{ $subsubcategory->subcategory->subcategory_name }}</td>
                                                <td> {{ $subsubcategory->category->category_name }} </td>
                                                <td width="30%">
                                                    <a href="{{ url('subsubcategory/' . $subsubcategory->id) }}"
                                                        class="btn btn-info" title="Edit Data"><i
                                                            class="fa fa-pencil"></i> </a>
                                                    <form method="POST"
                                                        id="{{ 'deletesubsubcategory' . $subsubcategory->id }}"
                                                        style="display:inline;">
                                                        @csrf
                                                        <button type="button" class="btn btn-danger delete-button"
                                                            onclick="deleteConfirmation('subsubcategory',{{ $subsubcategory->id }})">
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
                                            <select name="category_id" id="category_id"
                                                class="form-control @error('category_id') is-invalid @enderror">
                                                <option value="" @selected(old('category_id') == '') disabled>- Select
                                                    Category -
                                                </option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                                                        {{ $category->category_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>SubCategory Select <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="subcategory_id" id="subcategory_id"
                                                class="form-control @error('subcategory_id') is-invalid @enderror">
                                                <option value="" @selected(old('subcategory_id') == '') disabled>- Select
                                                    SubCategory -
                                                </option>
                                                @if (old('subcategory_id'))
                                                    @foreach ($subcategories as $subcategory)
                                                        @if (old('subcategory_id') == $subcategory->id || $subcategory->category->id == old('category_id'))
                                                            <option value="{{ $subcategory->id }}"
                                                                @selected(old('subcategory_id') == $subcategory->id)>
                                                                {{ $subcategory->subcategory_name }}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('subcategory_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <h5>subsubcategory<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="subsubcategory_name"
                                                class="form-control @error('subsubcategory_name') is-invalid @enderror"
                                                value="{{ old('subsubcategory_name') }}">
                                            @error('subsubcategory_name')
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

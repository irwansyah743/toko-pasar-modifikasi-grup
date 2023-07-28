@extends('admin.master')
@section('content')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <div class="container-full">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content">

            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Add Product </h4>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">

                            <form method="post" action="{{ route('product.store') }}" enctype="multipart/form-data"
                                novalidate>
                                @csrf

                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <!-- start 1st row  -->


                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Category Select <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="category_id" id="category_id"
                                                            class="form-control @error('category_id') is-invalid @enderror">
                                                            <option value="" @selected(old('category_id') == '') disabled>-
                                                                Select
                                                                Category -
                                                            </option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}"
                                                                    @selected(old('category_id') == $category->id)>
                                                                    {{ $category->nama_kategori }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('category_id')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->


                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>SubCategory Select <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="subcategory_id" id="subcategory_id"
                                                            class="form-control @error('subcategory_id') is-invalid @enderror">
                                                            <option value="" @selected(old('subcategory_id') == '') disabled>-
                                                                Select
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

                                            </div> <!-- end col md 4 -->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Sub-SubCategory Select <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="subsubcategory_id" id="subsubcategory_id"
                                                            class="form-control @error('subsubcategory_id') is-invalid @enderror">
                                                            <option value="" @selected(old('subsubcategory_id') == '') disabled>-
                                                                Select
                                                                Sub-SubCategory -
                                                            </option>
                                                            @if (old('subsubcategory_id'))
                                                                @foreach ($subsubcategories as $subsubcategory)
                                                                    @if (old('subsubcategory_id') == $subsubcategory->id || $subsubcategory->subcategory->id == old('subcategory_id'))
                                                                        <option value="{{ $subsubcategory->id }}"
                                                                            @selected(old('subsubcategory_id') == $subsubcategory->id)>
                                                                            {{ $subsubcategory->subsubcategory_name }}
                                                                        </option>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        @error('subsubcategory_id')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->

                                        </div> <!-- end 1st row  -->



                                        <div class="row">
                                            <!-- start 2nd row  -->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Brand Select <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="brand_id"
                                                            class="form-control @error('brand_id') is-invalid @enderror"
                                                            required="">
                                                            <option value="" selected="" disabled="">Select
                                                                Brand</option>
                                                            @foreach ($brands as $brand)
                                                                <option @selected(old('brand_id') == $brand->id)
                                                                    value="{{ $brand->id }}">
                                                                    {{ $brand->nama_merek }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('brand_id')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->


                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <h5>Product Name En <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" value="{{ old('product_name') }}"
                                                            name="product_name"
                                                            class="form-control @error('product_name') is-invalid @enderror"
                                                            required="">
                                                        @error('product_name')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->
                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <h5>Product Code <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_code"
                                                            value="{{ old('product_code') }}"
                                                            class="form-control @error('product_code') is-invalid @enderror"
                                                            required="">
                                                        @error('product_code')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->
                                        </div> <!-- end 2nd row  -->



                                        <div class="row">
                                            <!-- start 3RD row  -->


                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <h5>Product Quantity <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="number" name="product_qty"
                                                            value="{{ old('product_qty') }}"
                                                            class="form-control @error('product_qty') is-invalid @enderror"
                                                            required="">
                                                        @error('product_qty')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->
                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <h5>Product Selling Price (Rp) <span class="text-danger">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <input type="text" name="selling_price"
                                                            value="{{ old('selling_price') }}"
                                                            class="form-control @error('selling_price') is-invalid @enderror"
                                                            required="">
                                                        @error('selling_price')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->
                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <h5>After Discount Price</h5>
                                                    <div class="controls">
                                                        <input type="text" name="discount_price" class="form-control"
                                                            value="{{ old('discount_price') }}">

                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->




                                        </div> <!-- end 3RD row  -->

                                        <div class="row">
                                            <!-- start 4th row  -->
                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <h5>Product Tags <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_tags"
                                                            value="{{ old('product_tags') ? old('product_tags') : 'clothes,sport,football' }}"
                                                            class="form-control @error('product_tags') is-invalid @enderror"
                                                            data-role="tagsinput" required="">
                                                        @error('product_tags')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                        <small>Use commas to separate each tag</small>
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->


                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <h5>Product Size<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_size"
                                                            value="{{ old('product_size') ? old('product_size') : 'small,medium,large' }}"
                                                            class="form-control @error('product_size') is-invalid @enderror"
                                                            data-role="tagsinput" required="">
                                                        @error('product_size')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                        <small>Use commas to separate each tag</small>
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->
                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <h5>Product Color<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_color"
                                                            value="{{ old('product_color') ? old('product_color') : 'red,black,white' }}"
                                                            class="form-control @error('product_color') is-invalid @enderror"
                                                            data-role="tagsinput" required="">
                                                        @error('product_color')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                        <small>Use commas to separate each tag</small>
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->



                                        </div> <!-- end 4th row  -->

                                        <div class="row">
                                            <!-- start 6th row  -->
                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <h5>Main Thambnail <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="file" name="product_thambnail"
                                                            class="form-control @error('product_thambnail') is-invalid @enderror"
                                                            onchange="previewImage()" id="input_image">
                                                        @error('product_thambnail')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                        <img class="mt-2" src=""
                                                            style="display: none; width:100px; height:100px;"
                                                            alt="User Avatar" id="img-preview">
                                                    </div>
                                                </div>


                                            </div> <!-- end col md 4 -->
                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <h5>Multiple Image <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="file" name="multi_img[]"
                                                            class="form-control  @error('multi_img.*') is-invalid @enderror @error('multi_img') is-invalid @enderror"
                                                            onchange="previewImages()" id="input_images" multiple>
                                                        @error('multi_img')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                        @error('multi_img.*')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror

                                                        <div class="row" id="img-previews"></div>
                                                    </div>
                                                </div>


                                            </div> <!-- end col md 4 -->


                                        </div> <!-- end 6th row  -->

                                        <div class="row">
                                            <!-- start 7th row  -->
                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <h5>Short Description<span class="text-danger">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <textarea name="short_descp" id="textarea" class="form-control @error('short_descp') is-invalid @enderror" required
                                                            placeholder="Textarea text">{{ old('short_descp') }}</textarea>
                                                        @error('short_descp')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 6 -->



                                        </div> <!-- end 7th row  -->





                                        <div class="row">
                                            <!-- start 8th row  -->
                                            <div class="col-md-12">

                                                <div class="form-group">
                                                    <h5>Long Description English <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <textarea id="editor1" name="long_descp" rows="10" cols="80" required=""
                                                            class="form-control @error('long_descp') is-invalid @enderror">{{ old('long_descp') }}</textarea>
                                                        @error('long_descp')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 6 -->



                                        </div> <!-- end 8th row  -->


                                        <hr>



                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <div class="controls">
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_2" name="hot_deals"
                                                                value="1" @checked(old('hot_deals'))>
                                                            <label for="checkbox_2">Hot Deals</label>
                                                        </fieldset>
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_3" name="featured"
                                                                value="1" @checked(old('featured'))>
                                                            <label for="checkbox_3">Featured</label>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <div class="controls">
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_4" name="special_offer"
                                                                value="1" @checked(old('special_offer'))>
                                                            <label for="checkbox_4">Special Offer</label>
                                                        </fieldset>
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_5" name="special_deals"
                                                                value="1" @checked(old('special_deals'))>
                                                            <label for="checkbox_5">Special Deals</label>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-xs-right">
                                            <input type="submit" class="btn btn-rounded btn-primary mb-5"
                                                value="Add Product">
                                        </div>
                            </form>

                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
    <script type="text/javascript" src="{{ asset('js/subcategory_select.js') }}"></script>

@endsection

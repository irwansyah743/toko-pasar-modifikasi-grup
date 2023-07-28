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
                    <h4 class="box-title">Edit Product </h4>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">

                            <form method="post" action="{{ route('product.update', $product->id) }}"
                                enctype="multipart/form-data" novalidate>
                                @csrf
                                @method('put')

                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <!-- start 1st row  -->


                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Category Select <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="id_kategori" id="id_kategori"
                                                            class="form-control @error('id_kategori') is-invalid @enderror">
                                                            <option value="" @selected(old('id_kategori') == '') disabled>- Select
                                                                Category -
                                                            </option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}"
                                                                    @selected($category->id == $product->id_kategori || old('id_kategori') == $category->id)>
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
                                            </div> <!-- end col md 4 -->


                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>SubCategory Select <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="id_subkategori" id="id_subkategori"
                                                            class="form-control @error('id_subkategori') is-invalid @enderror">
                                                            <option value="" @selected(old('id_subkategori') == '') disabled>- Select
                                                                SubCategory -
                                                            </option>
                                                            @if (old('id_subkategori', $product->id_subkategori))
                                                                @foreach ($subcategories as $subcategory)
                                                                    @if (old('id_subkategori') == $subcategory->id || $subcategory->category->id == old('id_kategori') || $subcategory->category->id == $product->id_kategori)
                                                                        <option value="{{ $subcategory->id }}"
                                                                            @selected(old('id_subkategori') == $subcategory->id || $subcategory->id == $product->id_subkategori)>
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

                                            </div> <!-- end col md 4 -->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Sub-SubCategory Select <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="id_subsubkategori" id="id_subsubkategori"
                                                            class="form-control @error('id_subsubkategori') is-invalid @enderror">
                                                            <option value="" @selected(old('id_subsubkategori') == '') disabled>- Select
                                                                Sub-SubCategory -
                                                            </option>
                                                            @if (old('id_subsubkategori', $product->id_subsubkategori))
                                                                @foreach ($subsubcategories as $subsubcategory)
                                                                    @if (old('id_subsubkategori') == $subsubcategory->id || $subsubcategory->subcategory->id == old('id_subkategori') || $subsubcategory->subcategory->id == $product->id_subkategori)
                                                                        <option value="{{ $subsubcategory->id }}"
                                                                            @selected(old('id_subsubkategori') == $subsubcategory->id || $subsubcategory->id == $product->id_subsubkategori)>
                                                                            {{ $subsubcategory->nama_subsubkategori }}
                                                                        </option>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        @error('id_subsubkategori')
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
                                                        <select name="id_merek"
                                                            class="form-control @error('id_merek') is-invalid @enderror"
                                                            required="">
                                                            <option value="" selected="" disabled="">Select Brand</option>
                                                            @foreach ($brands as $brand)
                                                                <option @selected(old('id_merek') == $brand->id || $brand->id == $product->id_merek)
                                                                    value="{{ $brand->id }}">
                                                                    {{ $brand->nama_merek }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('id_merek')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->


                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <h5>Product Name <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text"
                                                            value="{{ old('nama_produk', $product->nama_produk) }}"
                                                            name="nama_produk"
                                                            class="form-control @error('nama_produk') is-invalid @enderror"
                                                            required="">
                                                        @error('nama_produk')
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
                                                        <input type="text" name="kode_produk"
                                                            value="{{ old('kode_produk', $product->kode_produk) }}"
                                                            class="form-control @error('kode_produk') is-invalid @enderror"
                                                            required="">
                                                        @error('kode_produk')
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
                                                        <input type="number" name="kuantitas_produk"
                                                            value="{{ old('kuantitas_produk', $product->kuantitas_produk) }}"
                                                            class="form-control @error('kuantitas_produk') is-invalid @enderror"
                                                            required="">
                                                        @error('kuantitas_produk')
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
                                                        <input type="text" name="harga_jual"
                                                            value="{{ old('harga_jual', $product->harga_jual) }}"
                                                            class="form-control @error('harga_jual') is-invalid @enderror"
                                                            required="">
                                                        @error('harga_jual')
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
                                                        <input type="text" name="harga_diskon" class="form-control"
                                                            value="{{ old('harga_diskon', $product->harga_diskon) }}">

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
                                                        <input type="text" name="tag_produk"
                                                            value="{{ old('tag_produk') ? old('tag_produk') : $product->tag_produk }}"
                                                            class="form-control @error('tag_produk') is-invalid @enderror"
                                                            data-role="tagsinput" required="">
                                                        @error('tag_produk')
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
                                                        <input type="text" name="ukuran_produk"
                                                            value="{{ old('ukuran_produk') ? old('ukuran_produk') : $product->ukuran_produk }}"
                                                            class="form-control @error('ukuran_produk') is-invalid @enderror"
                                                            data-role="tagsinput" required="">
                                                        @error('ukuran_produk')
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
                                                        <input type="text" name="warna_produk"
                                                            value="{{ old('warna_produk') ? old('warna_produk') : $product->warna_produk }}"
                                                            class="form-control @error('warna_produk') is-invalid @enderror"
                                                            data-role="tagsinput" required="">
                                                        @error('warna_produk')
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
                                            <!-- start 7th row  -->
                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <h5>Short Description<span class="text-danger">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <textarea name="deskripsi_singkat" id="textarea" class="form-control @error('deskripsi_singkat') is-invalid @enderror" required
                                                            placeholder="Textarea text">{{ old('deskripsi_singkat', $product->deskripsi_singkat) }}</textarea>
                                                        @error('deskripsi_singkat')
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
                                                    <h5>Long Description <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <textarea id="editor1" name="deskripsi_panjang" rows="10" cols="80" required=""
                                                            class="form-control @error('deskripsi_panjang') is-invalid @enderror">{{ old('deskripsi_panjang', $product->deskripsi_panjang) }}</textarea>
                                                        @error('deskripsi_panjang')
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
                                                            <input type="checkbox" id="checkbox_2" name="diskon_besar"
                                                                value="1" @checked(old('diskon_besar', $product->diskon_besar))>
                                                            <label for="checkbox_2">Hot Deals</label>
                                                        </fieldset>
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_3" name="unggulan" value="1"
                                                                @checked(old('unggulan', $product->unggulan))>
                                                            <label for="checkbox_3">unggulan</label>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <div class="controls">
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_4" name="penawaran_spesial"
                                                                value="1" @checked(old('penawaran_spesial', $product->penawaran_spesial))>
                                                            <label for="checkbox_4">Special Offer</label>
                                                        </fieldset>
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_5" name="penawaran_khusus"
                                                                value="1" @checked(old('penawaran_khusus', $product->penawaran_khusus))>
                                                            <label for="checkbox_5">Special Deals</label>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-xs-right">
                                            <input type="submit" class="btn btn-rounded btn-primary mb-5"
                                                value="Update Product">
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

        <!-- ///////////////// Start Multiple Image Update Area ///////// -->

        <section class="content">
            <div class="row">

                <div class="col-md-6">
                    <div class="row row-sm">
                        @foreach ($multiimg as $img)
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="{{ asset('storage/' . $img->nama_gambar_produk) }}" class="card-img-top"
                                        style="height: 130px; width: 280px;">
                                    <div class="card-body">

                                        <form method="POST" id="{{ 'deleteimages' . $img->id }}" style="display:inline;">
                                            @csrf
                                            <button style="width:100%;" type="button" class="btn btn-danger delete-button"
                                                onclick="deleteConfirmation('images',{{ $img->id }})">
                                                <i class="fa fa-trash"></i></button>
                                        </form>

                                    </div>
                                </div>

                            </div><!--  end col md 3		 -->
                        @endforeach

                    </div>

                </div>
                <div class="col-md-6">
                    <div class="box bt-3 border-info">
                        <div class="box-header">
                            <h4 class="box-title">Add Product Images</h4>
                        </div>
                        <div class="box-body">
                            <form action="{{ route('product.images.store') }}" method="post"
                                enctype="multipart/form-data" novalidate>
                                @csrf
                                <input type="hidden" value="{{ $product->id }}" name="id_produk">
                                <div class="form-group">
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
                                <button type="submit" class="btn btn-rounded btn-primary mb-5">Submit</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>



    </div> <!-- // end row  -->

    </section>
    <!-- ///////////////// End Start Multiple Image Update Area ///////// -->



    <!-- ///////////////// Start Thambnail Image Update Area ///////// -->

    <section class="content">
        <div class="row">

            <div class="col-md-12">
                <div class="box bt-3 border-info">
                    <div class="box-header">
                        <h4 class="box-title">Product Thambnail Image <strong>Update</strong></h4>
                    </div>
                    <div class="box-body">
                        <form method="post" action="{{ route('update.product.thumbnail', $product->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <input type="hidden" name="old_img" value="{{ $product->thumbnail_produk }}">
                            <div class="row row-sm">
                                <div class="col-md-4">
                                    <img src="{{ asset('storage/' . $product->thumbnail_produk) }}"
                                        class="card-img-top mb-3">
                                    <div class="form-group">
                                        <label class="form-control-label">Change Image <span
                                                class="text-danger">*</span></label>
                                        <input type="file" name="thumbnail_produk"
                                            class="form-control    @error('thumbnail_produk') is-invalid @enderror"
                                            onchange="previewImage()" id="input_image">
                                        @error('thumbnail_produk')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <img src="" class="mt-2" id="img-preview">
                                    </div>
                                </div><!--  end col md 3		 -->
                            </div>
                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Thumbnail">
                            </div>
                            <br><br>
                        </form>

                    </div>






                </div>
            </div>



        </div> <!-- // end row  -->

    </section>
    <!-- ///////////////// End Start Thambnail Image Update Area ///////// -->
    </div>


    <script type="text/javascript" src="{{ asset('js/subcategory_select.js') }}"></script>

@endsection

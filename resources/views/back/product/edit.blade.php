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
                    <h4 class="box-title">Edit Produk </h4>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">

                            <form method="post" action="{{ route('product.update', $product->getKey()) }}"
                                enctype="multipart/form-data" novalidate>
                                @csrf
                                @method('put')

                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <!-- start 1st row  -->


                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Pilih Kategori <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="id_kategori" id="id_kategori"
                                                            class="form-control @error('id_kategori') is-invalid @enderror">
                                                            <option value="" @selected(old('id_kategori') == '') disabled>- Pilih Kategori -
                                                            </option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->getKey() }}"
                                                                    @selected($category->getKey() == $product->id_kategori || old('id_kategori') == $category->getKey())>
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
                                                    <h5>Pilih Subkategori <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="id_subkategori" id="id_subkategori"
                                                            class="form-control @error('id_subkategori') is-invalid @enderror">
                                                            <option value="" @selected(old('id_subkategori') == '') disabled>- Pilih subKategori -
                                                            </option>
                                                            @if (old('id_subkategori', $product->id_subkategori))
                                                                @foreach ($subcategories as $subcategory)
                                                                    @if (old('id_subkategori') == $subcategory->getKey() || $subcategory->category->getKey() == old('id_kategori') || $subcategory->category->getKey() == $product->id_kategori)
                                                                        <option value="{{ $subcategory->getKey() }}"
                                                                            @selected(old('id_subkategori') == $subcategory->getKey() || $subcategory->getKey() == $product->id_subkategori)>
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
                                                    <h5>Pilih Subsubkategori <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="id_subsubkategori" id="id_subsubkategori"
                                                            class="form-control @error('id_subsubkategori') is-invalid @enderror">
                                                            <option value="" @selected(old('id_subsubkategori') == '') disabled>- Pilih Subsubkategori -
                                                            </option>
                                                            @if (old('id_subsubkategori', $product->id_subsubkategori))
                                                                @foreach ($subsubcategories as $subsubcategory)
                                                                    @if (old('id_subsubkategori') == $subsubcategory->getKey() || $subsubcategory->subcategory->getKey() == old('id_subkategori') || $subsubcategory->subcategory->getKey() == $product->id_subkategori)
                                                                        <option value="{{ $subsubcategory->getKey() }}"
                                                                            @selected(old('id_subsubkategori') == $subsubcategory->getKey() || $subsubcategory->getKey() == $product->id_subsubkategori)>
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
                                                    <h5>Pilih Merek <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="id_merek"
                                                            class="form-control @error('id_merek') is-invalid @enderror"
                                                            required="">
                                                            <option value="" selected="" disabled="">Pilih Merek</option>
                                                            @foreach ($brands as $brand)
                                                                <option @selected(old('id_merek') == $brand->getKey() || $brand->getKey() == $product->id_merek)
                                                                    value="{{ $brand->getKey() }}">
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
                                                    <h5>Nama Produk <span class="text-danger">*</span></h5>
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
                                                    <h5>Kode Produk <span class="text-danger">*</span></h5>
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


                                            {{-- <div class="col-md-4">

                                                <div class="form-group">
                                                    <h5>Kuantitas Produk <span class="text-danger">*</span></h5>
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

                                            </div> --}}

                                            <!-- end col md 4 -->
                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <h5>Harga jual Produk (Rp) <span class="text-danger">*</span>
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
                                                    <h5>Sesudah Harga diskon</h5>
                                                    <div class="controls">
                                                        <input type="text" name="harga_diskon" class="form-control"
                                                            value="{{ old('harga_diskon', $product->harga_diskon) }}">

                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->

                                            <!-- start 4th row  -->
                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <h5>Tag Produk <span class="text-danger">*</span></h5>
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
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->


                                        </div> <!-- end 3RD row  -->

                                        <div class="row">

                                            <div class="col-md-12">
                                                <br>
                                                <div class="form-group">
                                                    <h5>Ukuran, Warna & Kuantitas Produk <span class="text-danger">*</span></h5>

                                                    <table class="table table-responsive">
                                                        <thead>
                                                            <tr>
                                                                <th>
                                                                    Ukuran Produk
                                                                </th>
                                                                <th>
                                                                    Warna Produk
                                                                </th>
                                                                <th>
                                                                    Kuantitas Produk
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($product->productDetail as $detail)
                                                                <tr>
                                                                    <td>
                                                                        <input type="text" name="ukuran_produk[{{ $detail->id_produk_detail }}]"
                                                                            value="{{ $detail->ukuran_produk }}"
                                                                            class="form-control @error('ukuran_produk') is-invalid @enderror" required="">
                                                                        @error('ukuran_produk')
                                                                            <div class="invalid-feedback">
                                                                                {{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" name="warna_produk[{{ $detail->id_produk_detail }}]"
                                                                            value="{{ $detail->warna_produk }}"
                                                                            class="form-control @error('warna_produk') is-invalid @enderror" required="">
                                                                        @error('warna_produk')
                                                                            <div class="invalid-feedback">
                                                                                {{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" name="kuantitas_produk[{{ $detail->id_produk_detail }}]"
                                                                            value="{{ $detail->kuantitas_produk }}"
                                                                            class="form-control @error('kuantitas_produk') is-invalid @enderror"
                                                                            required="">
                                                                        @error('kuantitas_produk')
                                                                            <div class="invalid-feedback">
                                                                                {{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                    </table>
                                                </div>

                                            </div>

                                            {{-- <div class="col-md-4">

                                                <div class="form-group">
                                                    <h5>Ukuran Produk<span class="text-danger">*</span></h5>
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
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->
                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <h5>Warna Produk<span class="text-danger">*</span></h5>
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
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 --> --}}



                                        </div> <!-- end 4th row  -->



                                        <div class="row">
                                            <!-- start 7th row  -->
                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <h5>Deskripsi Singkat<span class="text-danger">*</span>
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
                                                    <h5>Deskripsi Panjang <span class="text-danger">*</span></h5>
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
                                        <div class="text-xs-right">
                                            <input type="submit" class="btn btn-rounded btn-primary mb-5"
                                                value="Update Produk">
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

                                        <form method="POST" id="{{ 'deleteimages' . $img->getKey() }}" style="display:inline;">
                                            @csrf
                                            <button style="width:100%;" type="button" class="btn btn-danger delete-button"
                                                onclick="deleteConfirmation('images',{{ $img->getKey() }})">
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
                            <h4 class="box-title">Gambar Tambah Produk</h4>
                        </div>
                        <div class="box-body">
                            <form action="{{ route('product.images.store') }}" method="post"
                                enctype="multipart/form-data" novalidate>
                                @csrf
                                <input type="hidden" value="{{ $product->getKey() }}" name="id_produk">
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
                        <form method="post" action="{{ route('update.product.thumbnail', $product->getKey()) }}"
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

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
                    <h4 class="box-title">Tambah Produk </h4>

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
                                                    <h5>Pilih Kategori <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="id_kategori" id="id_kategori"
                                                            class="form-control @error('id_kategori') is-invalid @enderror">
                                                            <option value="" @selected(old('id_kategori') == '') disabled>-
                                                                Pilih
                                                                Kategori -
                                                            </option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->getKey() }}"
                                                                    @selected(old('id_kategori') == $category->getKey())>
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
                                                    <h5>Pilih SubKategori <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="id_subkategori" id="id_subkategori"
                                                            class="form-control @error('id_subkategori') is-invalid @enderror">
                                                            <option value="" @selected(old('id_subkategori') == '') disabled>-
                                                                Pilih
                                                                Kategori -
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

                                            </div> <!-- end col md 4 -->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Pilih Sub-SubKategory <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="id_subsubkategori" id="id_subsubkategori"
                                                            class="form-control @error('id_subsubkategori') is-invalid @enderror">
                                                            <option value="" @selected(old('id_subsubkategori') == '') disabled>-
                                                                Pilih
                                                                Sub-SubKategory -
                                                            </option>
                                                            @if (old('id_subsubkategori'))
                                                                @foreach ($subsubcategories as $subsubcategory)
                                                                    @if (old('id_subsubkategori') == $subsubcategory->getKey() || $subsubcategory->subcategory->getKey() == old('id_subkategori'))
                                                                        <option value="{{ $subsubcategory->getKey() }}"
                                                                            @selected(old('id_subsubkategori') == $subsubcategory->getKey())>
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
                                                            <option value="" selected="" disabled="">Pilih
                                                                Merek</option>
                                                            @foreach ($brands as $brand)
                                                                <option @selected(old('id_merek') == $brand->getKey())
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
                                                        <input type="text" value="{{ old('nama_produk') }}"
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
                                                    <h5>kode Produk <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="kode_produk"
                                                            value="{{ old('kode_produk') }}"
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
                                                    <h5>Kuantits Produk <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="number" name="kuantitas_produk"
                                                            value="{{ old('kuantitas_produk') }}"
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
                                                    <h5>harga Jual Produk (Rp) <span class="text-danger">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <input type="text" name="harga_jual"
                                                            value="{{ old('harga_jual') }}"
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
                                                    <h5>Harga seteleh Diskon</h5>
                                                    <div class="controls">
                                                        <input type="text" name="harga_diskon" class="form-control"
                                                            value="{{ old('harga_diskon') }}">

                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->




                                        </div> <!-- end 3RD row  -->

                                        <div class="row">
                                            <!-- start 4th row  -->
                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <h5>Tag Produk <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="tag_produk"
                                                            value="{{ old('tag_produk') ? old('tag_produk') : 'clothes,sport,football' }}"
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
                                                    <h5>Ukuran Produk<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="ukuran_produk"
                                                            value="{{ old('ukuran_produk') ? old('ukuran_produk') : 'small,medium,large' }}"
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
                                                    <h5>Warna Produkr<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="warna_produk"
                                                            value="{{ old('warna_produk') ? old('warna_produk') : 'red,black,white' }}"
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
                                            <!-- start 6th row  -->
                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <h5>Thumbnail Produk <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="file" name="thumbnail_produk"
                                                            class="form-control @error('thumbnail_produk') is-invalid @enderror"
                                                            onchange="previewImage()" id="input_image">
                                                        @error('thumbnail_produk')
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
                                                    <h5>Banyak Gambar <span class="text-danger">*</span></h5>
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
                                                    <h5>Deskripsi Singkat<span class="text-danger">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <textarea name="deskripsi_singkat" id="textarea" class="form-control @error('deskripsi_singkat') is-invalid @enderror" required
                                                            placeholder="Textarea text">{{ old('deskripsi_singkat') }}</textarea>
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
                                                    <h5>Deskripsi panjang <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <textarea id="editor1" name="deskripsi_panjang" rows="10" cols="80" required=""
                                                            class="form-control @error('deskripsi_panjang') is-invalid @enderror">{{ old('deskripsi_panjang') }}</textarea>
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
                                                                value="1" @checked(old('diskon_besar'))>
                                                            <label for="checkbox_2">Diskon besar</label>
                                                        </fieldset>
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_3" name="unggulan"
                                                                value="1" @checked(old('unggulan'))>
                                                            <label for="checkbox_3">Unggulan</label>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <div class="controls">
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_4" name="penawaran_spesial"
                                                                value="1" @checked(old('penawaran_spesial'))>
                                                            <label for="checkbox_4">Penawaran spesial</label>
                                                        </fieldset>
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_5" name="penawaran_khusus"
                                                                value="1" @checked(old('penawaran_khusus'))>
                                                            <label for="checkbox_5">Penawaran khusus</label>
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

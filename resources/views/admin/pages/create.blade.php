@extends('admin.master')
@section('content')
    <div class="container-full">

        <section class="content">

            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Create Admin User </h4>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form method="post" action="{{ route('admin.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">

                                        <div class="row">
                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <h5>Admin Name <span class="text-danger">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <input type="text" name="name"
                                                            class="form-control  @error('name') is-invalid @enderror"
                                                            value="{{ old('name') }}">
                                                        @error('name')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- end cold md 6 -->



                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <h5>Admin Email <span class="text-danger ">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <input type="email" name="email"
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            value="{{ old('email') }}">
                                                        @error('email')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- end cold md 6 -->

                                        </div> <!-- end row 	 -->




                                        <div class="row">
                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <h5>Admin Phone

                                                    </h5>
                                                    <div class="controls">
                                                        <input type="text" name="phone"
                                                            class="form-control  @error('phone') is-invalid @enderror"
                                                            value="{{ old('phone') }}">
                                                        @error('phone')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- end cold md 6 -->



                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <h5>Admin Password <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="password" name="password"
                                                            class="form-control @error('password') is-invalid @enderror">
                                                        @error('password')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- end cold md 6 -->

                                        </div> <!-- end row 	 -->







                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Profile photo</h5>
                                                    <div class="controls">
                                                        <input type="file" name="profile_photo_path"
                                                            class="form-control @error('profile_photo_path') is-invalid @enderror"
                                                            onchange="previewImage()" id="input_image">
                                                        @error('profile_photo_path')
                                                            <div class="invalid-feedback text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div><!-- end cold md 6 -->

                                            <div class="col-md-6">
                                                <img class="rounded-circle" src="{{ url('storage/no_image.jpg') }}"
                                                    alt="User Avatar" style="width: 100px; height:100px;" id="img-preview">
                                            </div><!-- end cold md 6 -->
                                        </div><!-- end row 	 -->



                                        <hr>



                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">

                                                    <div class="controls">
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_2" name="Merek"
                                                                value="1" @checked(old('Merek'))>
                                                            <label for="checkbox_2">Merek</label>
                                                        </fieldset>
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_3" name="Kategori"
                                                                value="1" @checked(old('kategori'))>
                                                            <label for="checkbox_3">Kategori</label>
                                                        </fieldset>

                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_4" name="produk"
                                                                value="1" @checked(old('produk'))>
                                                            <label for="checkbox_4">Produk</label>
                                                        </fieldset>

                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_5" name="Suplier"
                                                                value="1" @checked(old('Suplier'))>
                                                            <label for="checkbox_5">Suplier</label>
                                                        </fieldset>

                                                    </div>
                                                </div>
                                            </div>







                                            <div class="col-md-4">
                                                <div class="form-group">

                                                    <div class="controls">
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_12" name="Pesanan"
                                                                value="1" @checked(old('Pesanan'))>
                                                            <label for="checkbox_12">Pesanan</label>
                                                        </fieldset>
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_11" name="review"
                                                                value="1" @checked(old('review'))>
                                                            <label for="checkbox_11"> Review</label>
                                                        </fieldset>

                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_14" name="Laporan"
                                                                value="1" @checked(old('Laporan'))>
                                                            <label for="checkbox_14">Laporan</label>
                                                        </fieldset>

                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_15" name="SemuaUser"
                                                                value="1" @checked(old('SemuaUser'))>
                                                            <label for="checkbox_15">SemuaUserr</label>
                                                        </fieldset>

                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_16" name="adminuserrole"
                                                                value="1" @checked(old('adminuserrole'))>
                                                            <label for="checkbox_16">SemuaAdmin</label>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>





                                        <div class="text-xs-right">
                                            <input type="submit" class="btn btn-rounded btn-primary mb-5"
                                                value="Add Admin User">
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
    </div>
@endsection

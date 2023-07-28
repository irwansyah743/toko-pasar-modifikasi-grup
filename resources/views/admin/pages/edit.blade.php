@extends('admin.master')
@section('content')
    <div class="container-full">

        <section class="content">

            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Edit Admin </h4>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form method="post" action="{{ route('admin.update', $adminuser->getKey()) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')
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
                                                            value="{{ old('name', $adminuser->name) }}">
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
                                                            value="{{ old('email', $adminuser->email) }}">
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
                                                            value="{{ old('phone', $adminuser->phone) }}">
                                                        @error('phone')
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
                                                        <input type="hidden" value="{{ $adminuser->profile_photo_path }}"
                                                            name="old_image">
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
                                                <img class="rounded-circle"
                                                    src="{{ !empty($adminuser->profile_photo_path) ? url('storage/' . $adminuser->profile_photo_path) : url('storage/no_image.jpg') }}"
                                                    alt="User Avatar" style="width: 100px; height:100px;" id="img-preview">
                                            </div><!-- end cold md 6 -->
                                        </div><!-- end row 	 -->



                                        <hr>



                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">

                                                    <div class="controls">
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_2" name="brand"
                                                                value="1" @checked(old('brand', $adminuser->brand))>
                                                            <label for="checkbox_2">Brand</label>
                                                        </fieldset>
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_3" name="category"
                                                                value="1" @checked(old('category', $adminuser->category))>
                                                            <label for="checkbox_3">Category</label>
                                                        </fieldset>

                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_4" name="product"
                                                                value="1" @checked(old('product', $adminuser->product))>
                                                            <label for="checkbox_4">Product</label>
                                                        </fieldset>

                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_5" name="slider"
                                                                value="1" @checked(old('slider', $adminuser->slider))>
                                                            <label for="checkbox_5">Slider</label>
                                                        </fieldset>

                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_6" name="coupons"
                                                                value="1" @checked(old('coupons', $adminuser->coupon))>
                                                            <label for="checkbox_6">Coupons</label>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>







                                            <div class="col-md-4">
                                                <div class="form-group">

                                                    <div class="controls">
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_12" name="orders"
                                                                value="1" @checked(old('orders', $adminuser->orders))>
                                                            <label for="checkbox_12">Orders</label>
                                                        </fieldset>
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_11" name="review"
                                                                value="1" @checked(old('review', $adminuser->review))>
                                                            <label for="checkbox_11"> Review</label>
                                                        </fieldset>

                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_14" name="reports"
                                                                value="1" @checked(old('reports', $adminuser->report))>
                                                            <label for="checkbox_14">Reports</label>
                                                        </fieldset>

                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_15" name="alluser"
                                                                value="1" @checked(old('alluser', $adminuser->alluser))>
                                                            <label for="checkbox_15">Alluser</label>
                                                        </fieldset>

                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_16" name="adminuserrole"
                                                                value="1" @checked(old('adminuserrole', $adminuser->alladmin))>
                                                            <label for="checkbox_16">Alladmin</label>
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

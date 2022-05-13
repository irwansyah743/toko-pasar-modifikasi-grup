@extends('admin.master')
@section('content')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">

            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Edit Admin Profile</h4>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form novalidate method="POST" action="{{ url('/admin/profile/' . $admin->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Username <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="name" class="form-control" required
                                                            data-validation-required-message="This field is required"
                                                            value="{{ old('name', $admin->name) }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Email <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="email" name="email" class="form-control" required
                                                            data-validation-required-message="This field is required"
                                                            value="{{ old('email', $admin->email) }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Profile photo <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="hidden" value="{{ $admin->profile_photo_path }}"
                                                            name="old_image">
                                                        <input type="file" name="profile_photo_path" class="form-control"
                                                            onchange="previewImage()" id="input_image" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <img class="rounded-circle"
                                                    src="{{ !empty($admin->profile_photo_path) ? url('storage/' . $admin->profile_photo_path) : url('storage/admin-images/no_image.jpg') }}"
                                                    alt="User Avatar" style="width: 100px; height:100px;" id="img-preview">
                                            </div>
                                        </div>


                                        <div class="text-xs-right">
                                            <button type="submit" class="btn btn-rounded btn-primary mb-5">Update</button>
                                        </div>
                                    </div>
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
@endsection

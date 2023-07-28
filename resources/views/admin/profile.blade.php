@extends('admin.master')
@section('content')
    <div class="container-full">

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="box box-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-black" center center;">
                        <h3 class="widget-user-username">{{ $admin->name }}</h3>
                        <a href="{{ route('admin.profile.edit') }}" style="float: right;"
                            class="btn btn-rounded btn-success mb-5">Edit Profile</a>
                        <h6 class="widget-user-desc">{{ $admin->email }}</h6>
                    </div>
                    <div class="widget-user-image">
                        <img class="rounded-circle"
                            src="{{ !empty($admin->profile_photo_path) ? url('storage/' . $admin->profile_photo_path) : url('storage/no_image.jpg') }}"
                            alt="User Avatar">
                    </div>
                    <div class="box-footer">
                        <div class="row">

                        </div>
                        <!-- /.row -->
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->

        <!-- Change Password -->
        <section class="content">

            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Change password</h4>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form novalidate method="POST" action="{{ url('/admin/profile/' . $admin->getKey()) }}">
                                @csrf
                                <div class="row">
                                    <div class="col-12">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Current password <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="password" name="current_password" class="form-control"
                                                        required data-validation-required-message="This field is required">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>New password <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input id="password" type="password" name="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        required data-validation-required-message="This field is required">
                                                    @error('password')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Confirmation password <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input id="password_confirmation" type="password"
                                                        name="password_confirmation" class="form-control " required
                                                        data-validation-required-message="This field is required">

                                                </div>
                                            </div>
                                        </div>



                                        <div class="text-xs-right">
                                            <button type="submit" class="btn btn-rounded btn-primary mb-5">Change
                                                password</button>
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

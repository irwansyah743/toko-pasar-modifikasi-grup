@extends('front.master')
@section('content')
    <div class="body-content">
        <div class="container">
            <div class="row">

                @include('front.common.user_sidebar')

                <div class="col-md-2">

                </div> <!-- // end col md 2 -->


                <div class="col-md-6">
                    <div class="card">
                        <h3 class="text-center"><span
                                class="text-danger">Hi....</span><strong>{{ Auth::user()->name }}</strong> Update Your
                            Profile </h3>

                        <div class="card-body">



                            <form method="post" action="{{ url('user/profile/' . $user->id) }}"
                                enctype="multipart/form-data" novalidate>
                                @csrf
                                @method('put')


                                <div class="form-group">
                                    <label class="info-title" for="exampleInputEmail1">Name <span> </span></label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $user->name) }}">
                                    @error('name')
                                        <div class="invalid-feedback text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="info-title" for="exampleInputEmail1">Email <span> </span></label>
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email', $user->email) }}">
                                    @error('email')
                                        <div class="invalid-feedback text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label class="info-title" for="exampleInputEmail1">Phone <span> </span></label>
                                    <input type="text" name="phone"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        value="{{ old('phone', $user->phone) }}">
                                    @error('phone')
                                        <div class="invalid-feedback text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="info-title" for="exampleInputEmail1">User Image <span>
                                                </span></label>
                                            <input type="hidden" value="{{ $user->profile_photo_path }}" name="old_image">
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
                                    <div class="col-md-6">
                                        <img class="rounded-circle"
                                            src="{{ !empty($user->profile_photo_path) ? url('storage/' . $user->profile_photo_path) : url('storage/no_image.jpg') }}"
                                            alt="User Avatar" style="width: 100px; height:100px;" id="img-preview">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update profile</button>
                                </div>
                            </form>
                        </div>



                    </div>

                </div> <!-- // end col md 6 -->

            </div> <!-- // end row -->

        </div>

    </div>
@endsection

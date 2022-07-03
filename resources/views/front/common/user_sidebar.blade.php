<div class="col-md-2"><br>
    <img class="card-img-top" style="border-radius: 50%"
        src="{{ !empty($user->profile_photo_path) ? url('storage/' . $user->profile_photo_path) : url('storage/no_image.jpg') }}"
        height="100%" width="100%"><br><br>

    <ul class="list-group list-group-flush">
        <a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm btn-block">Home</a>

        <a href="{{ route('profile') }}" class="btn btn-primary btn-sm btn-block">Profile Update</a>

        <a href="{{ route('user.password') }}" class="btn btn-primary btn-sm btn-block">Change Password </a>

        <a href="{{ route('my.orders') }}" class="btn btn-primary btn-sm btn-block">Orders</a>

        <form method="POST" action="{{ route('logout') }}" class="mt-2">
            @csrf
            <button type="submit" class="btn btn-danger btn-sm btn-block">Logout</button>
        </form>


    </ul>

</div> <!-- // end col md 2 -->

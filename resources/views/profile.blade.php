@extends('layouts.app')

@section('title', 'Profile | XiAO DiNG DoNG')

@section('content')

    {{-- File CSS --}}
    <link rel="stylesheet" href="{{ asset('css/Profile.css') }}">

    @include('layouts/navbar')


    @if (isset($success))
        <div class="alert alert-success alert-dismissible fade show ms-5 me-5 mt-3 mb-3" role="alert">
            <strong>{{ $success }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(isset($errors) && $errors->isEmpty() == false)
        <div class="alert alert-danger alert-dismissible fade show ms-5 me-5 mt-3 mb-3" role="alert">
            <strong>{{ $errors->first() }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container-fluid w-50 d-flex justify-content-center">
        <h1 class="title">编辑个人资料 | Edit Profile</h1>
    </div>

    <form method="POST" action="profile" enctype="multipart/form-data">
        @csrf

        <div class="form-group container-fluid w-50 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Username</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" name="username"
                placeholder="Minimum 5 Characters" value="{{ old('username') }}">
        </div>

        <div class="form-group container-fluid w-50 mb-3">
            <label for="exampleFormControlInput2" class="form-label">Email</label>
            <input type="email" class="form-control" id="exampleFormControlInput2" name="email"
                placeholder="Must to end with '@gmail.com'" value="{{ old('email') }}">
        </div>

        <div class="form-group container-fluid w-50 mb-3">
            <label for="exampleFormControlInput3" class="form-label">Phone Number</label>
            <input type="tel" class="form-control" id="exampleFormControlInput3" name="phone"
                placeholder="Must contains 12 Numbers" value="{{ old('phone') }}">
        </div>
        <div class="form-group container-fluid w-50 mb-3">
            <label for="exampleFormControlInput4" class="form-label">Address</label>
            <input type="text" class="form-control" id="exampleFormControlInput4" name="address"
                placeholder="Do not have to be filled, Minimum 5 Characters" value="{{ old('address') }}">
        </div>

        <div class="form-group container-fluid w-50 mb-3">
            <label for="exampleFormControlInput5" class="form-label">New Profile Image</label>
            <input type="file" class="form-control" id="profile_picture" name="profile_picture" placeholder=""
                value="{{ old('profile_picture') }}">
        </div>



        <div class="form-group container-fluid w-50 mb-3">
            <label for="exampleInputPassword6">Current Password</label>
            <input type="password" class="form-control" id="exampleInputPassword6"
                placeholder="Has to be the same with previous password" name="current_password"
                value="{{ old('current_password') }}">
        </div>

        <div class="form-group container-fluid w-50 mb-3">
            <label for="exampleInputPassword3">New Password</label>
            <input type="password" class="form-control" id="exampleInputPassword3"
                placeholder="Minimum 5 Characters, Maximum 255 Characters" name="new_password"
                value="{{ old('new_password') }}">
        </div>

        <div class="form-group container-fluid w-50 mb-3">
            <label for="exampleInputPassword4">Confirm Password</label>
            <input type="password" class="form-control" id="exampleInputPassword4"
                placeholder="Has to be the same with Password Field" name="password_confirmation"
                value="{{ old('password_confirmation') }}">
        </div>

        <div class="form-group container-fluid w-50 mb-3">
            <input class="btn btn-primary w-30" type="submit" value="Update Profile">
        </div>

    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
</script>
@endsection

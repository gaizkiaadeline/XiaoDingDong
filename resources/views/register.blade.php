@extends('layouts.form')

@section('title', 'Register | XiAO DiNG DoNG')

@section('content')

{{-- File CSS --}}
<link rel="stylesheet" href="{{ asset('css/Profile.css') }}">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


@if(isset($errors) && $errors->isEmpty() == false)
    <div class="alert alert-danger alert-dismissible fade show ms-5 me-5 mt-3 mb-3" role="alert">
        <strong>{{ $errors->first() }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

    <div class="container-fluid w-50 d-flex justify-content-center">
        <h1 class="title">Register</h1>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group container-fluid w-50 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Has to end with '@gmail.com'"
                @error('email') is-invalid @enderror name="email" value="{{ old('email') }}"
                autocomplete="email" autofocus>

        </div>
        <div class="form-group container-fluid w-50 mb-3">
            <label for="exampleFormControlInput2" class="form-label">Username</label>
            <input type="text" class="form-control" id="exampleFormControlInput2"
                placeholder="Minimum 5 Characters, Maximum 50 Characters" name="username">
        </div>
        <div class="form-group container-fluid w-50 mb-3">
            <label for="exampleInputPassword3">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword3"
                placeholder="Minimum 5 Characters, Maximum 255 Characters" name="password"
                autocomplete="new-password">

        </div>

        <div class="form-group container-fluid w-50 mb-3">
            <label for="exampleInputPassword4">Confirm Password</label>
            <input type="password" class="form-control" id="exampleInputPassword4"
                placeholder="Has to be the same with Password Field" name="password_confirmation"
                autocomplete="new-password">
        </div>

        <div class="form-group container-fluid w-50 mb-3">
            <input class="btn btn-primary w-100" type="submit" value="Register">
        </div>
        <div class="container-fluid w-50 d-flex justify-content-center">
            <label>Already have an account? </label>
            <a href="/login">Log In</a>
        </div>

    </form>

@endsection

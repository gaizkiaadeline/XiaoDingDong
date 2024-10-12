@extends('layouts.app')

@section('title', 'Home | XiAO DiNG DoNG')

@section('content')

    {{-- File CSS --}}
    <link rel="stylesheet" href="{{ asset('css/Home.css') }}">

    @include('layouts/navbar')

    @if (isset($errors) && $errors->isEmpty() == false)
        {{-- @foreach ($errors as $error) --}}
        <div class="alert alert-danger alert-dismissible fade show ms-5 me-5 mt-3 mb-3" role="alert">
            <strong>{{ $errors->first() }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        {{-- @endforeach --}}
    @endif

    <h1 class="text-light text-center m-4">Checkout</h1>
    <div class="d-flex flex-column align-items-center">
        <form action="/checkout" method="POST" class="d-flex flex-column align-items-center w-75">
            @csrf
            <h2 class="text-light mt-2">Billing Information</h2>
            <div class="d-flex w-100">
                <div class="w-50 m-4">
                    <label for="full_name" class="form-label text-light">Full Name</label>
                    <input type="text" class="form-control" id="full_name" placeholder="Min 5 characters"
                        name="full_name">
                </div>
                <div class="w-50 m-4">
                    <label for="phone_number" class="form-label text-light">Phone Number</label>
                    <input type="text" class="form-control" id="phone_number"
                        placeholder="Must be numerical and consists of 12 numbers" name="phone_number">
                </div>
            </div>
            <div class="d-flex w-100">
                <div class="w-50 m-4 d-flex flex-column">
                    <label for="country" class="form-label text-light">Country</label>
                    <select class="form-select" aria-label="Default select example" id="country" name="country">
                        @if (isset($countries))
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->country }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="w-50 m-4">
                    <label for="city" class="form-label text-light">City</label>
                    <input type="text" class="form-control" id="city" placeholder="Min 5 characters" name="city">
                </div>
            </div>
            <div class="d-flex w-100">
                <div class="w-50 m-4">
                    <label for="card_holder_name" class="form-label text-light">Card Holder Name</label>
                    <input type="text" class="form-control" id="card_holder_name" placeholder="Min 3 characters"
                        name="card_holder_name">
                </div>
                <div class="w-50 m-4">
                    <label for="card_number" class="form-label text-light">Card Number</label>
                    <input type="text" class="form-control" id="card_number"
                        placeholder="Must be filled and has 16 digits" name="card_number">
                </div>
            </div>
            <h2 class="text-light mt-3">Additional Information</h2>
            <div class="w-100 m-4">
                <label for="address" class="form-label text-light">Address</label>
                <textarea class="form-control" id="address" name="address" rows="3" placeholder="Min 5 characters"></textarea>
            </div>
            <div class="w-100 m-4">
                <label for="zip_code" class="form-label text-light">ZIP / Postal Code</label>
                <input type="text" class="form-control" id="zip_code" placeholder="Must be filled with numeric"
                    name="zip_code">
            </div>
            <div class="w-100 d-flex justify-content-end">
                <button class="btn btn-secondary m-2">Cancel</button>
                <button type="submit" class="btn btn-secondary m-2">Check Out</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
</script>
@endsection

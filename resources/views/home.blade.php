@extends('layouts.app')

@section('title', 'Home | XiAO DiNG DoNG')

@section('content')

    {{-- File CSS --}}
    <link rel="stylesheet" href="{{ asset('css/Home.css') }}">

    @include('layouts/navbar')

    @if (session('alert'))
        <div class="alert alert-success alert-dismissible fade show ms-5 me-5 mt-3 mb-3" role="alert">
            <strong>{{ session('alert') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h1 class="title-menu">菜单 Menu</h1>

    <div class="button-group">
        <form action="{{ route('filterCategory') }}" method="post">
            @csrf
            <button type="submit" name="category" class="btn btn-secondary" value="主菜 | Main Course">主菜 | Main
                Course</button>
            <button type="submit" name="category" class="btn btn-secondary" value="饮料 | Beverage">饮料 | Beverage</button>
            <button type="submit" name="category" class="btn btn-secondary" value="甜点 | Dessert">甜点 | Dessert</button>
        </form>

    </div>


    <div class="row row-cols-1 row-cols-md-4 g-4 m-2">
        @if (isset($food))
            @foreach ($food as $f)
                <a href="/search/{{ $f->id }}">
                    <div class="col">
                        <div class="card h-100 text-white text-center bg-dark mb-3" style="width: 90%">

                            <img class="card-img-top" src="{{ asset('storage/images/' . $f->food_image) }}"
                                alt="Image Not Found" style="width: 100%; height:90%">
                            <div class="card-body">
                                <h5 class="card-title">{{ $f->food_name }}</h5>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        @endif

    </div>

    @auth
        @if (Session::get('mysession'))
            <div>Helloooo {{ Session::get('mysession')['email'] }}</div>
        @endif
        @if (Auth::user()->role == 'Admin')
            {{-- <div>
                <h5>You are admin</h5>
            </div> --}}
        @endif
    @endauth
    {{-- @else --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"> --}}
    {{-- </script> --}}
@endsection

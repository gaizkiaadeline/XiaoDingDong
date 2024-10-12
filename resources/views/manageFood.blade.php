@extends('layouts.app')

@section('title', 'Manage Food | XiAO DiNG DoNG')

@section('content')

    {{-- File CSS --}}
    <link rel="stylesheet" href="{{ asset('css/Home.css') }}">

    @include('layouts/navbar')

    <form action="{{ route('searchFoodPost') }}" method="post">
        @csrf
        <div class="d-flex">
            <input class="form-control me-2" type="text" placeholder="Search" aria-label="Search" name="search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </div>
        <div class="d-flex" style="color: white">
            <p>Filter Category</p>
            @foreach ($category as $c)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="{{ $c->category_name }}"
                        name="category[]">
                    <label class="form-check-label" for="inlineCheckbox1">{{ $c->category_name }}</label>
                </div>
            @endforeach
        </div>

    </form>
    @auth
        @if (Auth::user()->role == 'Admin')
            <h1 class="title-menu">管理食物 Manage Food</h1>
        @endif
    @else
        <h1 class="title-menu">搜索食物 Search Food</h1>
    @endauth

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
                            <div class="card-body">
                                <h5 class="card-title">{{ $f->category->category_name }}</h5>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $f->food_brief_description }}</h5>
                            </div>
                        </div>
                    </div>
                </a>
                @auth

                    @if (Auth::user()->role == 'Admin')
                        <div>
                            <a href="/updateFood/{{ $f->id }}"><button>Update</button></a>

                            {{-- <form action="/delete/{{ $f->id }}"> --}}
                            <form action="{{ route('foodRemove', ['id' => $f->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </div>
                    @endif
                @endauth
            @endforeach
        @endif

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>


@endsection

@extends('layouts.app')

@section('title', 'Food Detail | XiAO DiNG DoNG')

@section('content')

    @include('layouts/navbar')

    <div class="">
        @if (isset($alert))
            <div class="alert alert-success alert-dismissible fade show ms-5 me-5 mt-3 mb-3" role="alert">
                <strong>{{ $alert }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div>
            <h1>食物细节 | Food Detail</h1>
        </div>
        <div class="d-flex">
            <div>
                <img src="{{ asset('storage/images/' . $food->food_image) }}" alt="" style="width: 400px">
            </div>
            <div>
                <h2>{{ $food->food_name }}</h2>
                <div>
                    <p>Food Type:</p>
                    <p>{{ $food->category->category_name }}</p>
                </div>
                <div>
                    <p>Food Price:</p>
                    <p>{{ $food->price }}</p>
                </div>
                <div>
                    <p>Brief Description:</p>
                    <p>{{ $food->food_brief_description }}</p>
                </div>
                <div>
                    <p>About This Food</p>
                    <p>{{ $food->food_full_description }}</p>
                </div>
                @if (Auth::user() && Auth::user()->role == 'Xiao User')
                    <div>
                        <form action="/search/{{ $food->id }}" method="POST">
                            @csrf
                            <input type="submit" value="Add to Cart">
                        </form>
                    </div>
                @endauth
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
</script>
@endsection

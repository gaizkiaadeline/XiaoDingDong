@extends('layouts.app')

@section('title', 'Add New Food | XiAO DiNG DoNG')

@section('content')

    {{-- File CSS --}}
    <link rel="stylesheet" href="{{ asset('css/addNewFood.css') }}">

    @include('layouts/navbar')


    <div class="container-fluid w-50 d-flex justify-content-center">
        <h1 class="title">添加新食物 | Add New Food</h1>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('addFood') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group container-fluid w-50 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Food Name</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" name="food_name" placeholder="Must be filled and contains minimum 5 characters">
        </div>

        <div class="form-group container-fluid w-50 mb-3">
            <label for="exampleFormControlInput3" class="form-label">Food Brief Description</label>
            <textarea type="text" class="form-control" id="exampleFormControlInput3" name="food_brief_description"  placeholder="Must be filled and less than or equal to 100 characters"></textarea>
        </div>

        <div class="form-group container-fluid w-50 mb-3">
            <label for="exampleFormControlInput4" class="form-label">Food Full Description</label>
            <textarea type="text" class="form-control" id="exampleFormControlInput4" name="food_full_description"
          placeholder="Must be filled and less than or equal to 255 characters"></textarea>
        </div>

        <div class="form-group container-fluid w-50 mb-3">
            <label for="exampleFormControlInput5" class="form-label" id="exampleFormControlInput5" name="category_id">Food
                Category</label>
            <select name="category_id" class="form-control" >
                <option value="1" {{-- {{ $food->food_category == 'main_course' ? 'selected' : '' }} --}}>Main Course
                </option>
                <option value="2" {{-- {{ $food->food_category == 'beverages' ? 'selected' : '' }} --}}>Beverages</option>
                <option value="3" {{-- {{ $food->food_category == 'desserts' ? 'selected' : '' }} --}}>Desserts</option>
            </select>
        </div>

        <div class="form-group container-fluid w-50 mb-3">
            <label for="exampleFormControlInput6" class="form-label">Food Price</label>
            <input type="number" class="form-control" id="exampleFormControlInput6" name="food_price" {{-- value="{{ $food->food_price }}"  --}}
                 placeholder="Must be filled and has to be more than 0">
        </div>

        <div class="form-group container-fluid w-50 mb-3">
            <label for="exampleFormControlInput5" class="form-label">Food Image</label>
            <input type="file" class="form-control" id="exampleFormControlInput5" name="food_image" placeholder="">
        </div>

        <div class="form-group container-fluid w-50 mb-3">
            <input class="btn btn-primary w-30" type="submit" value="Cancel">
            <input class="btn btn-primary w-30" type="submit" value="Save">
        </div>

    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
</script>
@endsection

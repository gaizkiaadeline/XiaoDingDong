@extends('layouts.app')

@section('title', 'Cart | XiAO DiNG DoNG')

@section('content')

    @include('layouts/navbar')
    @if (session('alert'))
        <div class="alert alert-success alert-dismissible fade show ms-5 me-5 mt-3 mb-3" role="alert">
            <strong>{{ session('alert') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="">
        <div>
            <h1>Your Cart</h1>
        </div>
        @if (isset($carts) && count($carts) > 0)
            @php
                $total = 0;
            @endphp
            <div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Food</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carts as $cart)
                            <tr>
                                <td>{{ $cart->food->food_name }}</td>
                                <td>{{ $cart->food->food_price }}</td>
                                <td class="d-flex">
                                    <form action="/cart/{{ $cart->id }}" method="POST">
                                        @csrf
                                        <button type="submit">-</button>
                                        <input type="hidden" name="type" value="sub">
                                        {{-- <input type="hidden" name="cartId" value="{{$cart->id}}"> --}}
                                    </form>
                                    {{ $cart->quantity }}
                                    <form action="/cart/{{ $cart->id }}" method="POST">
                                        @csrf
                                        <button type="submit">+</button>
                                        <input type="hidden" name="type" value="add">
                                        {{-- <input type="hidden" name="cartId" value="{{$cart->id}}"> --}}
                                    </form>
                                </td>
                                <td>{{ $cart->quantity * $cart->food->food_price }}</td>
                                <td>
                                    <form action="/cart-delete/{{ $cart->id }}" method="post">
                                        @csrf
                                        <button type="submit">Remove</button>
                                        {{-- <input type="hidden" name="cartId" value="{{$cart->id}}"> --}}
                                    </form>
                                </td>
                            </tr>
                            @php
                                $total += $cart->quantity * $cart->food->food_price
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                <p>Total Price : {{$total}}</p>
                <a href="/checkout">
                    <button>Proceed to Checkout</button>
                </a>
            </div>
        @else
            <div>
                <h3>Your cart is empty...</h3>
            </div>

    </div>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
</script>

@endsection

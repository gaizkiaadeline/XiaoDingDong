@extends('layouts.app')

@section('title', 'Cart | XiAO DiNG DoNG')

@section('content')

    @include('layouts/navbar')

    <div class="">
        <div>
            <h1>Your Cart</h1>
        </div>
        @if (isset($transactions))
            <div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Transaction ID</th>
                            <th scope="col">Purchase Date</th>
                            <th scope="col">Food Name</th>
                            <th scope="col">Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->transaction_id }}</td>
                                <td>{{ $transaction->created_at->format('Y-m-d') }}</td>
                                <td>{{ $transaction->food->food_name }} [x{{ $transaction->quantity }}]</td>
                                <td>{{ $transaction->food->food_price * $transaction->quantity }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- <div>
      <p>total price</p>
      <a href="/checkout">
        <button>Proceed to Checkout</button>
      </a>
    </div> --}}
        @else
        @endif

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
</script>
@endsection

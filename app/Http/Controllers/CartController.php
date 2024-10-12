<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index() {
        $user = Auth::user();
        if ($user) {
            $cart = Cart::where('user_id', $user->id)->get();
            // dd($cart);
            return view('cart')->with('carts', $cart);
        }
        return redirect('/login');
    }

    public function quantity(Request $request, string $id) {
        $id = (int) $id;
        $user = Auth::user();
        if ($user) {
            $cart = Cart::where('user_id', $user->id)->get();
            $userCart = Cart::where('id', $id)->first();
            if ($userCart!==null) {
                if ($request->input('type') === "add") {
                    $quantity = $userCart->quantity + 1;
                    $userCart->quantity = $quantity;
                    $userCart->save();
                    // dd($userCart->quantity);
                }
                else {
                    $quantity = $userCart->quantity - 1;
                    $userCart->quantity = $quantity;
                    $userCart->save();
                    // dd($userCart->quantity);
                }
                return redirect('/cart')->with('carts', $cart);
            }
            return redirect('/cart')->with('carts', $cart);
        }
        return view('login');
    }

    public function delete(Request $request, string $id) {
        $id = (int) $id;
        Cart::destroy($id);
        $cart = Cart::all();
        return redirect('/cart', ['carts'=> $cart, 'alert'=>'Cart deleted']);
    }

}

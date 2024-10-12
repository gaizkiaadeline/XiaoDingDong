<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Country;
use App\Models\TransactionDetail;
use App\Models\TransactionHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    public function index() {
        $countries = Country::all();
        return view('checkout', ['countries'=>$countries]);
    }

    public function checkout(Request $request) {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|min:5',
            'phone_number' => 'required|numeric|digits:12',
            'country' => 'required',
            'city' => 'required|min:5',
            'card_holder_name' => 'required|min:3',
            'card_number' => 'required|numeric|digits:16',
            'address' => 'required|min:5',
            'zip_code' => 'required|numeric'
        ]);
        
        if ($validator->fails()) {
            // dd($validator->errors());
            return redirect('checkout')->withErrors($validator)->withInput();
        }
        
        // dd($request);
        $user = Auth::user();

        if ($user) {
            // $transaction_header = new TransactionHeader([
            //     'user_id' => $user->id,
            //     'full_name' => $request->full_name,
            //     'phone_number' => $request->phone_number,
            //     'address' => $request->address,
            //     'city' => $request->city,
            //     'card_holder_name' => $request->card_holder_name,
            //     'card_number' => $request->card_number,
            //     'country' => $request->country,
            //     'zip_code' => $request->zip_code
            // ]);
            // $transaction_header->save();

            $digits = 'TR'.substr(str_shuffle("0123456789"), 0, 3);

            while(TransactionHeader::where('transaction_id', $digits)->count() > 0) {
                $digits = 'TR'.substr(str_shuffle("0123456789"), 0, 3);
            }
            
            $transaction_header = TransactionHeader::create(
                [
                    'transaction_id' => $digits,
                    'user_id' => $user->id,
                    'full_name' => $request->full_name,
                    'phone_number' => $request->phone_number,
                    'address' => $request->address,
                    'city' => $request->city,
                    'card_holder_name' => $request->card_holder_name,
                    'card_number' => $request->card_number,
                    'country' => $request->country,
                    'zip_code' => $request->zip_code
                ]
            );
            $cart = Cart::where('user_id', $user->id)->get();
            foreach ($cart as $c) {
                $item = new TransactionDetail([
                    'transaction_id' => $digits,
                    'food_id' => $c->food_id,
                    'quantity' => $c->quantity
                ]);
                $item->save();
            }
            $res = Cart::where('user_id', $user->id)->delete();
            $alert = 'Transaction Success';
            return redirect('/')->with(['alert' => $alert]);
        }

        return redirect('login');
    }

}

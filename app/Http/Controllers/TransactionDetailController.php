<?php

namespace App\Http\Controllers;

use App\Models\TransactionDetail;
use App\Models\TransactionHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionDetailController extends Controller
{
    public function index() {
        $user = Auth::user();
        if ($user) {
            $headers = TransactionHeader::where('user_id', $user->id)->pluck('transaction_id');
            // dd(TransactionHeader::first()->transactionDetails);
            // $transactionId = TransactionHeader::where('transaction_id', 'TR674')->value('transaction_id');
            // dd($user->id);
            // dd($headers->transaction_id);
            // dd(TransactionDetail::all());
            $transactions = TransactionDetail::whereIn('transaction_id', $headers)->get();
            // dd(TransactionHeader::first()->transactionDetail);
            // dd($transactions);
            // dd($transactions->transactionHeader);
            return view('transactionHistory', ['transactions' => $transactions]);
        }
        return redirect('login');
    }
}

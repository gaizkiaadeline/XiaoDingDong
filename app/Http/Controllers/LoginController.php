<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // dd($request);
        if ($validator->fails()) {
            return redirect('login')->withErrors($validator)->withInput();
        }



        $credentials = [
            'email' => $request->email,
            'password'=> $request->password
        ];

        if (Auth::attempt($credentials, true)) {
            if($request->remember){
                Cookie::queue('mycookie', $request->email, 300);
            }
            // Session::put('mysession', $credentials);

            // $category = Categorypph::first();
            // dd($request);
            return redirect('/');
        }

        return redirect('login')->withErrors(['email'=>"Invalid credentials"]);
    }

    public function login(Request $request) {

    }

    public function logoutUser() {
        Auth::logout();
        return redirect('/');
    }
}

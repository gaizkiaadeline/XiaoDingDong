<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function show() {
        return view('register');
    }

    public function registerUser(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|ends_with:@gmail.com',
            'username' => 'required|min:5|max:50',
            'password' => 'required|min:5|max:255|confirmed',
            'password_confirmation' => 'required'
        ]);

        if ($validator->fails()) {
            // dd($validator->errors());
            return redirect('register')->withErrors($validator)->withInput();
        }

        $user = new User([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        // dd($request);

        $user->save();

        return redirect('login');
    }

    
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('profile.index', ['user' => auth()->user()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // public function update(Request $request, $id)
    public function update(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'username' => 'required|min:5|max:50',
            'email' => 'nullable|email|ends_with:@gmail.com',
            'phone' => 'nullable|digits:12',
            'address' => 'nullable|min:5',
            'current_password' => 'required',
            'new_password' => 'nullable|min:5|max:255',
            'confirm_password' => 'nullable|min:5|same:new_password',
            'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg',
        ]);

        // dd($request);
            // dd($request->hasFile('profile_picture'));

        if ($validator->fails()) {
            return redirect('profile')->withErrors($validator)->withInput();
        }

        $errors = '';

        if ($user) {
            if (Auth::attempt(['email' => $user->email, 'password'=> $request->input('current_password')])) {
                $edited_user = User::where('id', $user->id)->first();
                $edited_user->username = $request->input('username');
                if ($request->input('email')) $edited_user->email = $request->input('email');
                if ($request->input('phone')) $edited_user->phone_number = $request->input('phone');
                if ($request->input('address')) $edited_user->address = $request->input('address');
                if ($request->input('new_password') && $request->input('confirm_password')) {
                    if ($request->input('new_password') == $request->input('confirm_password')) {
                        $edited_user->password = Hash::make($request->input('new_password'));
                    }
                    else {
                        $errors = "Confirm password must be the same as password";
                    }
                }
                // if ($request->input('profile_picture')) dd($request->input('profile_picture'));
                // if ($request->hasFile('profile_picture')) {
                //     $file_name = pathinfo($request->file('profile_picture')->getClientOriginalName(), PATHINFO_FILENAME);
                //     $extension = $request->file('profile_picture')->getClientOriginalExtension();
                //     $file_path = $file_name.'.'.$extension;
                //     $storage_path = $request->file('profile_picture')->storeAs('public/images',$file_path);
                //     $edited_user->profile_picture = $file_path;
                // }
                if ($request->hasFile('profile_picture')) {
                    $image = $request->file('profile_picture');
                    $imageName = time() . '.' . $image->getClientOriginalExtension();

                    $image->move(public_path('storage/images'), $imageName);

                    $edited_user->profile_picture = $imageName;
                }
                // $edited_user->profile_picture = $request->input('profile_picture');
                $edited_user->save();
                return redirect('profile')->with('success', 'Profile updated successfully.');
            }

            else {
                return redirect('profile')->with('errors', $errors);
            }


        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

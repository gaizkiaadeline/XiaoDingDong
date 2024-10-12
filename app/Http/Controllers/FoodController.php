<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Food;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $foods = Food::simplePaginate();
        $foods = Food::all();
        $category = Category::all();
        return view('searchFood', [
            'food' => $foods,
            'category' => $category
        ]);

    }

    public function search(Request $request) {
        $searchedName = $request->input('search');
        $category_name = $request->input('category', []);
        $category = Category::all();
        // dd($searchedName);

        if ($searchedName === null) {
            $searchedName = "";
        }
        // dd($searchedName);

        // dd($food);
        // dd($id);
        if (empty($category_name)) {
            // dd($id);
            $food = Food::where('food_name', 'LIKE', '%'.$searchedName.'%')->get();
        }
        else {

            $id = Category::whereIn('category_name', $category_name)->pluck('id');
            // dd($id);
            $food = Food::whereIn('category_id', $id)->where('food_name', 'LIKE', '%'.$searchedName.'%')->get();
            // dd($food);
        }
        // dd($food);
        return view('searchFood', [
            'food' => $food,
            'category' => $category
        ]);
    }


    public function detail(string $id) {
        $id = (int) $id;
        // dd($id);
        $food = Food::where('id', $id)->first();
        // dd($food);
        return view('detail')->with('food', $food);
    }

    public function cart(string $id) {
        $id = (int) $id;
        // dd($id);
        $food = Food::where('id', $id)->first();
        $alert = null;
        if ($food !== null) {

            $user = Auth::user();

            if ($user !== null) {
                // dd("ada");

                $userCart = Cart::where('user_id', $user->id)->where('food_id', $id)->first();
                if ($userCart===null) {
                    $cart = new Cart([
                        'user_id' => $user->id,
                        'food_id' => $id,
                        'quantity' => 1
                    ]);
                    $cart->save();
                }
                else {
                    $quantity = $userCart->quantity + 1;
                    $userCart->quantity = $quantity;
                    $userCart->save();
                }
                $alert = 'Added to cart!';
            }
            // dd("gaada");
        }
        return view('detail', [
            'food' => $food,
            'alert' => $alert
        ]);
    }

    // public function filter(Request $request) {
    //     // dd($request);
    //     $category_name = $request->input('category');
    //     // dd($category_name);
    //     $category = Category::where('category_name', $category_name)->get();
    //     if ($category === null) {
    //         $food = null;
    //     }
    //     else {
    //         $id = Category::where('category_name', $category_name)->pluck('id');
    //         // dd($id);
    //         $food = Food::where('category_id', 'IN', $id)->get();
    //         dd($food);
    //     }
    //     return view('searchFood')->with('food', $food);
    // }

    // public function search(Request $request)
    // {
    //     $foods = Food::where("food_name", "LIKE", "%$request->search%")->simplePaginate(4);
    //     return view('home')->with('foods', $foods);
    // }

    // public function filter(Request $request)
    // {
    //     $category = $request->input('food_category');

    //     $foods = match ($category) {
    //         // 'maincourse' => DB:table('foods')->where("food_category", "LIKE", "$category")->get();
    //         'maincourse' => DB::table('foods')->where("food_category", "LIKE", "Main Course")->get(),
    //         'beverage' => DB::table('foods')->where("food_category", "LIKE", "Beverage")->get(),
    //         'dessert' => DB::table('foods')->where("food_category", "LIKE", "Dessert")->get(),
    //         default => Food::all()
    //     };

    //     // return view('home', ['foods' => $foods]);
    //     // return view('home')->with('foods', $foods);
    //     return view('home', compact('foods', 'food_category'));
    // }
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
        $rules = [
            'food_name' => 'required|min:5',
            'food_brief_description' => 'required|max:100',
            'food_full_description' => 'required|max:255',
            'category_id' => 'required',
            'food_price' => 'required|numeric|min:0',
            'food_image' => 'required|image|mimes:jpeg,jpg,png',
        ];

        $request->validate($rules);

        $newFood = new Food();
        $newFood->food_name = $request->input('food_name');
        $newFood->food_brief_description = $request->input('food_brief_description');
        $newFood->food_full_description = $request->input('food_full_description');
        $newFood->category_id = $request->input('category_id');
        $newFood->food_price = $request->input('food_price');

        if ($request->hasFile('food_image')) {
            $image = $request->file('food_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('storage/images'), $imageName);

            $newFood->food_image = $imageName;
        }

        $newFood->save();

        return redirect('/')->with('success', 'New food item added successfully.');
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
        $food = Food::findOrFail($id);
        $categories = Category::all();

        return view('updateFood', compact('food', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $request->validate([
            'food_name' => 'required|min:5',
            'food_brief_description' => 'required|max:100',
            'food_full_description' => 'required|max:255',
            'category_id' => 'required',
            'food_price' => 'required|numeric|min:0',
            'food_image' => 'image|mimes:jpeg,jpg,png',
        ]);

        $food = Food::findOrFail($id);
        $food->food_name = $request->input('food_name');
        $food->food_brief_description = $request->input('food_brief_description');
        $food->food_full_description = $request->input('food_full_description');
        $food->category_id = $request->input('category_id');
        $food->food_price = $request->input('food_price');

        if ($request->hasFile('food_image')) {
            $image = $request->file('food_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/images'), $imageName);
            $food->food_image = $imageName;
        }

        $food->save();

        return redirect('/')->with('success', 'Food item updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $food = Food::find($id);

        if (!$food) {
            return redirect('/')->with('error', 'Food not found.');
        }

        if (File::exists(public_path($food->food_image))) {
            File::delete(public_path($food->food_image));
        }

        $food->delete();

        return redirect('/search')->with('alert', 'Food deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Food;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $category = Category::first();
    //     // dd($category);
    //     return view('home')->with('category', $category);
    // }

    // public function filter(Request $request) {
    //     // dd($request);
    //     $category_name = $request->input('category');
    //     $category = Category::where('category_name', $category_name)->first();
    //     return view('home')->with('category', $category);
        
    // }

    public function index()
    {
        // $foods = Food::simplePaginate();
        $foods = Food::all();
        $category = Category::all();
        return view('home', [
            'food' => $foods,
            'category' => $category
        ]);

    }

    public function filter(Request $request) {
        // dd($request);
        $category_name = $request->input('category');
        $categories = Category::all();
        $category = Category::where('category_name', $category_name)->first();
        if ($category === null) {
            $food = null;
        }
        else {
            $food = Food::where('category_id', $category->id)->get();
        }
        return view('home', [
            'food' => $food,
            'category' => $categories
        ]);
    }

    /**
     * Show the form for crseating a new resource.
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
    public function update(Request $request, $id)
    {
        //
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
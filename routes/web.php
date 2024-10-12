<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TransactionDetailController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('viewMenu');
Route::post('/', [HomeController::class, 'filter'])->name('filterCategory');
Route::get('/search/{id}', [FoodController::class, 'detail'])->name('detail');


// ALL [ GUEST, ADMIN, XIAO USER ]
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('login');
    });
    
    Route::get('/register', function () {
        return view('register');
    });
    Route::post('/login', [LoginController::class, 'loginUser'])->name('login');
    Route::post('/register', [RegisterController::class, 'registerUser'])->name('register');
});

// AUTH [ ADMIN, XIAO USER ]
Route::middleware('auth')->group(function () {
    Route::get('/logout', [LoginController::class, 'logoutUser']);

    Route::get('/profile', function () {
        return view('profile');
    });
    Route::post('/profile', [ProfileController::class, 'update']);

    Route::get('/search', [FoodController::class, 'index'])->name('searchFood');
    Route::post('/search', [FoodController::class, 'search'])->name('searchFoodPost');

    // AUTH [ XIAO USER ]
    Route::middleware('forXiaoUser:Xiao User')->group(function () {
        Route::post('/search/{id}', [FoodController::class, 'cart'])->name('cart');

        Route::get('/cart', [CartController::class, 'index']);
        Route::post('/cart/{id}', [CartController::class, 'quantity']);
        Route::post('/cart-delete/{id}', [CartController::class, 'delete']);

        Route::get('/checkout', [CheckoutController::class, 'index']);
        Route::post('/checkout', [CheckoutController::class, 'checkout']);
        Route::get('/history', [TransactionDetailController::class, 'index']);
    });

    // AUTH [ ADMIN ]
    Route::middleware('security:Admin')->group(function () {
        Route::get('/addNewFood', function () {
            return view('addNewFood');
        });
        Route::post('/addFood', [FoodController::class, 'store'])->name('addFood');

        Route::get('/updateFood/{id}', [FoodController::class, 'edit'])->name('updateFoodView');
        Route::post('/updateFood/{id}', [FoodController::class, 'update'])->name('updateFood');
        Route::delete('/delete/{id}', [FoodController::class, 'destroy'])->name('foodRemove');
    });
});

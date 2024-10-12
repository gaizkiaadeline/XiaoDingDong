<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    // use HasFactory;
    public $timestamps = false;

    protected $table = 'foods';
    protected $fillable = [
        'food_name',
        'food_brief_description',
        'food_full_description',
        'food_category',
        'food_price',
        'food_image',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function transactionDetail()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}

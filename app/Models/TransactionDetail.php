<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'food_id',
        'quantity'
    ];

    public function transactionHeader()
    {
        return $this->belongsTo(TransactionHeader::class);
    }

    public function food()
    {
        return $this->belongsTo(Food::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHeader extends Model
{
    use HasFactory;

    // protected $primaryKey = 'transaction_id';

    protected $fillable = [
        'transaction_id',
        'user_id',
        'full_name',
        'phone_number',
        'address',
        'city',
        'card_holder_name',
        'card_number',
        'country',
        'zip_code'
    ];

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function country() {
        return $this->belongsTo(Country::class);
    }
}

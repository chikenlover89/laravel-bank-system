<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'fromAccount',
        'fromCurrency',
        'amount',
        'rate',
        'toCurrency',
        'toAccount',
        'status',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getAmount()
    {
        return $this->amount/100;
    }
}

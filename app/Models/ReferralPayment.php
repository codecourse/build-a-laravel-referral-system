<?php

namespace App\Models;

use Cknow\Money\Casts\MoneyDecimalCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralPayment extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'amount' => MoneyDecimalCast::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

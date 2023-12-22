<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Subscription as CashierSubscription;

class Subscription extends CashierSubscription
{
    public function plan()
    {
        return $this->belongsTo(Plan::class, 'stripe_price', 'stripe_price');
    }

    public function referralCodes()
    {
        return $this->belongsToMany(ReferralCode::class)
            ->withPivot('multiplier');
    }
}

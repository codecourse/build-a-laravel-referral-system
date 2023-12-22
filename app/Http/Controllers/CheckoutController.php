<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\ReferralCode;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __invoke(Plan $plan)
    {
        $subscription = auth()->user()->newSubscription('default', $plan->stripe_price);
        $referralCode = ReferralCode::where('code', request()->cookie('referral_code'))->first();

        if ($referralCode) {
            $subscription = $subscription->withCoupon(config('referral.promo_code'));
        }

        $subscriptionOptions = [
            'success_url' => route('dashboard'),
            'cancel_url' => route('dashboard'),
        ];

        if ($referralCode) {
            $subscriptionOptions = array_merge($subscriptionOptions, [
                'subscription_data' => [
                    'metadata' => [
                        'referral_code' => $referralCode->code ?? ''
                    ]
                ],
            ]);
        }

        return $subscription->checkout($subscriptionOptions);
    }
}

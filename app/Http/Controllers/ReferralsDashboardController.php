<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReferralsDashboardController extends Controller
{
    public function __invoke()
    {
        return view('referrals.index', [
            'referralCode' => auth()->user()->referralCode,
            'subscriptions' => auth()->user()->referralCode->subscriptions()->notCanceled()->get(),
        ]);
    }
}

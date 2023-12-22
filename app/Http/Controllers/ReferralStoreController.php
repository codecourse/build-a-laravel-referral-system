<?php

namespace App\Http\Controllers;

use App\Models\ReferralCode;
use Illuminate\Http\Request;

class ReferralStoreController extends Controller
{
    public function __invoke(ReferralCode $referralCode)
    {
        $referralCode->increment('clicks');

        cookie()->queue(
            cookie('referral_code', $referralCode->code, now()->addMonth()->diffInMinutes())
        );

        return redirect()->route('register');
    }
}

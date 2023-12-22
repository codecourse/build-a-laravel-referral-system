<?php

namespace App\Http\Controllers;

use App\Models\ReferralCode;
use Illuminate\Http\Request;

class ReferralIndexController extends Controller
{
    public function __invoke(ReferralCode $referralCode)
    {
        $referralCode->increment('visits');

        return view('referral.index', [
            'referralCode' => $referralCode
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\ReferralCode;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('dashboard', [
            'referralCode' => ReferralCode::where('code', request()->cookie('referral_code'))->first()
        ]);
    }
}

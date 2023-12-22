<?php

namespace App\Http\Controllers;

use App\Models\ReferralCode;
use Illuminate\Http\Request;

class ReferralIndexController extends Controller
{
    public function __invoke(ReferralCode $referralCode)
    {
        dd($referralCode);
    }
}

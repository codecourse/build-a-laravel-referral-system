<?php

namespace App\Observers;

use App\Models\ReferralCode;
use App\Support\ReferralCodeGenerator;

class ReferralCodeObserver
{
    public function creating(ReferralCode $referralCode)
    {
        $referralCode->code = (new ReferralCodeGenerator())->generate();
    }
}

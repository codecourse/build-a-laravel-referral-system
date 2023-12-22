<?php

namespace App\Models\Traits;

use App\Models\ReferralCode;

trait HasReferrals
{
    public function referralsEnabled()
    {
        return $this->hasReferralCode()
            && !is_null($this->paypal_email);
    }

    public function hasReferralCode()
    {
        return $this->referralCode()->exists();
    }

    public function referralLink()
    {
        return route('referral.index', $this->referralCode);
    }

    public function referralCode()
    {
        return $this->hasOne(ReferralCode::class);
    }
}

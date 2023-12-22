<?php

namespace App\Support;

use App\Models\ReferralCode;

class ReferralCodeGenerator
{
    public function generate()
    {
        $code = $this->generateCode();

        while (ReferralCode::where('code', $code)->exists()) {
            $code = $this->generateCode();
        }

        return $code;
    }

    protected function generateCode()
    {
        return str()->random(8);
    }
}

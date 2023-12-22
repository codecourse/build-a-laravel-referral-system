<?php

namespace App\Referrals;

use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;

class ReferralPayoutExport implements FromCollection, WithMapping
{
    use Exportable;

    public function __construct(protected Builder $payouts)
    {

    }

    public function collection()
    {
        return $this->payouts->get();
    }

    public function map($payout): array
    {
        return [
            $payout->paypal_email,
            $payout->amount->formatByDecimal(),
            'USD'
        ];
    }
}

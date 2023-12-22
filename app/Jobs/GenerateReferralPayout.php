<?php

namespace App\Jobs;

use App\Mail\ReferralPayout;
use App\Models\ReferralPayment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class GenerateReferralPayout implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $payouts = ReferralPayment::query()
            ->where('available_at', '<=', now()->startOfDay())
            ->whereNull('paid_at');

        if ($payouts->count() === 0) {
            return;
        }

        // $payouts->update(['paid_at' => now()]);

        // $records = $payouts
        //     ->selectRaw('SUM(amount) as amount, users.paypal_email')
        //     ->leftJoin('users', 'users.id', '=', 'referral_payments.user_id')
        //     ->groupBy('user_id')
        //     ->get()
        //     ->toArray();

        // dd($records);

        Mail::to('alex@codecourse.com')->send(new ReferralPayout());
    }
}

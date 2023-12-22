<?php

namespace App\Jobs;

use App\Models\ReferralPayment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

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
            ->with('user')
            ->where('available_at', '<=', now()->startOfDay())
            ->whereNull('paid_at');

        if ($payouts->count() === 0) {
            return;
        }

        // email

        $payouts->update(['paid_at' => now()]);
    }
}

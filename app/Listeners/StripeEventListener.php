<?php

namespace App\Listeners;

use App\Models\ReferralCode;
use App\Models\ReferralPayment;
use App\Models\Subscription;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Arr;

class StripeEventListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        match ($event->payload['type']) {
            'customer.subscription.created' => $this->handleSubscriptionCreated($event->payload),
            'invoice.payment_succeeded' => $this->handlePaymentSucceeded($event->payload),
            default => null
        };
    }

    protected function handlePaymentSucceeded($payload)
    {
        retry(5, function () use ($payload) {
            $subscription = $this->getSubscriptionByStripeId(Arr::get($payload, 'data.object.subscription'));
            $referralCode = $subscription->referralCodes->firstOrFail();

            ReferralPayment::firstOrCreate([
                'stripe_id' => Arr::get($payload, 'data.object.id'),
            ], [
                'user_id' => $referralCode->user->id,
                'referred_user_id' => $subscription->user->id,
                'payment_total' => $total = Arr::get($payload, 'data.object.total'),
                'amount' => ceil($total) * $referralCode->pivot->multiplier,
                'available_at' => now()->endOfDay()->addMonth(),
            ]);
        }, 500);
    }

    protected function handleSubscriptionCreated($payload)
    {
        $referralCode = ReferralCode::where('code', Arr::get($payload, 'data.object.metadata.referral_code'))->first();

        retry(5, function () use ($payload, $referralCode) {
            $subscription = $this->getSubscriptionByStripeId(Arr::get($payload, 'data.object.id'));

            $referralCode->subscriptions()->syncWithoutDetaching([
                $subscription->id => [
                    'multiplier' => config('referral.multiplier')
                ]
            ]);
        }, 500);
    }

    protected function getSubscriptionByStripeId($stripeId)
    {
        return Subscription::where('stripe_id', $stripeId)->firstOrFail();
    }
}

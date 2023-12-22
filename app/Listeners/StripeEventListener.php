<?php

namespace App\Listeners;

use App\Models\ReferralCode;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Arr;
use Laravel\Cashier\Subscription;

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
            default => null
        };
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

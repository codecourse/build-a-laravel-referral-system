<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Active referrals') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Currently active referrals you're receiving payouts for.
        </p>
    </header>

    <div class="mt-6">
        <table class="min-w-full">
            <thead>
                <tr>
                    <th class="py-3 pl-0 text-left">Signed up</th>
                    <th class="py-3 pl-0 text-left">Plan</th>
                    <th class="py-3 pl-0 text-left">Your %</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($subscriptions as $subscription)
                    <tr>
                        <td class="py-3 pl-0 text-left">{{ $subscription->created_at->toDateString() }}</td>
                        <td class="py-3 pl-0 text-left">{{ $subscription->plan->title }}</td>
                        <td class="py-3 pl-0 text-left">{{ $subscription->pivot->multiplier * 100 }}% ({{ $subscription->plan->price->multiply($subscription->pivot->multiplier) }})</td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-gray-500">-</td>
                        <td class="text-gray-500">-</td>
                        <td class="text-gray-500">-</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>

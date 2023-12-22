<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Referral stats') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Here's how you're doing.
        </p>
    </header>

    <div class="mt-6">
        <table class="min-w-full">
            <tbody class="divide-y divide-gray-200">
                <tr>
                    <td class="font-medium py-3 pl-0 text-left">Visits</td>
                    <td class="py-3 pl-0 text-left">{{ $referralCode->visits }}</td>
                </tr>
                <tr>
                    <td class="font-medium py-3 pl-0 text-left">Clicks</td>
                    <td class="py-3 pl-0 text-left">{{ $referralCode->clicks }}</td>
                </tr>
                <tr>
                    <td class="font-medium py-3 pl-0 text-left">Conversions</td>
                    <td class="py-3 pl-0 text-left">{{ $referralCode->subscriptions->count() }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

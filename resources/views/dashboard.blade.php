<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 space-y-3">
                    @if (!auth()->user()->subscribed('default'))
                        @if ($referralCode)
                            <p>You'll receive a discount due to a referral</p>
                        @endif

                        @foreach ($plans as $plan)
                            <a href="{{ route('checkout.index', $plan) }}" class="text-indigo-500">{{ $plan->title }} ({{ $plan->price }})</a>
                        @endforeach
                    @else
                        <p>You are subscribed</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

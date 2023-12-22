<x-guest-layout>
    <form action="" class="p-6 text-center space-y-6">
        <p>You've been referred by {{ $referralCode->user->name }}</p>
        <x-primary-button>Sign up for 20% off</x-primary-button>
        @csrf
    </form>
</x-guest-layout>

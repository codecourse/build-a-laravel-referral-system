<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Referral code') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Send this referral code to invite people.
        </p>
    </header>

    <div
        class="mt-6 flex items-baseline space-x-3"
        x-data="{
            link: '{{ auth()->user()->referralLink() }}',
            copied: false,
            timeout: null,
            copy () {
                $clipboard(this.link)
                this.copied = true

                clearTimeout(this.timeout)

                this.timeout = setTimeout(() => {
                    this.copied = false
                }, 3000)
            }
        }"
    >
        <x-text-input id="referral_code" type="text" value="{{ auth()->user()->referralLink() }}" class="mt-1 block w-full shrink-0" readonly />
        <button class="shrink-0 font-medium text-sm text-indigo-500" x-on:click="copy" x-text="copied ? `Copied!` : `Copy link`">Copy link</button>
    </div>
</section>

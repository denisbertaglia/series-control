<section >
    <header>
        <h2 class="fs-5 text-body text-opacity-2">
            {{ __('Profile Information') }}
        </h2>

        <p class="fs-6 text-body text-black-50 text-opacity-2">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" >
        @csrf
        @method('patch')

        <x-input-label for="name" :value="__('Name')" />
        <x-text-input id="name" name="name" type="text" class="mt-1" :value="old('name', $user->name)" required
            autofocus autocomplete="name" />
        <x-input-error class="mt-2" :messages="$errors->get('name')" />

        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" name="email" type="email" class="mt-1" :value="old('email', $user->email)" required
            autocomplete="email" />
        <x-input-error class="mt-2" :messages="$errors->get('email')" />

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
        <div>
            <p class="text-black-50 text-opacity-2">
                {{ __('Your email address is unverified.') }}

                <button form="send-verification" class="btn btn-warning">
                    {{ __('Click here to re-send the verification email.') }}
                </button>
            </p>

            @if (session('status') === 'verification-link-sent')
            <p class="mt-2 text-black-50 text-opacity-2">
                {{ __('A new verification link has been sent to your email address.') }}
            </p>
            @endif
        </div>
        @endif

        <div class="mt-2">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
            <p class="text-black-50 text-opacity-2">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

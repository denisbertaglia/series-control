<section>
    <header>
        <h2 class="fs-5 text-body text-black-50 text-opacity-2">
            {{ __('Update Password') }}
        </h2>

        <p class="fs-6 text-body text-black-50 text-opacity-2">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6">
        @csrf
        @method('put')

        <x-input-label for="current_password" :value="__('Current Password')" class="form-label" />
        <x-text-input id="current_password" name="current_password" type="password" class="mt-1"
            autocomplete="current-password" />
        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />

        <x-input-label for="password" :value="__('New Password')" class="form-label" />
        <x-text-input id="password" name="password" type="password" class="mt-1" autocomplete="new-password" />
        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />

        <x-input-label for="password_confirmation" class="form-label" :value="__('Confirm Password')" />
        <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1"
            autocomplete="new-password" />
        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />


        <div class="mt-2">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
            <p class="text-body text-secondary">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

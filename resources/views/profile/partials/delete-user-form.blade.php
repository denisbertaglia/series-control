<section class="">
    <header>
        <h2 class="fs-5 text-body text-opacity-2">
            {{ __('Delete Account') }}
        </h2>

        <p class="fs-6 text-body text-black-50 text-opacity-2">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before
            deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-danger-button data-bs-toggle="modal" data-bs-target="#confirmUserDeletion">{{ __('Delete Account') }}
    </x-danger-button>

    <x-modal name="confirm-user-deletion" id="confirmUserDeletion"
        title="{{ __('Are you sure you want to delete your account?') }}"
        :open="count($errors->userDeletion->get('password'))" :footerDefault="false" focusable>

        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <p class="mt-1 text-body text-black-50 text-opacity-2">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please
                enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-3">
                <x-input-label for="password" value="Password" class="" />

                <x-text-input id="password" name="password" type="password" class="mt-1"
                    placeholder="Password" />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>
            <div class="mt-3 d-flex justify-content-center gap-2">
                <x-secondary-button class="" data-bs-dismiss="modal">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>

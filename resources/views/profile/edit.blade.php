<x-app-layout>
    <x-slot name="header" class="">
        <h2 class="fs-3 text-black-50 text-opacity-2">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row bg-white shadow rounded">
            <div class="p-4 col-12 col-lg-6">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>
        <div class="row bg-white shadow rounded mt-5">
            <div class="p-4 col-12 col-lg-6">
                @include('profile.partials.update-password-form')
            </div>
        </div>
        <div class="row bg-white shadow rounded  my-5">
            <div class="p-4 col-12 col-lg-6">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>

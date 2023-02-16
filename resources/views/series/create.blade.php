<x-app-layout>
    <x-slot name="header">
        <h2 class="fs-3 text-black-50 text-opacity-2">
            {{ __('Series Create') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row">
            <div class="p-4 bg-white shadow rounded">
                <div class="d-flex align-content-center mb-2">
                    <a href="{{route('series.index')}}" class="btn btn-secondary">
                        {{__("Return")}}
                    </a>
                </div>
                <form action="{{route('series.store')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input class="mt-1" id="name" name="name" :value="old('name')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div class="col-12 col-lg-4">
                            <x-input-label for="name" :value="__('Seasons Quantity')" />
                            <x-text-input class="mt-1" type="number" min='1' id="name" name="seasonsQts"
                                :value="old('seasonsQts')??1" required />
                            <x-input-error class="mt-2" :messages="$errors->get('seasonsQts')" />
                        </div>
                        <div class="col-12 col-lg-4">
                            <x-input-label for="name" :value="__('Episodes per Seasons Quantity')" />
                            <x-text-input class="mt-1" type="number" min='1' id="name" name="episodesSeasonsQts"
                                :value="old('episodesSeasonsQts')??1" required />
                            <x-input-error class="mt-2" :messages="$errors->get('episodesSeasonsQts')" />
                        </div>
                        <div class="col-12 col-lg-6 mt-2">
                            <button type="submit" class="btn btn-primary">
                                {{__("Save")}}
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

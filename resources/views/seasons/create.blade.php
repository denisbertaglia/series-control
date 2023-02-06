<x-app-layout>
    <x-slot name="header">
        <h2 class="fs-3 text-black-50 text-opacity-2">
            {{ __('Season Create') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row">
            <div class="p-4 bg-white shadow rounded">
                <div class="d-flex align-content-center mb-2">
                    <a href="{{route('seasons.index',['series' =>$series])}}" class="btn btn-secondary">
                        {{__("Return")}}
                    </a>
                </div>
                <form action="{{route('seasons.update',['series' =>$series])}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <x-input-label for="name" :value="__('Seasons Quantity')" />
                            <x-text-input class="mt-1" type="number" min='1' id="name" name="seasonsQts"
                                :value="old('seasonsQts')??1" required />
                            <x-input-error class="mt-2" :messages="$errors->get('seasonsQts')" />
                        </div>
                        <div class="col-12 col-lg-12 mt-2">
                            <button type="submit" class="btn btn-primary">
                                {{__("Add")}}
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

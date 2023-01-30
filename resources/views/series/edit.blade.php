<x-app-layout>
    <x-slot name="header">
        <h2 class="fs-3 text-black-50 text-opacity-2">
            {{ __('Series Update') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row">
            <div class="p-4 bg-white shadow rounded">
                <div class="d-flex align-content-center mb-2">
                    <a href="{{url()->previous()}}" class="btn btn-secondary">
                        {{__("Return")}}
                    </a>
                </div>
                <div class="col-12 col-lg-6">
                    <form action="{{route('series.update',['series'=>$series->id])}}" method="post" >
                        @csrf
                        @method('PATCH')
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input class="mt-1" id="name" name="name" :value="$series->name" required />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary">
                                {{__("Save")}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

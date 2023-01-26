<x-app-layout>
    <x-slot name="header">
        <h2 class="fs-3 text-black-50 text-opacity-2">
            {{ __('Series List') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row">
            <div class="p-4 bg-white shadow rounded">
                <div class="d-flex align-content-center mb-2">
                    <a href="#" class="btn btn-primary">
                        {{__("Add")}}
                    </a>
                </div>
                @foreach ($seriesCollection as $series)
                <div
                    class="border my-2 p-2 rounded d-flex flex-column flex-sm-row justify-content-sm-between align-content-center">
                    <a href="#" class="p-1 text-break">
                        {{$series->name}}
                    </a>
                    <span class="d-flex gap-2 justify-content-between align-content-center">
                        <form action="" method="get">
                            @csrf
                            <button class="btn btn-warning">
                                {{__("Edit")}}
                            </button>
                        </form>
                        <form action="" method="get">
                            @csrf
                            <button class="btn btn-danger">
                                {{__("Remove")}}
                            </button>
                        </form>
                    </span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>

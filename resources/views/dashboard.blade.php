<x-app-layout>
    <x-slot name="header">
        <h2 class="fs-3 text-black-50 text-opacity-2">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container ">
        <div class="row">
            <div class="col-3 p-3 m-2 d-flex align-items-startbg-white shadow rounded ">
                <h2 class="bi text-muted flex-shrink-0 me-3">
                    {{$seriesCount}}
                </h2>
                <div class="row">
                    <h3 class="fw-bold mb-0 fs-4">
                        {{ __('Series') }}
                    </h3>
                    <p>
                        {{ __('Count of Registered Series') }}
                    </p>
                    <div class="d-flex justify-content-end ">
                        <a href="{{route('series.index')}}" class="btn btn-dark">
                            {{ __('View') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>

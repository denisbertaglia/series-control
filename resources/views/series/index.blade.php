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
                    <a href="{{route('series.create')}}" class="btn btn-primary">
                        {{__("Add")}}
                    </a>
                </div>
                @forelse ($seriesCollection as $series)
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
                        <x-danger-button data-bs-toggle="modal" data-bs-target="#confirmSeriesDeletion"
                            data-bs-action="{{ route('series.destroy',['series' =>$series]) }}">
                            {{__("Remove")}}
                        </x-danger-button>
                    </span>
                </div>
                @empty
                <div
                    class="border my-2 p-2 rounded d-flex flex-column flex-sm-row justify-content-center align-content-center">
                    <h2 class="fs-5 text-body text-opacity-2">
                        {{__("No Series")}}
                    </h2>
                </div>
                @endforelse
            </div>
        </div>
        <x-modal name="confirm-series-deletion" id="confirmSeriesDeletion"
            title="{{ __('Are you sure you want to delete this series?') }}" :footerDefault="false" focusable>
            <form method="post" action="" class="p-6">
                @csrf
                @method('delete')

                <p class="mt-1 text-body text-black-50 text-opacity-2">
                    {{ __('Once this series is deleted, all of its resources and data will be permanently deleted.') }}
                </p>
                <div class="mt-3 d-flex justify-content-center gap-2">
                    <x-secondary-button class="" data-bs-dismiss="modal">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-danger-button class="">
                        {{ __('Delete Series') }}
                    </x-danger-button>
                </div>
            </form>
        </x-modal>
        <script>
            const exampleModal = document.getElementById('confirmSeriesDeletion')
            exampleModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget
            const recipient = button.getAttribute('data-bs-action');
            const modalBodyInput = exampleModal.querySelector('form')
            modalBodyInput.action = recipient
            })
        </script>
</x-app-layout>

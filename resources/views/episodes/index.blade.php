<x-app-layout>
    <x-slot name="header">
        <h2 class="fs-3 text-black-50 text-opacity-2">
            {{ __('Season Episodes') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row">
            <div class="p-4 bg-white shadow rounded">
                <div class="d-flex  gap-3 align-content-center mb-2">
                    <a href="{{route('seasons.index',['series' =>$seriesId])}}" class="btn btn-secondary">
                        {{__("Return")}}
                    </a>
                    <a href="{{route('episodes.create', ['season' => $season])}}" class="btn btn-primary">
                        {{__("Add Episode")}}
                    </a>
                </div>
                <form action="{{route('episodes.update',['season'=> $season->id])}}" method="post">
                    @method('PUT')
                    @csrf
                    @forelse ($episodes as $key => $episode)
                    <div
                        class="border my-2 p-2 rounded d-flex flex-column flex-sm-row justify-content-sm-between align-content-center">
                        <span href="#" class="p-1 text-break">
                            {{__("Episodes")}} {{$episode->number}}
                        </span>
                        <div class="d-flex gap-2 p-1">
                            @if($episodesLastKey===$key)
                            <x-danger-button data-bs-toggle="modal" data-bs-target="#confirmSeriesDeletion"
                                type="button"
                                data-bs-action="{{route('episodes.destroy',['season' =>$season,'episode' =>$episode])}}">
                                {{__("Remove")}}
                            </x-danger-button>
                            @endif
                            <input type="checkbox" name="episodes[]" value="{{$episode->id}}"
                                @checked($episode->watched) class="ms-2"/>
                        </div>
                    </div>
                    @empty
                    <div
                        class="border my-2 p-2 rounded d-flex flex-column flex-sm-row justify-content-center align-content-center">
                        <h2 class="fs-5 text-body text-opacity-2">
                            {{__("No Episodes")}}
                        </h2>
                    </div>
                    @endforelse
                    @if(count($episodes) > 0)
                    <div
                        class="border my-2 p-2 rounded d-flex flex-column flex-sm-row justify-content-end align-content-center">
                        <button type="submit" class="btn btn-primary mb-2 mt-2">
                            Salvar
                        </button>
                    </div>
                    @endif
                </form>
            </div>
        </div>
        <x-modal name="confirm-series-deletion" id="confirmSeriesDeletion"
            title="{{ __('Are you sure you want to delete this episode?') }}" :footerDefault="false" focusable>
            <form method="post" action="" class="p-6">
                @csrf
                @method('delete')

                <p class="mt-1 text-body text-black-50 text-opacity-2">
                    {{ __('Once this episode is deleted, all of its resources and data will be permanently deleted.') }}
                </p>
                <div class="mt-3 d-flex justify-content-center gap-2">
                    <x-secondary-button class="" data-bs-dismiss="modal">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-danger-button class="">
                        {{ __('Delete Episode') }}
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

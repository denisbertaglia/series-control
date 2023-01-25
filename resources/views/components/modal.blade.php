@props([
'id' => '',
'title' => '',
'open' => false,
'footerDefault' =>true
])

<!-- Modal -->
<div class="modal fade" id="{{ $id ? $id : '' }}" tabindex="-1" aria-labelledby="{{ $id ? $id : '' }}"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">
                    {{ $title ? $title : '' }}
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
            @if ($footerDefault)
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            @endif
        </div>
    </div>
</div>
@if ($open)
<script type="module">
    new bootstrap.Modal(document.getElementById('{{ $id ? $id : '' }}'), {}).toggle();
</script>
@endif

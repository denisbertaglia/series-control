@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'fw-semibold fs-6 text-success']) }}>
        {{ $status }}
    </div>
@endif

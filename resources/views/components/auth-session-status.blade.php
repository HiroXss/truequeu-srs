@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'text-success small fw-semibold']) }}>
        {{ $status }}
    </div>
@endif

@props(['active'])

@php
$classes = ($active ?? false)
            ? 'nav-link active fw-semibold border-start border-4 border-primary'
            : 'nav-link';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

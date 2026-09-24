@props([
    'name',
])

@php
    $iconPath = resource_path("views/icons/{$name}.blade.php");
@endphp

@if (file_exists($iconPath))
    @include("icons.{$name}", [
        'attributes' => $attributes,
    ])
@else
    {{-- Optional: show a fallback icon --}}
@endif
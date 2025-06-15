@php
    $src = $src ?? '';
    $fallback = $fallback ?? '';
    $alt = $alt ?? '';
    $class = $class ?? '';
    $style = ($style ?? '') . ' ';
    $imagePath = public_path($src);
@endphp

@if(file_exists($imagePath) && !is_dir($imagePath))
    <img src="{{ asset($src) }}" alt="{{ $alt }}" class="{{ $class }}" style="{{ $style }}">
@else
    <img src="{{ asset($fallback) }}" alt="{{ $alt }}" class="{{ $class }}" style="{{ $style }}">
@endif

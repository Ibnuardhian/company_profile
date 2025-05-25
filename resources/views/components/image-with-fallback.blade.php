@php
    $src = $src ?? '';
    $fallback = $fallback ?? '';
    $alt = $alt ?? '';
    $class = $class ?? '';
    $style = ($style ?? '') . 'width:432px; aspect-ratio:9/10; object-fit:cover;';
    $imagePath = public_path($src);
@endphp

@if(file_exists($imagePath) && !is_dir($imagePath))
    <img src="{{ asset($src) }}" alt="{{ $alt }}" class="{{ $class }}" style="{{ $style }}">
@else
    <img src="{{ asset($fallback) }}" alt="{{ $alt }}" class="{{ $class }}" style="{{ $style }}">
@endif

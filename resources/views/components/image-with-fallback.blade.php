@php
    $src = $src ?? '';
    $fallback = $fallback ?? 'images/default-no-image.png';
    $alt = $alt ?? '';
    $class = $class ?? '';
    $style = ($style ?? '') . ' ';
    // Cek apakah src adalah URL eksternal
    $isExternal = preg_match('/^https?:\/\//', $src);
    $imagePath = public_path($src);
@endphp

@if($isExternal)
    <img src="{{ $src }}" alt="{{ $alt }}" class="{{ $class }}" style="{{ $style }}">
@elseif(file_exists($imagePath) && !is_dir($imagePath))
    <img src="{{ asset($src) }}" alt="{{ $alt }}" class="{{ $class }}" style="{{ $style }}">
@else
    <img src="{{ asset($fallback) }}" alt="{{ $alt }}" class="{{ $class }}" style="{{ $style }}">
@endif

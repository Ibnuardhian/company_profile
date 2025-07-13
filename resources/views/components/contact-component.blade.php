@props(['icon', 'label' => null, 'value', 'link' => null, 'iconType' => 'svg'])

<div class="flex items-center gap-3">
    @if($iconType === 'fontawesome')
        <span class="w-5 h-5 text-gray-400 flex items-center justify-center">
            {!! $icon !!}
        </span>
    @else
        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            {!! $icon !!}
        </svg>
    @endif
    <span>
        @if($label){{ $label }}: @endif
        @if($link)
            <a href="{{ $link }}" class="text-green-400 hover:underline">{{ $value }}</a>
        @else
            {{ $value }}
        @endif
    </span>
</div>
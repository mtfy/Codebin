@if(!\is_null($href) && \is_string($href))
	<a href="{{ $href }}" {{ $attributes->merge(['class' => 'select-none text-center transition-general enabled:cursor-pointer disabled:cursor-default whitespace-nowrap' . $style . $class]) }}>
        {{ $slot }}
    </a>
@else
	<button {{ $attributes->merge(['class' => 'select-none text-center transition-general enabled:cursor-pointer disabled:cursor-default whitespace-nowrap' . $style . $class]) }}>
        {{ $slot }}
    </button>
@endif
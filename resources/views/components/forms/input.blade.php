<div class="flex flex-col space-y-2 relative">
	@if (!\is_null($label) && \is_string($label))
		<label class="whitespace-nowrap text-theme-foreground-primary text-sm font-semibold" for="{{ $attributes['id'] }}">{{ $label }}</label>
	@endif
	@if (!\is_null($icon) && \is_string($icon))
		<div class="relative">
			<div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">{!! $icon !!}</div>
    		<input {{ $attributes->merge(['class' => 'transition-general disabled:opacity-50 whitespace-nowrap ps-10' . $style . $class]) }} />
		</div>
	@else
		<input {{ $attributes->merge(['class' => 'transition-general disabled:opacity-50 whitespace-nowrap' . $style . $class]) }} />
	@endif
	@if (!\is_null($helperText) && \is_string($helperText))
		<span class="whitespace-nowrap text-theme-foreground-darker text-[11px] leading-loose" id="{{ $attributes['aria-describedby'] }}">{{ $helperText }}</span>
	@endif
</div>



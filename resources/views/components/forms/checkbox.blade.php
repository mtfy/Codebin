<div class="flex flex-row items-center relative">
	<input type="checkbox" value="" {{ $attributes->merge(['class' => 'noselect w-4 h-4 text-blue-600 bg-transparent border-gray-300 rounded-lg ring-0 outline-none dark:border-gray-600' . $class]) }}>
	<label {{  isset($attributes['id']) ? 'for=' .  $attributes['id'] . ' ' : '' }}class="ms-2 text-md leading-snug font-light text-foreground-primary">{!! $label !!}</label>
</div>
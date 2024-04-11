@props([
	'textLeft' => null,
	'textRight' => null,
	'class' => null,
	'style' => null,
	'width' => null,
	'tooltip' => null
])

<th 
	{{ $attributes->wire('click') }}
	class="border-b-2 dark:border-dark-5 whitespace-nowrap
		@if($textLeft) 
			text-left 
		@elseif ($textRight) 
			text-right 
		@else 
			text-center 
		@endif
		@if($this->sortState) cursor-pointer @endif 
		@if($class) {{ $class }} @endif 
		@if($tooltip) tooltip @endif
	" 
	@if($width) width="{{ $width }}" @endif
	@if($tooltip) tooltip="{{ $tooltip }}" @endif 
	@if($style) style="{{ $style }}" @endif 
>
    <div class="flex flex-row items-center">
        <span>{{ $slot }}</span>
        <div class="ml-1">
            @if ($this->sortState && $attributes->wire('click')->value())
                @if ($this->sortState['sort_by'] != (explode("'", $attributes->wire('click')->value())[1]))
                    <div class="flex items-center">
                        <x-icons.arrow-up class="h-2 w-2" />
                        <x-icons.arrow-down class="h-2 w-2" />
                    </div>
                @elseif ($this->sortState['direction'] === 'ASC')
                    <div class="flex items-center">
                        <x-icons.arrow-up class="h-2 w-2" />
                    </div>
                @else
                    <div class="flex items-center">
                        <x-icons.arrow-down class="h-2 w-2" />
                    </div>
                @endif
            @endif
        </div>
    </div>

</th>
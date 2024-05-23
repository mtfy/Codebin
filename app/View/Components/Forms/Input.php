<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
	public $style;
	public $label;
	public $class;
	public $icon;
	public $helperText;
	private $styles;

    /**
     * Create a new component instance.
     */
    public function __construct(string $style = 'primary', mixed $label = NULL, mixed $helperText = NULL, mixed $class = NULL, mixed $icon = NULL)
    {
        $this->class = (!\is_null($class) && \is_string($class) && Str::of($class)->trim()->isNotEmpty()) ? Str::of($class)->trim()->prepend(' ')->toString() : '';

		$this->label = (!\is_null($label) && \is_string($label) && Str::of($label)->trim()->isNotEmpty()) ? Str::of($label)->trim()->lower()->ucfirst()->toString() : NULL;

		$this->helperText = (!\is_null($helperText) && \is_string($helperText) && Str::of($helperText)->trim()->isNotEmpty()) ? Str::of($helperText)->trim()->toString() : NULL;

		$this->icon = (!\is_null($icon) && \is_string($icon) && Str::of($icon)->trim()->isNotEmpty()) ? Str::of($icon)->trim()->toString() : NULL;

		$this->styles = [
			'primary'				=>	'bg-transparent border border-theme-600 text-sm ring-theme-500 block w-full px-2.5 py-2 text-theme-foreground-primary placeholder-neutral-400 focus:ring',
			'secondary'				=>	'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg ring-blue-500 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:ring-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500',
			'alternative'			=>	'bg-transparent border border-theme-200 text-sm ring-theme-500 block w-full px-2.5 py-2 text-theme-foreground-secondary placeholder-neutral-400 focus:ring',
			'modern'				=>	'bg-theme-300 border border-theme-200 text-sm rounded-lg ring-theme-500 border-theme-600 block w-full px-2.5 py-2 text-foreground-primary placeholder-neutral-400 focus:ring',
		];

		$this->style = (\array_key_exists($style, $this->styles)) ? Str::of($this->styles[$style])->trim()->prepend(' ')->toString() : Str::of($this->styles['primary'])->trim()->prepend(' ')->toString();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.input');
    }
}

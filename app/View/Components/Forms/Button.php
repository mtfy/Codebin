<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{

	public $style;
	public $class;
	public $href;
	private $styles;

    /**
     * Create a new component instance.
     */
    public function __construct(string $style = 'primary', mixed $class = NULL, mixed $href = NULL)
	{

		$this->class = (!\is_null($class) && \is_string($class) && Str::of($class)->trim()->isNotEmpty()) ? Str::of($class)->trim()->prepend(' ')->toString() : '';

		$this->href = (!\is_null($href) && \is_string($href) && Str::of($href)->trim()->isNotEmpty()) ? Str::of($href)->trim()->toString() : NULL;

		$this->styles = [
			'primary'				=>	'text-white border border-[#00000000] bg-blue-700 hover:bg-blue-800 outline-none focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800',
			'primaryNoRadius'		=>	'text-white border border-[#00000000] bg-blue-700 hover:bg-blue-800 outline-none focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium text-sm dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800',
			'secondaryNoRadius'		=>	'text-theme-foreground-primary border border-blue-700 dark:border-blue-600 dark:text-theme-foreground-contrast bg-transparent hover:bg-theme-600 outline-none focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium text-sm dark:hover:border-blue-700 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800',
			'alternative'			=>	'py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700',
			'dark'					=>	'text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700',
			'light'					=>	'text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700',
			'green'					=>	'focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800',
			'danger'				=>	'focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900',
			'gradientPurpleBlue'	=>	'text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm',
			'gradientBlue'			=>	'text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm'
		];

		$this->style = (\array_key_exists($style, $this->styles)) ? Str::of($this->styles[$style])->trim()->prepend(' ')->toString() : Str::of($this->styles['primary'])->trim()->prepend(' ')->toString();
	}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.button');
    }
}

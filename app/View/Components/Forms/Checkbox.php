<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Checkbox extends Component
{
	public $label;
	public $class;

    /**
     * Create a new component instance.
     */
    public function __construct(string $label = '', mixed $class = NULL)
    {
        $this->label = Str::of($label)->trim()->ucfirst()->toString();
		$this->class = (!\is_null($class) && \is_string($class) && Str::of($class)->trim()->isNotEmpty()) ? Str::of($class)->trim()->prepend(' ')->toString() : '';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.checkbox');
    }
}

<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class datePicker extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $id,
        public string $name,
        public ?string $value = null,
        public ?string $placeholder = 'Select date',
        public ?string $class = '',
        public ?string $min = null,
        public ?string $max = null,
        public bool $required = false,
        public bool $autohide = true,
    )
    {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.date-picker');
    }
}

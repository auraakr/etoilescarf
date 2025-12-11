<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class fileInput extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $id,
        public string $name,
        public ?string $accept = null,
        public ?string $label = 'Click to upload',
        public ?string $hint = 'SVG, PNG, JPG or GIF (MAX. 800x400px)',
        public ?string $class = '',
        public bool $required = false,
        public bool $multiple = false,
    )
    {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.file-input');
    }
}

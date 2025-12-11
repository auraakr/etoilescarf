<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class textarea extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $id,
        public string $name,
        public ?string $value = null,
        public ?string $placeholder = '',
        public ?string $class = '',
        public ?int $rows = 4,
        public bool $required = false,
    )
    {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.textarea');
    }
}

<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class select extends Component
{
    public function __construct(
        public string $id,
        public string $name,
        public array $options = [],
        public ?string $selected = null,
        public ?string $placeholder = 'Choose an option',
        public ?string $class = '',
        public bool $required = false,
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.select');
    }
}

<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class InputError extends Component
{
    public $error;

    /**
     * Create a new component instance.
     */
    public function __construct(string $error)
    {
        $this->error = $error;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-error');
    }
}

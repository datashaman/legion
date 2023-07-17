<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CreatePersona extends Component
{
    public array $acts;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->acts = collect(config('legion.prompts'))
            ->pluck('act', 'id')
            ->all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.create-persona');
    }
}

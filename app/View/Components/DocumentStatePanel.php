<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DocumentStatePanel extends Component
{
    public bool $can_show = false;
    public bool $validated = false;
    public bool $signed = false;
    public string $state = "Создание";
    /**
     * Create a new component instance.
     */
    public function __construct($item = null)
    {
        if ($item) {
            $this->can_show = true;
            $this->state = $item->state;
            $this->validated = $item->validated;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.document-state-panel');
    }
}

<?php

namespace App\View\Components\DocumentTable;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ControlCell extends Component
{

    public $item;
    public $routeName;
    /**
     * Create a new component instance.
     */
    public function __construct($item = null, string $routeName = null)
    {
        $this->item = $item;
        $this->routeName = $routeName;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.document-table.control-cell');
    }
}

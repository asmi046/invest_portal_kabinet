<?php

namespace App\View\Components\DocumentTable;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ControlCell extends Component
{

    public $item;
    public $documentType;
    /**
     * Create a new component instance.
     */
    public function __construct($item = null, $documentType = null)
    {
        $this->item = $item;
        $this->documentType = $documentType;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.document-table.control-cell');
    }
}

<?php

namespace App\View\Components\DocumentTable;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ControlCell extends Component
{

    public $item;
    public $documentType;

    public bool $signed = false;
    public bool $signed_local = false;

    /**
     * Create a new component instance.
     */
    public function __construct($item = null, $documentType = null)
    {
        $this->item = $item;
        $this->documentType = $documentType;

        if ($item->goskeyRegistries && isset($item->goskeyRegistries[0]) && $item->goskeyRegistries[0]->status_code == 100) {
                $this->signed = true;
            }

        if( $item->signature && $item->signature->signature != null ) {
                $this->signed_local = true;
            }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.document-table.control-cell');
    }
}

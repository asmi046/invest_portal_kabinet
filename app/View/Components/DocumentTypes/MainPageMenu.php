<?php

namespace App\View\Components\DocumentTypes;

use Closure;
use App\Models\DocumentType;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class MainPageMenu extends Component
{
    public $documentTypes;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->documentTypes = DocumentType::orderBy('order')->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.document-types.main-page-menu');
    }
}

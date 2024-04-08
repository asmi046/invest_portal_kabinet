<?php

declare(strict_types=1);

namespace App\MoonShine\Components;

use Closure;
use Illuminate\Contracts\View\View;
use MoonShine\Components\MoonShineComponent;

/**
 * @method static static make()
 */
final class MainLink extends MoonShineComponent
{
    protected string $view = 'admin.components.main-link';
    protected $label = "Ссылка";
    protected $lnk_name = "";
    protected $lnk = "";

    public function __construct(string $label, string $lnk = "", string $name = "")
    {
        $this->label = $label;
        $this->lnk_name = $name;
        $this->lnk = $lnk;
    }

    protected function viewData(): array
    {
        return [
            'label' => $this->label,
            'lnk_name' => $this->lnk_name,
            'lnk' => $this->lnk,
        ];
    }
}

<?php

declare(strict_types=1);

namespace App\Providers;

use MoonShine\MoonShine;
use MoonShine\Menu\MenuItem;
use MoonShine\Menu\MenuGroup;
use App\MoonShine\Resources\AreaGetResource;
use App\MoonShine\Resources\ProjectResource;
use MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;
use MoonShine\Providers\MoonShineApplicationServiceProvider;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    protected function resources(): array
    {
        return [];
    }

    protected function pages(): array
    {
        return [];
    }

    protected function menu(): array
    {
        return [
            MenuGroup::make(static fn() => __('moonshine::ui.resource.system'), [
               MenuItem::make(
                   static fn() => __('moonshine::ui.resource.admins_title'),
                   new MoonShineUserResource()
               ),
               MenuItem::make(
                   static fn() => __('moonshine::ui.resource.role_title'),
                   new MoonShineUserRoleResource()
               ),
            ]),

            MenuGroup::make(static fn() => __('Заявления на предоставление земельного участка'), [
                MenuItem::make(
                    "Все заявления",
                    new AreaGetResource()
                )->icon('heroicons.outline.clipboard-document-list'),
            ]),


            MenuItem::make(
                "Проекты",
                new ProjectResource()
            ),

        ];
    }

    /**
     * @return array{css: string, colors: array, darkColors: array}
     */
    protected function theme(): array
    {
        return [];
    }
}

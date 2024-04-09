<?php

declare(strict_types=1);

namespace App\Providers;

use MoonShine\MoonShine;
use MoonShine\Menu\MenuItem;
use MoonShine\Menu\MenuGroup;
use App\MoonShine\Resources\AreaGetResource;
use App\MoonShine\Resources\ProjectResource;
use App\MoonShine\Resources\AlgorithmResource;
use App\MoonShine\Resources\AttachmentResource;
use App\MoonShine\Resources\MoonShineUserResource;
use App\MoonShine\Resources\InvestDocumentResource;
use App\MoonShine\Resources\SignedDocumentResource;
use App\MoonShine\Resources\MoonShineUserRoleResource;
use App\MoonShine\Resources\TechnicalConnectsResource;
use App\MoonShine\Resources\OrganizationContactResource;
use MoonShine\Providers\MoonShineApplicationServiceProvider;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    protected function resources(): array
    {
        return [
            new SignedDocumentResource(),
            new AttachmentResource(),
        ];
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
            ])
            ->icon('heroicons.outline.users')
            ->canSee(fn() => auth()->user()->moonshineUserRole->name === "Admin"),

            MenuGroup::make(static fn() => __('Заявление на земельного участка'), [
                MenuItem::make(
                    "Все заявления",
                    new AreaGetResource()
                )->icon('heroicons.outline.clipboard-document-list'),
            ])
            ->icon('heroicons.outline.globe-europe-africa')
            ->canSee(fn() => in_array(auth()->user()->moonshineUserRole->name, ["Admin", "Просмотр показателей"])),

            MenuGroup::make(static fn() => __('Техническое присоединение'), [
                MenuItem::make(
                    "Все заявления",
                    new TechnicalConnectsResource()
                )->icon('heroicons.outline.clipboard-document-list'),
            ])
            ->icon('heroicons.outline.power')
            ->canSee(fn() => in_array(auth()->user()->moonshineUserRole->name, ["Admin", "Ресурсные организации"])),

            MenuGroup::make(static fn() => __('Дополнительно'), [
                MenuItem::make(
                    "Ресурсоснабжающие организации",
                    new OrganizationContactResource()
                )->icon('heroicons.outline.building-office'),

                MenuItem::make(
                    "Алгоритмы действий",
                    new AlgorithmResource()
                )->icon('heroicons.outline.cog-6-tooth'),

                MenuItem::make(
                    "Нормативная база",
                    new InvestDocumentResource()
                )->icon('heroicons.outline.building-library'),
            ])
            ->icon('heroicons.outline.cog-6-tooth')
            ->canSee(fn() => in_array(auth()->user()->moonshineUserRole->name, ["Admin", "Просмотр показателей"])),


            // MenuItem::make(
            //     "Проекты",
            //     new ProjectResource()
            // ),

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

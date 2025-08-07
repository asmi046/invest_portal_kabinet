<?php

declare(strict_types=1);

namespace App\MoonShine\Layouts;

use MoonShine\MenuManager\MenuGroup;
use MoonShine\MenuManager\MenuItem;

use App\MoonShine\Resources\AreaGetResource;
use App\MoonShine\Resources\TechnicalConnectsResource;
use App\MoonShine\Resources\OrganizationContactResource;
use App\MoonShine\Resources\AlgorithmResource;
use App\MoonShine\Resources\InvestDocumentResource;
use App\MoonShine\Resources\MoonShineUserResource;
use App\MoonShine\Resources\MoonShineUserRoleResource;

use MoonShine\Laravel\Layouts\AppLayout;
use MoonShine\ColorManager\ColorManager;
use MoonShine\Contracts\ColorManager\ColorManagerContract;
use MoonShine\Laravel\Components\Layout\{Locales, Notifications, Profile, Search};
use MoonShine\UI\Components\{Breadcrumbs,
    Components,
    Layout\Flash,
    Layout\Div,
    Layout\Body,
    Layout\Burger,
    Layout\Content,
    Layout\Footer,
    Layout\Head,
    Layout\Favicon,
    Layout\Assets,
    Layout\Meta,
    Layout\Header,
    Layout\Html,
    Layout\Layout,
    Layout\Logo,
    Layout\Menu,
    Layout\Sidebar,
    Layout\ThemeSwitcher,
    Layout\TopBar,
    Layout\Wrapper,
    When};
use App\MoonShine\Resources\DocumentTypeResource;
use App\MoonShine\Resources\OrganizationResource;

final class MoonShineLayout extends AppLayout
{
    protected function assets(): array
    {
        return [
            ...parent::assets(),
        ];
    }

    protected function menu(): array
    {
        return [

            MenuGroup::make(static fn() => __('Заявление на земельного участка'), [
                MenuItem::make(
                    "Все заявления",
                    AreaGetResource::class
                )->icon('clipboard-document-list'),
            ])
            ->icon('globe-europe-africa')
            ->canSee(fn() => auth()->user()->documentTypes->contains('model', 'App\Models\AreaGet')),

            MenuGroup::make(static fn() => __('Техническое присоединение'), [
                MenuItem::make(
                    "Все заявления",
                    TechnicalConnectsResource::class
                )->icon('clipboard-document-list'),
            ])
            ->icon('power')
            ->canSee(fn() => auth()->user()->documentTypes->contains('model', 'App\Models\TechnicalConnects')),
            // ->canSee(fn() => in_array(auth()->user()->moonshineUserRole->name, ["Admin", "Ресурсные организации", "Просмотр показателей"])),

            MenuGroup::make(static fn() => __('Дополнительно'), [
                MenuItem::make(
                    "Ресурсоснабжающие организации",
                    OrganizationContactResource::class
                )->icon('building-office'),

                MenuItem::make(
                    "Алгоритмы действий",
                    AlgorithmResource::class
                )->icon('cog-6-tooth'),

                MenuItem::make(
                    "Нормативная база",
                    InvestDocumentResource::class
                )->icon('building-library'),
            ])
            ->icon('cog-6-tooth')
            ->canSee(fn() => in_array(auth()->user()->moonshineUserRole->name, ["Admin", "Просмотр показателей"])),

            MenuGroup::make(static fn() => __('Настройки портала'), [
                MenuItem::make('Типы документов', DocumentTypeResource::class)->icon('document-text'),
                MenuItem::make('Организации', OrganizationResource::class)->icon('building-library'),
            ])
            ->icon('cube')
            ->canSee(fn() => in_array(auth()->user()->moonshineUserRole->name, ["Admin", "Просмотр показателей"])),

            MenuGroup::make(static fn() => __('moonshine::ui.resource.system'), [
               MenuItem::make(
                   static fn() => __('moonshine::ui.resource.admins_title'),
                   MoonShineUserResource::class
               ),
               MenuItem::make(
                   static fn() => __('moonshine::ui.resource.role_title'),
                   MoonShineUserRoleResource::class
               ),
            ])
            ->icon('users')
            ->canSee(fn() => auth()->user()->moonshineUserRole->name === "Admin"),




        ];
    }

    /**
     * @param ColorManager $colorManager
     */
    protected function colors(ColorManagerContract $colorManager): void
    {
        parent::colors($colorManager);

        // $colorManager->primary('#00000');
    }


    protected function getFooterCopyright(): string
    {
        return '';
    }

    public function build(): Layout
    {
        return parent::build();
    }
}

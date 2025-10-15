<?php

declare(strict_types=1);

namespace App\MoonShine\Layouts;

use MoonShine\MenuManager\MenuGroup;
use MoonShine\MenuManager\MenuItem;

use App\MoonShine\Resources\AreaGetResource;
use App\MoonShine\Resources\TechnicalConnectsResource;
use App\MoonShine\Resources\AttachmentResource;
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
use App\MoonShine\Resources\GoskeyRegistryResource;
use App\MoonShine\Resources\CommissioningPermitResource;
use App\MoonShine\Resources\ConstructionPermitResource;
use App\MoonShine\Resources\GasConnectionResource;
use App\MoonShine\Resources\HeatConnectionResource;
use App\MoonShine\Resources\LandAuctionApplicationResource;
use App\MoonShine\Resources\LandLeaseApplicationResource;
use App\MoonShine\Resources\WaterConnectionResource;

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

            MenuGroup::make(static fn() => __('Земельные участки'), [
                MenuItem::make("Предоставление участка",
                    AreaGetResource::class
                )
                ->icon('globe-alt')
                ->canSee(fn() => auth()->user()->documentTypes->contains('model', 'App\Models\AreaGet')),

                MenuItem::make('Проведении аукциона ',
                    LandAuctionApplicationResource::class
                )
                ->icon('globe-asia-australia')
                ->canSee(fn() => auth()->user()->documentTypes->contains('model', 'App\Models\LandAuctionApplication')),

                MenuItem::make('Приобретение участка',
                    LandLeaseApplicationResource::class
                )
                ->icon('globe-americas')
                ->canSee(fn() => auth()->user()->documentTypes->contains('model', 'App\Models\LandLeaseApplication')),
            ]),
            MenuGroup::make(static fn() => __('Строительство'), [
                MenuItem::make('Ввод объекта в эксплуатацию',
                    CommissioningPermitResource::class
                )
                ->icon('home-modern')
                ->canSee(fn() => auth()->user()->documentTypes->contains('model', 'App\Models\CommissioningPermit')),

                MenuItem::make('Разрешение на строительство',
                    ConstructionPermitResource::class
                )
                ->icon('home-modern')
                ->canSee(fn() => auth()->user()->documentTypes->contains('model', 'App\Models\ConstructionPermit')),
            ]),


            MenuGroup::make(static fn() => __('Техническое присоединение'), [
                MenuItem::make(
                    "Электросети",
                    TechnicalConnectsResource::class
                )
                ->icon('clipboard-document-list')
                ->canSee(fn() => auth()->user()->documentTypes->contains('model', 'App\Models\TechnicalConnects')),

                MenuItem::make('Газовые сети',
                    GasConnectionResource::class
                )
                ->icon('sparkles')
                ->canSee(fn() => auth()->user()->documentTypes->contains('model', 'App\Models\GasConnection')),

                MenuItem::make('Тепловые сети',
                    HeatConnectionResource::class
                )
                ->icon('fire')
                ->canSee(fn() => auth()->user()->documentTypes->contains('model', 'App\Models\HeatConnection')),

                MenuItem::make('Водоснабжение',
                    WaterConnectionResource::class
                )
                ->icon('lifebuoy')
                ->canSee(fn() => auth()->user()->documentTypes->contains('model', 'App\Models\WaterConnection')),
            ]),

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



            // MenuItem::make('Вложения', AttachmentResource::class)->icon('paper-clip'),
            // MenuItem::make('Процедуры госключа', GoskeyRegistryResource::class)->icon('shield-check'),

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

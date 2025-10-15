<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\MoonShine\Resources\AreaGetResource;
use App\MoonShine\Resources\AlgorithmResource;
use App\MoonShine\Resources\AttachmentResource;
use App\MoonShine\Resources\DocumentTypeResource;
use App\MoonShine\Resources\OrganizationResource;
use App\MoonShine\Resources\MoonShineUserResource;
use App\MoonShine\Resources\GoskeyRegistryResource;
use App\MoonShine\Resources\SignedDocumentResource;
use MoonShine\Laravel\DependencyInjection\MoonShine;
use App\MoonShine\Resources\MoonShineUserRoleResource;
use App\MoonShine\Resources\TechnicalConnectsResource;
use MoonShine\Contracts\Core\DependencyInjection\CoreContract;
use MoonShine\Laravel\DependencyInjection\MoonShineConfigurator;
use MoonShine\Contracts\Core\DependencyInjection\ConfiguratorContract;
use App\MoonShine\Resources\CommissioningPermitResource;
use App\MoonShine\Resources\ConstructionPermitResource;
use App\MoonShine\Resources\GasConnectionResource;
use App\MoonShine\Resources\HeatConnectionResource;
use App\MoonShine\Resources\LandAuctionApplicationResource;
use App\MoonShine\Resources\LandLeaseApplicationResource;
use App\MoonShine\Resources\WaterConnectionResource;

class MoonShineServiceProvider extends ServiceProvider
{
    /**
     * @param  MoonShine  $core
     * @param  MoonShineConfigurator  $config
     *
     */
    public function boot(CoreContract $core, ConfiguratorContract $config): void
    {
        $core
            ->resources([
                MoonShineUserResource::class,
                MoonShineUserRoleResource::class,
                AreaGetResource::class,
                AlgorithmResource::class,
                AttachmentResource::class,
                SignedDocumentResource::class,
                DocumentTypeResource::class,
                OrganizationResource::class,
                GoskeyRegistryResource::class,
                TechnicalConnectsResource::class,
                CommissioningPermitResource::class,
                ConstructionPermitResource::class,
                GasConnectionResource::class,
                HeatConnectionResource::class,
                LandAuctionApplicationResource::class,
                LandLeaseApplicationResource::class,
                WaterConnectionResource::class,
            ])
            ->pages([
                ...$config->getPages(),
            ])
        ;
    }
}

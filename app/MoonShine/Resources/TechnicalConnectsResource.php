<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Phone;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Switcher;
use App\Models\TechnicalConnects;
use MoonShine\Handlers\ExportHandler;

use MoonShine\Handlers\ImportHandler;
use MoonShine\Laravel\Resources\ModelResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;
use App\MoonShine\Pages\TechnicalConnects\TechnicalConnectsFormPage;
use App\MoonShine\Pages\TechnicalConnects\TechnicalConnectsIndexPage;
use App\MoonShine\Pages\TechnicalConnects\TechnicalConnectsDetailPage;

/**
 * @extends ModelResource<TechnicalConnects>
 */
class TechnicalConnectsResource extends ModelResource
{
    protected string $model = TechnicalConnects::class;

    protected string $title = 'Заявления на техническое присоединение';

    protected bool $withPolicy = true;

    public function pages(): array
    {
        return [
            TechnicalConnectsIndexPage::class,
            TechnicalConnectsFormPage::class,
            TechnicalConnectsDetailPage::class,
        ];
    }


    public function import(): ?ImportHandler
    {
        return null;
    }

    public function export(): ?ExportHandler
    {
        return ExportHandler::make('Экспорт');
    }
}

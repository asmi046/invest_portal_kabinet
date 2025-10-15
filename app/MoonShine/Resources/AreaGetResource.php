<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\AreaGet;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Fields\Phone;
use MoonShine\Support\ListOf;

use MoonShine\Laravel\Enums\Action;
use MoonShine\Handlers\ExportHandler;
use MoonShine\Handlers\ImportHandler;
use Illuminate\Database\Eloquent\Model;
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Laravel\Resources\ModelResource;
use App\MoonShine\Pages\AreaGet\AreaGetFormPage;
use App\MoonShine\Pages\AreaGet\AreaGetIndexPage;
use App\MoonShine\Pages\AreaGet\AreaGetDetailPage;

/**
 * @extends ModelResource<AreaGet>
 */
class AreaGetResource extends ModelResource
{
    protected string $model = AreaGet::class;

    protected string $title = 'Заявления на предоставление земельного участка';

    protected string $column = 'id';

    protected bool $withPolicy = true;

    protected function activeActions(): ListOf
    {
        return parent::activeActions()->except(Action::VIEW);
    }

    protected function pages(): array
    {
        return [
            AreaGetIndexPage::class,
            AreaGetFormPage::class,
            AreaGetDetailPage::class,
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

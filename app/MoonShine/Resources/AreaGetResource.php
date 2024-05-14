<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\AreaGet;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Fields\Phone;
use MoonShine\Handlers\ExportHandler;

use MoonShine\Handlers\ImportHandler;
use MoonShine\Resources\ModelResource;
use Illuminate\Database\Eloquent\Model;
use MoonShine\ActionButtons\ActionButton;
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

    public function pages(): array
    {
        return [
            AreaGetIndexPage::make($this->title()),
            AreaGetFormPage::make(
                $this->getItemID()
                    ? __('moonshine::ui.edit')
                    : __('moonshine::ui.add')
            ),
            AreaGetDetailPage::make(__('moonshine::ui.show')),
        ];
    }

    public function fields(): array
    {
        return [
            ID::make()->showOnExport(),
            Text::make("Пользователь", 'User.name', fn($item) => $item->user->name." ".$item->user->lastname ." ". $item->user->fathername)->showOnExport(),
            Text::make("Заявитель", "name")->showOnExport(),
            Text::make("Организация", "organization")->showOnExport(),
            Phone::make("Телефон", "phone")->showOnExport(),
            Text::make("Участок", "object_name")->showOnExport(),
            Text::make("Тип участка", "object_type")->showOnExport(),
            Text::make("Статус", "state")->showOnExport(),
        ];
    }

    public function indexButtons(): array
    {
        return [

        ];
    }

    public function rules(Model $item): array
    {
        return [];
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

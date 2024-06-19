<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use MoonShine\Fields\Text;
use MoonShine\Fields\Phone;
use MoonShine\Fields\Select;
use MoonShine\Fields\Switcher;
use App\Models\TechnicalConnects;
use MoonShine\Handlers\ExportHandler;

use MoonShine\Handlers\ImportHandler;
use MoonShine\Resources\ModelResource;
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

    public function pages(): array
    {
        return [
            TechnicalConnectsIndexPage::make($this->title()),
            TechnicalConnectsFormPage::make(
                $this->getItemID()
                    ? __('moonshine::ui.edit')
                    : __('moonshine::ui.add')
            ),
            TechnicalConnectsDetailPage::make(__('moonshine::ui.show')),
        ];
    }

    public function fields(): array
    {
        return [
            Text::make("Пользователь", 'User.name', fn($item) => $item->user->name." ".$item->user->lastname ." ". $item->user->fathername)->showOnExport(),
            Text::make("Заявитель", "name")->showOnExport(),
            Text::make("Организация", "organization")->showOnExport(),
            Phone::make("Телефон", "phone")->showOnExport(),

            Text::make("Мощьность прис. устройств", "pover_pris_devices")->showOnExport(),
            Text::make("Устройства", "ustroistvo")->showOnExport(),

            Text::make("Статус", "state")->showOnExport(),
        ];
    }

    public function filters(): array
    {
        return [
            Text::make("Заявитель", "name"),
            Phone::make("Телефон", "phone"),
            Switcher::make('Проверено корпорацией развитие', 'corporation_check'),
            Switcher::make('Проверено ресурсной организацией', 'resource_check'),
            Select::make("Статус", "state")
            ->options(config('documents')['tc']['statuses_select_options'])->nullable()
        ];
    }

    public function query(): Builder
    {
        if (auth()->user()->moonshine_user_role_id == 3)
            return parent::query()->where('corporation_check', 1);
        else
            return parent::query();
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

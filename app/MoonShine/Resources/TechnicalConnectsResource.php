<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\TechnicalConnects;
use App\MoonShine\Pages\TechnicalConnects\TechnicalConnectsIndexPage;
use App\MoonShine\Pages\TechnicalConnects\TechnicalConnectsFormPage;
use App\MoonShine\Pages\TechnicalConnects\TechnicalConnectsDetailPage;

use MoonShine\Resources\ModelResource;

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

    public function rules(Model $item): array
    {
        return [];
    }
}

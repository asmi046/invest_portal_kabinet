<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\AreaGet;
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


    public function indexButtons(): array
    {
        return [

        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}

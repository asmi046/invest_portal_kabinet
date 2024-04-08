<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Project;
use App\MoonShine\Pages\Project\ProjectIndexPage;
use App\MoonShine\Pages\Project\ProjectFormPage;
use App\MoonShine\Pages\Project\ProjectDetailPage;

use MoonShine\Resources\ModelResource;

/**
 * @extends ModelResource<Project>
 */
class ProjectResource extends ModelResource
{
    protected string $model = Project::class;

    protected string $title = 'Инвестиционные проекты';

    protected array $with = [
        'attachment',
        'signature'
    ];

    public function pages(): array
    {
        return [
            ProjectIndexPage::make($this->title()),
            ProjectFormPage::make(
                $this->getItemID()
                    ? __('moonshine::ui.edit')
                    : __('moonshine::ui.add')
            ),
            ProjectDetailPage::make(__('moonshine::ui.show')),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}

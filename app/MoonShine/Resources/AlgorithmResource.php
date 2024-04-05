<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use MoonShine\Fields\ID;
use App\Models\Algorithm;

use MoonShine\Fields\File;
use MoonShine\Fields\Text;
use MoonShine\Decorations\Block;
use MoonShine\Resources\ModelResource;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends ModelResource<Algorithm>
 */
class AlgorithmResource extends ModelResource
{
    protected string $model = Algorithm::class;

    protected string $title = 'Алгоритмы действий инвестора';

    protected string $column = 'title';

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Заголовок', 'title')->required(),
                Text::make('Закладка', 'subtype')->required(),
                Text::make('Группа', 'group')->required()->hideOnIndex(),
                File::make('Прикрепленный файл', 'file')
                    ->required()
                    ->disk('public')
                    ->dir('algoritmes')
                    ->removable()
                    ->allowedExtensions(['pdf', 'doc', 'docx'])
                    ->hideOnIndex(),

            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}

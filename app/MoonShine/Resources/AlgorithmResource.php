<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Algorithm;
use MoonShine\UI\Fields\ID;

use MoonShine\UI\Fields\File;
use MoonShine\UI\Fields\Text;
use Illuminate\Database\Eloquent\Model;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\Resources\ModelResource;

/**
 * @extends ModelResource<Algorithm>
 */
class AlgorithmResource extends ModelResource
{
    protected string $model = Algorithm::class;

    
    protected string $title = 'Алгоритмы действий инвестора';

    protected string $column = 'title';
    
    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Заголовок', 'title'),
            Text::make('Закладка', 'subtype'),
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make([
                ID::make(),
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
            ])
        ];
    }

    /**
     * @return list<FieldContract>
     */
    protected function detailFields(): iterable
    {
        return [
            ID::make(),
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
        ];
    }

    /**
     * @param Algorithm $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [];
    }
}

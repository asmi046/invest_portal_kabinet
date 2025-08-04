<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use MoonShine\Fields\ID;
use MoonShine\Fields\File;

use MoonShine\Fields\Text;
use App\Models\InvestDocument;
use MoonShine\Decorations\Block;
use MoonShine\Laravel\Resources\ModelResource;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends ModelResource<InvestDocument>
 */
class InvestDocumentResource extends ModelResource
{
    protected string $model = InvestDocument::class;

    protected string $title = 'Нормативно-правовая база для Инвестора';

    protected string $column = 'title';

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Заголовок', 'title')->required(),
                Text::make('Группа', 'subtype')->required(),
                File::make('Прикрепленный файл', 'file')
                    ->required()
                    ->disk('public')
                    ->dir('portal_documents')
                    ->removable()
                    ->allowedExtensions(['pdf', 'doc', 'docx'])
                    ->hideOnIndex(),
            ]),
        ];
    }

     protected function rules($item): array
    {
        return [];
    }
}

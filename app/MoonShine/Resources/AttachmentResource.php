<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Attachment;
use MoonShine\UI\Fields\ID;

use MoonShine\UI\Fields\Text;
use MoonShine\Decorations\Block;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Laravel\Resources\ModelResource;

/**
 * @extends ModelResource<Attachment>
 */
class AttachmentResource extends ModelResource
{
    protected string $model = Attachment::class;

    protected string $title = 'Вложения';

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
                Text::make("Имя файла", "file_real"),


        ];
    }

    protected function detailFields(): iterable
    {
        return $this->indexFields();
    }

    protected function formFields(): iterable
    {
        return [
            Text::make('Имя файла', 'file_real'),
        ];
    }
    public function fields(): array
    {
        return [
            Block::make([

            ]),
        ];
    }

     protected function rules($item): array
    {
        return [];
    }
}

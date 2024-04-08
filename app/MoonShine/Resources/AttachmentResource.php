<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use MoonShine\Fields\ID;
use App\Models\Attachment;

use MoonShine\Fields\Text;
use MoonShine\Decorations\Block;
use MoonShine\Resources\ModelResource;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends ModelResource<Attachment>
 */
class AttachmentResource extends ModelResource
{
    protected string $model = Attachment::class;

    protected string $title = 'Attachments';

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make("Имя файла", "file_real"),
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}

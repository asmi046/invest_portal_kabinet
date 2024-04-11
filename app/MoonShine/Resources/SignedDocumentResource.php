<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use MoonShine\Fields\ID;
use MoonShine\Fields\Url;

use MoonShine\Fields\Text;
use App\Models\SignedDocument;
use MoonShine\Decorations\Block;
use App\MoonShine\Fields\MainLnk;
use App\MoonShine\Components\MainLink;
use MoonShine\Resources\ModelResource;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends ModelResource<SignedDocument>
 */
class SignedDocumentResource extends ModelResource
{
    protected string $model = SignedDocument::class;

    protected string $title = 'SignedDocuments';


    public function getActiveActions(): array
    {
        return ['view', 'delete'];
    }

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                MainLnk::make('Ссылка на подпись','signature'),
                MainLnk::make('Ссылка на файл','file'),
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}

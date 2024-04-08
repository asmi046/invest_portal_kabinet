<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use MoonShine\Fields\ID;
use MoonShine\Fields\Url;

use MoonShine\Fields\Text;
use App\Models\SignedDocument;
use MoonShine\Decorations\Block;
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
                MainLink::make('Ссылка на подпись',
                    ($this->getItem())?$this->getItem()->storage_patch."/".$this->getItem()?->signature:"",
                    ($this->getItem())?$this->getItem()?->signature:""),

                MainLink::make('Ссылка на файл',
                    ($this->getItem())?$this->getItem()->storage_patch."/".$this->getItem()->file:"",
                    ($this->getItem())?$this->getItem()->file_real:""),
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}

<?php

namespace App\MoonShine\Fields;

use App\MoonShine\Resources\AttachmentResource;
use MoonShine\Laravel\Fields\Relationships\HasOne;
use App\MoonShine\Resources\GoskeyRegistryResource;
use App\MoonShine\Resources\SignedDocumentResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\Laravel\Fields\Relationships\MorphMany;




class RelationFields
{
    public static function make(): array
    {
        return [
            HasMany::make("Вложения", "attachment", resource: AttachmentResource::class),
            MorphMany::make(
                'Подпись (Госключ)',
                'goskeyRegistries',
                resource: GoskeyRegistryResource::class
            ),
            HasOne::make("Подпись (плагин)", "signature", resource: SignedDocumentResource::class)
        ];
    }
}

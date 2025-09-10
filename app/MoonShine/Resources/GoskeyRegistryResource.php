<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Url;

use MoonShine\UI\Fields\File;
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Text;
use App\Models\GoskeyRegistry;
use MoonShine\UI\Fields\Position;
use Illuminate\Database\Eloquent\Model;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\Resources\ModelResource;

/**
 * @extends ModelResource<GoskeyRegistry>
 */
class GoskeyRegistryResource extends ModelResource
{
    protected string $model = GoskeyRegistry::class;

    protected string $title = 'GoskeyRegistries';

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('ID сообщения', 'message_id'),
            Text::make('Статус', 'status'),
            Json::make('Подписи', 'signatures')->fields([
                Position::make(),
                Url::make('Подпись', 'signature')->afterFill(
                    function(Url $ctx) {

                        if (is_string($ctx->toValue())) {
                            $ctx->setValue('/goskey/download/' . ltrim($ctx->toValue(), '/'));
                        }

                        return $ctx;
                    }
                ),
                Url::make('Файл', 'signed_file')->afterFill(
                    function(Url $ctx) {

                        if (is_string($ctx->toValue())) {
                            $ctx->setValue('/goskey/download/' . ltrim($ctx->toValue(), '/'));
                        }

                        return $ctx;
                    }
                ),
            ])
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
        ];
    }

    /**
     * @param GoskeyRegistry $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [];
    }
}

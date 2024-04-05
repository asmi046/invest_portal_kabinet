<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use MoonShine\Fields\ID;
use MoonShine\Fields\Text;

use MoonShine\Fields\Email;
use MoonShine\Fields\Phone;
use MoonShine\Decorations\Block;
use App\Models\OrganizationContact;
use MoonShine\Resources\ModelResource;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends ModelResource<OrganizationContact>
 */
class OrganizationContactResource extends ModelResource
{
    protected string $model = OrganizationContact::class;

    protected string $title = 'Список ресурсоснабжающих организаций';

    protected string $column = 'organization';

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Организация', 'organization')->required(),
                Text::make('Ответственный', 'person')->required(),
                Text::make('Должность', 'dolgnost')->hideOnIndex(),
                Phone::make('Телефон', 'phone')->required()->mask('+7(999)999-99-99'),
                Email::make('e-mail', 'email')->hideOnIndex(),
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}

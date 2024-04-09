<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\TechnicalConnects;

use MoonShine\Pages\Crud\DetailPage;

class TechnicalConnectsDetailPage extends DetailPage
{
    public function fields(): array
    {
        return [];
    }

    protected function topLayer(): array
    {
        return [
            ...parent::topLayer()
        ];
    }

    protected function mainLayer(): array
    {
        return [
            ...parent::mainLayer()
        ];
    }

    protected function bottomLayer(): array
    {
        return [
            ...parent::bottomLayer()
        ];
    }
}

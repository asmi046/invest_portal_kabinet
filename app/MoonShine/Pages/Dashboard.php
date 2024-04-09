<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use App\Models\AreaGet;
use App\Models\Project;
use App\Models\Support;
use MoonShine\Pages\Page;
use MoonShine\Decorations\Grid;
use App\Models\TechnicalConnects;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Divider;
use MoonShine\Decorations\Heading;
use MoonShine\Metrics\ValueMetric;
use MoonShine\Metrics\DonutChartMetric;

class Dashboard extends Page
{
    public function breadcrumbs(): array
    {
        return [
            '#' => $this->title()
        ];
    }

    public function title(): string
    {
        return $this->title ?: 'Сводка';
    }

    public function components(): array
	{
		return [


            Grid::make([
                DonutChartMetric::make('Всего')
                    ->values([
                        'Инвестиционные проекты' => Project::count(),
                        'Заявления на господдержку' => Support::count(),
                        'Заявления на предоставление земельного участка' => AreaGet::count(),
                        'Заявления на технологическое присоединение' => TechnicalConnects::count()
                    ])->columnSpan(12),

                ValueMetric::make("Инвестиционные проекты")
                    ->value(Project::count())
                    ->columnSpan(3),
                ValueMetric::make("Заявления на господдержку")
                    ->value(Support::count())
                    ->columnSpan(3),
                ValueMetric::make("Заявления на предоставление земельного участка")
                    ->value(AreaGet::count())
                    ->columnSpan(3),
                ValueMetric::make("Заявления на технологическое присоединение")
                    ->value(TechnicalConnects::count())
                    ->columnSpan(3),
            ]),
        ];
	}
}

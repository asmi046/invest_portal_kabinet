<?php

namespace App\MoonShine\Traits;

use Illuminate\Contracts\Database\Eloquent\Builder;

trait FiltersByUserRole
{
    protected function modifyQueryBuilder(Builder $builder): Builder
    {

        $role_name = auth()->user()->moonshineUserRole->name;

        if (in_array($role_name, ['Модератор портала', 'Ресурсные организации', 'Просмотр показателей'])) {

            return $builder->where('state', "На рассмотрении"); // Модераторы
        }

        if (in_array($role_name, ['Admin'])) {
             return $builder;
        }

        return $builder->where('id', 0); // Остальные - ничего не видят

    }
}

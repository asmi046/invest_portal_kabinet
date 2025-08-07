<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use MoonShine\Laravel\Models\MoonshineUser as BaseMoonshineUser;

class MoonshineUser extends BaseMoonshineUser
{
    protected static function boot()
    {
        parent::boot();

        // Добавляем дополнительные отношения к родительскому $with
        static::addGlobalScope('with_relations', function ($query) {
            $query->with(['documentTypes', 'organization']);
        });

        // Добавляем дополнительные поля к $fillable родителя
        static::retrieved(function ($model) {
            $model->fillable(array_merge($model->getFillable(), ['organization_id']));
        });
    }


    /**
     * Связь многие ко многим с типами документов
     */
    public function documentTypes(): BelongsToMany
    {
        return $this->belongsToMany(DocumentType::class);
    }

    /**
     * Обратная связь один ко многим с моделью Organization
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }
}

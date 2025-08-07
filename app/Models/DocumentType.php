<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DocumentType extends Model
{
    protected $fillable = [
        'name',
        'description',
        'model',
    ];

    /**
     * Приведение типов атрибутов
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Связь многие ко многим с пользователями MoonShine
     * Использует уникальный индекс 'unique_document_type_user' из миграции
     */
    public function moonshineUsers(): BelongsToMany
    {
        return $this->belongsToMany(MoonshineUser::class)->withTimestamps();
    }

    /**
     * Связь с этапами
     * Связь один ко многим
     */
    public function stages(): HasMany
    {
        return $this->hasMany(Stage::class)->orderBy('order');
    }
}

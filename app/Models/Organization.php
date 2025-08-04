<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organization extends Model
{
    use HasFactory;

    /**
     * Поля, которые можно массово заполнять
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'short_name',
        'phone',
        'email',
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
     * Связь с заявлениями
     * Связь один ко многим
     */
    public function declarations(): HasMany
    {
        return $this->hasMany(Declaration::class);
    }

    /**
     * Связь с доступными типами документов через промежуточную таблицу
     * Полиморфная связь один ко многим
     */
    public function documentTypes(): HasMany
    {
        return $this->hasMany(OrganizationDocumentType::class);
    }

    /**
     * Получить все доступные типы документов для организации
     * через полиморфную связь
     */
    public function getAvailableDocumentTypesAttribute()
    {
        return $this->documentTypes()->with('documentable')->get()
                    ->pluck('documentable');
    }
}

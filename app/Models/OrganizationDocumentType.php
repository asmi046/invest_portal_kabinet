<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class OrganizationDocumentType extends Model
{
    use HasFactory;

    /**
     * Название таблицы
     *
     * @var string
     */
    protected $table = 'organization_document_types';

    /**
     * Поля, которые можно массово заполнять
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'organization_id',
        'documentable_type',
        'documentable_id',
    ];

    /**
     * Приведение типов атрибутов
     *
     * @var array<string, string>
     */
    protected $casts = [
        'organization_id' => 'integer',
        'documentable_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Связь с организацией
     */
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    /**
     * Полиморфная связь с типом документа
     */
    public function documentable(): MorphTo
    {
        return $this->morphTo();
    }
}

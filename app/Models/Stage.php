<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stage extends Model
{
    use HasFactory;

    /**
     * Поля, которые можно массово заполнять
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'order',
        'description',
        'document_type_id',
    ];

    /**
     * Приведение типов атрибутов
     *
     * @var array<string, string>
     */
    protected $casts = [
        'order' => 'integer',
        'document_type_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Значения по умолчанию для атрибутов
     *
     * @var array
     */
    protected $attributes = [
        'order' => 0,
    ];

    /**
     * Связь с типом документа
     * Связь многие к одному
     */
    public function documentType(): BelongsTo
    {
        return $this->belongsTo(DocumentType::class);
    }

    /**
     * Scope для сортировки по порядку
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    /**
     * Scope для фильтрации по типу документа
     */
    public function scopeForDocumentType($query, $documentTypeId)
    {
        return $query->where('document_type_id', $documentTypeId);
    }
}

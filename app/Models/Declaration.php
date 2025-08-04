<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Declaration extends Model
{
    use HasFactory;

    /**
     * Поля, которые можно массово заполнять
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
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
        'user_id' => 'integer',
        'organization_id' => 'integer',
        'documentable_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Связь с пользователем (заявителем)
     * Связь один к одному
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Полиморфная связь с типами документов
     */
    public function documentable(): MorphTo
    {
        return $this->morphTo();
    }
}

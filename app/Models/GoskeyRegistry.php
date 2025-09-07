<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GoskeyRegistry extends Model
{
    protected $fillable = [
        'message_id',
        'is_ul',
        'short_identifier',
        'user_id',
        'document_type',
        'last_check_at',
        'status',
        'registryable_id',
        'registryable_type',
    ];

    protected $casts = [
        'message_id' => 'string',
        'last_check_at' => 'datetime',
    ];

    /**
     * Связь с пользователем
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function registryable()
    {
        return $this->morphTo();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoskeyQueueMessage extends Model
{
    protected $fillable = [
        'original_message_id',
        'message_id',
        'type',
        'error_code',
        'error_message',
        'temporary_code',
        'state_message',
    ];

    protected $casts = [
        'original_message_id' => 'string',
        'message_id' => 'string',
    ];
}

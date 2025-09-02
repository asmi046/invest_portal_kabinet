<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Statement extends Model
{
    protected $fillable = [
        'document_id',
        'document_type',
        'user_id',
    ];

    public function document()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'name',
        'user_id',
        'model',
        'model_id',
        'staus'
    ];
}

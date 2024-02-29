<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'sign',
        'name',
        'user_id',
        'document',
        'document_type',
        'model_id',
        'state'
    ];
}

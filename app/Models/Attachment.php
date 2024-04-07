<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    public $fillable = [
        'file',
        'file_real',
        'file_hash',
        'storage_patch',
        'inner_document_type',
        'document_id'
    ];
}

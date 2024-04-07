<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignedDocument extends Model
{
    use HasFactory;

    public $fillable = [
        'file_real',
        'file',
        'storage_patch',
        'signature',
        'file_hash',
        'inner_document_type',
        "document_id"
    ];
}

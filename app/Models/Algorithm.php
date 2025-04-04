<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Algorithm extends Model
{
    use HasFactory;

    public $fillable = [
        'title',
        'subtype',
        'group',
        'file',
    ];
}

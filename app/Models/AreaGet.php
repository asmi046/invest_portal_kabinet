<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaGet extends Model
{
    use HasFactory;

    public $fillable = [
        "user_id",
        "state",
        "name",
        "dolgnost",
        "phone",
        "organization",
        "object_name",
        "object_type",
        "prilogenie_list_count",
    ];
}

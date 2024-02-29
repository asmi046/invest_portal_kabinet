<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'state',
        'organization',
        'name',
        'invest_volume',
        'detail',
        'many_src',
        'time_relis',
        'npv',
        'irr',
        'time_prib',
        'worck_place_coun',
        'zp',
        'okved',
        'description',
    ];
}

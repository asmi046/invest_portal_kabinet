<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'state',
        'name',
        'target',
        'time_relis',
        'worck_place_coun',
        'relis_area',
        'invest_volume',
        'project_description',
        'erth_area_description',
        'prom_area_description',
        'dop_volume',
        'electro',
        'gaz',
        'gos_support',
        'gos_support_direction',
        'description'
    ];

    public function user()
    {
        return $this->hasOne(User::class,'id', 'user_id');
    }
}

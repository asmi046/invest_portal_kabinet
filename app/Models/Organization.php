<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organization extends Model
{
    use HasFactory;

    /**
     * Поля, которые можно массово заполнять
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'short_name',
        'phone',
        'email',
    ];

    /**
     * Получить пользователей, связанных с организацией.
     */
    public function moonshineUsers(): HasMany
    {
        return $this->hasMany(MoonshineUser::class);
    }
}

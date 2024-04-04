<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaGet extends Model
{
    use HasFactory;

    public $fillable = [
        "created_at",
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


    /**
     * user
     *
     * @return void
     */
    public function user()
    {
        return $this->hasOne(User::class, "id", "user_id");
    }


}

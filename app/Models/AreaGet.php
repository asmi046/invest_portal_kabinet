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
        "zayavitel_adress",
        "organization",
        "object_name",
        "object_type",
        "prilogenie_list_count",
    ];

    public $with = [
        'attachment',
        'signature'
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

    public function attachment() {
        return $this->hasMany(Attachment::class, 'document_id', 'id')
        ->where('inner_document_type', 'area_get');
    }

    public function signature() {
        return $this->hasOne(SignedDocument::class, 'document_id', 'id')
        ->where('inner_document_type', 'area_get');
    }

}

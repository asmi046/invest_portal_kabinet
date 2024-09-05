<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechnicalConnects extends Model
{
    use HasFactory;

    public $fillable = [
        "user_id",
        "state",
        "name",
        "dolgnost",
        "phone",
        "organization",
        "egrul",
        "adress",
        "okved",

        "project_name",
        "cadastr_number",
        "geo",
        "object_place_name",

        "safety_category",
        "point_count",
        "corporation_check",
        "resource_check",

        "osnovanie",
        "ustroistvo",
        "raspologeie",

        "pover_prin_devices",
        "napr_prin_devices",
        "pover_pris_devices",
        "napr_pris_devices",
        "pover_pris_r_devices",
        "napr_pris_r_devices",

        "plan_raspologenia",
        "pravo_sobstv",
        "perechen",
    ];

    protected $casts = [
        'etaps' => 'array',
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
        ->where('inner_document_type', 'tc');
    }

    public function signature() {
        return $this->hasOne(SignedDocument::class, 'document_id', 'id')
        ->where('inner_document_type', 'tc');
    }
}

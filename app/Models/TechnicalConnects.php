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

        "pasport_seria",
        "pasport_number",
        "pasport_vidan",

        "osnovanie",
        "ustroistvo",
        "raspologeie",

        "pover_prin_devices",
        "napr_prin_devices",
        "pover_pris_devices",
        "napr_pris_devices",
        "pover_pris_r_devices",
        "napr_pris_r_devices",
        "rashet_plati",
        "gen_postavhik",
        "prilogenie",
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

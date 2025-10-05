<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WaterConnection extends Model
{
    protected $fillable = [
        "user_id",
        "document_type",
        "validated",
        "editable",

        'supplier_org',
        'applicant_name',
        'address',
        'phone',
        'email',

        'object_name',
        'object_address',
        'object_description',

        'payload_all_snab',
        'payload_all_ot',
        'payload_hoz_snab',
        'payload_hoz_ot',
        'payload_prom_snab',
        'payload_prom_ot',
        'payload_fire_snab',
        'payload_fire_ot',
    ];

    protected $casts = [

    ];
}

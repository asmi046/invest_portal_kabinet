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

        'supplier_org','applicant_name','address','phone','email',
        'statement_applicant_name','object_name','object_address','object_description',
        'attachments',
        'last_name','first_name','middle_name','signature','application_date',
    ];

    protected $casts = [
        'application_date' => 'date',
    ];
}

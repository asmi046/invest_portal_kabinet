<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConstructionPermit extends Model
{
    protected $fillable = [
        'last_name', 'first_name', 'middle_name',
        'passport_name', 'passport_series', 'passport_number',
        'passport_issued_by', 'passport_issued_at', 'passport_code',
        'ogrnip', 'inn',

        'company_name', 'ogrn', 'inn_company',
        'director_last_name', 'director_first_name', 'director_middle_name',
        'director_passport_name', 'director_passport_series',
        'director_passport_number', 'director_passport_issued_by',
        'director_passport_issued_at', 'director_passport_code',

        'rep_last_name', 'rep_first_name', 'rep_middle_name',
        'rep_passport_name', 'rep_passport_series', 'rep_passport_number',
        'rep_passport_issued_by', 'rep_passport_issued_at', 'rep_passport_code',
        'rep_doc_name', 'rep_doc_number', 'rep_doc_issued_by', 'rep_doc_issued_at',

        'object_name', 'object_cadastral_number',
        'land_cadastral_number', 'land_docs',

        'document', 'document_number', 'document_date', 'attachment',
        'phone', 'email', 'result',
        'signature', 'initials',
    ];

    protected $casts = [
        'passport_issued_at' => 'date',
        'director_passport_issued_at' => 'date',
        'rep_passport_issued_at' => 'date',
        'rep_doc_issued_at' => 'date',
        'document_date' => 'date',
    ];
}

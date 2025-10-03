<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommissioningPermit extends Model
{
    protected $fillable = [

        "user_id",
        "document_type",
        "validated",
        "editable",

        'form_date','authority_name',
        'last_name','first_name','middle_name',
        'passport_name','passport_series','passport_number',
        'passport_issued_by','passport_issued_at','passport_code',
        'ogrnip','company_name','ogrn','inn_company',
        'object_name','object_address','land_cadastral_number',
        'permit_index','permit_authority','permit_number','permit_date',
        'previous_permit_index','previous_permit_authority',
        'previous_permit_number','previous_permit_date',
        'doc_index','doc_name','doc_number','doc_date','doc_attachment',
        'phone','email',
        'result_portal','result_mfc','result_mail',
        'sign_last_name','sign_first_name','sign_middle_name','signature',
    ];

    protected $casts = [
        'form_date' => 'date',
        'passport_issued_at' => 'date',
        'permit_date' => 'date',
        'previous_permit_date' => 'date',
        'doc_date' => 'date',
    ];
}

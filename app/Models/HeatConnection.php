<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeatConnection extends Model
{
    protected $fillable = [
        "user_id",
        "document_type",
        "validated",
        "editable",

        'organization_name','legal_address','postal_address','phone_fax',
        'bank_name','account_number','correspondent_account','bik','inn_kpp','egrul_number',
        'object_name','object_address',
        'heat_pressure','heat_temperature','has_meter','consumption_mode',
        'reliability_category','has_own_source','commissioning_year',
        'land_usage_info','construction_limits',
        'attachments',
        'last_name','first_name','middle_name',
        'contact_phone','position','signature','application_date',
    ];

    protected $casts = [
        'heat_pressure' => 'decimal:2',
        'heat_temperature' => 'decimal:2',
        'has_meter' => 'boolean',
        'has_own_source' => 'boolean',
        'commissioning_year' => 'integer',
        'application_date' => 'date',
    ];

}

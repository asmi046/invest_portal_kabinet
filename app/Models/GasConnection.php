<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GasConnection extends Model
{
    protected $fillable = [
        "user_id",
        "document_type",
        "validated",
        "editable",

        'full_name','short_name','last_name','first_name','middle_name',
        'residence','postal_address','passport_name','passport_series',
        'passport_number','passport_issued_by','passport_issued_at','passport_code',
        'egrul_number','egrip_number','registry_date',
        'contact_info','land_doc_date','land_doc_number','reason',
        'object_name','object_address',
        'need_on_land','need_design','need_equipment_installation',
        'need_pipeline_construction','need_meter_installation',
        'need_meter_supply','need_equipment_supply',
        'gas_flow_total','gas_flow_new','gas_flow_existing','planned_date',
        'connection_point','connection_planned_date',
        'connection_flow_total','connection_flow_new','connection_flow_existing',
        'consumption_type','previous_tech_number','previous_tech_date',
        'additional_info','notification_method','attachments',
        'applicant_last_name','applicant_first_name','applicant_middle_name',
        'applicant_phone','applicant_position','applicant_signature','applicant_date',
    ];

    protected $casts = [
        'passport_issued_at' => 'date',
        'registry_date' => 'date',
        'land_doc_date' => 'date',
        'planned_date' => 'date',
        'connection_planned_date' => 'date',
        'gas_flow_total' => 'decimal:2',
        'gas_flow_new' => 'decimal:2',
        'gas_flow_existing' => 'decimal:2',
        'connection_flow_total' => 'decimal:2',
        'connection_flow_new' => 'decimal:2',
        'connection_flow_existing' => 'decimal:2',
        'need_on_land' => 'boolean',
        'need_design' => 'boolean',
        'need_equipment_installation' => 'boolean',
        'need_pipeline_construction' => 'boolean',
        'need_meter_installation' => 'boolean',
        'need_meter_supply' => 'boolean',
        'need_equipment_supply' => 'boolean',
        'applicant_date' => 'date',
    ];
}

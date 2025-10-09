<?php

namespace App\Models;

use App\Services\CreateDocServices;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class GasConnection extends Model
{

    protected $fillable = [
        'user_id',
        'document_type',
        'validated',
        'editable',
        'state',
        'applicant_name',
        'applicant_ogrn',
        'applicant_ogrn_data',
        'applicant_address',
        'applicant_passport_data',
        'applicant_connect_variants',
        'phone',
        'email',
        'land_docs',
        'reason',
        'object_name',
        'object_address',
        'need_any_works',
        'need_design',
        'need_equipment_installation',
        'need_pipeline_construction',
        'need_meter_installation',
        'need_meter_supply',
        'need_equipment_supply',
        'gas_flow_total',
        'gas_flow_new',
        'gas_flow_existing',
        'planned_date',
        'connection_point',
        'connection_planned_date',
        'connection_flow_total',
        'connection_flow_new',
        'connection_flow_existing',
        'consumption_type',
        'previous_tech_number',
        'previous_tech_date',
        'additional_info',
        'notification_method',
    ];

    protected $casts = [
        'validated' => 'boolean',
        'editable' => 'boolean',
        'need_any_works' => 'boolean',
        'need_design' => 'boolean',
        'need_equipment_installation' => 'boolean',
        'need_pipeline_construction' => 'boolean',
        'need_meter_installation' => 'boolean',
        'need_meter_supply' => 'boolean',
        'need_equipment_supply' => 'boolean',
        'gas_flow_total' => 'decimal:2',
        'gas_flow_new' => 'decimal:2',
        'gas_flow_existing' => 'decimal:2',
        'connection_flow_total' => 'decimal:2',
        'connection_flow_new' => 'decimal:2',
        'connection_flow_existing' => 'decimal:2',
        'connection_point' => 'integer',
    ];

    protected $with = [
        'attachment',
        'documentType',
    ];

    public function print() {
        $document = new CreateDocServices();
        $options = $this->getOriginal();

        $options['dey'] = date('d');
        $options['month'] = get_month(date('m'));
        $options['year'] = date('Y');

        $fn = $document->create_tmp_document_html(
            public_path('documents_template/GasConnection.html'),
            $options,
            $this->id,
            'GasConnection',
            "Заявление на техническое присоединение к объектам газораспределения: " . $this->object_name
        );

        return $fn["url"];
    }

    protected function plannedDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($value) ? date("d.m.Y", strtotime($value)) : null,
            set: fn ($value) => ($value) ? date("Y-m-d", strtotime($value)) : null,
        );
    }

    protected function connectionPlannedDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($value) ? date("d.m.Y", strtotime($value)) : null,
            set: fn ($value) => ($value) ? date("Y-m-d", strtotime($value)) : null,
        );
    }

    public function goskeyRegistries()
    {
        return $this->morphMany(GoskeyRegistry::class, 'registryable');
    }

    public function user()
    {
        return $this->hasOne(User::class, "id", "user_id");
    }

    public function documentType()
    {
        return $this->belongsTo(DocumentType::class, 'document_type', 'id');
    }

    public function attachment() {
        return $this->hasMany(Attachment::class, 'document_id', 'id')
        ->where('inner_document_type', self::class);
    }
}

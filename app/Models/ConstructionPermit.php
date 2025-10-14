<?php

namespace App\Models;

use App\Services\CreateDocServices;
use App\Services\GetSignDataService;
use Illuminate\Database\Eloquent\Model;

class ConstructionPermit extends Model
{
    protected $fillable = [
        'user_id',
        'document_type',
        'validated',
        'editable',
        'state',
        'supplier_org',
        'applicant_name',
        'applicant_passport_data',
        'applicant_ogrn',
        'applicant_inn',
        'applicant_company_name',
        'applicant_company_passport_data',
        'applicant_company_ogrn',
        'applicant_company_inn',
        'applicant_predst_name',
        'applicant_predst_passport_data',
        'applicant_predst_ogrn',
        'applicant_predst_inn',
        'rep_doc_issued_at',
        'object_name',
        'object_cadastral_number',
        'land_cadastral_number',
        'land_docs',
        'doc_name',
        'doc_number',
        'doc_date',
        'phone',
        'email',
        'send_result_type',
        'send_mfc_adress',
        'attention_details',
    ];

    protected $casts = [
        'validated' => 'boolean',
        'editable' => 'boolean',
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


        $getSignDataService = new GetSignDataService();
        $signData = $getSignDataService->getSignData($this);
        $options = array_merge($options, $signData);

        $fn = $document->create_tmp_document_html(
            public_path('documents_template/ConstructionPermit.html'),
            $options,
            $this->id,
            'ConstructionPermit',
            "Разрешение на строительство в рамках реализации инвестиционного проекта: " . $this->object_name
        );

        return $fn["url"];
    }

    protected function docDate(): Attribute
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

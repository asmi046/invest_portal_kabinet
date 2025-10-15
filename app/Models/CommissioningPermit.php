<?php

namespace App\Models;

use App\Services\CreateDocServices;
use App\Services\GetSignDataService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommissioningPermit extends Model
{
    protected $fillable = [
        // Системные поля
        "user_id",
        "document_type",
        "validated",
        "editable",
        "state",

        // Уполномоченный орган
        'supplier_org',

        // Сведения о заявителе
        'applicant_type',
        'applicant_name',
        'applicant_ogrn',
        'applicant_inn',
        'applicant_passport_data',

        // Сведения об объекте
        'object_name',
        'object_address',

        // Земельный участок
        'land_cadastral_number',

        // Разрешение на строительство
        'permit_authority',
        'permit_number',
        'permit_date',

        // Ранее выданные разрешения
        'previous_permit_authority',
        'previous_permit_number',
        'previous_permit_date',

        // Ввод объекта на основании документов
        'doc_name',
        'doc_number',
        'doc_date',

        // Контакты
        'phone',
        'email',

        // Результат предоставления услуги
        'send_result_type',
        'send_mfc_adress',
        'send_post_adress',
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
            public_path('documents_template/CommissioningPermit.html'),
            $options,
            $this->id,
            'CommissioningPermit',
            "Заявление на техническое присоединение к объектам водоснабжения и водоотведения: " . $this->object_name
        );

        return $fn["url"];
    }

    protected function permit_date(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($value)?date("d.m.Y", strtotime($value)):null,
            set: fn ($value) => ($value)?date("Y-m-d", strtotime($value)):null,
        );
    }

    protected function previous_permit_date(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($value)?date("d.m.Y", strtotime($value)):null,
            set: fn ($value) => ($value)?date("Y-m-d", strtotime($value)):null,
        );
    }

    protected function doc_date(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($value)?date("d.m.Y", strtotime($value)):null,
            set: fn ($value) => ($value)?date("Y-m-d", strtotime($value)):null,
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

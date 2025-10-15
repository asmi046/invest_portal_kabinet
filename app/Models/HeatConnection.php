<?php

namespace App\Models;

use App\Services\CreateDocServices;
use App\Services\GetSignDataService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class HeatConnection extends Model
{

    protected $fillable = [
        'user_id',
        'document_type',
        'validated',
        'editable',
        'state',
        'supplier_org',
        'applicant_name',
        'applicant_address_ur',
        'applicant_address_post',
        'applicant_phone',
        'applicant_bank_name',
        'applicant_bank_rs',
        'applicant_bank_ks',
        'applicant_bank_bik',
        'applicant_ogrn',
        'applicant_inn_kpp',
        'object_name',
        'object_address',
        'teplovaya_nagruzka_vsego_chasovaya_maksimalnaya',
        'teplovaya_nagruzka_vsego_chasovaya_minimalnaya',
        'teplovaya_nagruzka_vsego_srednechasovaya_maksimalnaya',
        'teplovaya_nagruzka_vsego_srednechasovaya_minimalnaya',
        'raskhod_teplonositelya_vsego_rashetnyi',
        'raskhod_teplonositelya_vsego_srednechasovoy',
        'teplovaya_nagruzka_otoplenie_chasovaya_maksimalnaya',
        'teplovaya_nagruzka_otoplenie_chasovaya_minimalnaya',
        'teplovaya_nagruzka_otoplenie_srednechasovaya_maksimalnaya',
        'teplovaya_nagruzka_otoplenie_srednechasovaya_minimalnaya',
        'raskhod_teplonositelya_otoplenie_rashetnyi',
        'raskhod_teplonositelya_otoplenie_srednechasovoy',
        'teplovaya_nagruzka_ventilyatsia_chasovaya_maksimalnaya',
        'teplovaya_nagruzka_ventilyatsia_chasovaya_minimalnaya',
        'teplovaya_nagruzka_ventilyatsia_srednechasovaya_maksimalnaya',
        'teplovaya_nagruzka_ventilyatsia_srednechasovaya_minimalnaya',
        'raskhod_teplonositelya_ventilyatsia_rashetnyi',
        'raskhod_teplonositelya_ventilyatsia_srednechasovoy',
        'teplovaya_nagruzka_gorvoda_chasovaya_maksimalnaya',
        'teplovaya_nagruzka_gorvoda_chasovaya_minimalnaya',
        'teplovaya_nagruzka_gorvoda_srednechasovaya_maksimalnaya',
        'teplovaya_nagruzka_gorvoda_srednechasovaya_minimalnaya',
        'raskhod_teplonositelya_gorvoda_rashetnyi',
        'raskhod_teplonositelya_gorvoda_srednechasovoy',
        'heat_pressure',
        'heat_temperature',
        'has_meter_control',
        'consumption_mode',
        'reliability_category',
        'has_own_source',
        'commissioning_year',
        'land_usage_info',
        'construction_limits',
        'attachments_list',
        'attachments_ekz',
    ];

    protected $casts = [
        'validated' => 'boolean',
        'editable' => 'boolean',
        'heat_pressure' => 'decimal:2',
        'heat_temperature' => 'decimal:2',
        'commissioning_year' => 'integer',
        'attachments_list' => 'integer',
        'attachments_ekz' => 'integer',
        // Все double поля для тепловых нагрузок
        'teplovaya_nagruzka_vsego_chasovaya_maksimalnaya' => 'double',
        'teplovaya_nagruzka_vsego_chasovaya_minimalnaya' => 'double',
        'teplovaya_nagruzka_vsego_srednechasovaya_maksimalnaya' => 'double',
        'teplovaya_nagruzka_vsego_srednechasovaya_minimalnaya' => 'double',
        'raskhod_teplonositelya_vsego_rashetnyi' => 'double',
        'raskhod_teplonositelya_vsego_srednechasovoy' => 'double',
        'teplovaya_nagruzka_otoplenie_chasovaya_maksimalnaya' => 'double',
        'teplovaya_nagruzka_otoplenie_chasovaya_minimalnaya' => 'double',
        'teplovaya_nagruzka_otoplenie_srednechasovaya_maksimalnaya' => 'double',
        'teplovaya_nagruzka_otoplenie_srednechasovaya_minimalnaya' => 'double',
        'raskhod_teplonositelya_otoplenie_rashetnyi' => 'double',
        'raskhod_teplonositelya_otoplenie_srednechasovoy' => 'double',
        'teplovaya_nagruzka_ventilyatsia_chasovaya_maksimalnaya' => 'double',
        'teplovaya_nagruzka_ventilyatsia_chasovaya_minimalnaya' => 'double',
        'teplovaya_nagruzka_ventilyatsia_srednechasovaya_maksimalnaya' => 'double',
        'teplovaya_nagruzka_ventilyatsia_srednechasovaya_minimalnaya' => 'double',
        'raskhod_teplonositelya_ventilyatsia_rashetnyi' => 'double',
        'raskhod_teplonositelya_ventilyatsia_srednechasovoy' => 'double',
        'teplovaya_nagruzka_gorvoda_chasovaya_maksimalnaya' => 'double',
        'teplovaya_nagruzka_gorvoda_chasovaya_minimalnaya' => 'double',
        'teplovaya_nagruzka_gorvoda_srednechasovaya_maksimalnaya' => 'double',
        'teplovaya_nagruzka_gorvoda_srednechasovaya_minimalnaya' => 'double',
        'raskhod_teplonositelya_gorvoda_rashetnyi' => 'double',
        'raskhod_teplonositelya_gorvoda_srednechasovoy' => 'double',
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
            public_path('documents_template/HeatConnection.html'),
            $options,
            $this->id,
            'HeatConnection',
            "Заявление на техническое присоединение к объектам теплоснабжения : " . $this->object_name
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

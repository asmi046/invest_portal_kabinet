<?php

namespace App\Models;

use App\Services\CreateDocServices;
use App\Services\GetSignDataService;
use Illuminate\Database\Eloquent\Model;

class WaterConnection extends Model
{
    protected $fillable = [
        "user_id",
        "document_type",
        "validated",
        "editable",
        "state",

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

    protected $with = [
        'attachment',
        'documentType',
        'signature'
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
            public_path('documents_template/WaterConnection.html'),
            $options,
            $this->id,
            'WaterConnection',
            "Заявление на техническое присоединение к объектам водоснабжения и водоотведения: " . $this->object_name
        );

        return $fn["url"];
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

    public function signature() {
        return $this->hasOne(SignedDocument::class, 'document_id', 'id')
        ->where('inner_document_type', self::class);
    }
}

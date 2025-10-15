<?php

namespace App\Models;

use App\Services\CreateDocServices;
use App\Services\GetSignDataService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TechnicalConnects extends Model
{
    use HasFactory;

    public $fillable = [
        "user_id",
        "document_type",
        "validated",
        "editable",
        "state",
        "name",
        "dolgnost",
        "phone",
        "organization",
        "egrul",
        "adress",
        "okved",

        "project_name",
        "cadastr_number",
        "geo",
        "object_place_name",

        "safety_category",
        "point_count",
        "corporation_check",
        "resource_check",

        "osnovanie",
        "ustroistvo",
        "raspologeie",

        "pover_prin_devices",
        "napr_prin_devices",
        "pover_pris_devices",
        "napr_pris_devices",
        "pover_pris_r_devices",
        "napr_pris_r_devices",

        "plan_raspologenia",
        "pravo_sobstv",
        "perechen",
    ];

    protected $casts = [
        'etaps' => 'array',
    ];


    public $with = [
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
            public_path('documents_template/TechnicalConnect.html'),
            $options,
            $this->id,
            'TechnicalConnects',
            "Заявление на технологическое присоединение к электрическим сетям: " . $this->object_name
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

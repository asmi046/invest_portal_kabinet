<?php

namespace App\Models;

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


    public function print() {
        $document = new CreateDocServices();
        $options = $this->getOriginal();

        $options['dey'] = date('d');
        $options['month'] = get_month(date('m'));
        $options['year'] = date('Y');

        $fn = $document->create_tmp_document(
            public_path('documents_template/area_get.docx'),
            $options,
            $this->id,
            'area_get',
            "Заявление на предоставление участка: " . $this->object_name
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
        return $this->belongsTo(DocumentType::class);
    }

    public function attachment() {
        return $this->hasMany(Attachment::class, 'document_id', 'id')
        ->where('inner_document_type', self::class);
    }
}

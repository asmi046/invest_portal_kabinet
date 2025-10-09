<?php

namespace App\Models;

use App\Services\CreateDocServices;
use Illuminate\Database\Eloquent\Model;

class LandAuctionApplication extends Model
{


    protected $fillable = [
        'user_id',
        'document_type',
        'validated',
        'editable',
        'state',
        'supplier_org',
        'applicant_name',
        'applicant_ogrn',
        'applicant_inn',
        'applicant_address',
        'person',
        'person_dover',
        'phone',
        'email',
        'post_address',
        'land_cadastral_number',
        'landmarks',
        'area',
        'purpose',
    ];

    protected $casts = [
        'validated' => 'boolean',
        'editable' => 'boolean',
        'area' => 'decimal:2',
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
            public_path('documents_template/LandAuctionApplication.html'),
            $options,
            $this->id,
            'LandAuctionApplication',
            "Заявление о проведении аукциона по продаже земельного участка, находящегося в государственной собственности: " . $this->object_name
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

}

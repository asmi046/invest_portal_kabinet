<?php

namespace App\Models;

use App\Models\AreaGet;
use App\Services\CreateDocServices;
use App\Services\GetSignDataService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AreaGet extends Model
{
    use HasFactory;

    public $fillable = [
        "created_at",
        "user_id",
        "document_type",
        "validated",
        "editable",
        "state",
        "name",
        "dolgnost",
        "phone",
        "zayavitel_adress",
        "organization",
        "object_name",
        "object_type",
        "prilogenie_list_count",
    ];

    public $with = [
        'attachment',
        'documentType',
        'signature'
    ];

    protected $attributes = [
        'document_type' => AreaGet::class,
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
            public_path('documents_template/AreaGet.html'),
            $options,
            $this->id,
            'AreaGet',
            "Заявление на выделение земельного участка: " . $this->object_name
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

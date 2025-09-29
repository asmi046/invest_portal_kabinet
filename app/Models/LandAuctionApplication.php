<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandAuctionApplication extends Model
{

    protected $fillable = [
        'company_name',
        'ogrn',
        'inn',
        'address',
        'position',
        'representative_name',
        'document_name',
        'document_details',
        'postal_address',
        'phone',
        'email',
        'auction_cadastral_number',
        'landmarks',
        'area',
        'purpose',
        'consent_confirmation',
        'signature',
        'initials',
        'application_date',
    ];

    protected $casts = [
        'area' => 'decimal:2',
        'application_date' => 'date',
    ];
}

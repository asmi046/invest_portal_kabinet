<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandLeaseApplication extends Model
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
        'cadastral_number',
        'area',
        'lease_term',
        'landmarks',
        'purpose',
        'legal_basis',
        'preliminary_decision',
        'planning_decision',
        'withdrawal_decision',
        'consent_confirmation',
        'signature',
        'initials',
        'application_date'
    ];

    protected $casts = [
        'area' => 'decimal:2',
        'lease_term' => 'date',
        'application_date' => 'date'
    ];
}

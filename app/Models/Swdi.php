<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Swdi extends Model
{
    use HasFactory;

    protected $table = 'swdi'; // Set explicitly if not plural

    protected $fillable = [
        'hhid',
        'grantee_fname',
        'grantee_mname',
        'grantee_lname',
        'grantee_ename',
        'religion',
        'ip_membership',
        'region',
        'province',
        'city_municipality',
        'barangay',
        'purok_street',
    ];

    /**
     * Reverse relationship: optional
     */
    public function beneficiary()
    {
        return $this->belongsTo(Beneficiary::class, 'hhid', 'hhid');
    }
    public function familyMembers()
{
    return $this->hasMany(SwdiFamilyComposition::class, 'swdi_entry_id', 'id');
}
}

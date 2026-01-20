<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Beneficiary extends Model
{
    use HasFactory;

    protected $fillable = [
        'hhid',
        'firstName',
        'middleName',
        'lastName',
        'extName',
        'age',
        'address',
    ];

    /**
     * Relationship to the SWDI record via hhid
     */
    public function swdi()
    {
        return $this->hasOne(Swdi::class, 'hhid', 'hhid');
    }

    /**
     * Get family members through the SWDI entry
     */
    public function getFamilyMembersAttribute()
    {
        return $this->swdi ? $this->swdi->familyMembers : collect();
    }
    public function familyMembers()
    {
        return $this->hasMany(SwdiFamilyComposition::class, 'hhid', 'hhid');
    }

}

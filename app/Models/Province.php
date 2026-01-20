<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    // Fillable columns
    protected $fillable = [
        'name',
        'region_id',
    ];

    /**
     * Get the region that owns the province
     */
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * Optional: define relationship to cities
     */
    public function cities()
    {
        return $this->hasMany(City::class);
    }
}

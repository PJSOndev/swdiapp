<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    // Fillable columns
    protected $fillable = [
        'name',
    ];

    /**
     * Get the provinces that belong to this region
     */
    public function provinces()
    {
        return $this->hasMany(Province::class);
    }
}

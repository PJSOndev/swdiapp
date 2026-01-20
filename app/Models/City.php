<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'name',
        'id',
        'psgc', // make sure this column exists in your migration
    ];

    // Optional: relationship to province
    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}

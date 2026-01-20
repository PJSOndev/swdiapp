<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NutritionalStatusChild extends Model
{
    use HasFactory;

    protected $table = 'nutritional_status_of_children_five_year_and_below';

    protected $fillable = [
        'hhid',
        'lowb',
        'code',
        'level',
        'swdi_entry_id',
        'weight',
        'age_month',
    ];
}

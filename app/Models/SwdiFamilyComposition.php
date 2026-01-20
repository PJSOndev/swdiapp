<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SwdiFamilyComposition extends Model
{
    protected $table = 'tbl_sfc';
    protected $guarded = [];


public function getFamilyMembers($hhid)
{
    $members = SwdiFamilyComposition::where('sfc_hhid', $hhid)->get();

    return response()->json($members);
}

}

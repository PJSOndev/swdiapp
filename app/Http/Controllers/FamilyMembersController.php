<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beneficiary;
use App\Models\SwdiFamilyComposition;

class FamilyMembersController extends Controller
{
    public function editGIS($id)
    {
        $beneficiary = Beneficiary::findOrFail($id);
        return view('beneficiaries.edit_gis', compact('beneficiary'));
    }

    // AJAX endpoint
    public function getFamilyComposition($id)
    {
        $beneficiary = Beneficiary::findOrFail($id);
        $familyMembers = SwdiFamilyComposition::where('hhid', $beneficiary->hhid)->get();

        return response()->json([
            'familyMembers' => $familyMembers
        ]);
    }
}

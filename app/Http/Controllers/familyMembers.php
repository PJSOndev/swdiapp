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

        $familyMembers = SwdiFamilyComposition::where('hhid', $beneficiary->hhid)->get();

        return view('beneficiaries.edit_gis', compact('beneficiary', 'familyMembers'));
    }
    public function getFamilyMembers($id)
    {
        $beneficiary = Beneficiary::with('swdi.familyMembers')->findOrFail($id);

        if (!$beneficiary->swdi) {
            return response()->json(['familyMembers' => []]);
        }

        return response()->json([
            'familyMembers' => $beneficiary->swdi->familyMembers
        ]);
    }


}

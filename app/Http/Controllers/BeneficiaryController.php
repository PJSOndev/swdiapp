<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use App\Models\Beneficiary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SwdiFamilyComposition;

class BeneficiaryController extends Controller
{
    /**
     * Show raw list from SWDI table.
     */
    public function index()
    {
        $swdiList = DB::table('swdi')->select(
            'id',
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
            'created_at',
            'updated_at'
        )->get();

        return view('your-view-name', compact('swdiList'));
    }

    /**
     * Show merged table of Beneficiaries and their SWDI info.
     */
    public function showTables(Request $request)
    {
        $query = Beneficiary::with('swdi');

        if ($request->has('search') && $request->search !== null) {
            $searchTerm = $request->search;

            $query->where(function ($q) use ($searchTerm) {
                $q->where('firstName', 'like', '%' . $searchTerm . '%')
                  ->orWhere('lastName', 'like', '%' . $searchTerm . '%')
                  ->orWhere('hhid', 'like', '%' . $searchTerm . '%');
            });
        }

        $beneficiaries = $query->paginate(10);

        return view('pages.tables', compact('beneficiaries'));
    }
    public function show($id)
    {
        $beneficiary = Beneficiary::findOrFail($id);
        return response()->json($beneficiary);
    }
    /**
     * Store a newly created beneficiary in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'hhid' => 'nullable|string|max:255',
            'firstName' => 'required|string|max:255',
            'middleName' => 'nullable|string|max:255',
            'lastName' => 'required|string|max:255',
            'extName' => 'nullable|string|max:50',
            'age' => 'required|integer|min:0',
            'address' => 'required|string|max:255',
        ]);

        Beneficiary::create($validated);

        return redirect()->back()->with('success', 'Beneficiary added successfully!');
    }

    /**
     * Update an existing beneficiary.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:beneficiaries,id',
            'firstName' => 'required|string|max:255',
            'middleName' => 'nullable|string|max:255',
            'lastName' => 'required|string|max:255',
            'extName' => 'nullable|string|max:50',
            'age' => 'required|integer',
            'address' => 'required|string|max:255',
        ]);

        $beneficiary = Beneficiary::findOrFail($validated['id']);
        $beneficiary->update($validated);

        return redirect()->back()->with('success', 'Beneficiary updated successfully.');
    }

    /**
     * Export beneficiaries as a .dat text file.
     */
    public function exportList()
    {
        $beneficiaries = Beneficiary::select(
            'hhid',
            'firstName',
            'middleName',
            'lastname',
            'extName',
            'age',
            'address'
        )->get();

        $content = "hhid,First Name,Middle Name,Last Name,Ext Name,Age,Address\n";

        foreach ($beneficiaries as $b) {
            $content .= "{$b->hhid},{$b->firstName},{$b->middleName},{$b->lastname},{$b->extName},{$b->age},{$b->address}\n";
        }

        $filename = "beneficiary_list_" . now()->format('Ymd_His') . ".dat";

        return Response::make($content, 200, [
            'Content-Type' => 'text/plain',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ]);
    }
    public function getFamilyMembers($hhid)
    {
        // old code probably like this 👇
        // $members = Beneficiary::where('hhid', $hhid)->get();

        // ✅ Replace with this:
        $members = \App\Models\SwdiFamilyComposition::where('sfc_hhid', $hhid)
            ->orderBy('sfc_line_number')
            ->get();

        return response()->json($members);
    }



    public function getEmployableSkills($hhid)
    {
        try {
            $skills = DB::table('tbl_emp_skills')
                ->where('es_hhid', $hhid)
                ->select(
                    'es_swdi_entry_id as swdi_entry_id',
                    'es_level as level',
                    'es_code as code'
                )
                ->get();

            return response()->json($skills);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getEmployment($hhid)
    {
        try {
            $employment = DB::table('tbl_emp')
                ->where('emp_hhid', $hhid)
                ->select(
                    'emp_swdi_entry_id as swdi_entry_id',
                    'emp_occupation as occupation',
                    'emp_level as level',
                    'emp_code as code'
                )
                ->get();

            return response()->json($employment);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function getIncome($hhid)
    {
        try {
            $income = DB::table('income')
                ->where('inc_hhid', $hhid)
                ->select(
                    'inc_level as level',
                    'inc_code as code'
                )
                ->get();

            return response()->json($income);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function getSocialSec($hhid)
    {
        try {
            $social = DB::table('social_security as ss')
                ->where('ss.ss_hhid', $hhid)
                ->select(
                    'ss.ss_level as level',
                    'ss.ss_code as code'
                )
                ->get();

            return response()->json($social);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function getAccessibilityHealth($hhid)
    {
        try {
            $records = DB::table('tbl_ifmfa as a')
                ->where('a.ifmfa_hhid', $hhid)
                ->select(
                    'a.ifmfa_level as level',
                    'a.ifmfa_code as code'
                )
                ->get();

            return response()->json($records);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getHealthCondition($hhid)
    {
        try {
            $records = DB::table('tbl_hcfm as h')
                ->where('h.hcfm_hhid', $hhid)
                ->select(
                    'h.hcfm_level as level',
                    'h.hcfm_code as code'
                )
                ->get();

            return response()->json($records);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getNumberMeals($hhid)
{
    try {
        $meals = DB::table('tbl_num_meals')
            ->where('meal_hhid', $hhid)
            ->select('meal_level as level', 'meal_code as code')
            ->get();

        return response()->json($meals);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
public function getNutritionalStatusChildren($hhid)
{
    try {
        $children = DB::table('tbl_nscfyb')
            ->where('nscfyb_hhid', $hhid)
            ->select(
                'nscfyb_swdi_entry_id as swdi_entry_id',
                'nscfyb_weight as weight',
                'nscfyb_age_month as age_month',
                'nscfyb_level as level',
                'nscfyb_code as code'
            )
            ->get();

        return response()->json($children);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
public function getFamilyAccessToSafeDrinkingWater($hhid)
{
    try {
        $records = DB::table('tbl_fasdw')
            ->where('fasdw_hhid', $hhid)
            ->select('fasdw_level as level', 'fasdw_code as code')
            ->get();

        return response()->json($records);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

public function getFamilyAccessToSanitaryToilet($hhid)
{
    try {
        $records = DB::table('tbl_fastf')
            ->where('fastf_hhid', $hhid)
            ->select('fastf_level as level', 'fastf_code as code')
            ->get();

        return response()->json($records);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

public function getFamilyGarbageDisposalPractice($hhid)
{
    try {
        $records = DB::table('tbl_mcfpgd')
            ->where('mcfpgd_hhid', $hhid)
            ->select('mcfpgd_level as level', 'mcfpgd_code as code')
            ->get();

        return response()->json($records);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
public function getConstructionMaterialsOfTheRoof($hhid)
{
    try {
        $records = DB::table('tbl_cmr')
            ->where('crm_hhid', $hhid)
            ->select('crm_level as level', 'crm_code as code')
            ->get();

        return response()->json($records);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

public function getConstructionMaterialsOfTheOuterWalls($hhid)
{
    try {
        $records = DB::table('tbl_cmow')
            ->where('cmow_hhid', $hhid)
            ->select('cmow_level as level', 'cmow_code as code')
            ->get();

        return response()->json($records);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

public function getTenureStatusOfHousingUnit($hhid)
{
    try {
        $records = DB::table('tbl_tshu')
            ->where('tshu_hhid', $hhid)
            ->select('tshu_level as level', 'tshu_code as code')
            ->get();

        return response()->json($records);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

public function getLightingFacilityOfTheHouse($hhid)
{
    try {
        $records = DB::table('tbl_lfth')
            ->where('lfth_hhid', $hhid)
            ->select('lfth_level as level', 'lfth_code as code')
            ->get();

        return response()->json($records);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
public function getFunctionalLiteracy($hhid)
{
    $flEntryIds = DB::table('tbl_flfmtyo')
        ->where('flfmtyo_hhid', $hhid)
        ->whereNotNull('flfmtyo_swdi_entry_id')
        ->pluck('flfmtyo_swdi_entry_id')
        ->toArray();

    if (empty($flEntryIds)) {
        return response()->json([]);
    }

    $data = DB::table('tbl_sfc as sfc')
        ->join('tbl_flfmtyo as fl', 'sfc.sfc_swdi_entry_id', '=', 'fl.flfmtyo_swdi_entry_id')
        ->select(
            'sfc.id as member_id',
            DB::raw("TRIM(CONCAT(
                COALESCE(sfc.sfc_grantee_fname, ''), ' ',
                COALESCE(sfc.sfc_grantee_mname, ''), ' ',
                COALESCE(sfc.sfc_grantee_lname, ''), ' ',
                COALESCE(sfc.sfc_grantee_ename, '')
            )) as full_name"),
            'fl.flfmtyo_level as level',
            'fl.flfmtyo_code as code'
        )
        ->where('sfc.sfc_hhid', $hhid)
        ->whereIn('sfc.sfc_swdi_entry_id', $flEntryIds)
        ->get();

    return response()->json($data);
}
public function getSeaData($hhid)
{
    $data = DB::table('tbl_sea as sea')
        ->join('tbl_sfc as sfc', 'sfc.sfc_swdi_entry_id', '=', 'sea.sea_swdi_entry_id')
        ->select(
            'sea.id',
            'sea.sea_hhid',
            'sea.sea_lowb',
            'sea.sea_code',
            'sea.sea_level',
            'sea.sea_swdi_entry_id',
            'sea.sea_age',
            'sea.created_at',
            DB::raw("TRIM(CONCAT(
                COALESCE(sfc.sfc_grantee_fname, ''), ' ',
                COALESCE(sfc.sfc_grantee_mname, ''), ' ',
                COALESCE(sfc.sfc_grantee_lname, ''), ' ',
                COALESCE(sfc.sfc_grantee_ename, '')
            )) as full_name"),
            DB::raw("'N/A' as school") // placeholder column for now
        )
        ->where('sea.sea_hhid', $hhid)
        ->get();

    return response()->json($data);
}
public function getFamilyFunctioning($hhid)
{
    // Involvement of family members in family activities
    $ifmfa = DB::table('tbl_ifmfa')
        ->select('ifmfa_level as level', 'ifmfa_code as code')
        ->where('ifmfa_hhid', $hhid)
        ->first();

    // Ability of parents/guardians to solve problems in family and arrive at solutions
    $pfmlol = DB::table('tbl_pfmlol')
        ->select('pfmlol_level as level', 'pfmlol_code as code')
        ->where('pfmlol_hhid', $hhid)
        ->first();

    // Participation/membership in organizations/groups
    $apgsp = DB::table('tbl_apgsp')
        ->select('apgsp_level as level', 'apgsp_code as code')
        ->where('apgsp_hhid', $hhid)
        ->first();

    // Combine all indicators into a single array response
    $data = [
        [
            'indicator' => '1. Involvement of family members in family activities',
            'level' => $ifmfa->level ?? '',
            'code' => $ifmfa->code ?? '',
        ],
        [
            'indicator' => '2. Ability of parents/guardians to solve problems in family and arrive at solutions',
            'level' => $pfmlol->level ?? '',
            'code' => $pfmlol->code ?? '',
        ],
        [
            'indicator' => '3. Participation/membership in organizations/groups (people’s orgs, women’s orgs, cooperatives, etc.)',
            'level' => $apgsp->level ?? '',
            'code' => $apgsp->code ?? '',
        ],
    ];

    return response()->json($data);
}

public function getFamilyAwareness($hhid)
{
    // Awareness of the rights of children
    $arc = DB::table('tbl_arc')
        ->select('arc_level as level', 'arc_code as code')
        ->where('arc_hhid', $hhid)
        ->first();

    // Awareness of gender-based violence
    $agbv = DB::table('tbl_agbv')
        ->select('agbv_level as level', 'agbv_code as code')
        ->where('agbv_hhid', $hhid)
        ->first();

    // Awareness of disaster risk reduction management
    $adrrm = DB::table('tbl_adrrm')
        ->select('adrrm_level as level', 'adrrm_code as code')
        ->where('adrrm_hhid', $hhid)
        ->first();

    // Combine all indicators into one response
    $data = [
        [
            'indicator' => '1. Awareness of the rights of children',
            'level' => $arc->level ?? '',
            'code' => $arc->code ?? '',
        ],
        [
            'indicator' => '2. Awareness of gender-based violence',
            'level' => $agbv->level ?? '',
            'code' => $agbv->code ?? '',
        ],
        [
            'indicator' => '3. Awareness of disaster risk reduction management',
            'level' => $adrrm->level ?? '',
            'code' => $adrrm->code ?? '',
        ],
    ];

    return response()->json($data);
}

public function getSwfeData($hhid)
{
    // Get salary & wages data first (only those that exist)
    $swfeData = DB::table('tbl_swfe')
        ->where('swfe_hhid', $hhid)
        ->select(
            'swfe_swdi_entry_id',
            'swfe_basic_comp_in_cash',
            'swfe_cash_comm',
            'swfe_cash_allowance',
            'swfe_basic_comp_in_kind',
            'swfe_lowb'
        )
        ->get();

    // If no data found, return empty
    if ($swfeData->isEmpty()) {
        return response()->json([]);
    }

    // Get only the members that match those swdi_entry_ids
    $memberIds = $swfeData->pluck('swfe_swdi_entry_id')->toArray();

    $members = DB::table('tbl_sfc')
        ->where('sfc_hhid', $hhid)
        ->whereIn('sfc_swdi_entry_id', $memberIds)
        ->select(
            'sfc_swdi_entry_id',
            DB::raw("CONCAT_WS(' ', sfc_grantee_fname, sfc_grantee_mname, sfc_grantee_lname) as name")
        )
        ->get()
        ->keyBy('sfc_swdi_entry_id');

    // Merge and filter out those with zero/empty values
    $result = $swfeData->map(function ($income) use ($members) {
        $subtotal =
            ($income->swfe_basic_comp_in_cash ?? 0) +
            ($income->swfe_cash_comm ?? 0) +
            ($income->swfe_cash_allowance ?? 0) +
            ($income->swfe_basic_comp_in_kind ?? 0);

        // Skip rows that have all 0 values
        if ($subtotal <= 0) {
            return null;
        }

        return [
            'name' => $members[$income->swfe_swdi_entry_id]->name ?? '(Unnamed Member)',
            'basic_cash' => $income->swfe_basic_comp_in_cash ?? 0,
            'commission' => $income->swfe_cash_comm ?? 0,
            'allowance_cash' => $income->swfe_cash_allowance ?? 0,
            'basic_kind' => $income->swfe_basic_comp_in_kind ?? 0,
            'allowance_kind' => $income->swfe_lowb ?? 0,
            'subtotal' => $subtotal,
        ];
    })
    ->filter() // remove null entries
    ->values(); // reset array keys

    return response()->json($result);
}


public function getifesaData($hhid)
{
    // Fetch all IFESA entries for the given household
    $ifesaData = DB::table('tbl_ifesa')
        ->where('ifesa_hhid', $hhid)
        ->select(
            'id',
            'ifesa_hhid',
            'ifesa_lowb',
            'ic2_activity_1',
            'ic2_type_1',
            'ic2_gross_1',
            'ic2_deduct_1',
            'ic2_activity_2',
            'ic2_type_2',
            'ic2_gross_2',
            'ic2_deduct_2',
            'ic2_activity_3',
            'ic2_type_3',
            'ic2_gross_3',
            'ic2_deduct_3',
            'ic2_activity_4',
            'ic2_type_4',
            'ic2_gross_4',
            'ic2_deduct_4',
            'ic2_activity_5',
            'ic2_type_5',
            'ic2_gross_5',
            'ic2_deduct_5'
        )
        ->first();

    if (!$ifesaData) {
        return response()->json([]);
    }

    // Convert each activity set into an array for front-end table display
    $activities = [];
    for ($i = 1; $i <= 5; $i++) {
        $activity = [
            'activity' => $ifesaData->{'ic2_activity_'.$i} ?? '',
            'type' => $ifesaData->{'ic2_type_'.$i} ?? '',
            'gross' => (float) ($ifesaData->{'ic2_gross_'.$i} ?? 0),
            'deduct' => (float) ($ifesaData->{'ic2_deduct_'.$i} ?? 0),
        ];
        $activity['net'] = $activity['gross'] - $activity['deduct'];

        // Only include non-empty rows
        if (!empty($activity['activity']) || !empty($activity['type']) || $activity['gross'] > 0 || $activity['deduct'] > 0) {
            $activities[] = $activity;
        }
    }

    // Compute subtotal of net income
    $subtotal = array_sum(array_column($activities, 'net'));

    // Return formatted JSON
    return response()->json([
        'household_id' => $ifesaData->ifesa_hhid,
        'lowb' => $ifesaData->ifesa_lowb,
        'activities' => $activities,
        'subtotal' => $subtotal
    ]);
}
public function getOsin($hhid)
{
    $osin = \DB::table('tbl_osin')
        ->where('osin_hhid', $hhid)
        ->select(
            'id',
            'osin_hhid',
            'osin_lowb',
            'osin_pension_cash',
            'osin_pension_in_kind',
            'osin_dividends_cash',
            'osin_dividends_in_kind',
            'osin_imputed_rental_cash',
            'osin_imputed_rental_in_kind',
            'osin_interest_cash',
            'osin_interest_in_kind',
            'osin_other_source_cash',
            'osin_other_source_in_kind',
            'created_at',
            'updated_at'
        )
        ->first();

    if (!$osin) {
        return response()->json(null, 200);
    }

    return response()->json($osin);
}
public function getSoi($hhid)
{
    $soi = \DB::table('tbl_soi')
        ->where('osi_hhid', $hhid)
        ->select(
            'id',
            'osi_hhid',
            'osi_lowb',
            'osi_reciept_in_cash',
            'osi_reciept_in_kind',
            'osi_reciept_subtotal',
            'osi_aid_in_cash',
            'osi_aid_in_kind',
            'osi_subtotal',
            'osi_support',
            'osi_support_in_cash',
            'osi_support_in_kind',
            'osi_support_subtotal',
            'created_at',
            'updated_at'
        )
        ->first();

    return response()->json($soi ?? null, 200);
}



}

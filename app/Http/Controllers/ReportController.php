<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $provinces = DB::table('beneficiaries')
            ->select('province')
            ->whereNotNull('province')
            ->distinct()
            ->orderBy('province')
            ->pluck('province');

        $cities = DB::table('beneficiaries')
            ->select('city_muni', 'barangay')
            ->whereNotNull('city_muni')
            ->whereNotNull('barangay')
            ->get()
            ->groupBy('city_muni')
            ->map(function ($group) {
                return $group->pluck('barangay')->unique()->values();
            });

        $allCities = DB::table('beneficiaries')
            ->select('city_muni')
            ->whereNotNull('city_muni')
            ->distinct()
            ->orderBy('city_muni')
            ->pluck('city_muni');

        $levelCounts = [
            'LEVEL 3' => DB::table('beneficiaries')->where('lowb_y', 'LEVEL 3')->count(),
            'LEVEL 2' => DB::table('beneficiaries')->where('lowb_y', 'LEVEL 2')->count(),
            'LEVEL 1' => DB::table('beneficiaries')->where('lowb_y', 'LEVEL 1')->count(),
        ];
        $locations = DB::table('beneficiaries')
        ->select('province', 'city_muni', 'barangay')
        ->whereNotNull('province')
        ->whereNotNull('city_muni')
        ->whereNotNull('barangay')
        ->get()
        ->groupBy('province')
        ->map(function ($provinceGroup) {
            return $provinceGroup->groupBy('city_muni')->map(function ($cityGroup) {
                return $cityGroup->pluck('barangay')->unique()->values();
            });
        });
        return view('pages.reports', compact('provinces', 'cities', 'levelCounts', 'allCities', 'locations'));

    }
public function export()
{
    // Example logic for exporting reports
    // You can use Laravel Excel, or generate PDF, etc.

    return response()->json(['message' => 'Export logic goes here.']);
}
}

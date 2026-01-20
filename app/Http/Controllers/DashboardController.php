<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $provinces = [
            'DAVAO DEL SUR',
            'DAVAO DEL NORTE',
            'DAVAO ORIENTAL',
            'DAVAO OCCIDENTAL',
            'DAVAO DE ORO'
        ];
        $city = 'DAVAO CITY';

        $totals = [];
        $updated = [];
        $cities = [];
        $levels = [];

        foreach ($provinces as $province) {
            $baseQuery = DB::table('beneficiaries')
                ->where('province', $province)
                ->when($province === 'DAVAO DEL SUR', function ($query) {
                    $query->where('city_muni', '!=', 'DAVAO CITY');
                });

            $totals[$province] = (clone $baseQuery)->count();
            $updated[$province] = (clone $baseQuery)->whereNotNull('updated_at')->count();

            $cities[$province] = (clone $baseQuery)
                ->select('city_muni', DB::raw('COUNT(*) as total'))
                ->whereNotNull('city_muni')
                ->groupBy('city_muni')
                ->pluck('total', 'city_muni')
                ->toArray();

            // Get count of lowb_y per level
            $levels[$province] = (clone $baseQuery)
                ->select('lowb_y', DB::raw('COUNT(*) as count'))
                ->whereNotNull('lowb_y')
                ->groupBy('lowb_y')
                ->pluck('count', 'lowb_y')
                ->toArray();
        }

        // Davao City handled separately
        $cityQuery = DB::table('beneficiaries')->where('city_muni', $city);
        $totals[$city] = $cityQuery->count();
        $updated[$city] = (clone $cityQuery)->whereNotNull('updated_at')->count();
        $cities[$city] = [$city => $cityQuery->count()];

        $levels[$city] = (clone $cityQuery)
            ->select('lowb_y', DB::raw('COUNT(*) as count'))
            ->whereNotNull('lowb_y')
            ->groupBy('lowb_y')
            ->pluck('count', 'lowb_y')
            ->toArray();

        $grandTotal = array_sum($totals);

        return view('dashboard.index', compact(
            'totals',
            'updated',
            'grandTotal',
            'cities',
            'levels'
        ));
    }
}

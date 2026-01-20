<?php

namespace App\Http\Controllers;

use App\Models\NutritionalStatusChild;
use Illuminate\Http\Request;

class NutritionalStatusController extends Controller
{
    public function index()
    {
        return view('pages.tables');
    }

    public function fetchData()
    {
        $children = NutritionalStatusChild::all();
        return response()->json($children);
    }
}
